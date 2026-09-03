<?php

namespace App\Services;

use App\Helpers\Helpers;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * ينشئ رابط إحالة قصير عبر ChottuLink (بديل Firebase Dynamic Links) لكل
 * مزوّد خدمة، على النطاق المخصص go.abaadapp.sa. الرابط القصير يفتح التطبيق
 * إن كان مثبَّتًا، وإلا يحوّل للمتجر ثم يسلّم كود الإحالة للتطبيق عند أول
 * تشغيل (deferred deep link) — وهذا ما يحلّ فقدان الكود على iOS/أندرويد.
 *
 * وجهة الـ deep link تبقى https://abaadapp.sa/ref/{code}: نفس ما يحلّله
 * تطبيق الجوال أصلًا (main.dart._handleReferralLink)، فمسار تحليل واحد
 * لكل مصادر الرابط.
 *
 * نمط ProviderPushNotifier: Http facade + timeout قصير + try/catch،
 * لا يُطلق استثناء أبدًا — فشل ChottuLink أو الشبكة يجب ألا يكسر
 * /api/v1/referrals/my-link؛ يتراجع النداء للرابط الخام.
 *
 * المفتاح/النطاق: business_settings أولًا (chottulink_api_key /
 * chottulink_domain) ثم config('services.chottulink.*') احتياطًا — نفس
 * نمط MoyasarPaymentController::publicKey().
 */
class ChottuLinkService
{
    private const CREATE_PATH = '/chotuCore/pa/v1/create-link';

    // سلوك الرابط في REST API عدد صحيح: 1 = فتح المتصفح، 2 = فتح التطبيق
    // (يسقط للمتجر ثم deferred deep link إن لم يكن مثبَّتًا). نفس تعيين
    // chottu_link SDK (CLDynamicLinkBehaviour: browser→1, app→2).
    private const BEHAVIOR_APP = 2;

    /**
     * يُنشئ الرابط القصير لمزوّد الخدمة ويعيده، أو null عند أي فشل.
     * لا يحفظ شيئًا — المستدعي (ReferralController::myLink) هو من يخزّن
     * الناتج على users.referral_short_link.
     */
    public static function createReferralLink(User $user): ?string
    {
        $apiKey = self::apiKey();
        $domain = self::domain();

        if (empty($apiKey) || empty($domain) || empty($user->referral_code)) {
            return null;
        }

        $destination = "https://abaadapp.sa/ref/{$user->referral_code}";

        try {
            $response = Http::withHeaders(['API-KEY' => $apiKey])
                ->timeout(8)
                ->acceptJson()
                ->post(self::baseUrl() . self::CREATE_PATH, [
                    'domain' => $domain,
                    'destination_url' => $destination,
                    // بعض نسخ الـ API تسمّيه link — نرسل الاثنين، الزائد يُتجاهل.
                    'link' => $destination,
                    'link_name' => "provider-{$user->id}",
                    // أعداد صحيحة إلزاميًا (2 = فتح التطبيق) — راجع BEHAVIOR_APP.
                    'android_behavior' => self::BEHAVIOR_APP,
                    'ios_behavior' => self::BEHAVIOR_APP,
                    'utm_source' => 'referral',
                    'utm_medium' => 'provider',
                    'utm_campaign' => 'provider_referral',
                    'social_title' => 'تطبيق أبعاد للتسويق العقاري',
                    'social_description' => 'سجّل في تطبيق أبعاد عبر رابط الإحالة الخاص بي.',
                ]);

            if (!$response->successful()) {
                Log::info('ChottuLink create-link failed', [
                    'user_id' => $user->id,
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);

                return null;
            }

            $shortLink = self::extractShortLink($response->json(), $domain);

            if (empty($shortLink)) {
                Log::info('ChottuLink create-link: no short link in response', [
                    'user_id' => $user->id,
                    'body' => $response->body(),
                ]);

                return null;
            }

            return $shortLink;
        } catch (\Throwable $e) {
            Log::info('ChottuLink create-link exception', [
                'user_id' => $user->id,
                'message' => $e->getMessage(),
            ]);

            return null;
        }
    }

    /**
     * يلتقط الرابط القصير من رد الـ API بغضّ النظر عن شكل التغليف. يبحث في
     * المفاتيح الشائعة (short_link / shortLink / short_url / link / url)،
     * على المستوى الأعلى وداخل data، ويقبل فقط قيمة تحتوي نطاقنا.
     */
    private static function extractShortLink($json, string $domain): ?string
    {
        if (!is_array($json)) {
            return null;
        }

        $candidates = [
            'short_link', 'shortLink', 'shortLinkRaw', 'short_url', 'shortUrl',
            'short', 'dynamic_link', 'dynamicLink', 'link', 'url',
            'data.short_link', 'data.shortLink', 'data.short_url', 'data.shortUrl',
            'data.link', 'data.url', 'data.dynamic_link',
            'result.short_link', 'result.shortLink', 'result.link',
        ];

        foreach ($candidates as $key) {
            $value = Arr::get($json, $key);
            if (is_string($value) && str_contains($value, $domain)) {
                return $value;
            }
        }

        // احتياط أخير: أول قيمة نصية تبدأ بـ http وتحتوي النطاق، مهما كان مفتاحها.
        foreach (Arr::dot($json) as $value) {
            if (is_string($value) && str_starts_with($value, 'http') && str_contains($value, $domain)) {
                return $value;
            }
        }

        return null;
    }

    private static function apiKey(): ?string
    {
        $fromSettings = Helpers::get_business_settings('chottulink_api_key');
        if (!empty($fromSettings)) {
            return $fromSettings;
        }

        return config('services.chottulink.api_key') ?: null;
    }

    private static function domain(): ?string
    {
        $fromSettings = Helpers::get_business_settings('chottulink_domain');
        if (!empty($fromSettings)) {
            return $fromSettings;
        }

        return config('services.chottulink.domain') ?: null;
    }

    private static function baseUrl(): string
    {
        return rtrim(config('services.chottulink.base_url') ?: 'https://api2.chottulink.com', '/');
    }
}
