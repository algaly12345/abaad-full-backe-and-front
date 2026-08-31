<?php

namespace App\Services;

use App\Helpers\Helpers;
use App\Models\Offer;
use App\Models\ServiceProviderSubscription;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * نقطة واحدة لتفعيل اشتراك مزوّد خدمة بعد دفع Moyasar، تستدعيها ثلاث مصادر:
 *   1. MoyasarPaymentController::callback  (تحويل المتصفح — الأسرع للـ UX)
 *   2. MoyasarWebhookController            (إشعار خادم-لخادم — مستقل عن المتصفح)
 *   3. أمر payments:reconcile-moyasar      (مسح دوري — شبكة أمان أخيرة)
 *
 * الهدف: أي عملية خصم ناجحة على Moyasar تنتهي حتمًا بتغيير حالة الاشتراك/العرض
 * إلى "مدفوع/مفعّل"، مهما حدث في المتصفح.
 */
class SubscriptionActivationService
{
    private const MOYASAR_BASE = 'https://api.moyasar.com/v1';

    /**
     * يفعّل الاشتراك انطلاقًا من كائن دفعة Moyasar (كما يرجعه REST API أو
     * حمولة الـ webhook). idempotent تمامًا: الاستدعاء المتكرّر لنفس الدفعة
     * لا يغيّر شيئًا ولا يُنشئ عمولة مكرّرة.
     *
     * @param  array<string,mixed>  $payment  كائن الدفعة من Moyasar
     * @return bool  true إذا كان الاشتراك مفعّلًا الآن (سواء فعّلناه للتو أو كان مفعّلًا)
     */
    public function activateFromPayment(ServiceProviderSubscription $subscription, array $payment): bool
    {
        // خروج سريع للحالة الشائعة (مفعّل مسبقًا) دون قفل صف.
        if ($subscription->payment_status === 'paid') {
            return true;
        }

        $isPaid        = ($payment['status'] ?? null) === 'paid';
        $matchesNumber = ($payment['metadata']['subscription_number'] ?? null) === $subscription->subscription_number;
        $matchesAmount = (int) ($payment['amount'] ?? 0) === (int) round(((float) $subscription->price) * 100);

        if (! ($isPaid && $matchesNumber && $matchesAmount)) {
            Log::warning('Moyasar activation rejected', [
                'subscription_id'     => $subscription->id,
                'subscription_number' => $subscription->subscription_number,
                'payment_id'          => $payment['id'] ?? null,
                'payment_status'      => $payment['status'] ?? null,
                'is_paid'             => $isPaid,
                'matches_number'      => $matchesNumber,
                'matches_amount'      => $matchesAmount,
                'moyasar_amount'      => $payment['amount'] ?? null,
                'expected_amount'     => (int) round(((float) $subscription->price) * 100),
            ]);

            return false;
        }

        return DB::transaction(function () use ($subscription, $payment) {
            // إعادة الجلب مع قفل الصف ثم إعادة الفحص: لو وصل callback و webhook
            // (أو أمر المطابقة) لنفس الدفعة في نفس اللحظة، لا يدخل جسم التفعيل
            // إلا واحد منهما.
            $fresh = ServiceProviderSubscription::whereKey($subscription->getKey())
                ->lockForUpdate()
                ->first();

            if (! $fresh || $fresh->payment_status === 'paid') {
                return true;
            }

            $fresh->payment_status     = 'paid';
            $fresh->subscription_status = 'active';
            $fresh->moyasar_payment_id = $payment['id'] ?? null;
            $fresh->save();

            // الحساب أصبح مزوّد خدمة منذ إرسال بيانات "إضافة خدمة" — يبقى فقط
            // تفعيل العرض نفسه بعد تأكّد الدفع. fetch+save (لا mass update) حتى
            // يمرّ التغيير عبر OfferObserver.
            if ($fresh->offer_id) {
                $offer = Offer::find($fresh->offer_id);
                if ($offer) {
                    $offer->status = 'accept';
                    $offer->save();
                }
            }

            // idempotent داخليًا: يقفل الإحالة ويتحقق أنها PENDING_PAYMENT، فلا
            // يُنشئ عمولة ثانية عند الاستدعاء المتكرّر.
            (new ReferralCommissionService())->createCommissionForPaidSubscription($fresh);

            Log::info('Provider subscription activated', [
                'subscription_id'     => $fresh->id,
                'subscription_number' => $fresh->subscription_number,
                'payment_id'          => $fresh->moyasar_payment_id,
            ]);

            return true;
        });
    }

