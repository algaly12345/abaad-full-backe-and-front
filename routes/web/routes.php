<?php

use App\Enums\ViewPaths\Web\Chatting;
use App\Enums\ViewPaths\Web\Pages;
use App\Http\Controllers\Customer\Auth\RegisterController;
use App\Http\Controllers\Dashboard\auth\LoginController;
use App\Http\Controllers\Dashboard\auth\RoleLoginController;
use App\Http\Controllers\Dashboard\EstateController;
use App\Http\Controllers\Dashboard\ZoneController;
use App\Http\Controllers\EstateContrller;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LoginController as ControllersLoginController;

use App\Http\Controllers\SharedController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\Web\ChattingController;
use App\Http\Controllers\Customer\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\Customer\CustomerUserProfileController;
use App\Http\Controllers\Web\Customer\UserProfileController as WebCustomerUserProfileController;
use App\Http\Controllers\Web\EstateController as WebEstateController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\PageController;
use App\Http\Controllers\Web\UserProfileController;

use App\Http\Controllers\api\v1\CustomerController;

use App\Http\Controllers\Web\WebController;
use App\Http\Controllers\Web\WishlistController;
use App\Http\Controllers\Web\MoyasarPaymentController;
use App\Models\EstateImage;
use App\Models\Offer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\OfferWizardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::post('change', [LanguageController::class, 'change'])->name('change');




Route::get('/admin/auth/login', [LoginController::class,'loginForm'])->name('showLogin');
Route::post('/admin/auth/login', [LoginController::class,'login'])->name('admin.login');

Route::get('/agent/auth/login', [RoleLoginController::class,'loginForm'])->name('role.showLogin');
Route::post('/agent/auth/login', [RoleLoginController::class,'login'])->name('role.login');

Route::get('/agent/auth/otp', [RoleLoginController::class,'otpForm'])->name('role.otp.form');

// التحقق من OTP
Route::post('/agent/auth/otp', [RoleLoginController::class,'verifyOtp'])->name('role.otp.verify');

// إعادة إرسال OTP
Route::post('/agent/auth/otp/resend', [RoleLoginController::class,'resendOtp'])->name('role.otp.resend');

Route::get('zone/get-coordinates/{id}', [ZoneController::class,'getCoordinates'])->name('zone.get-coordinates');

// Route::get('/', function () {
//     return view('welcome');
// });
    
Route::get('/estates', [HomeController::class, 'estates'])->name('estates.index2');
Route::get('/estates/{estate}/edit', [HomeController::class, 'editEstate'])->name('estates.edit');
Route::put('/estates/{estate}', [HomeController::class, 'updateEstate'])->name('estates.update');


Route::post('/estates/{estate}/transfer-identity', [HomeController::class, 'transferIdentity'])
    ->name('estates.transferIdentity');

// صفحتا دفع اشتراك مزود الخدمة عبر Moyasar (تُفتح داخل WebView في تطبيق الجوال).
// الرابطان موقّعان رقمياً (signed) من ServiceProviderService::createOfferAndSubscription
// و MoyasarPaymentController::callback، لذلك لا يحتاجان جلسة/توكن مستخدم.
Route::get('payment/provider-subscription/{subscription}', [MoyasarPaymentController::class, 'show'])
    ->middleware('signed')
    ->name('payment.provider-subscription.show');

Route::get('payment/provider-subscription/{subscription}/callback', [MoyasarPaymentController::class, 'callback'])
    ->middleware('signed')
    ->name('payment.provider-subscription.callback');


