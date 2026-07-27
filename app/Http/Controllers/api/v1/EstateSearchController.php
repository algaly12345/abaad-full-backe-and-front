<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\GetEstatesRequest;
use App\Http\Resources\EstateResource;
use App\Services\EstateCatalogService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;

/**
 * نقطة دخول API جديدة ومُحسَّنة لتصفح/بحث العقارات (Pagination حقيقي + فلترة
 * + بحث + كاش)، موازية لمسارات app\Helpers\EstateLogic القديمة (لا تستبدلها
 * ولا تتقاطع معها). راجع تعليق EstateCatalogService لتفاصيل سبب الإنشاء بدل
 * التعديل المباشر على الكود القديم.
 *
 * مفتوحة بدون تسجيل دخول، بنفس فلسفة مسارات "estate/get-estate" القديمة،
 * لأن تصفح العقارات المفعّلة فعل عام في كل التطبيق الحالي.
 */
class EstateSearchController extends Controller
{
    public function __construct(
        private readonly EstateCatalogService $estateCatalogService
    ) {
    }

    public function index(GetEstatesRequest $request): JsonResponse
    {
        $estates = $this->estateCatalogService->list($request->validated());

        return $this->paginatedResponse($estates);
    }

    public function show(int $id): JsonResponse
    {
        $estate = $this->estateCatalogService->find($id);

        if (!$estate) {
            return response()->json([
                'status' => 'error',
                'message' => 'العقار غير موجود أو غير متاح',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => new EstateResource($estate),
        ], 200);
    }

    private function paginatedResponse(LengthAwarePaginator $estates): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'total_size' => $estates->total(),
            'limit' => $estates->perPage(),
            'current_page' => $estates->currentPage(),
            'last_page' => $estates->lastPage(),
            'data' => EstateResource::collection($estates->items()),
        ], 200);
    }
}
