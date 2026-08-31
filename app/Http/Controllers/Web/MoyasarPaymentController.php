<?php

namespace App\Http\Controllers\Web;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\ServiceProviderSubscription;
use App\Services\SubscriptionActivationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class MoyasarPaymentController extends Controller
{
    public function __construct(private SubscriptionActivationService $activation)
    {
    }

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
     * هذا مجرد "مسار سريع" لتجربة المستخدم — إن فشل (أُغلق المتصفح، انقطاع
     * الشبكة، تعذّر التحقق الآن) فإن webhook أو أمر payments:reconcile-moyasar
     * سيفعّل الاشتراك لاحقاً. لا نثق بأي query param من الرابط: نتحقق من
     * Moyasar مباشرة server-to-server.
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

        $payment = $this->activation->fetchPayment($paymentId);

        // تعذّر التحقق الآن — لا نعتبرها فشلاً: نترك الاشتراك كما هو ليلتقطه
        // webhook / أمر المطابقة.
        if ($payment === null) {
            return view('payments.result', [
                'success' => false,
                'message' => 'تعذر تأكيد الدفع الآن، سيتم تحديث اشتراكك تلقائياً خلال دقائق إن تم الخصم',
            ]);
        }

        if ($this->activation->activateFromPayment($subscription, $payment)) {
            return view('payments.result', [
                'success' => true,
                'message' => 'تم الدفع بنجاح، تم تفعيل اشتراكك',
            ]);
        }

        // لم يُفعَّل: إمّا فشل فعلي، أو دفعة "paid" غير مطابقة (المبلغ/الرقم) —
        // نعلّم failed فقط عندما لا تكون paid، حتى لا نلمس دفعة نجحت فعلاً.
        if (($payment['status'] ?? null) !== 'paid') {
            $subscription->payment_status = 'failed';
            $subscription->save();
        }

        return view('payments.result', [
            'success' => false,
            'message' => $payment['message'] ?? 'فشلت عملية الدفع',
        ]);
    }

    /**
     * المفتاح العام يُقرأ من business_settings، ثم يسقط على .env كخيار احتياط.
     */
    private function publicKey(): ?string
    {
        $fromSettings = Helpers::get_business_settings('moyasar_public_key');
        if (! empty($fromSettings)) {
            return $fromSettings;
        }

        return config('services.moyasar.public_key') ?: null;
    }
}
