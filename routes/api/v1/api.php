<?php

use App\Enums\ProviderPermission;
use App\Http\Controllers\api\v1\AgentController;
use App\Http\Controllers\api\v1\auth\CustomerAuthController;
use App\Http\Controllers\api\v1\BannerController;
use App\Http\Controllers\api\v1\ConfigController;
use App\Http\Controllers\api\v1\CategoryController;
use App\Http\Controllers\api\v1\ConversationController;
use App\Http\Controllers\api\v1\CustomerController;
use App\Http\Controllers\api\v1\EstateController;
use App\Http\Controllers\Api\v1\EstateSearchController;
use App\Http\Controllers\api\v1\NotificationController;
use App\Http\Controllers\api\v1\ServiceProvidertController;
use App\Http\Controllers\api\v1\WalletController;
use App\Http\Controllers\api\v1\WishlistController;
use App\Http\Controllers\api\v1\ZonAndCityController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\api\v1\ServiceCatalogController;

use App\Http\Controllers\Api\v1\ServiceManagementController;
use App\Http\Controllers\Api\v1\ServicePlanManagementController;
use App\Http\Controllers\Api\v1\ProviderPermissionController;
use App\Http\Controllers\Api\v1\ReportController;
use App\Http\Controllers\Api\v1\UserPermissionController;

