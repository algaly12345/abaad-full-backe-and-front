<?php

namespace App\Providers;

use App\Helpers\Helpers;
use App\Models\Banner;
use App\Models\BusinessSetting;
use App\Models\Category;
use App\Models\Estate;
use Illuminate\Support\ServiceProvider;
use MatanYadaev\EloquentSpatial\Objects\Geometry;



use App\Models\FlashDealProduct;
use App\Traits\FileManagerTrait;

use App\Enums\GlobalConstant;

use App\Models\Currency;
use App\Models\Setting;
use App\Models\Shop;
use App\Models\SocialMedia;
use App\Models\Tag;

use App\Models\FlashDeal;
use App\Models\Offer;
use App\Models\Product;
use App\Models\User;
use App\Observers\OfferObserver;
use App\Observers\UserObserver;
use App\Traits\AddonHelper;
use App\Traits\ThemeHelper;
use App\Utils\ProductManager;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */

     use ThemeHelper;


    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    // public function boot()
    // {
    //     Geometry::macro('getName', function (): string {
    //         /** @var Geometry $this */
    //         return class_basename($this);
    //     });


    // }


    public function boot()
    {


        if (class_exists(\App\Observers\EstateObserver::class)) {
            \App\Models\Estate::observe(\App\Observers\EstateObserver::class);
        }


        if (class_exists(\App\Observers\OfferObserver::class)) {
            Offer::observe(OfferObserver::class);
        }

        // نظام صلاحيات مزودي الخدمة: ربط دور provider تلقائيًا بأي حساب
        // user_type=provider عند الإنشاء أو التحديث (انظر تعليقات UserObserver
        // للتنبيه حول استعلامات DB::table() الخام التي تتجاوز هذا الحدث).
        if (class_exists(UserObserver::class)) {
            User::observe(UserObserver::class);
        }


            
        if (!App::runningInConsole()) {
            Paginator::useBootstrap();




            // Config::set('get_theme_routes', $this->get_theme_routes());

            try {
                if (Schema::hasTable('business_settings')) {


                    $popup_banner = Banner::where(['status' => 1])->first();

                    $header_banner = Banner::where(['status' => 1,'status' => 1])->latest()->first();


                    $web = BusinessSetting::all();
                    $settings = Helpers::get_settings($web, 'colors');
                    $data = json_decode($settings['value'], true);

                    Cache::forget('inhouseShopInTemporaryClose');
                    $inhouseShopInTemporaryClose = Cache::get('inhouseShopInTemporaryClose');
                    if ($inhouseShopInTemporaryClose === null) {
                        $inhouseShopInTemporaryClose = Helpers::get_settings($web, 'temporary_close');
                        $inhouseShopInTemporaryClose = $inhouseShopInTemporaryClose ? json_decode($inhouseShopInTemporaryClose->value, true)['status'] : 0;
                        Cache::put('inhouseShopInTemporaryClose', $inhouseShopInTemporaryClose, (60 * 24));
                    }

                    $web_config = [
                        'primary_color' => $data['primary'],
                        'secondary_color' => $data['secondary'],
                        'primary_color_light' => isset($data['primary_light']) ? $data['primary_light'] : '',
                        'name' => Helpers::get_settings($web, 'company_name'),
                        'phone' => Helpers::get_settings($web, 'company_phone'),
                        'about_us_web' => Helpers::get_settings($web, 'about_us_web'),
                        'about_us_web_ar' => Helpers::get_settings($web, 'about_us_web_ar'),


                        'privacy_policy_web_ar' => Helpers::get_settings($web, 'privacy_policy_web_ar'),

                        'privacy_policy_web' => Helpers::get_settings($web, 'privacy_policy_web'),



                        'terms_and_conditions' => Helpers::get_settings($web, 'terms_and_conditions'),

                        'terms_condition' => Helpers::get_settings($web, 'terms_condition'),





                        'web_logo' => getWebConfig('company_web_logo'),
                        'mob_logo' => getWebConfig( 'company_mobile_logo'),
                        'fav_icon' => getWebConfig( 'company_fav_icon'),
                        'email' => Helpers::get_settings($web, 'company_email'),
                        'about' => Helpers::get_settings($web, 'about_us'),
                        'footer_logo' => getWebConfig('company_footer_logo'),
                        'ios' => Helpers::get_business_settings('download_app_apple_stroe'),
                        'android' => Helpers::get_business_settings('download_app_google_stroe'),
                        // 'social_media' => SocialMedia::where('active_status', 1)->get(),
                        'cookie_setting' => Helpers::get_settings($web, 'cookie_setting'),
                        'copyright_text' => Helpers::get_settings($web, 'company_copyright_text'),
                        // 'decimal_point_settings' => !empty(\App\Utils\Helpers::get_business_settings('decimal_point_settings')) ? \App\Utils\Helpers::get_business_settings('decimal_point_settings') : 0,
                        'seller_registration' => BusinessSetting::where(['type' => 'seller_registration'])->first()->value,
                        'wallet_status' => Helpers::get_business_settings('wallet_status'),
                        'loyalty_point_status' => Helpers::get_business_settings('loyalty_point_status'),
                        'guest_checkout_status' => Helpers::get_business_settings('guest_checkout'),
                        'popup_banner' => $popup_banner,
                        'header_banner' => $header_banner,
                    ];



                    $features_section = [
                        'features_section_top' => BusinessSetting::where('type', 'features_section_top')->first() ? BusinessSetting::where('type', 'features_section_top')->first()->value : [],
                        'features_section_middle' => BusinessSetting::where('type', 'features_section_middle')->first() ? BusinessSetting::where('type', 'features_section_middle')->first()->value : [],
                        'features_section_bottom' => BusinessSetting::where('type', 'features_section_bottom')->first() ? BusinessSetting::where('type', 'features_section_bottom')->first()->value : [],
                    ];




                    if ((!Request::is('admin') && !Request::is('admin/*') && !Request::is('seller/*') && !Request::is('vendor/*')) || Request::is('vendor/auth/registration/*') ) {
                        $userId = Auth::guard('customer')->user() ? Auth::guard('customer')->id() : 0;


                        $recaptcha = Helpers::get_business_settings('recaptcha');
                        $socials_login = Helpers::get_business_settings('social_login');
                        $socialLoginTextShowStatus = false;
                        foreach ($socials_login as $socialLoginService) {
                            if (isset($socialLoginService) && $socialLoginService['status'] == true) {
                                $socialLoginTextShowStatus = true;
                            }
                        }

                        $popup_banner = Banner::where(['status' => 1])->first();

                        $header_banner = Banner::where(['status' => 1,'status' => 1])->latest()->first();

                        $paymentGatewayPublishedStatus = 0; // Set a default value

                        $paymentPublishedStatus = config('get_payment_publish_status');
                        if (isset($paymentPublishedStatus[0]['is_published'])) {
                            $paymentGatewayPublishedStatus = $paymentPublishedStatus[0]['is_published'];
                        }

                        $paymentsGatewaysList = [];


                        $referralEarningStatus = BusinessSetting::where('type', 'ref_earning_status')->first()->value ?? 0;




                    }


                    $language = BusinessSetting::where('type', 'language')->first();

                    //currency


                    View::share(['web_config' => $web_config, 'language' => $language]);

                    Schema::defaultStringLength(191);

                }
            } catch (\Exception $exception) {

            }
        }

        /**
         * Paginate a standard Laravel Collection.
         *
         * @param int $perPage
         * @param int $total
         * @param int $page
         * @param string $pageName
         * @return array
         */



    }
}