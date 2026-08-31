<?php

namespace App\Console\Commands;

use App\Models\ServiceProviderSubscription;
use App\Services\SubscriptionActivationService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

/**
 * شبكة الأمان الأخيرة لدفع اشتراكات المزوّدين، مجدولة كل 5 دقائق في
 * App\Console\Kernel. تعمل على مرحلتين:
 *
 *  1) تفعيل: تمسح دفعات Moyasar الأخيرة وتطابقها بالاشتراكات unpaid عبر
 *     metadata.subscription_number، فتفعّل أي اشتراك خُصم ثمنه فعلًا وفاته
 *     كلٌّ من callback و webhook.
 *
 *  2) كنس المهلة: أي اشتراك بقي unpaid وتجاوز عمرُه مهلة الدفع (رابط الدفع
 *     صالح ساعتين) = فشل أو تُرك — تُعلّمه failed، ما يُطلق
 *     ServiceProviderSubscriptionObserver فيُرسل إشعار "لم يتم الدفع".
 *
 * المرحلتان لا تعملان إطلاقًا إن تعذّر الوصول إلى Moyasar (listRecentPayments
 * أرجعت null)، حتى لا يُعلَّم اشتراك مدفوع فاشلًا لمجرد أن الـ API معطّل.
 */
class ReconcileMoyasarPayments extends Command
{
    protected $signature = 'payments:reconcile-moyasar
        {--hours=48 : كم ساعة للخلف نمسح دفعات Moyasar}
        {--pages=6 : أقصى عدد صفحات من قائمة دفعات Moyasar نمسحها}
        {--stale-minutes=180 : بعد كم دقيقة يُعتبر اشتراك unpaid فاشلًا/متروكًا}';

    protected $description = 'تفعيل اشتراكات المزوّدين المدفوعة غير المؤكَّدة، وتعليم غير المدفوعة المنتهية مهلتها فاشلة (مع إشعار).';

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
        $moyasarReachable = true;

        for ($page = 1; $page <= $maxPages; $page++) {
            $payments = $activation->listRecentPayments($page);

            if ($payments === null) {
                // تعذّر الوصول إلى Moyasar — نوقف كل شيء ولا نكنس المهلة.
                $moyasarReachable = false;
                $this->warn('تعذّر الوصول إلى Moyasar — تخطّي هذه الدورة.');
                break;
            }

            if ($payments === []) {
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
                    $pending->forget($subNumber);
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

        $failed = 0;

        if ($moyasarReachable) {
            // ما تبقّى unpaid وعمره تجاوز المهلة = فشل/تُرك. لو كان مدفوعًا فعلًا
            // لكان فُعّل في المرحلة الأولى (نمسح 48 ساعة). markFailed idempotent
            // ولا يلمس اشتراكًا صار paid.
            $staleBefore = now()->subMinutes((int) $this->option('stale-minutes'));

            foreach ($pending as $subNumber => $subscription) {
                if (Carbon::parse($subscription->created_at)->gt($staleBefore)) {
                    continue; // لا يزال ضمن مهلة الدفع
                }

                $activation->markFailed($subscription);
                $failed++;
                $this->line("  ✗ علّم فاشلًا (انتهت المهلة) {$subNumber}");
            }
        }

        $this->info("تمّ. فُعّل {$activated} اشتراك، وعُلّم {$failed} فاشلًا.");
        return self::SUCCESS;
    }
}
