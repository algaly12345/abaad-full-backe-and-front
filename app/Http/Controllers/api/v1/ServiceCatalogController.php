<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\GetServicesRequest;
use App\Http\Resources\ServiceOfferResource;
use App\Models\Offer;
use App\Services\ServiceCatalogService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * كنترولر "كتالوج الخدمات داخل العقارات" — جلب عام، مفلتر (بما فيه فلتر مزود الخدمة)،
 * مرقّم صفحات، ومخزّن كاش + لوحة "خدماتي" الخاصة بمقدّم الخدمة المسجّل دخوله.
 *
 * ⚠️ الحارس المستخدم هنا هو 'api' (مثل Laravel Passport)، وهو الافتراض الأكثر شيوعًا في
 * هذا النوع من المشاريع. إن كان مشروعك يستخدم حارسًا مختلفًا (مثل 'sanctum') فاستبدل
 * 'api' في كل استدعاءات $request->user('api') أدناه + في ملف الراوتس (auth:api).
 */
class ServiceCatalogController extends Controller
{
    private const AUTH_GUARD = 'api';

    public function __construct(
        private readonly ServiceCatalogService $serviceCatalogService
    ) {
    }

    /**
     * GET /api/v1/services
     * يدعم: category_id, zone_id, service_type_id, provider_id, offer_type, min_price,
     *       max_price, min_discount, max_discount, search, sort_by, only_active,
     *       per_page, page
     */
    public function index(GetServicesRequest $request): JsonResponse
    {
        $filters = $request->validated();

        // only_active=0 يسمح برؤية العروض غير المعتمدة/المنتهية — نسمح بذلك فقط لمستخدم
        // مسجّل دخوله (استخدام إداري)، أما الزوار فيُفرض عليهم العرض المعتمد دائمًا.
        $filters['only_active'] = $request->user(self::AUTH_GUARD)
            ? $request->boolean('only_active', true)
            : true;

        $services = $this->serviceCatalogService->list($filters);

        return $this->paginatedResponse($services);
    }

    /**
     * GET /api/v1/services/my-services (محمي بـ auth:api)
     * يعرض لمقدّم الخدمة المسجّل دخوله كل خدماته الخاصة بجميع حالاتها:
     * accept (نشطة) / pending (قيد المراجعة) / cancelled (ملغية أو منتهية من الإدارة).
     * تتجاهل هذه الدالة قيمة only_active المرسلة من العميل عمدًا.
     */
    public function myServices(GetServicesRequest $request): JsonResponse
    {
        $user = $request->user(self::AUTH_GUARD);

        if (!$user) {
            return response()->json([
                'status'  => 'error',
                'message' => 'يجب تسجيل الدخول لعرض خدماتك',
            ], 401);
        }

        $filters = $request->validated();
        $filters['owner_id'] = $user->id;
        $filters['only_active'] = false;

        $services = $this->serviceCatalogService->list($filters);

        return $this->paginatedResponse($services);
    }

    /**
     * GET /api/v1/services/{id}
     */
    public function show(int $id): JsonResponse
    {
        $service = $this->serviceCatalogService->find($id);

        if (!$service) {
            return response()->json([
                'status'  => 'error',
                'message' => 'الخدمة غير موجودة أو غير متاحة',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data'   => new ServiceOfferResource($service),
        ], 200);
    }

    /**
     * GET /api/v1/services/filters
     * بيانات بناء واجهة الفلترة: الأقسام، المناطق، أنواع الخدمات، مزودو الخدمة، ونطاق السعر.
     */
    public function filtersData(): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data'   => $this->serviceCatalogService->filtersData(),
        ], 200);
    }

    /**
     * POST /api/v1/services/{id}/toggle-status (محمي بـ auth:api)
     * يسمح لمالك الخدمة فقط (offer_owner) بتفعيلها/إيقافها مؤقتًا (accept <-> pending).
     * لا يمكن للمزود إعادة تفعيل خدمة ألغتها الإدارة (status = cancelled).
     */
    public function toggleStatus(int $id, Request $request): JsonResponse
    {
        $user = $request->user(self::AUTH_GUARD);

        if (!$user) {
            return response()->json([
                'status'  => 'error',
                'message' => 'يجب تسجيل الدخول',
            ], 401);
        }

        $offer = Offer::query()->find($id);

        if (!$offer) {
            return response()->json([
                'status'  => 'error',
                'message' => 'الخدمة غير موجودة',
            ], 404);
        }

        if ((int) $offer->offer_owner !== (int) $user->id) {
            return response()->json([
                'status'  => 'error',
                'message' => 'غير مصرح لك بتعديل هذه الخدمة',
            ], 403);
        }

        if ($offer->status === 'cancelled') {
            return response()->json([
                'status'  => 'error',
                'message' => 'لا يمكن تفعيل خدمة ملغاة من قِبل الإدارة',
            ], 422);
        }

        $offer->status = $offer->status === 'accept' ? 'pending' : 'accept';
        $offer->save();

        ServiceCatalogService::flushCache();

        return response()->json([
            'status'  => 'success',
            'message' => $offer->status === 'accept' ? 'تم تفعيل الخدمة بنجاح' : 'تم إيقاف الخدمة مؤقتًا',
            'data'    => [
                'id'     => $offer->id,
                'status' => $offer->status,
            ],
        ], 200);
    }

    private function paginatedResponse(LengthAwarePaginator $services): JsonResponse
    {
        return response()->json([
            'status'       => 'success',
            'total_size'   => $services->total(),
            'limit'        => $services->perPage(),
            'current_page' => $services->currentPage(),
            'last_page'    => $services->lastPage(),
            'data' => ServiceOfferResource::collection($services->items()),
        ], 200);
    }
}