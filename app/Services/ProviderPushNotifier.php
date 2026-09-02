<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * نقطة موحّدة لإرسال إشعار push لمزوّد خدمة عند تغيّر إحدى "حالاته"
 * (اشتراك/عرض/تفعيل حساب/توثيق/عمولة)، عبر خدمة الإشعارات الخارجية على
 * dashboard.abaadapp.sa (POST /api/v1/notifications/send-to-token) بدل
 * FcmV1Service الداخلي.
 *
 * ⚠️ ذاك الـ endpoint غير موجود بهذا الريبو (خدمة/سيرفر منفصل)، فلا يمكن
 * التأكد من كودها المصدري أن حقلي type/order_id يصلان فعليًا ضمن حمولة
 * FCM data — أُرسلا بأفضل جهد (top-level + متداخلين داخل data) لحين
 * التحقق الفعلي على الجهاز.
 *
 * يُرسل دائمًا عبر DB::afterCommit(): لو استُدعيت من داخل DB::transaction
 * (مثل اعتماد عمولة إحالة مع lockForUpdate)، يُؤجَّل طلب الـ HTTP الخارجي
 * حتى بعد commit المعاملة فعليًا، حتى لا يحجز قفل صف قاعدة بيانات طوال
 * مدة انتظار رد سيرفر خارجي. خارج أي transaction يُنفَّذ فورًا.
 *
 * لا تُطلق استثناء أبدًا: توكن فاسد/منتهي أو فشل شبكة لمزوّد واحد يجب
 * ألا يكسر transaction اشتراك أو ريدايركت أدمن.
 */
class ProviderPushNotifier
{
    private const ENDPOINT = 'https://dashboard.abaadapp.sa/api/v1/notifications/send-to-token';
    private const API_KEY = 'omeromer';

    public static function notify(User $user, string $type, string $title, string $description, $refId = null): void
    {
        if (empty($user->cm_firebase_token)) {
            return;
        }

        self::notifyToken($user->cm_firebase_token, $type, $title, $description, $refId, $user->id);
    }

    /**
     * نفس منطق notify() لكن مع توكن FCM خام بدل موديل User — يُستخدم للجهات
     * التي لا تُمثَّل بسجل User في هذا الريبو (مثل جهاز أدمن مراجعة الإعلانات
     * على dashboard.abaadapp.sa). التوكن الفارغ يُتجاهل بصمت.
     */
    public static function notifyToken(?string $fcmToken, string $type, string $title, string $description, $refId = null, $userId = null): void
    {
        if (empty($fcmToken)) {
            return;
        }

        $orderId = $refId ?? '';

        DB::afterCommit(function () use ($fcmToken, $userId, $type, $title, $description, $orderId) {
            try {
                Http::withHeaders(['X-Api-Key' => self::API_KEY])
                    ->timeout(5)
                    ->post(self::ENDPOINT, [
                        'fcmToken' => $fcmToken,
                        'title' => $title,
                        'body' => $description,
                        'type' => $type,
                        'order_id' => $orderId,
                        'data' => [
                            'type' => $type,
                            'order_id' => $orderId,
                        ],
                    ]);
            } catch (\Throwable $e) {
                Log::info('ProviderPushNotifier failed', [
                    'user_id' => $userId,
                    'type' => $type,
                    'message' => $e->getMessage(),
                ]);
            }
        });
    }
}