Route::group(['namespace' => 'Web', 'middleware' => ['guestCheck']], function () {
    Route::get('/',  [HomeController::class,'zones'])->name('zones');
    Route::get('home',  [HomeController::class,'index'])->name('home');

    Route::get('map',  [HomeController::class,'map'])->name('map');
    
    
          Route::put('/Brokerage/PushNotification', [HomeController::class, 'handle']);
    
    


    Route::get('/',  [HomeController::class,'zones'])->name('zones-main');

    Route::get('/properties/zone/{zone_id}', [HomeController::class, 'getPropertiesByZone'])->name('byZone');
    
    
    






    Route::controller(WebController::class)->group(function () {
        Route::get('checkout-details', 'checkout_details')->name('checkout-details');
        Route::get('checkout-shipping', 'checkout_shipping')->name('checkout-shipping');
        Route::get('checkout-payment', 'checkout_payment')->name('checkout-payment');
        Route::get('checkout-review', 'checkout_review')->name('checkout-review');
        Route::get('checkout-complete', 'getCashOnDeliveryCheckoutComplete')->name('checkout-complete');
        Route::post('offline-payment-checkout-complete', 'getOfflinePaymentCheckoutComplete')->name('offline-payment-checkout-complete');
        Route::get('order-placed', 'order_placed')->name('order-placed');
        Route::get('shop-cart', 'shop_cart')->name('shop-cart');
        Route::post('order_note', 'order_note')->name('order_note');
        Route::get('digital-product-download/{id}', 'getDigitalProductDownload')->name('digital-product-download');
        Route::post('digital-product-download-otp-verify', 'getDigitalProductDownloadOtpVerify')->name('digital-product-download-otp-verify');
        Route::post('digital-product-download-otp-reset', 'getDigitalProductDownloadOtpReset')->name('digital-product-download-otp-reset');
        Route::get('pay-offline-method-list', 'pay_offline_method_list')->name('pay-offline-method-list')->middleware('guestCheck');

        //wallet payment
        Route::get('checkout-complete-wallet', 'checkout_complete_wallet')->name('checkout-complete-wallet');

        Route::post('subscription', 'subscription')->name('subscription');
        Route::get('search-shop', 'search_shop')->name('search-shop');

        Route::get('categories', 'getAllCategoriesView')->name('categories');
        Route::get('category-ajax/{id}', 'categories_by_category')->name('category-ajax');

        Route::get('brands', 'getAllBrandsView')->name('brands');
        Route::get('vendors', 'getAllVendorsView')->name('vendors');
        Route::get('seller-profile/{id}', 'seller_profile')->name('seller-profile');

        Route::get('flash-deals/{id}', 'getFlashDealsView')->name('flash-deals');
    });


Route::prefix('website-offers')->group(function () {
    Route::get('/step-one', [OfferWizardController::class, 'stepOne'])->name('website.offers.step-one');
    Route::post('/step-one', [OfferWizardController::class, 'stepOneStore'])->name('website.offers.step-one.store');

    Route::get('/step-two', [OfferWizardController::class, 'stepTwo'])->name('website.offers.step-two');
    Route::post('/step-two', [OfferWizardController::class, 'stepTwoStore'])->name('website.offers.step-two.store');

    Route::get('/step-three', [OfferWizardController::class, 'stepThree'])->name('website.offers.step-three');
    Route::post('/step-three', [OfferWizardController::class, 'stepThreeStore'])->name('website.offers.step-three.store');

    Route::get('/preview', [OfferWizardController::class, 'preview'])->name('website.offers.preview');
    // في routes/web.php

Route::post('/website-offers/store', [OfferWizardController::class, 'store'])
    ->name('website.offers.store');
});




    Route::group(['namespace' => 'Customer', 'prefix' => 'customer', 'as' => 'customer.'], function () {

        Route::group(['namespace' => 'Auth', 'prefix' => 'auth', 'as' => 'auth.'], function () {
            Route::get('/code/captcha/{tmp}', [ControllersLoginController::class,'captcha'])->name('default-captcha');
            Route::get('login',  [AuthLoginController::class,'login'])->name('login');
            Route::post('login', [AuthLoginController::class,'submit']);
            Route::get('logout', [AuthLoginController::class,'logout'])->name('logout');
            Route::get('get-login-modal-data', [AuthLoginController::class,'get_login_modal_data'])->name('get-login-modal-data');

            Route::get('sign-up',  [RegisterController::class,'register'])->name('sign-up');
            Route::post('sign-up',   [RegisterController::class,'submit'])->name('sign-up.submit');
            Route::post('sign-up3',   [RegisterController::class,'submit'])->name('sign-up3');

             Route::post('sign-provider',   [RegisterController::class,'submit_provider'])->name('sign-provider');


            // Route::get('provider',  [RegisterController::class,'provider'])->name('provider');


            Route::get('provider',  [RegisterController::class,'provider'])->name('provider');


            Route::get('about-provider',  [RegisterController::class,'about_provider'])->name('about-provider');


        

            Route::get('verify-register/{user_id}', [RegisterController::class, 'showVerificationForm'])->name('verify-register');
            // Route::post('verify-register', [RegisterController::class, 'verify'])->name('verify-register');
            Route::get('resend-register/{user_id}', [RegisterController::class, 'resendOtp'])->name('resend-register');



            Route::get('check-register/{id}',   [RegisterController::class,'check'])->name('check');

            // Customer Default Verify
            Route::post('verify',   [RegisterController::class,'verify'])->name('verify');

            // Customer Ajax Verify for theme except default
            Route::post('ajax-verify',   [RegisterController::class,'@jax_verify'])->name('ajax_verify');
            Route::post('resend-otp',   [RegisterController::class,'resend_otp'])->name('resend_otp');




            Route::get('update-phone/{id}', 'SocialAuthController@editPhone')->name('update-phone');
            Route::post('update-phone/{id}', 'SocialAuthController@updatePhone');

            Route::get('login/{service}', 'SocialAuthController@redirectToProvider')->name('service-login');
            Route::get('login/{service}/callback', 'SocialAuthController@handleProviderCallback')->name('service-callback');

            Route::get('recover-password', 'ForgotPasswordController@reset_password')->name('recover-password');
            Route::post('forgot-password', 'ForgotPasswordController@reset_password_request')->name('forgot-password');
            Route::get('otp-verification', 'ForgotPasswordController@otp_verification')->name('otp-verification');
            Route::post('otp-verification', 'ForgotPasswordController@otp_verification_submit');
            Route::get('reset-password', 'ForgotPasswordController@reset_password_index')->name('reset-password');
            Route::post('reset-password', 'ForgotPasswordController@reset_password_submit');
            Route::post('resend-otp-reset-password', 'ForgotPasswordController@ajax_resend_otp')->name('resend-otp-reset-password');
        });

        // Route::group([], function () {

        //     Route::controller(SystemController::class)->group(function () {
        //         Route::get('set-payment-method/{name}', 'setPaymentMethod')->name('set-payment-method');
        //         Route::get('set-shipping-method', 'setShippingMethod')->name('set-shipping-method');
        //         Route::post('choose-shipping-address', 'getChooseShippingAddress')->name('choose-shipping-address');
        //         Route::post('choose-shipping-address-other', 'getChooseShippingAddressOther')->name('choose-shipping-address-other');
        //         Route::post('choose-billing-address', 'choose_billing_address')->name('choose-billing-address');
        //     });

        //     Route::group(['prefix' => 'reward-points', 'as' => 'reward-points.', 'middleware' => ['auth:customer']], function () {
        //         Route::get('convert', 'RewardPointController@convert')->name('convert');
        //     });
        // });
    });






    Route::controller(UserProfileController::class)->group(function () {
        Route::group(['prefix' => 'support-ticket', 'as' => 'support-ticket.'], function () {
            Route::get('{id}', 'single_ticket')->name('index');
            Route::post('{id}', 'comment_submit')->name('comment');
            Route::get('delete/{id}', 'support_ticket_delete')->name('delete');
            Route::get('close/{id}', 'support_ticket_close')->name('close');
        });
    });

    Route::controller(UserProfileController::class)->group(function () {
        Route::group(['prefix' => 'track-order', 'as' => 'track-order.'], function () {
            Route::get('', 'track_order')->name('index');
            Route::get('result-view', 'track_order_result')->name('result-view');
            Route::get('last', 'track_last_order')->name('last');
            Route::any('result', 'track_order_result')->name('result');
            Route::get('order-wise-result-view', 'track_order_wise_result')->name('order-wise-result-view');
        });
    });





    // // Chatting start
    Route::controller(ChattingController::class)->group(function () {
        Route::get(Chatting::INDEX[URI] . '/{type}', 'index')->name('chat')->middleware('customer');
        Route::get(Chatting::MESSAGE[URI], 'getMessageByUser')->name('messages');
        Route::post(Chatting::MESSAGE[URI], 'addMessage');
    });
    // // chatting end

    // Route::get('wallet-account', 'UserWalletController@my_wallet_account')->name('wallet-account'); //theme fashion
    // Route::get('wallet', 'UserWalletController@index')->name('wallet')->middleware('customer');

    // Route::controller(UserLoyaltyController::class)->group(function () {
    //     Route::get(UserLoyalty::LOYALTY[URI], 'index')->name('loyalty')->middleware('customer');
    //     Route::post(UserLoyalty::EXCHANGE_CURRENCY[URI], 'getLoyaltyExchangeCurrency')->name('loyalty-exchange-currency');
    //     Route::get(UserLoyalty::GET_CURRENCY_AMOUNT[URI], 'getLoyaltyCurrencyAmount')->name('ajax-loyalty-currency-amount');
    // });

    // Route::controller(DigitalProductDownloadController::class)->group(function () {
    //     Route::group(['prefix' => 'digital-product-download-pos', 'as' => 'digital-product-download-pos.'], function () {
    //         Route::get('/', 'index')->name('index');
    //     });
    // });

    // Route::controller(ShopViewController::class)->group(function () {
    //     Route::get('shopView/{id}', 'seller_shop')->name('shopView');
    //     Route::get('ajax-shop-vacation-check', 'ajax_shop_vacation_check')->name('ajax-shop-vacation-check');
    // });

    // Route::controller(WebController::class)->group(function () {
    //     Route::post('shopView/{id}', 'seller_shop_product');
    //     Route::get('top-rated', 'top_rated')->name('topRated');
    //     Route::get('best-sell', 'best_sell')->name('bestSell');
    //     Route::get('new-product', 'new_product')->name('newProduct');
    // });

    // // Route::post('shop-follow', 'ShopFollowerController@shop_follow')->name('shop_follow');

    // Route::group(['prefix' => 'contact', 'as' => 'contact.'], function () {
    //     Route::controller(WebController::class)->group(function () {
    //         Route::post('store', 'contact_store')->name('store');
    //         Route::get('/code/captcha/{tmp}', 'captcha')->name('default-captcha');
    //     });
    // });
});



    // // Profile Route
    Route::controller(WebCustomerUserProfileController::class)->group(function () {
        Route::get('user-profile', 'user_profile')->name('user-profile')->middleware('customer'); //theme_aster
        Route::get('user-account', 'user_account')->name('user-account')->middleware('customer');
        Route::post('user-account-update', 'getUserProfileUpdate')->name('user-update')->middleware('customer');





        Route::post('user-account-picture', 'user_picture')->name('user-picture');
        Route::get('account-address-add', 'account_address_add')->name('account-address-add');
        Route::get('account-address', 'account_address')->name('account-address');
        Route::post('account-address-store', 'address_store')->name('address-store');
        Route::get('account-address-delete', 'address_delete')->name('address-delete');
        ROute::get('account-address-edit/{id}', 'address_edit')->name('address-edit');
        Route::post('account-address-update', 'address_update')->name('address-update');
        Route::get('account-payment', 'account_payment')->name('account-payment');
        Route::get('account-estate', 'account_estate')->name('account-estate')->middleware('customer');
        Route::get('account-order-details', 'account_order_details')->name('account-order-details')->middleware('customer');
        Route::get('account-order-details-vendor-info', 'account_order_details_seller_info')->name('account-order-details-vendor-info')->middleware('customer');
        Route::get('account-order-details-delivery-man-info', 'account_order_details_delivery_man_info')->name('account-order-details-delivery-man-info')->middleware('customer');
        Route::get('account-order-details-reviews', 'getAccountOrderDetailsReviewsView')->name('account-order-details-reviews')->middleware('customer');
        Route::get('generate-invoice/{id}', 'generate_invoice')->name('generate-invoice');
        Route::get('account-wishlist', 'account_wishlist')->name('account-wishlist'); //add to card not work
        Route::get('refund-request/{id}', 'refund_request')->name('refund-request');
        Route::get('refund-details/{id}', 'refund_details')->name('refund-details');
        Route::post('refund-store', 'store_refund')->name('refund-store');
        Route::get('account-tickets', 'account_tickets')->name('account-tickets');
        Route::get('order-cancel/{id}', 'order_cancel')->name('order-cancel');
        Route::post('ticket-submit', 'submitSupportTicket')->name('ticket-submit');
        Route::get('account-delete/{id}', 'account_delete')->name('account-delete');
        Route::get('refer-earn', 'refer_earn')->name('refer-earn')->middleware('customer');
        Route::get('user-coupons', 'user_coupons')->name('user-coupons')->middleware('customer');
        Route::get('delete-estate/{id}', 'delete_estate')->name('delete-estate');

        Route::post('nafath-validation', [CustomerController::class,'sendRequestWeb'])->name('nafath-validation');


        Route::get('add-license', 'add_license')->name('add-license')->middleware('customer');

        Route::post('check-license', 'check_license')->name('check-license')->middleware('customer');


        

        Route::post('support-ticket', 'store_ticket')->name('support-ticket');






         Route::post('check-request-status', [CustomerController::class,'checkRequestStatusWeb'])->name('check-request-status');;

        Route::get('/get-cities/{zone_id}', [WebEstateController::class, 'getCities']);
        Route::get('/get-districts/{cityId}', [WebEstateController::class, 'getDistricts']);



;




            Route::get('/properties/{id}/images', 'getImages')->name('getImages')->middleware('customer');

       Route::get('/properties/{id}/planned', 'getPlanned')->name('getPlanned')->middleware('customer');
        Route::delete('/properties/{id}/images/{image}', 'deleteImage')->name('delete-property-image')->middleware('customer');

        Route::delete('/properties/{id}/planned/{image}', 'deletePlanned')->name('delete-property-planned')->middleware('customer');



        Route::post('/properties/{id}/upload-images', 'uploadImages')->middleware('customer');


        Route::post('/properties/{id}/upload-planned', 'uploadPlanned')->middleware('customer');

        Route::post('report', [WebEstateController::class, 'report'])->name('report');














        // routes/web.php



    });


    Route::controller(PageController::class)->group(function () {
        Route::get(Pages::ABOUT_US[URI], 'getAboutUsView')->name('about-us');
        Route::get(Pages::CONTACTS[URI], 'getContactView')->name('contacts');
        Route::get(Pages::HELP_TOPIC[URI], 'getHelpTopicView')->name('helpTopic');
        Route::get(Pages::REFUND_POLICY[URI], 'getRefundPolicyView')->name('refund-policy');
        Route::get(Pages::RETURN_POLICY[URI], 'getReturnPolicyView')->name('return-policy');
        Route::get(Pages::PRIVACY_POLICY[URI], 'getPrivacyPolicyView')->name('privacy-policy');
        Route::get(Pages::CANCELLATION_POLICY[URI], 'getCancellationPolicyView')->name('cancellation-policy');
        Route::get(Pages::TERMS_AND_CONDITION[URI], 'getTermsAndConditionView')->name('terms');
    });
    Route::controller(WebEstateController::class)->group(function () {
        Route::get('create-estate', 'create_estate')->name('create-estate')->middleware('customer'); //theme_aster

        Route::post('store-estate', 'store_estate')->name('store-estate')->middleware('customer');
        Route::get('/categories/filter','filterCategories')->name('categories.filter');

        Route::get('details/{id}', 'get_details')->name('details');


        Route::get('search','search')->name('search');

        Route::post('wishlist','wishlist')->name('wishlist');

        Route::get('getfv','getfv')->name('getfv');

        Route::post('upload-videos', 'uploadVideosWeb')->name('upload-videos');





        // Route::post('/upload-videos_web', [EstateController::class, 'uploadVideosWeb'])->name('upload.videos');



    });


    
    Route::controller(WishlistController::class)->group(function () {
   

        Route::get('view-wishlist', 'viewWishlist')->name('view-wishlist');
    
        Route::post('delete-wishlist', 'deleteWishlist')->name('delete-wishlist');
     
    });

