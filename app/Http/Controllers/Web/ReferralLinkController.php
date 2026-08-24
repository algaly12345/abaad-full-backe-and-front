<?php

namespace App\Http\Controllers\Web;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * يخدم رابط الإحالة الفعلي https://abaadapp.sa/ref/{code}: مجرد تحويل
 * (302) — لا Blade، لا واجهة. لو التطبيق مثبَّت ومُتحقَّق عبر assetlinks.json
 * (App Links)، النظام يعترض الرابط قبل ما يوصل لهذا الكنترولر أصلاً؛ هذا
 * المسار هو fallback المتصفح فقط (تطبيق غير مثبَّت، أو التحقق التلقائي لم
 * يكتمل بعد).
 */
class ReferralLinkController extends Controller
{
    private const PLAY_STORE_URL = 'https://play.google.com/store/apps/details';

    public function redirect(Request $request, string $code)
    {
        $exists = User::where('referral_code', $code)->exists();
        if (!$exists) {
            Log::info('Referral link opened with unknown code', ['code' => $code]);
        }

        $userAgent = $request->userAgent() ?? '';
        $isAndroid = str_contains($userAgent, 'Android');
        $isIOS = (bool) preg_match('/iPhone|iPad|iPod/', $userAgent);

        if ($isIOS) {
            $appStoreUrl = config('services.ios_app.app_store_url');

            // لا نحوّل مستخدم آيفون لمتجر أندرويد أبدًا. لو التطبيق لم يُنشر
            // على App Store بعد (لا يوجد IOS_APP_STORE_URL في .env)، نعيده
            // للصفحة الرئيسية بدل تحويل خاطئ لا معنى له على منصته.
            return redirect($appStoreUrl ?: url('/'));
        }

        if ($isAndroid) {
            $packageName = config('services.android_app.package_name');
            $query = [
                'id' => $packageName,
                // Play Install Referrer API يقرأ هذه القيمة داخل التطبيق بعد
                // التثبيت مباشرة، فيحفظها التطبيق ويعبّيها تلقائيًا عند التسجيل.
                'referrer' => 'ref_code=' . $code,
            ];

            return redirect(self::PLAY_STORE_URL . '?' . http_build_query($query));
        }

        // متصفح سطح مكتب أو جهاز غير معروف: لا يوجد متجر مناسب للتحويل إليه.
        return redirect(url('/'));
    }

    /**
     * https://developers.google.com/digital-asset-links/v1/getting-started
     * لازم يرجع كمصفوفة JSON عارية بدون أي لف (data/status)، بـ
     * Content-Type: application/json، حتى يقدر أندرويد يتحقق من ملكية
     * الدومين ويفتح الرابط بالتطبيق مباشرة بدل المتصفح.
     */
    public function assetLinks()
    {
        $packageName = config('services.android_app.package_name');

        // نفس نمط MoyasarPaymentController::secretKey(): business_settings أولاً
        // (قابل للتعديل من قاعدة البيانات مباشرة بدون وصول SSH/.env على سيرفر
        // الإنتاج)، ثم .env احتياطياً. القيمة: بصمات SHA256 مفصولة بفاصلة —
        // يمكن إضافة أكثر من بصمة (مثلاً debug + release) بنفس الحقل.
        $configured = Helpers::get_business_settings('android_sha256_fingerprints');
        $raw = filled($configured) ? $configured : config('services.android_app.sha256_fingerprints');
        $fingerprints = array_filter(array_map('trim', explode(',', (string) $raw)));

        return response()->json([
            [
                'relation' => ['delegate_permission/common.handle_all_urls'],
                'target' => [
                    'namespace' => 'android_app',
                    'package_name' => $packageName,
                    'sha256_cert_fingerprints' => array_values($fingerprints),
                ],
            ],
        ]);
    }

    /**
     * https://developer.apple.com/documentation/xcode/supporting-universal-links-in-your-app
     * نفس فكرة assetLinks() لأندرويد: يجب أن يرجع JSON عاريًا (بدون data/status)
     * بمسار /ref/* فقط، حتى يقدر آيفون يربط الرابط بالتطبيق مباشرة بدل Safari.
     * appID بصيغة {TEAM_ID}.{BUNDLE_ID} — انظر config('services.ios_app').
     */
    public function appleAppSiteAssociation()
    {
        $teamId = config('services.ios_app.team_id');
        $bundleId = config('services.ios_app.bundle_id');

        return response()->json([
            'applinks' => [
                'details' => [
                    [
                        'appID' => "{$teamId}.{$bundleId}",
                        'paths' => ['/ref/*'],
                    ],
                ],
            ],
        ]);
    }
}
