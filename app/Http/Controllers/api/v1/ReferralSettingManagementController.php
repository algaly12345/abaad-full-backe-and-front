<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\ReferralSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * إدارة إعدادات نظام مكافآت الإحالة (نسبة/قيمة العمولة، نافذة الإحالة،
 * فترة الانتظار قبل الاعتماد التلقائي، الحد الأدنى للسحب).
 *
 * ⚠️ نفس تنبيه SubscriptionSettingManagementController: لا يوجد حاليًا حارس
 * API مخصّص لحساب إداري حقيقي (Admin لا يملك Passport tokens بهذا المشروع)،
 * فهذه المسارات مقيَّدة بصلاحية "referrals.manage-global" التي لا يملكها أي
 * مزود خدمة افتراضيًا (انظر ProviderPermissionsSeeder) إلى أن يُستحدث حارس
 * إداري حقيقي.
 */
class ReferralSettingManagementController extends Controller
{
    public function show(): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data' => ReferralSetting::current(),
        ], 200);
    }

    public function update(Request $request): JsonResponse
    {
        $data = $request->validate([
            'reward_type' => 'required|in:FIXED,PERCENTAGE',
            'reward_value' => 'required|numeric|min:0',
            'attribution_window_days' => 'required|integer|min:1',
            'commission_hold_days' => 'required|integer|min:0',
            'min_payout_limit' => 'required|numeric|min:0',
        ]);

        if ($data['reward_type'] === 'PERCENTAGE' && $data['reward_value'] > 100) {
            return response()->json([
                'status' => 'error',
                'message' => 'نسبة العمولة لا يمكن أن تتجاوز 100%',
            ], 422);
        }

        $settings = ReferralSetting::current();
        $settings->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'تم تحديث إعدادات الإحالة بنجاح',
            'data' => $settings->fresh(),
        ], 200);
    }
}
