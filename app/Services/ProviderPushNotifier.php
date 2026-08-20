<?php

namespace App\Services;

use App\Helpers\Helpers;
use App\Models\User;
use Illuminate\Support\Facades\Log;

/**
 * نقطة موحّدة لإرسال إشعار push لمزوّد خدمة عند تغيّر إحدى "حالاته"
 * (اشتراك/عرض/تفعيل حساب)، فوق نفس بنية FCM الموجودة أصلاً
 * (Helpers::send_push_notif_to_device + users.cm_firebase_token).
 *
 * لا تُطلق استثناء أبدًا: توكن فاسد/منتهي لمزوّد واحد يجب ألا يكسر
 * transaction اشتراك أو ريدايركت أدمن.
 */
class ProviderPushNotifier
{
    public static function notify(User $user, string $type, string $title, string $description, $refId = null): void
    {
        if (empty($user->cm_firebase_token)) {
            return;
        }

        $data = [
            'title' => $title,
            'description' => $description,
            'image' => '',
            'order_id' => $refId ?? '',
            'type' => $type,
        ];

        try {
            Helpers::send_push_notif_to_device($user->cm_firebase_token, $data);
        } catch (\Exception $e) {
            Log::info('ProviderPushNotifier failed', [
                'user_id' => $user->id,
                'type' => $type,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
