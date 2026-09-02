<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionDurationDiscount;
use App\Models\SubscriptionPricingSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * إدارة إعدادات تسعير اشتراك مزوّد الخدمة (99 ريال أساسي + 49 لكل منطقة/نوع
 * إضافي) ونسب الخصم حسب المدة — تحل محل ServicePlanManagementController
 * القديمة (نظام الباقات الثلاث الثابتة، مُستبدَل بالكامل).
 *
 * ⚠️ نفس تنبيه ServicePlanManagementController القديمة: لا يوجد حاليًا حارس
 * API مخصّص للإدارة الحقيقية (Admin لا يملك Passport tokens بهذا المشروع)،
 * فهذه المسارات مقيَّدة بصلاحية "plans.manage-global" التي لا يملكها أي مزود
 * خدمة افتراضيًا (انظر ProviderPermissionsSeeder) إلى أن يُستحدث حارس إداري
 * حقيقي. لوحة تحكم الأدمن (Dashboard\SubscriptionPricingSettingController)
 * هي الطريقة الفعلية المتاحة حاليًا لتعديل هذه الإعدادات.
 */
class SubscriptionSettingManagementController extends Controller
{
    public function show(): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data' => [
                'pricing_settings' => SubscriptionPricingSetting::current(),
                'duration_discounts' => SubscriptionDurationDiscount::orderBy('duration_months')->get(),
            ],
        ], 200);
    }

    public function updatePricing(Request $request): JsonResponse
    {
        $data = $request->validate([
            'base_price' => 'required|numeric|min:0',
            'included_zones' => 'required|integer|min:0',
            'included_categories' => 'required|integer|min:0',
            'extra_zone_price' => 'required|numeric|min:0',
            'extra_category_price' => 'required|numeric|min:0',
            'vat_percent' => 'sometimes|numeric|min:0|max:100',
        ]);

        $settings = SubscriptionPricingSetting::current();
        $settings->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'تم تحديث إعدادات التسعير بنجاح',
            'data' => $settings->fresh(),
        ], 200);
    }

    public function updateDiscounts(Request $request): JsonResponse
    {
        $data = $request->validate([
            'discounts' => 'required|array|min:1',
            'discounts.*.duration_months' => 'required|integer|in:1,3,6,12',
            'discounts.*.discount_percent' => 'required|integer|min:0|max:100',
        ]);

        foreach ($data['discounts'] as $row) {
            SubscriptionDurationDiscount::updateOrCreate(
                ['duration_months' => $row['duration_months']],
                ['discount_percent' => $row['discount_percent']]
            );
        }

        return response()->json([
            'status' => 'success',
            'message' => 'تم تحديث نسب الخصم بنجاح',
            'data' => SubscriptionDurationDiscount::orderBy('duration_months')->get(),
        ], 200);
    }
}
