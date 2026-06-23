<?php

use App\Http\Controllers\api\v1\AgentController;
use App\Http\Controllers\api\v1\auth\CustomerAuthController;
use App\Http\Controllers\api\v1\BannerController;
use App\Http\Controllers\api\v1\ConfigController;
use App\Http\Controllers\api\v1\CategoryController;
use App\Http\Controllers\api\v1\ConversationController;
use App\Http\Controllers\api\v1\CustomerController;
use App\Http\Controllers\api\v1\EstateController;
use App\Http\Controllers\api\v1\NotificationController;
use App\Http\Controllers\api\v1\ServiceProvidertController;
use App\Http\Controllers\api\v1\WalletController;
use App\Http\Controllers\api\v1\WishlistController;
use App\Http\Controllers\api\v1\ZonAndCityController;
use Illuminate\Support\Facades\Route;

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

});