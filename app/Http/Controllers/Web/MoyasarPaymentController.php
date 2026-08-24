<?php

namespace App\Http\Controllers\Web;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\ServiceProviderSubscription;
use App\Services\ReferralCommissionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;

class MoyasarPaymentController extends Controller
{
    /**
     * صفحة إدخال بيانات البطاقة — هذا الرابط هو ما يفتحه WebView في التطبيق.
     * محمي بـ middleware('signed') وليس بتوكن، لأن WebView لا يرسل
     * هيدر Authorization بسهولة عند تحميل صفحة عادية.
     */
    public function show(Request $request, ServiceProviderSubscription $subscription)
    {
        $amount = (float) $subscription->price;

        $callbackUrl = URL::temporarySignedRoute(
            'payment.provider-subscription.callback',
            now()->addHours(2),
            ['subscription' => $subscription->id]
        );

        return view('payments.provider-subscription', [
            'subscription'  => $subscription,
            'amount'        => $amount,
            'amountHalalas' => (int) round($amount * 100), // Moyasar يطلب المبلغ بالهللة
            'publicKey'     => $this->publicKey(),
            'callbackUrl'   => $callbackUrl,
        ]);
    }

    /**
     * Moyasar يحوّل المتصفح إلى هذا الرابط تلقائياً بعد إتمام/فشل الدفع.
     * نتحقق من السيرفر مباشرة (server-to-server) — لا نثق بأي query
     * param قادم من الرابط نفسه لأنه قابل للتلاعب من جهة العميل.
     */
    public function callback(Request $request, ServiceProviderSubscription $subscription)
    {
        $paymentId = $request->query('id');

        if (! $paymentId) {
            return view('payments.result', [
                'success' => false,
                'message' => 'لم يتم استلام معرف العملية من بوابة الدفع',
            ]);
        }

        $response = Http::withBasicAuth($this->secretKey(), '')
            ->get("https://api.moyasar.com/v1/payments/{$paymentId}");

        if (! $response->ok()) {
            Log::error('Moyasar verify failed', [
                'subscription_id' => $subscription->id,
                'response' => $response->body(),
            ]);

            return view('payments.result', [
                'success' => false,
                'message' => 'تعذر التحقق من حالة الدفع، حاول مرة أخرى',
            ]);
        }

        $payment = $response->json();

        $matchedSubscriptionNumber = $payment['metadata']['subscription_number'] ?? null;
        $isCorrectSubscription = $matchedSubscriptionNumber === $subscription->subscription_number;
        $isPaid = ($payment['status'] ?? null) === 'paid';
        $amountMatches = (int) ($payment['amount'] ?? 0) === (int) round($subscription->price * 100);

        if ($isPaid && $isCorrectSubscription && $amountMatches) {
            $subscription->payment_status = 'paid';
            $subscription->subscription_status = 'active';
            $subscription->save();

            $provider = $subscription->user?->provider;
            $isAlreadyApproved = $provider
                && $provider->approval_status === \App\Enums\ProviderApprovalStatus::APPROVED;

            if ($subscription->offer_id) {
                // fetch+save بدل mass update عبر query builder، حتى يمر التغيير عبر
                // save() ويُطلق OfferObserver (mass update لا يُطلق أحداث Eloquent إطلاقًا).
                $offer = Offer::find($subscription->offer_id);
                if ($offer) {
                    // مزوّد معتمَد سلفاً: عرضه الجديد يُفعَّل فورًا كسابقيه.
                    // مزوّد جديد/قيد المراجعة: يبقى العرض 'pending' فيظهر تلقائيًا
                    // ضمن تبويب "قيد المراجعة" في شاشة "خدماتي" (بلا أي تعديل
                    // إضافي بالفرونت) إلى أن يعتمده الأدمن — راجع
                    // AdminProviderController::approve() الذي يُفعِّله حينها.
                    $offer->status = $isAlreadyApproved ? 'accept' : 'pending';
                    $offer->save();
                }
            }

            (new ReferralCommissionService())->createCommissionForPaidSubscription($subscription);

            // كل دفعة ناجحة تضع طلب مزوّد الخدمة "قيد المراجعة" (أول مرة، أو
            // إعادة تقديم بعد رفض سابق) — إلا لو كان معتمَداً سلفاً فلا داعي
            // لإعادته لقائمة المراجعة بسبب اشتراك/عرض إضافي. لا تُفعِّل
            // user_type=provider هنا مباشرة: الاعتماد الفعلي يتم يدويًا من
            // الأدمن (admin/providers/{user}/approve) بعد مراجعة بياناته،
            // راجع App\Enums\ProviderApprovalStatus.
            if ($provider && ! $isAlreadyApproved) {
                $provider->update(['approval_status' => \App\Enums\ProviderApprovalStatus::PENDING]);
            }

            return view('payments.result', [
                'success' => true,
                'message' => 'تم الدفع بنجاح، تم تفعيل اشتراكك',
            ]);
        }

        $subscription->payment_status = 'failed';
        $subscription->save();

        return view('payments.result', [
            'success' => false,
            'message' => $payment['message'] ?? 'فشلت عملية الدفع',
        ]);
    }

    /**
     * المفتاح السري يُقرأ أولاً من business_settings (قابل للتعديل مباشرة
     * من قاعدة البيانات دون الحاجة لتعديل .env)، ويسقط احتياطياً على
     * .env إن لم يكن الصف موجوداً أو كانت قيمته فارغة.
     */
    private function secretKey(): ?string
    {
        $value = Helpers::get_business_settings('moyasar_secret_key');

        return filled($value) ? $value : config('services.moyasar.secret_key');
    }

    /**
     * نفس منطق secretKey() — يقرأ من business_settings أولاً، ثم .env احتياطياً.
     */
    private function publicKey(): ?string
    {
        $value = Helpers::get_business_settings('moyasar_public_key');

        return filled($value) ? $value : config('services.moyasar.public_key');
    }
}