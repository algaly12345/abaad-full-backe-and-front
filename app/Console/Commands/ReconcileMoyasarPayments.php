<?php

namespace App\Console\Commands;

use App\Models\ServiceProviderSubscription;
use App\Services\SubscriptionActivationService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

/**
 * شبكة الأمان الأخيرة: لو فات كلٌّ من تحويل المتصفح (callback) وإشعار الـ
 * webhook، يمسح هذا الأمر دفعات Moyasar الأخيرة ويطابقها بالاشتراكات غير
 * المدفوعة عبر metadata.subscription_number، فيفعّل أي اشتراك خُصم ثمنه فعلًا.
 *
 * مجدول كل 5 دقائق في App\Console\Kernel.
 */
class ReconcileMoyasarPayments extends Command
{
    protected $signature = 'payments:reconcile-moyasar
        {--hours=48 : كم ساعة للخلف نمسح دفعات Moyasar}
        {--pages=6 : أقصى عدد صفحات من قائمة دفعات Moyasar نمسحها}';

    protected $description = 'تفعيل اشتراكات المزوّدين التي نجح دفعها في Moyasar ولم يُؤكَّد (webhook + callback فاتا).';

    public function handle(SubscriptionActivationService $activation): int
    {
        $pending = ServiceProviderSubscription::where('payment_status', 'unpaid')
            ->where('created_at', '>=', now()->subDays(3))
            ->get()
            ->keyBy('subscription_number');

        if ($pending->isEmpty()) {
            $this->info('لا اشتراكات معلّقة للمطابقة.');
            return self::SUCCESS;
        }

        $this->info($pending->count() . ' اشتراك معلّق — جارٍ مسح دفعات Moyasar…');

        $cutoff   = now()->subHours((int) $this->option('hours'));
        $maxPages = (int) $this->option('pages');
        $activated = 0;

        for ($page = 1; $page <= $maxPages; $page++) {
            $payments = $activation->listRecentPayments($page);
            if (empty($payments)) {
                break;
            }

            $reachedCutoff = false;

            foreach ($payments as $payment) {
                $createdAt = isset($payment['created_at']) ? Carbon::parse($payment['created_at']) : null;
                if ($createdAt && $createdAt->lt($cutoff)) {
                    $reachedCutoff = true;
                    continue;
                }

                if (($payment['status'] ?? null) !== 'paid') {
                    continue;
                }

                $subNumber = $payment['metadata']['subscription_number'] ?? null;
                if (! $subNumber || ! $pending->has($subNumber)) {
                    continue;
                }

                if ($activation->activateFromPayment($pending->get($subNumber), $payment)) {
                    $activated++;
                    $this->line("  ✓ فُعّل {$subNumber} (دفعة {$payment['id']})");
                    Log::info('Reconcile activated subscription', [
                        'sub'        => $subNumber,
                        'payment_id' => $payment['id'],
                    ]);
                }
            }

            if ($reachedCutoff) {
                break;
            }
        }

        $this->info("تمّ. فُعّل {$activated} اشتراك.");
        return self::SUCCESS;
    }
}
