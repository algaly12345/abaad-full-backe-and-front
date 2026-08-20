<?php

namespace App\Observers;

use App\Models\ServiceProviderSubscription;
use App\Services\ProviderPushNotifier;
use App\Services\ReferralCommissionService;

/**
 * إلغاء عمولة الإحالة تلقائيًا إذا خرج اشتراك المُحال عن حالة "paid" (استرجاع
 * أو إلغاء) بعد أن كان قد وُلِّدت له عمولة. نفس تنبيه UserObserver ينطبق هنا:
 * لا يُطلق هذا الـ Observer عند تحديثات DB::table() الخام.
 */
class ServiceProviderSubscriptionObserver
{
    public function updated(ServiceProviderSubscription $subscription): void
    {
        if (!$subscription->wasChanged('payment_status')) {
            return;
        }

        $this->notifyPaymentStatus($subscription);

        if ($subscription->payment_status === 'paid') {
            return;
        }

        (new ReferralCommissionService())->cancelCommissionForSubscription($subscription);
    }

    private function notifyPaymentStatus(ServiceProviderSubscription $subscription): void
    {
        if ($subscription->payment_status === 'paid') {
            ProviderPushNotifier::notify(
                $subscription->user,
                'subscription_status',
                'تم تفعيل اشتراكك',
                'تم الدفع بنجاح وتفعيل اشتراكك.',
                $subscription->offer_id
            );
        } elseif ($subscription->payment_status === 'failed') {
            ProviderPushNotifier::notify(
                $subscription->user,
                'subscription_status',
                'فشلت عملية الدفع',
                'لم تكتمل عملية دفع اشتراكك، حاول مرة أخرى.',
                $subscription->offer_id
            );
        }
    }
}
