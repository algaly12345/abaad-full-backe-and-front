<?php

namespace App\Services;

use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * إرسال FCM عبر HTTP v1 — الطريقة الوحيدة العاملة حاليًا. الكود القديم في
 * Helpers::send_push_notif_to_device/topic كان يستخدم Legacy HTTP API
 * (https://fcm.googleapis.com/fcm/send) التي أوقفتها Google نهائيًا في
 * يونيو 2024 وترجع 404 دائمًا مهما كان المفتاح صحيحًا.
 *
 * يتطلب ملف مفتاح حساب خدمة Firebase (Service Account JSON) في
 * storage/app/firebase/service-account.json — غير موجود في Git، يوضع يدويًا
 * (Firebase Console → Project Settings → Service Accounts → Generate new
 * private key)، لمشروع FIREBASE_PROJECT_ID المحدد في .env.
 */
class FcmV1Service
{
    private const SCOPE = 'https://www.googleapis.com/auth/firebase.messaging';
    private const TOKEN_URL = 'https://oauth2.googleapis.com/token';
    private const CACHE_KEY = 'fcm_v1_access_token';

    public static function sendToToken(string $token, array $data, ?string $title = null, ?string $body = null, ?string $image = null): bool
    {
        return self::send(['token' => $token], $data, $title, $body, $image);
    }

    public static function sendToTopic(string $topic, array $data, ?string $title = null, ?string $body = null, ?string $image = null): bool
    {
        return self::send(['topic' => $topic], $data, $title, $body, $image);
    }

    private static function send(array $target, array $data, ?string $title, ?string $body, ?string $image): bool
    {
        $accessToken = self::getAccessToken();
        if (!$accessToken) {
            return false;
        }

        $projectId = env('FIREBASE_PROJECT_ID');
        if (!$projectId) {
            Log::info('FCM v1: FIREBASE_PROJECT_ID غير مضبوط في .env');
            return false;
        }

        $message = $target;
        // v1 يشترط أن تكون كل قيم data نصوصًا (بعكس Legacy API التي كانت تقبل أي نوع).
        $message['data'] = array_map('strval', $data);

        $notification = array_filter([
            'title' => $title,
            'body' => $body,
            'image' => $image,
        ], fn ($v) => $v !== null && $v !== '');
        if (!empty($notification)) {
            $message['notification'] = $notification;
        }

        $response = Http::withToken($accessToken)
            ->post("https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send", [
                'message' => $message,
            ]);

        if (!$response->successful()) {
            Log::info('FCM v1: فشل الإرسال', [
                'status' => $response->status(),
                'body' => $response->body(),
                'target' => $target,
            ]);
            return false;
        }

        return true;
    }

    private static function getAccessToken(): ?string
    {
        return Cache::remember(self::CACHE_KEY, 3000, function () {
            $credentialsPath = storage_path('app/firebase/service-account.json');

            if (!file_exists($credentialsPath)) {
                Log::info('FCM v1: ملف service-account.json غير موجود في ' . $credentialsPath);
                return null;
            }

            $credentials = json_decode(file_get_contents($credentialsPath), true);
            if (!$credentials || empty($credentials['client_email']) || empty($credentials['private_key'])) {
                Log::info('FCM v1: service-account.json ناقص الحقول المطلوبة');
                return null;
            }

            $now = time();
            $jwt = JWT::encode([
                'iss' => $credentials['client_email'],
                'scope' => self::SCOPE,
                'aud' => self::TOKEN_URL,
                'iat' => $now,
                'exp' => $now + 3600,
            ], $credentials['private_key'], 'RS256');

            $response = Http::asForm()->post(self::TOKEN_URL, [
                'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
                'assertion' => $jwt,
            ]);

            if (!$response->successful()) {
                Log::info('FCM v1: فشل تبادل التوكن', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
                return null;
            }

            return $response->json('access_token');
        });
    }
}
