<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\ServiceProviderSubscription;
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
            'publicKey'     => config('services.moyasar.public_key'),
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

        $response = Http::withBasicAuth(config('services.moyasar.secret_key'), '')
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

            if ($subscription->offer_id) {
                Offer::where('id', $subscription->offer_id)->update(['status' => 'accept']);
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
}