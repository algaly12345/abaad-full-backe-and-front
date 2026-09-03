<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'moyasar' => [
        // تُقرأ أساسًا من business_settings؛ هذه القيم خيار احتياط (.env).
        'public_key' => env('MOYASAR_PUBLIC_KEY'),
        'secret_key' => env('MOYASAR_SECRET_KEY'),
        // secret_token الذي يُضبط عند إنشاء الـ webhook في لوحة Moyasar —
        // انظر MoyasarWebhookController. الأساس business_settings.moyasar_webhook_secret.
        'webhook_secret' => env('MOYASAR_WEBHOOK_SECRET'),
    ],

    // رابط الإحالة الفعلي (abaadapp.sa/ref/CODE) + assetlinks.json — انظر
    // ReferralLinkController. SHA256 يبقى فارغًا حتى يتوفر مفتاح توقيع
    // release حقيقي (حاليًا release موقّع بمفتاح debug في build.gradle.kts).
    'android_app' => [
        'package_name' => env('ANDROID_PACKAGE_NAME', 'sa.pdm.abaad.abaad'),
        'sha256_fingerprints' => env('ANDROID_SHA256_FINGERPRINTS', ''),
    ],

    // Apple Universal Links (apple-app-site-association) — انظر
    // ReferralLinkController::appleAppSiteAssociation. القيم من
    // ios/Runner.xcodeproj/project.pbxproj (DEVELOPMENT_TEAM / PRODUCT_BUNDLE_IDENTIFIER).
    'ios_app' => [
        'bundle_id' => env('IOS_BUNDLE_ID', 'sa.pdm.abaad.abaad'),
        'team_id' => env('IOS_TEAM_ID', ''),
        // فارغ عمدًا حتى ينشر التطبيق على App Store ويصدر له رقم معرّف —
        // انظر ReferralLinkController::redirect لسلوك الاحتياط بدون هذه القيمة.
        'app_store_url' => env('IOS_APP_STORE_URL', ''),
    ],

    // ChottuLink (بديل Firebase Dynamic Links) — يُنشئ رابط الإحالة القصير
    // لكل مزوّد على نطاق abaadapp.chottu.link ويحمل الكود عبر التثبيت
    // (deferred deep link). انظر App\Services\ChottuLinkService +
    // ReferralController::myLink. نفس نمط moyasar: القيم الأساسية من
    // business_settings، وهذه مجرد احتياط .env:
    //   - chottulink_api_key         : مفتاح REST (c_api_…) لإنشاء الروابط — خادمي فقط
    //   - chottulink_mobile_sdk_key  : مفتاح SDK للجوال (c_app_…) — يُرسَل لتطبيق الجوال عبر /api/v1/config
    //   - chottulink_domain          : النطاق (abaadapp.chottu.link)
    'chottulink' => [
        'api_key' => env('CHOTTULINK_API_KEY', ''),
        'domain' => env('CHOTTULINK_DOMAIN', 'abaadapp.chottu.link'),
        'base_url' => env('CHOTTULINK_BASE_URL', 'https://api2.chottulink.com'),
    ],

];