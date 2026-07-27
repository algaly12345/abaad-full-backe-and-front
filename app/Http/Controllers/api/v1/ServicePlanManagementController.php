<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreServicePlanRequest;
use App\Http\Requests\Api\UpdateServicePlanRequest;
use App\Models\ServicePlan;
use Illuminate\Http\JsonResponse;

/**
 * إدارة باقات اشتراك مزودي الخدمة (CRUD) عبر API.
 *
 * ⚠️ ملاحظة مهمة: لا يوجد حاليًا حارس API مخصّص للإدارة (الإدارة تستخدم
 * guard='admin' بجلسة الويب فقط، لا Passport). لذلك قيّدت هذه العمليات بـ
 * provider.api كأقرب صلاحية مرتفعة متاحة على API. عمليًا هذا يعني أن أي
 * مزود خدمة (user_type=provider) يستطيع حاليًا إدارة الباقات، وهو ليس مثاليًا
 * للإنتاج. لتقييدها فعليًا للإدارة فقط عبر API يلزم أولًا تفعيل Passport على
 * موديل Admin — وهذا خارج نطاق هذه المهمة.
 */
class ServicePlanManagementController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data'   => ServicePlan::orderBy('price')->get(),
        ], 200);
    }

    public function show(int $id): JsonResponse
    {
        $plan = ServicePlan::find($id);

        if (!$plan) {
            return response()->json([
                'status'  => 'error',
                'message' => 'الباقة غير موجودة',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data'   => $plan,
        ], 200);
    }

    public function store(StoreServicePlanRequest $request): JsonResponse
    {
        $plan = ServicePlan::create($request->validated());

        return response()->json([
            'status'  => 'success',
            'message' => 'تم إنشاء الباقة بنجاح',
            'data'    => $plan,
        ], 201);
    }

    public function update(UpdateServicePlanRequest $request, int $id): JsonResponse
    {
        $plan = ServicePlan::find($id);

        if (!$plan) {
            return response()->json([
                'status'  => 'error',
                'message' => 'الباقة غير موجودة',
            ], 404);
        }

        $plan->update($request->validated());

        return response()->json([
            'status'  => 'success',
            'message' => 'تم تعديل الباقة بنجاح',
            'data'    => $plan,
        ], 200);
    }

    public function destroy(int $id): JsonResponse
    {
        $plan = ServicePlan::find($id);

        if (!$plan) {
            return response()->json([
                'status'  => 'error',
                'message' => 'الباقة غير موجودة',
            ], 404);
        }

        $plan->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'تم حذف الباقة بنجاح',
        ], 200);
    }
}