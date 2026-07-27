<?php

namespace App\Services;

use App\Models\Commission;
use App\Models\Referral;
use App\Models\ReferralSetting;
use App\Models\ServiceProviderSubscription;
use App\Models\WalletTransaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * منطق مكافأة الإحالة: إنشاء العمولة عند أول دفع ناجح، وإلغاؤها عند
 * استرجاع/إلغاء الاشتراك المرتبط بها. سيناريو أبعاد: 10% من صافي المبلغ
 * المدفوع، أول اشتراك مدفوع فقط لكل مستخدم مُحال.
 */
class ReferralCommissionService
{
    /**
     * يُستدعى بعد تأكيد نجاح الدفع (MoyasarPaymentController::callback).
     */
    public function createCommissionForPaidSubscription(ServiceProviderSubscription $subscription): void
    {
        DB::transaction(function () use ($subscription) {
            // lockForUpdate: لو Moyasar استدعى الـ callback مرتين متزامنتين لنفس
            // الدفعة (إعادة محاولة شبكة، أو تحديث المستخدم للصفحة)، هذا القفل
            // يمنع كلا الطلبين من قراءة نفس حالة PENDING_PAYMENT وإنشاء عمولتين.
            $referral = Referral::where('referred_id', $subscription->user_id)
                ->where('status', 'PENDING_PAYMENT')
                ->lockForUpdate()
                ->first();

            if (!$referral) {
                return;
            }

            // "أول اشتراك فقط": هل يوجد اشتراك آخر مدفوع لنفس المستخدم قبل هذا؟
            $hasEarlierPaidSubscription = ServiceProviderSubscription::where('user_id', $subscription->user_id)
                ->where('payment_status', 'paid')
                ->where('id', '!=', $subscription->id)
                ->exists();

            if ($hasEarlierPaidSubscription) {
                $referral->status = 'REJECTED';
                $referral->save();
                return;
            }

            // لا توجد ضريبة مضافة أو خصم منفصلين على سعر الاشتراك في الكود الحالي
            // (ServiceProviderService::calculatePrice) — subscription->price هو
            // المبلغ الفعلي المدفوع فعليًا لبوابة Moyasar بدون أي تعديل إضافي.
            $paidAmount = (float) $subscription->price;
            $settings = ReferralSetting::current();
            $commissionAmount = $settings->calculateCommission($paidAmount);

            Commission::create([
                'user_id' => $referral->referrer_id,
                'referral_id' => $referral->id,
                'amount' => $commissionAmount,
                'status' => Commission::STATUS_PENDING,
            ]);

            $referral->status = 'COMPLETED';
            $referral->save();
        });
    }

    /**
     * يُستدعى يوميًا من أمر referrals:process-commissions: يعتمد العمولات التي
     * انتهت مدة انتظارها (commission_hold_days) ويضيفها للمحفظة مباشرة، ما لم
     * يكن اشتراك المُحال قد خرج عن حالة "paid" في هذه الأثناء.
     *
     * @return array{approved: int, cancelled: int}
     */
    public function processPendingCommissions(): array
    {
        $settings = ReferralSetting::current();
        $holdDays = $settings->commission_hold_days ?? 14;

        $eligibleIds = Commission::where('status', Commission::STATUS_PENDING)
            ->where('created_at', '<=', now()->subDays($holdDays))
            ->pluck('id');

        $approved = 0;
        $cancelled = 0;

        foreach ($eligibleIds as $commissionId) {
            // معاملة + قفل صف مستقلان لكل عمولة: لو تداخل تشغيلان لنفس الأمر
            // (مثلاً تشغيل يدوي أثناء تشغيل الجدولة التلقائية)، القفل يمنع
            // اعتماد نفس العمولة مرتين أو إضافتها للمحفظة مرتين.
            $result = DB::transaction(function () use ($commissionId) {
                /** @var Commission|null $commission */
                $commission = Commission::where('id', $commissionId)
                    ->where('status', Commission::STATUS_PENDING)
                    ->lockForUpdate()
                    ->first();

                if (!$commission) {
                    // عملية متزامنة أخرى سبقتها لنفس العمولة، أو تغيّرت حالتها.
                    return null;
                }

                $subscription = ServiceProviderSubscription::where('user_id', $commission->referral->referred_id)
                    ->where('payment_status', 'paid')
                    ->latest('id')
                    ->first();

                if (!$subscription) {
                    $commission->status = Commission::STATUS_CANCELLED;
                    $commission->save();
                    return 'cancelled';
                }

                $commission->status = Commission::STATUS_APPROVED;
                $commission->approved_at = now();
                $commission->save();

                $this->creditWallet($commission);

                $commission->status = Commission::STATUS_AVAILABLE;
                $commission->available_at = now();
                $commission->save();

                return 'approved';
            });

            if ($result === 'approved') {
                $approved++;
            } elseif ($result === 'cancelled') {
                $cancelled++;
            }
        }

        return ['approved' => $approved, 'cancelled' => $cancelled];
    }

    private function creditWallet(Commission $commission): void
    {
        $lastBalance = (float) (WalletTransaction::where('user_id', $commission->user_id)
            ->latest('id')
            ->value('balance') ?? 0);

        WalletTransaction::create([
            'user_id' => $commission->user_id,
            'transaction_id' => (string) Str::uuid(),
            'credit' => $commission->amount,
            'debit' => 0,
            'admin_bonus' => 0,
            'balance' => round($lastBalance + $commission->amount, 3),
            'transaction_type' => 'referral_commission',
            'reference' => 'commission:' . $commission->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * يُستدعى عند اكتشاف أن اشتراك مرتبط بعمولة لم يعد مدفوعًا (استرجاع/إلغاء).
     */
    public function cancelCommissionForSubscription(ServiceProviderSubscription $subscription): void
    {
        DB::transaction(function () use ($subscription) {
            $referral = Referral::where('referred_id', $subscription->user_id)
                ->where('status', 'COMPLETED')
                ->first();

            if (!$referral) {
                return;
            }

            /** @var Commission|null $commission */
            $commission = Commission::where('referral_id', $referral->id)
                ->lockForUpdate()
                ->first();

            if (!$commission || $commission->status === Commission::STATUS_WITHDRAWN) {
                // عمولة مسحوبة بالفعل: تحتاج تدخل يدوي، لا نسحب مبلغًا مدفوعًا تلقائيًا.
                return;
            }

            if ($commission->status === Commission::STATUS_CANCELLED) {
                return;
            }

            if ($commission->status === Commission::STATUS_AVAILABLE) {
                $this->reverseWalletCredit($commission);
            }

            $commission->status = Commission::STATUS_CANCELLED;
            $commission->save();
        });
    }

    private function reverseWalletCredit(Commission $commission): void
    {
        $lastBalance = (float) (WalletTransaction::where('user_id', $commission->user_id)
            ->latest('id')
            ->value('balance') ?? 0);

        WalletTransaction::create([
            'user_id' => $commission->user_id,
            'transaction_id' => (string) Str::uuid(),
            'credit' => 0,
            'debit' => $commission->amount,
            'admin_bonus' => 0,
            'balance' => round($lastBalance - $commission->amount, 3),
            'transaction_type' => 'referral_commission_reversal',
            'reference' => 'commission:' . $commission->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
