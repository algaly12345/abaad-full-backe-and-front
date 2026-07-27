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

class ServiceCatalogController extends Controller
{
    private const AUTH_GUARD = 'api';

    public function __construct(
        private readonly ServiceCatalogService $serviceCatalogService
    ) {
    }

    public function index(GetServicesRequest $request): JsonResponse
    {
        $filters = $request->validated();

        $filters['only_active'] = $request->user(self::AUTH_GUARD)
            ? $request->boolean('only_active', true)
            : true;

        $services = $this->serviceCatalogService->list($filters);

        return $this->paginatedResponse($services);
    }

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

    public function filtersData(): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data'   => $this->serviceCatalogService->filtersData(),
        ], 200);
    }

    /**
     * يسمح لمالك الخدمة فقط (offer_owner، بما يشمل التوافق مع الاتفاقية
     * القديمة offer_owner='me' عبر isOwnedBy()) بتفعيلها/إيقافها مؤقتًا.
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

        if (!$offer->isOwnedBy($user)) {
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