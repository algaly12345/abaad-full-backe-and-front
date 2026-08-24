<?php

namespace App\Http\Controllers\api\v1\admin;

use App\Enums\ProviderApprovalStatus;
use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\User;

/**
 * مراجعة/اعتماد طلبات "الترقية إلى مزوّد خدمة" (بعد نجاح أول دفعة اشتراك —
 * راجع MoyasarPaymentController::callback الذي يضبط approval_status=pending).
 * approve() هو المكان الوحيد الذي يُفعِّل user_type=provider لعميل جديد في
 * المسار الجديد (Flutter+API)؛ يُستخدم $user->update() لا DB::table() حتى
 * يمر التغيير عبر Eloquent فيُطلق UserObserver الذي يُسنِد دور
 * ProviderRole::PROVIDER تلقائيًا.
 */
class AdminProviderController extends Controller
{
    public function statuses()
    {
        $statuses = collect(ProviderApprovalStatus::LIST)->map(fn ($value) => [
            'value' => $value,
            'label' => ProviderApprovalStatus::LABELS[$value],
        ])->values();

        return response()->json([
            'success' => true,
            'data' => $statuses,
        ]);
    }

    /**
     * قائمة طلبات مزوّدي الخدمة قيد المراجعة (ينتظرون قرار الأدمن).
     */
    public function pending()
    {
        $users = User::query()
            ->whereHas('provider', function ($q) {
                $q->where('approval_status', ProviderApprovalStatus::PENDING);
            })
            ->with('provider')
            ->orderByDesc('id')
            ->get(['id', 'name', 'phone', 'email', 'user_type', 'created_at']);

        return response()->json([
            'success' => true,
            'data' => $users,
        ]);
    }

    public function approve(User $user)
    {
        $provider = $user->provider;

        if (! $provider) {
            return response()->json([
                'success' => false,
                'message' => 'هذا المستخدم لم يقدّم طلب مزوّد خدمة',
            ], 404);
        }

        if ($provider->approval_status !== ProviderApprovalStatus::PENDING) {
            return response()->json([
                'success' => false,
                'message' => 'هذا الطلب ليس قيد المراجعة حاليًا',
            ], 422);
        }

        $provider->update(['approval_status' => ProviderApprovalStatus::APPROVED]);
        $user->update(['user_type' => 'provider']);
        $this->releasePendingOffers($user, 'accept');

        return response()->json([
            'success' => true,
            'message' => 'تم اعتماد مزوّد الخدمة بنجاح',
            'data' => [
                'id' => $user->id,
                'user_type' => $user->user_type,
                'approval_status' => $provider->approval_status,
            ],
        ]);
    }

    public function reject(User $user)
    {
        $provider = $user->provider;

        if (! $provider) {
            return response()->json([
                'success' => false,
                'message' => 'هذا المستخدم لم يقدّم طلب مزوّد خدمة',
            ], 404);
        }

        if ($provider->approval_status !== ProviderApprovalStatus::PENDING) {
            return response()->json([
                'success' => false,
                'message' => 'هذا الطلب ليس قيد المراجعة حاليًا',
            ], 422);
        }

        $provider->update(['approval_status' => ProviderApprovalStatus::REJECTED]);
        $this->releasePendingOffers($user, 'rejected');

        return response()->json([
            'success' => true,
            'message' => 'تم رفض طلب مزوّد الخدمة',
            'data' => [
                'id' => $user->id,
                'approval_status' => $provider->approval_status,
            ],
        ]);
    }

    /**
     * يحوّل عرض المزوّد الذي بقي 'pending' بانتظار هذا القرار (راجع
     * MoyasarPaymentController::callback الذي يتركه 'pending' لمزوّد غير
     * معتمَد بدل تفعيله فورًا) إلى حالته النهائية بعد اعتماد/رفض الأدمن.
     * fetch+save بدل mass update حتى يمر التغيير عبر Eloquent فيُطلق
     * OfferObserver (يُبطل كاش الكتالوج + إشعار Push للمزوّد).
     */
    private function releasePendingOffers(User $user, string $newStatus): void
    {
        $offerIds = $user->subscriptions()
            ->where('payment_status', 'paid')
            ->whereNotNull('offer_id')
            ->pluck('offer_id');

        Offer::whereIn('id', $offerIds)
            ->where('status', 'pending')
            ->each(function (Offer $offer) use ($newStatus) {
                $offer->status = $newStatus;
                $offer->save();
            });
    }
}