Route::group(['namespace' => 'api\v1', 'prefix' => 'v1'], function () {

    /*
    |--------------------------------------------------------------------------
    | Auth
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'auth', 'namespace' => 'auth'], function () {
        Route::post('register', [CustomerAuthController::class, 'register']);
        Route::post('login', [CustomerAuthController::class, 'login']);
        Route::post('verify-phone', [CustomerAuthController::class, 'verify_phone']);
        Route::get('verify', [CustomerAuthController::class, 'all_code']);
    });

    /*
    |--------------------------------------------------------------------------
    | Config / App bootstrap
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'config'], function () {
        Route::get('/', [ConfigController::class, 'configuration']);
        Route::get('place-api-autocomplete', [ConfigController::class, 'place_api_autocomplete']);
        Route::get('place-api-details', [ConfigController::class, 'place_api_details']);
        Route::get('get-zone-id', [ConfigController::class, 'get_zone']);
        Route::get('geocode-api', [ConfigController::class, 'geocode_api']);
    });

    /*
    |--------------------------------------------------------------------------
    | Categories
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', [CategoryController::class, 'get_categories']);
    });

    /*
    |--------------------------------------------------------------------------
    | Zones / Cities / Districts
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'zones'], function () {
        Route::get('/', [ZonAndCityController::class, 'all']);
        Route::get('get-regions', [ZonAndCityController::class, 'get_regions']);
        Route::get('get-city-by-zoneId', [ZonAndCityController::class, 'cities_by_zoneId']);
        Route::get('get-cities-by-regions/{id}', [ZonAndCityController::class, 'get_cities_by_regions']);
        Route::get('get-districts-by-cities/{id}', [ZonAndCityController::class, 'get_districts_by_cities']);
    });

    /*
    |--------------------------------------------------------------------------
    | Estate (listings, media, validation)
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'estate'], function () {
        Route::get('get-estate/{filter_data}', [EstateController::class, 'get_estate']);
        Route::get('get-services', [EstateController::class, 'get_services']);
        Route::get('list/{filter_data}', [EstateController::class, 'list']);
        Route::get('map-list/{filter_data}', [EstateController::class, 'mapList']);
        Route::post('create', [EstateController::class, 'create']);
        Route::get('details/{id}', [EstateController::class, 'get_details']);
        Route::get('package-views', [EstateController::class, 'package']);
        Route::get('package-view', [EstateController::class, 'package']);
        Route::get('get-properties', [EstateController::class, 'get_properties']);
        Route::post('market-plan', [EstateController::class, 'market_plan']);
        Route::get('get-facilities', [EstateController::class, 'get_facilities']);
        Route::get('get-advantages', [EstateController::class, 'get_advantages']);
        Route::get('agent-info', [EstateController::class, 'info_by_id']);
        Route::get('near_by', [EstateController::class, 'near_by']);
        Route::post('update', [EstateController::class, 'update']);

        // Video / media
        Route::post('upload-video', [EstateController::class, 'uploadVideo']);
        Route::post('upload-sky-view', [EstateController::class, 'uploadSkyView']);
        Route::get('video/{id}', [EstateController::class, 'showVideo']);
        Route::put('video/path', [EstateController::class, 'updatePath']);
        Route::delete('video-delete/{id}', [EstateController::class, 'destroyVideo']);

        // Images
        Route::get('etch-existing-images/{id}', [EstateController::class, 'fetchExistingImages']);
        Route::post('upload-images/{id}', [EstateController::class, 'uploadImages']);
        Route::delete('delete-image/{id}/{imageUrl}', [EstateController::class, 'deleteImage']);

        // Planned images
        Route::get('etch-existing-planned/{id}', [EstateController::class, 'fetchExistingPlanned']);
        Route::post('upload-planned/{id}', [EstateController::class, 'uploadPlanned']);
        Route::delete('delete-planned/{id}/{imageUrl}', [EstateController::class, 'deletePlanned']);

        // Reports / advantages
        Route::post('create-report', [EstateController::class, 'createReport']);
        Route::get('advantages', [EstateController::class, 'advantage']);
        Route::get('existing-advantages', [EstateController::class, 'getExistingAdvantages']);
        // Route::post('advantages/selected', [EstateController::class, 'getSelectedAdvantages']);

        // Licensing / compliance
        Route::get('validate-advertisement', [EstateController::class, 'validateAdvertisement']);
        Route::post('platform-compliance', [EstateController::class, 'sendComplianceData']);
        Route::post('check-license', [EstateController::class, 'check_license']);

        // Categories / search
        Route::get('categories-by-type', [EstateController::class, 'getCategoriesByType']);
        Route::get('search', [EstateController::class, 'search']);
        Route::get('search-list', [ConversationController::class, 'get_searched_conversations']);
    });

    /*
    |--------------------------------------------------------------------------
    | Customer (authenticated)
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'customer', 'middleware' => 'auth:api'], function () {
        Route::get('notifications', [NotificationController::class, 'get_notifications']);
        Route::post('update-profile', [CustomerController::class, 'update_profile']);
        Route::get('info', [CustomerController::class, 'info']);
        Route::post('complete-agent', [AgentController::class, 'complete_agent']);
        Route::post('cm-firebase-token', [CustomerController::class, 'update_cm_firebase_token']);
        Route::get('my-estate', [CustomerController::class, 'info_by_id']);
        Route::delete('delete', [CustomerController::class, 'delete']);
        Route::post('nafath-validation', [CustomerController::class, 'sendRequest']);
        Route::post('check-request-status', [CustomerController::class, 'checkRequestStatus']);
    });

    /*
    |--------------------------------------------------------------------------
    | Chatting / Messages (authenticated)
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'message', 'middleware' => 'auth:api'], function () {
        Route::get('list', [ConversationController::class, 'conversations']);
        Route::get('search-list', [ConversationController::class, 'get_searched_conversations']);
        Route::get('details', [ConversationController::class, 'messages']);
        Route::post('send', [ConversationController::class, 'messages_store']);
        Route::post('chat-image', [ConversationController::class, 'chat_image']);
    });

    /*
    |--------------------------------------------------------------------------
    | Wishlist (authenticated)
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'wish-list', 'middleware' => 'auth:api'], function () {
        Route::post('add', [WishlistController::class, 'add_to_wishlist']);
        Route::delete('remove', [WishlistController::class, 'remove_from_wishlist']);
        Route::get('/', [WishlistController::class, 'wish_list']);
    });

    /*
    |--------------------------------------------------------------------------
    | Wallet (authenticated)
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'wallet', 'middleware' => 'auth:api'], function () {
        Route::get('transactions', [WalletController::class, 'transactions']);
    });

    /*
    |--------------------------------------------------------------------------
    | Service Provider / Provider Subscriptions (authenticated)
    |--------------------------------------------------------------------------
    | Note: "provider-subscriptions" and "service-provider" used to duplicate
    | offer-setup-data / store-offer under two different prefixes. Both are
    | kept below (under their original prefixes) so existing mobile/client
    | calls to either path keep working — they just point at the same
    | controller methods, no duplicate route definitions.
    */
    Route::group(['prefix' => 'provider-subscriptions', 'middleware' => 'auth:api'], function () {
        Route::get('/', [ServiceProvidertController::class, 'index']);
        Route::get('offer-setup-data', [ServiceProvidertController::class, 'getOfferSetupData']);
        Route::post('calculate-price', [ServiceProvidertController::class, 'calculatePrice']);
        Route::post('store-offer', [ServiceProvidertController::class, 'storeOfferAPI']);
        Route::get('{subscription_number}/status', [ServiceProvidertController::class, 'getSubscriptionStatus']);
    });

    Route::group(['prefix' => 'service-provider', 'middleware' => 'auth:api'], function () {
        Route::put('update', [ServiceProvidertController::class, 'update']);
        Route::get('offer-setup-data', [ServiceProvidertController::class, 'getOfferSetupData']);
        Route::post('store-offer', [ServiceProvidertController::class, 'storeOfferAPI']);
    });

    // نقطة استرجاع ذاتية للأدوار/الصلاحيات — معزولة في مجموعة خاصة لتجنب
    // تغيير سلوك المسارات الثلاثة أعلاه دون طلب صريح.
    Route::group(['prefix' => 'service-provider', 'middleware' => ['auth:api', 'provider.api']], function () {
        Route::get('permissions', [ProviderPermissionController::class, 'index']);
    });


    Route::group(['prefix' => 'manage-permissions', 'middleware' => 'auth:api'], function () {
        // عرض كل الصلاحيات الموجودة في النظام
        Route::get('/', [UserPermissionController::class, 'allPermissions']);
        
        // إسناد صلاحية لمستخدم (مثلاً إعطاؤه صلاحية الباقات)
        Route::post('{id}/assign', [UserPermissionController::class, 'assign']);
        
        // سحب صلاحية من مستخدم
        Route::post('{id}/revoke', [UserPermissionController::class, 'revoke']);
        
        // مزامنة الصلاحيات (تحذف القديم وتضع الجديد)
        Route::post('{id}/sync', [UserPermissionController::class, 'sync']);
    });


    /*
    |--------------------------------------------------------------------------
    | Loyalty points (disabled)
    |--------------------------------------------------------------------------
    */
    // Route::group(['prefix' => 'loyalty-point'], function () {
    //     Route::post('point-transfer', 'LoyaltyPointController@point_transfer');
    //     Route::get('transactions', 'LoyaltyPointController@transactions');
    // });

    /*
    |--------------------------------------------------------------------------
    | Banners / Advertisement validation
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'banners'], function () {
        Route::get('/', [BannerController::class, 'banners']);
        Route::post('advertisement/validate', [EstateController::class, 'validate2']);
    });

    /*
    |--------------------------------------------------------------------------
    | Services Catalog
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'services'], function () {

        // عام: لا يحتاج تسجيل دخول — كتالوج كل الخدمات + بيانات الفلاتر (تشمل قائمة مزودي الخدمة)
        Route::get('/', [ServiceCatalogController::class, 'index']);
        Route::get('filters', [ServiceCatalogController::class, 'filtersData']);

        // محمي: يحتاج تسجيل دخول + صفة "مزود خدمة" فعلية (provider.api)
        // + صلاحية محددة لكل عملية (provider.permission) — هذه الطبقة الجديدة
        // هي ما يحول النظام من "كل مزود = كل الصلاحيات" إلى صلاحيات حقيقية.
        Route::middleware(['auth:api', 'provider.api'])->group(function () {
            Route::get('my-services', [ServiceCatalogController::class, 'myServices'])
                ->middleware('provider.permission:services.view');

            Route::post('{id}/toggle-status', [ServiceCatalogController::class, 'toggleStatus'])
                ->middleware('provider.permission:services.toggle-status');

            Route::post('/', [ServiceManagementController::class, 'store'])
                ->middleware('provider.permission:services.create');

            Route::put('{id}', [ServiceManagementController::class, 'update'])
                ->middleware('provider.permission:services.update');

            Route::delete('{id}', [ServiceManagementController::class, 'destroy'])
                ->middleware('provider.permission:services.delete');
        });

        // عام أيضًا: تفاصيل خدمة واحدة — يجب أن يبقى آخر سطر داخل المجموعة
        Route::get('{id}', [ServiceCatalogController::class, 'show']);
    });


    /*
    |--------------------------------------------------------------------------
    | Service Plans (باقات مزودي الخدمة) — CRUD كامل عبر API
    |--------------------------------------------------------------------------
    | ⚠️ تنبيه: تم تقييد كل مسارات هذا القسم بصلاحية "plans.manage-global"
    | التي لا يملكها أي مزود خدمة افتراضيًا (انظر ProviderPermissionsSeeder).
    | هذا يُغلق الثغرة السابقة (كل مزود كان يستطيع إنشاء/تعديل/حذف باقات
    | جميع المزودين الآخرين) كأثر جانبي مباشر لبناء نظام الصلاحيات، وذلك
    | لأن لا يوجد حاليًا حارس API مخصّص لحساب إداري حقيقي (Admin لا يملك
    | Passport tokens في هذا المشروع). إعادة فتح هذا القسم لفئة إدارية حقيقية
    | مستقبلاً (مهمة "إدارة الخدمات والباقات") تتطلب منح هذه الصلاحية صريحًا
    | لذلك الحساب فقط، عبر:
    |   $user->givePermissionTo(\App\Enums\ProviderPermission::PLANS_MANAGE_GLOBAL);
    */
    Route::group([
        'prefix' => 'service-plans',
        'middleware' => ['auth:api', 'provider.api', 'provider.permission:plans.manage-global'],
    ], function () {
        Route::get('/', [ServicePlanManagementController::class, 'index']);
        Route::get('{id}', [ServicePlanManagementController::class, 'show']);
        Route::post('/', [ServicePlanManagementController::class, 'store']);
        Route::put('{id}', [ServicePlanManagementController::class, 'update']);
        Route::delete('{id}', [ServicePlanManagementController::class, 'destroy']);
    });



    /*
    |--------------------------------------------------------------------------
    | Estates Catalog (نسخة محسّنة: فلترة + بحث + Pagination حقيقي + كاش)
    |--------------------------------------------------------------------------
    | مسارات جديدة موازية لمسارات "estate/*" القديمة، لا تستبدلها. عامة (بدون
    | تسجيل دخول) لأن تصفح العقارات المفعّلة فعل عام في كل التطبيق الحالي.
    */
    Route::group(['prefix' => 'estates'], function () {
        Route::get('/', [EstateSearchController::class, 'index']);
        Route::get('{id}', [EstateSearchController::class, 'show']);
    });


    /*
    |--------------------------------------------------------------------------
    | Reports / Statistics (التقارير والإحصائيات)
    |--------------------------------------------------------------------------
    | - provider/dashboard: إحصائيات مزود الخدمة الحالي فقط (صلاحية آمنة تُمنح
    |   تلقائيًا لكل مزود: reports.view-own).
    | - global/*: إحصائيات إدارية على مستوى المنصة كلها. مقيّدة بصلاحية
    |   reports.view-global التي لا تُمنح لأي مزود افتراضيًا (نفس أسلوب
    |   service-plans أعلاه)، إلى أن يُستحدث حارس Passport إداري حقيقي.
    */
    Route::group(['prefix' => 'reports', 'middleware' => ['auth:api', 'provider.api']], function () {
        Route::get('provider/dashboard', [ReportController::class, 'providerDashboard'])
            ->middleware('provider.permission:' . ProviderPermission::REPORTS_VIEW_OWN);

        Route::group(['prefix' => 'global', 'middleware' => 'provider.permission:' . ProviderPermission::REPORTS_VIEW_GLOBAL], function () {
            Route::get('overview', [ReportController::class, 'globalOverview']);
            Route::get('estates', [ReportController::class, 'globalEstates']);
            Route::get('users', [ReportController::class, 'globalUsers']);
            Route::get('charts', [ReportController::class, 'globalCharts']);
        });
    });



});