Route::prefix('/estate')->group(function () {
    Route::get('/create', [EstateContrller::class,'create'])->name('home.create');
    Route::post('store',[EstateContrller::class,'store'])->name('home.store');
    Route::get('/success', [EstateContrller::class,'success'])->name('estate.success');

});

Route::prefix('/video')->group(function () {
    Route::get('/', [VideoController::class,'create'])->name('video.create');
    Route::post('video-upload', [ VideoController::class, 'uploadVideo' ])->name('store.video');

 
    Route::get('/success', [EstateContrller::class,'success'])->name('video.success');

});
Route::get('/test', function () {
    // for($i = 0; $i <=12;$i++) {

    //     $image = new EstateImage();

    //     $image->image = 'service-providers/NdFiwmmuVf3gj4gXWjJd6NbEMekNMATjxVWAjTGz.png';
    //     $image->estate_id = 1;
    //     $image->save();

    // }
    // return Offer::all();

    dd(auth()->guard('user')->check());
});
Route::get('/logout', function () {
    Auth::guard('admin')->logout();

    return to_route('showLogin');
})->name('admin.logout');


Route::get('/agent/logout', function () {
    Auth::guard('user')->logout();

    return to_route('role.showLogin');
})->name('agent.logout');

Route::post('/getEmployees', [EstateController::class,'getUser'])->name('getEmployees');


Route::post('/advertisement/validate', [EstateController::class, 'validateAdvertisement'])
      ->withoutMiddleware('csrf');