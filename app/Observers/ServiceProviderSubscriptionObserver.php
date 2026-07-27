<?php

namespace App\Observers;

use App\Models\ServiceProviderSubscription;
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

        if ($subscription->payment_status === 'paid') {
            return;
        }

        (new ReferralCommissionService())->cancelCommissionForSubscription($subscription);
    }
}