    /**
     * يُعلّم الاشتراك "فشل الدفع" — يُطلق ServiceProviderSubscriptionObserver
     * فيُرسل إشعار "لم تكتمل عملية دفع اشتراكك، حاول مرة أخرى" ويُلغي عمولة
     * الإحالة المعلّقة. idempotent: لا يُعيد الإرسال إن كان failed مسبقًا،
     * ولا يلمس اشتراكًا مدفوعًا مؤكّدًا.
     */
    public function markFailed(ServiceProviderSubscription $subscription, ?string $paymentId = null): void
    {
        if (in_array($subscription->payment_status, ['paid', 'failed'], true)) {
            return;
        }

        $subscription->payment_status = 'failed';
        if ($paymentId) {
            $subscription->moyasar_payment_id = $paymentId;
        }
        $subscription->save();

        Log::info('Provider subscription marked failed', [
            'subscription_id'     => $subscription->id,
            'subscription_number' => $subscription->subscription_number,
            'payment_id'          => $paymentId,
        ]);
    }

    /**
     * يجلب دفعة واحدة من Moyasar بالمعرّف. يرجع null إذا تعذّر التحقق الآن
     * (مفتاح ناقص أو استجابة غير ناجحة) — لا نعتبرها "فشل دفع".
     *
     * @return array<string,mixed>|null
     */
    public function fetchPayment(string $paymentId): ?array
    {
        $secret = $this->secretKey();
        if (empty($secret)) {
            Log::error('Moyasar secret key missing in business_settings (moyasar_secret_key)');
            return null;
        }

        $response = Http::withBasicAuth($secret, '')
            ->timeout(15)
            ->get(self::MOYASAR_BASE . "/payments/{$paymentId}");

        if (! $response->ok()) {
            Log::error('Moyasar fetch payment failed', [
                'payment_id' => $paymentId,
                'status'     => $response->status(),
                'body'       => mb_substr($response->body(), 0, 500),
            ]);
            return null;
        }

        return $response->json();
    }

    /**
     * صفحة واحدة من قائمة دفعات Moyasar (الأحدث أولًا). يستخدمها أمر المطابقة.
     * null = تعذّر الوصول لـ Moyasar (مفتاح ناقص/استجابة غير ناجحة) — مهم
     * لتمييزها عن [] (لا دفعات) حتى لا يُعلَّم اشتراك فاشلًا بالخطأ.
     *
     * @return array<int,array<string,mixed>>|null
     */
    public function listRecentPayments(int $page = 1): ?array
    {
        $secret = $this->secretKey();
        if (empty($secret)) {
            Log::error('Moyasar secret key missing — cannot reconcile');
            return null;
        }

        $response = Http::withBasicAuth($secret, '')
            ->timeout(20)
            ->get(self::MOYASAR_BASE . '/payments', ['page' => $page]);

        if (! $response->ok()) {
            Log::error('Moyasar list payments failed', [
                'page'   => $page,
                'status' => $response->status(),
            ]);
            return null;
        }

        return $response->json('payments', []);
    }

    /**
     * المفتاح السري يُقرأ من business_settings أولًا (نفس منطق باقي التكامل)،
     * ثم يسقط على config('services.moyasar.secret_key') أي .env كخيار احتياط.
     */
    public function secretKey(): ?string
    {
        $fromSettings = Helpers::get_business_settings('moyasar_secret_key');
        if (! empty($fromSettings)) {
            return $fromSettings;
        }

        return config('services.moyasar.secret_key') ?: null;
    }
}
