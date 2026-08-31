<?php

namespace App\Http\Controllers\Web;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\ServiceProviderSubscription;
use App\Services\SubscriptionActivationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * إشعار Moyasar من خادم-لخادم. مستقل تمامًا عن WebView في التطبيق، فهو
 * الضمان بأن أي عملية خصم ناجحة تُغيّر حالة الاشتراك/العرض حتى لو أُغلق
 * المتصفح أو فشل تحويله.
 *
 * المصادقة عبر secret_token داخل حمولة الطلب (يُضبط عند إنشاء الـ webhook
 * في لوحة Moyasar، ويُخزَّن عندنا في business_settings.moyasar_webhook_secret).
 * لذلك لا auth middleware ولا CSRF (المسار ضمن مجموعة api).
 */
class MoyasarWebhookController extends Controller
{
    public function providerSubscription(Request $request, SubscriptionActivationService $activation): JsonResponse
    {
        $expected = Helpers::get_business_settings('moyasar_webhook_secret')
            ?: config('services.moyasar.webhook_secret');

        $received = (string) $request->input('secret_token', '');

        if (empty($expected) || ! hash_equals((string) $expected, $received)) {
            Log::warning('Moyasar webhook rejected: bad secret_token', ['ip' => $request->ip()]);
            return response()->json(['message' => 'invalid secret_token'], 403);
        }

        $type    = $request->input('type');
        $payment = (array) $request->input('data', []);
        $subNumber = $payment['metadata']['subscription_number'] ?? null;

        Log::info('Moyasar webhook received', [
            'type'       => $type,
            'payment_id' => $payment['id'] ?? null,
            'status'     => $payment['status'] ?? null,
            'sub'        => $subNumber,
        ]);

        $status = $payment['status'] ?? null;

        // نستجيب 200 لكل حدث لا يخصّنا حتى لا يعيد Moyasar إرساله بلا فائدة.
        // نتعامل مع paid (تفعيل) و failed (إشعار "لم يتم الدفع") فقط.
        if (! $subNumber || ! in_array($status, ['paid', 'failed'], true)) {
            return response()->json(['message' => 'ignored'], 200);
        }

        $subscription = ServiceProviderSubscription::where('subscription_number', $subNumber)->first();

        if (! $subscription) {
            Log::warning('Moyasar webhook: subscription not found', ['sub' => $subNumber]);
            return response()->json(['message' => 'subscription not found'], 200);
        }

        if ($status === 'paid') {
            $activated = $activation->activateFromPayment($subscription, $payment);
            return response()->json(['message' => $activated ? 'ok' : 'not activated'], 200);
        }

        // status === 'failed' — يُطلق ServiceProviderSubscriptionObserver فيرسل
        // إشعار "لم تكتمل عملية دفع اشتراكك، حاول مرة أخرى" (ما لم يكن paid مسبقًا).
        $activation->markFailed($subscription, $payment['id'] ?? null);

        return response()->json(['message' => 'marked failed'], 200);
    }
}
