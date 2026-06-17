@php
    use App\Enums\ViewPaths\Admin\Brand;
    use App\Enums\ViewPaths\Admin\BusinessSettings;

    use App\Enums\ViewPaths\Admin\Currency;
    use App\Enums\ViewPaths\Admin\Customer;

    use App\Enums\ViewPaths\Admin\Dashboard;
    use App\Enums\ViewPaths\Admin\DatabaseSetting;

    use App\Enums\ViewPaths\Admin\EnvironmentSettings;

    use App\Enums\ViewPaths\Admin\HelpTopic;
    use App\Enums\ViewPaths\Admin\InhouseProductSale;
    use App\Enums\ViewPaths\Admin\Mail;
    use App\Enums\ViewPaths\Admin\OfflinePaymentMethod;
    use App\Enums\ViewPaths\Admin\Order;
    use App\Enums\ViewPaths\Admin\Pages;
    use App\Enums\ViewPaths\Admin\Product;
    use App\Enums\ViewPaths\Admin\PushNotification;

    use App\Enums\ViewPaths\Admin\SiteMap;
    use App\Enums\ViewPaths\Admin\SMSModule;
    use App\Enums\ViewPaths\Admin\SocialLoginSettings;
    use App\Enums\ViewPaths\Admin\SocialMedia;
    use App\Enums\ViewPaths\Admin\SoftwareUpdate;
    use App\Enums\ViewPaths\Admin\SubCategory;
    use App\Enums\ViewPaths\Admin\SubSubCategory;
    use App\Enums\ViewPaths\Admin\ThemeSetup;
    use App\Enums\ViewPaths\Admin\FirebaseOTPVerification;
    use App\Enums\ViewPaths\Admin\Vendor;
    use App\Enums\ViewPaths\Admin\InhouseShop;
    use App\Enums\ViewPaths\Admin\SocialMediaChat;
    use App\Enums\ViewPaths\Admin\ShippingMethod;
    use App\Enums\ViewPaths\Admin\PaymentMethod;
    use App\Enums\ViewPaths\Admin\InvoiceSettings;
    use App\Enums\ViewPaths\Admin\SEOSettings;
    use App\Enums\ViewPaths\Admin\ErrorLogs;
    use App\Enums\ViewPaths\Admin\StorageConnectionSettings;
    use App\Enums\ViewPaths\Admin\SystemSetup;
    use App\Utils\Helpers;
    use App\Enums\EmailTemplateKey;
    $eCommerceLogo = getWebConfig(name: 'company_web_logo');
@endphp


<div id="sidebarMain" class="d-none">
    <aside class="bg-white js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered text-start">
        <div class="navbar-vertical-container">
            <div class="navbar-brand-wrapper justify-content-between side-logo dashboard-navbar-side-logo-wrapper">
                <a class="navbar-brand" href="{{route('admin.dashboard.index')}}" aria-label="Front">
                    <img class="navbar-brand-logo-mini for-web-logo max-h-30"
                         src="{{asset( 'public/assets/front-end/img/cover.png')}}" alt="{{translate('logo')}}">
                </a>
                <button type="button"
                        class="d-none js-navbar-vertical-aside-toggle-invoker navbar-vertical-aside-toggle btn btn-icon btn-xs btn-ghost-dark">
                    <i class="tio-clear tio-lg"></i>
                </button>

                <button type="button" class="js-navbar-vertical-aside-toggle-invoker close">
                    <i class="tio-first-page navbar-vertical-aside-toggle-short-align"></i>
                    <i class="tio-last-page navbar-vertical-aside-toggle-full-align"
                       data-template="<div class=&quot;tooltip d-none d-sm-block&quot; role=&quot;tooltip&quot;><div class=&quot;arrow&quot;></div><div class=&quot;tooltip-inner&quot;></div></div>"
                       ></i>
                </button>
            </div>
            <div class="navbar-vertical-footer-offset pb-0">
                <div class="navbar-vertical-content">
                    <div class="sidebar--search-form pb-3 pt-4 mx-3">
                        <div class="search--form-group">
                            <button type="button" class="btn"><i class="tio-search"></i></button>
                            <input type="text" class="js-form-search form-control form--control" id="search-bar-input"
                                   placeholder="البحث هنا"   style="font-family: 'Cairo', sans-serif; font-size: 18px;">
                        </div>
                    </div>
                    <ul class="navbar-nav navbar-nav-lg nav-tabs">
                        <li class="navbar-vertical-aside-has-menu {{Request::is('admin/dashboard'.Dashboard::VIEW[URI])?'active':''}}" style="border-bottom: 1px solid #ddd; padding-bottom: 10px;">
                            <a class="js-navbar-vertical-aside-menu-link nav-link "
                               title="{{translate('dashboard')}}"
                               href="{{route('admin.dashboard.index')}}">
                                <i class="tio-home-vs-1-outlined nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate"    style="font-family: 'Cairo', sans-serif; font-size: 16px;">
                                   الرئيسية
                                </span>
                            </a>
                        </li>
{{--                        @if (Helpers::module_permission_check('pos_management'))--}}
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/pos*')?'active':''}}" style="border-bottom: 1px solid #ddd; padding-bottom: 10px;">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                   title="ميثاق العمل " href="{{ route('admin.indicators.add') }}"   style="font-family: 'Cairo', sans-serif; font-size: 16px;">
                                   <i class="tio-survey nav-icon"></i>
                                    <span
                                        class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate"   style="font-family: 'Cairo', sans-serif; font-size: 16px;">ميثاق العمل </span>
                                </a>
                            </li>
{{--                        @endif--}}
                        {{-- @if (Helpers::module_permission_check('pos_management'))
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/pos*')?'active':''}}" style="border-bottom: 1px solid #ddd; padding-bottom: 10px;">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                   title="الاحصاءات" href="">
                                   <i class="tio-chart-bar-4 nav-icon"></i>
                                    <span
                                        class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate"   style="font-family: 'Cairo', sans-serif; font-size: 16px;"> الاحصاءات </span>
                                </a>
                            </li>
                        @endif --}}




                        @if (Helpers::module_permission_check('pos_management'))
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/pos*')?'active':''}}" style="border-bottom: 1px solid #ddd; padding-bottom: 10px;">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                   title="التنبيهات" href=""
                                   style="font-family: 'Cairo', sans-serif; font-size: 16px;">
                                    <i class="tio-notifications nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate" > التنبيهات </span>
                                </a>
                            </li>
                        @endif

                        @if (Helpers::module_permission_check('pos_management'))
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/pos*')?'active':''}}" style="border-bottom: 1px solid #ddd; padding-bottom: 10px;">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                   title="الإدارة " href="{{route('admin.admins.list')}}"
                                   style="font-family: 'Cairo', sans-serif; font-size: 16px;">
                                    <i class="tio-notifications nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate"> الإدارة  </span>
                                </a>
                            </li>
                        @endif


                        @if(Helpers::module_permission_check('user_section'))
{{--                            <li class="nav-item {{(Request::is('admin/customer/'.Customer::LIST[URI]) || Request::is('admin/customer/'.Customer::VIEW[URI].'*') || Request::is('admin/customer/'.Customer::SUBSCRIBER_LIST[URI])||Request::is('admin/vendors/'.Vendor::ADD[URI]) || Request::is('admin/vendors/'.Vendor::LIST[URI]) || Request::is('admin/delivery-man*'))?'scroll-here':''}}" style="border-bottom: 1px solid #ddd; padding-bottom: 10px;">--}}
{{--                                <small    style="font-family: 'Cairo', sans-serif; font-size: 18px;" class="nav-subtitle" title="">إدارة المسخدمين</small>--}}
{{--                                <small class="tio-more-horizontal nav-subtitle-replacer"></small>--}}
{{--                            </li>--}}



                            <li class="navbar-vertical-aside-has-menu {{ Request::is('admin/vendors*') || Request::is('admin/vendors/withdraw-method/*') || (Request::is('admin/orders/details/*') && request()->has('user-order-list')) ? 'active' : '' }}"  style="border-bottom: 1px solid #ddd; padding-bottom: 10px;">
                                <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                   href="javascript:" title="المستخدمين">
                                    <i class="tio-users-switch nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate"   style="font-family: 'Cairo', sans-serif; font-size: 16px;">المستخدمين</span>
                                </a>
                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                    style="display: {{Request::is('admin/vendors*') || (Request::is('admin/orders/details/*') && request()->has('user-order-list'))?'block':'none'}}">
                                    <li class="nav-item {{Request::is('admin/vendors/'.Vendor::ADD[URI])?'active':''}}">
                                        <a class="nav-link" title=" اضافة مسخدم جديد"
                                           href="{{route('admin.vendors.add')}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate"   style="font-family: 'Cairo', sans-serif; font-size: 16px;">
                                        اضافة مستخدم جديد
                                    </span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('admin/vendors/'.Vendor::LIST[URI]) ||Request::is('admin/vendors/'.Vendor::VIEW[URI].'*') ?'active':''}}">
                                        <a class="nav-link" title=" قائمة المسخدمين"
                                           href="{{route('admin.vendors.user-list')}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate"   style="font-family: 'Cairo', sans-serif; font-size: 16px;">
                                        قائمة المسخدمين
                                    </span>
                                        </a>
                                    </li>




                                </ul>
                            </li>







                        @endif


                        @if (Helpers::module_permission_check('pos_management'))
                        <li class="navbar-vertical-aside-has-menu {{Request::is('admin/pos*')?'active':''}}" style="border-bottom: 1px solid #ddd; padding-bottom: 10px;">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                               title="التقارير" href="{{route('admin.reports.index')}}">
                               <i class="tio-chart-bar-4 nav-icon"></i>
                                <span
                                    class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate"   style="font-family: 'Cairo', sans-serif; font-size: 16px;"> التقارير </span>
                            </a>
                        </li>

                    @endif


{{--                    @if (Helpers::module_permission_check('pos_management'))--}}
                    <li class="navbar-vertical-aside-has-menu {{Request::is('admin/pos*')?'active':''}}" style="border-bottom: 1px solid #ddd; padding-bottom: 10px;">
                        <a class="js-navbar-vertical-aside-menu-link nav-link"
                           title="الإعتمادات" href="{{ route('admin.credits.list') }}">
                           <i class="tio-airdrop nav-icon"></i>
                            <span
                                class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate"   style="font-family: 'Cairo', sans-serif; font-size: 16px;"> الإعتمادات </span>
                        </a>
                    </li>










{{--                @endif--}}




                @if (Helpers::module_permission_check('pos_management'))
                <li class="navbar-vertical-aside-has-menu {{Request::is('admin/pos*')?'active':''}}" style="border-bottom: 1px solid #ddd; padding-bottom: 10px;">
                    <a class="js-navbar-vertical-aside-menu-link nav-link"
                       title="الادوات" href=" {{ route('admin.tools.add') }}">
                       <i class="tio-airdrop nav-icon"></i>
                        <span
                            class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate"   style="font-family: 'Cairo', sans-serif; font-size: 16px;"> الادوات </span>
                    </a>
                </li>

            @endif




            @if (Helpers::module_permission_check('pos_management'))
            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/pos*')?'active':''}}" style="border-bottom: 1px solid #ddd; padding-bottom: 10px;">
                <a class="js-navbar-vertical-aside-menu-link nav-link"
                   title="المعاير" href=" {{ route('admin.standards.add') }}">
                   <i class="tio-airdrop nav-icon"></i>
                    <span
                        class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate"   style="font-family: 'Cairo', sans-serif; font-size: 16px;"> المعايير </span>
                </a>
            </li>

        @endif




                        @if (Helpers::module_permission_check('indicators'))
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/pos*')?'active':''}}" style="border-bottom: 1px solid #ddd; padding-bottom: 10px;">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                   title="المؤشرات" href="{{route('admin.indicators.add')}}">
                                    <i class="tio-chart-bar-4 nav-icon"></i>
                                    <span
                                        class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate"   style="font-family: 'Cairo', sans-serif; font-size: 16px;"> المؤشرات </span>
                                </a>
                            </li>
                        @endif

{{--                        @if(Helpers::module_permission_check('system_settings'))--}}
{{--                            <li class="nav-item {{(--}}
{{--                                Request::is('admin/business-settings/web-config') ||--}}
{{--                                Request::is('admin/business-chart-settings')||--}}
{{--                                Request::is('admin/business-settings/'.SocialMedia::VIEW[URI]) ||--}}
{{--                                Request::is('admin/business-settings/web-config/'.BusinessSettings::APP_SETTINGS[URI]) ||--}}
{{--                                Request::is('admin/business-settings/'.Pages::TERMS_CONDITION[URI]) ||--}}
{{--                                Request::is('admin/business-settings/'.Pages::VIEW[URI].'*') ||--}}
{{--                                Request::is('admin/business-settings/'.Pages::PRIVACY_POLICY[URI]) ||--}}
{{--                                Request::is('admin/business-settings/'.Pages::ABOUT_US[URI]) ||--}}
{{--                                Request::is('admin/helpTopic/'.HelpTopic::LIST[URI]) ||--}}
{{--                                Request::is('admin/business-settings/'.PushNotification::INDEX[URI]) ||--}}
{{--                                Request::is('admin/business-settings/'.Mail::VIEW[URI])||--}}
{{--                                Request::is('admin/business-settings/web-config/'.DatabaseSetting::VIEW[URI]) ||--}}
{{--                                Request::is('admin/business-settings/web-config/'.EnvironmentSettings::VIEW[URI]) ||--}}
{{--                                Request::is('admin/business-settings/'.BusinessSettings::INDEX[URI]) ||--}}
{{--                                Request::is('admin/business-settings/'.BusinessSettings::COOKIE_SETTINGS[URI]) ||--}}
{{--                                Request::is('admin/system-setup/login-settings/'.SystemSetup::CUSTOMER_LOGIN_SETUP[URI]) ||--}}
{{--                                Request::is('admin/system-setup/login-settings/'.SystemSetup::OTP_SETUP[URI]) ||--}}
{{--                                Request::is('admin/system-setup/login-settings/'.SystemSetup::LOGIN_URL_SETUP[URI]) ||--}}
{{--                                Request::is('admin/system-settings/'.SoftwareUpdate::VIEW[URI]) ||--}}
{{--                                Request::is('admin/business-settings/web-config/theme/'.ThemeSetup::VIEW[URI]) ||--}}
{{--                                Request::is('admin/business-settings/shipping-method/'.ShippingMethod::UPDATE[URI].'*') ||--}}
{{--                                Request::is('admin/business-settings/shipping-method/'.ShippingMethod::INDEX[URI]) ||--}}
{{--                                Request::is('admin/business-settings/delivery-restriction') ||--}}
{{--                                Request::is('admin/business-settings/invoice-settings') ||--}}
{{--                                Request::is('admin/seo-settings/'.SEOSettings::WEB_MASTER_TOOL[URI]) ||--}}
{{--                                Request::is('admin/seo-settings/'.SEOSettings::ROBOT_TXT[URI]) ||--}}
{{--                                Request::is('admin/seo-settings/'.SiteMap::SITEMAP[URI]) ||--}}
{{--                                Request::is('admin/seo-settings/robots-meta-content*') ||--}}
{{--                                Request::is('admin/error-logs/'.ErrorLogs::INDEX[URI]) ||--}}
{{--                                Request::is('admin/addon')) ? 'scroll-here' : '' }}">--}}

{{--                                <small class="nav-subtitle"--}}
{{--                                       title="">{{translate('system_Settings')}}</small>--}}
{{--                                <small class="tio-more-horizontal nav-subtitle-replacer"></small>--}}
{{--                            </li>--}}

{{--                            <li class="navbar-vertical-aside-has-menu">--}}
{{--                                <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"--}}
{{--                                   href="javascript:" title="{{translate('business_Setup')}}">--}}
{{--                                    <i class="tio-pages-outlined nav-icon"></i>--}}
{{--                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">--}}
{{--                                        {{translate('business_Setup')}}--}}
{{--                                    </span>--}}
{{--                                </a>--}}
{{--                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub"--}}
{{--                                    style="display: {{(--}}
{{--                                        Request::is('admin/business-settings/web-config') ||--}}
{{--                                        Request::is('admin/business-chart-settings')||--}}
{{--                                        Request::is('admin/business-chart-settings/'.InhouseShop::VIEW[URI]) ||--}}
{{--                                        Request::is('admin/business-settings/payment-method/'.PaymentMethod::PAYMENT_OPTION[URI])||--}}
{{--                                        Request::is('admin/business-settings/user-settings') ||--}}
{{--                                        Request::is('admin/customer/'.Customer::SETTINGS[URI]) ||--}}
{{--                                        Request::is('admin/business-settings/delivery-man-settings') ||--}}
{{--                                        Request::is('admin/business-settings/shipping-method/'.ShippingMethod::UPDATE[URI].'*') ||--}}
{{--                                        Request::is('admin/business-settings/shipping-method/'.ShippingMethod::INDEX[URI]) ||--}}
{{--                                        Request::is('admin/business-settings/order-settings/index') ||--}}
{{--                                        Request::is('admin/'.BusinessSettings::PRODUCT_SETTINGS[URI]) ||--}}
{{--                                        Request::is('admin/business-settings/invoice-settings') ||--}}
{{--                                        Request::is('admin/business-settings/priority-setup')||--}}
{{--                                        Request::is('admin/seo-settings/'.SEOSettings::WEB_MASTER_TOOL[URI]) ||--}}
{{--                                        Request::is('admin/seo-settings/'.SEOSettings::ROBOT_TXT[URI]) ||--}}
{{--                                        Request::is('admin/seo-settings/'.SiteMap::SITEMAP[URI]) ||--}}
{{--                                        Request::is('admin/seo-settings/robots-meta-content*') ||--}}
{{--                                        Request::is('admin/error-logs/'.ErrorLogs::INDEX[URI]) ||--}}
{{--                                        Request::is('admin/business-settings/delivery-restriction'))?'block':'none'}}">--}}
{{--                                    <li class="nav-item {{(--}}
{{--                                            Request::is('admin/business-settings/web-config') ||--}}
{{--                                            Request::is('admin/business-chart-settings')||--}}
{{--                                            Request::is('admin/business-settings/payment-method/'.PaymentMethod::PAYMENT_OPTION[URI]) ||--}}
{{--                                            Request::is('admin/business-settings/user-settings') ||--}}
{{--                                            Request::is('admin/customer/'.Customer::SETTINGS[URI]) ||--}}
{{--                                            Request::is('admin/business-settings/delivery-man-settings') ||--}}
{{--                                            Request::is('admin/business-settings/shipping-method/'.ShippingMethod::UPDATE[URI].'*') ||--}}
{{--                                            Request::is('admin/business-settings/shipping-method/'.ShippingMethod::INDEX[URI]) ||--}}
{{--                                            Request::is('admin/business-settings/order-settings/index') ||--}}
{{--                                            Request::is('admin/'.BusinessSettings::PRODUCT_SETTINGS[URI]) ||--}}
{{--                                            Request::is('admin/business-settings/invoice-settings') ||--}}
{{--                                            Request::is('admin/business-settings/priority-setup') ||--}}
{{--                                            Request::is('admin/business-settings/delivery-restriction'))?'active':''}}">--}}
{{--                                        <a class="nav-link" href="{{route('admin.business-settings.web-config.index')}}"--}}
{{--                                           title="{{translate('business_Settings')}}">--}}
{{--                                            <span class="tio-circle nav-indicator-icon"></span>--}}
{{--                                            <span class="text-truncate">--}}
{{--                                              {{translate('business_Settings')}}--}}
{{--                                            </span>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                    <li class="nav-item {{Request::is('admin/business-chart-settings/'.InhouseShop::VIEW[URI]) ? 'active' : ''}}">--}}
{{--                                        <a class="nav-link" href=""--}}
{{--                                           title="{{translate('in-house_Shop')}}">--}}
{{--                                            <span class="tio-circle nav-indicator-icon"></span>--}}
{{--                                            <span class="text-truncate">--}}
{{--                                              {{translate('in-house_Shop')}}--}}
{{--                                            </span>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                    <li class="nav-item {{--}}
{{--                                        (Request::is('admin/seo-settings/'.SEOSettings::WEB_MASTER_TOOL[URI]) ||--}}
{{--                                        Request::is('admin/seo-settings/'.SEOSettings::ROBOT_TXT[URI]) ||--}}
{{--                                        Request::is('admin/seo-settings/'.SiteMap::SITEMAP[URI]) ||--}}
{{--                                        Request::is('admin/seo-settings/robots-meta-content*') ||--}}
{{--                                        Request::is('admin/error-logs/'.ErrorLogs::INDEX[URI])) ? 'active' : ''--}}
{{--                                    }}">--}}
{{--                                        <a class="nav-link" href=""--}}
{{--                                           title="{{ translate('SEO_Settings') }}">--}}
{{--                                            <span class="tio-circle nav-indicator-icon"></span>--}}
{{--                                            <span class="text-truncate">--}}
{{--                                              {{ translate('SEO_Settings') }}--}}
{{--                                            </span>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </li>--}}
{{--                            <li class="navbar-vertical-aside-has-menu ">--}}
{{--                                <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"--}}
{{--                                   href="javascript:" title="{{translate('system_Setup')}}">--}}
{{--                                    <i class="tio-pages-outlined nav-icon"></i>--}}
{{--                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">--}}
{{--                                        {{translate('system_Setup')}}--}}
{{--                                    </span>--}}
{{--                                </a>--}}
{{--                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub"--}}
{{--                                    style="display: {{(--}}
{{--                                        Request::is('admin/business-settings/web-config/'.EnvironmentSettings::VIEW[URI]) ||--}}
{{--                                        Request::is('admin/business-settings/web-config/'.SiteMap::SITEMAP[URI]) ||--}}
{{--                                        Request::is('admin/currency/'.Currency::LIST[URI]) ||--}}
{{--                                        Request::is('admin/currency/'.Currency::UPDATE[URI].'*') ||--}}
{{--                                        Request::is('admin/business-settings/web-config/'.DatabaseSetting::VIEW[URI]) ||--}}
{{--                                        Request::is('admin/business-settings/language*') ||--}}
{{--                                        Request::is('admin/business-settings/web-config/theme/'.ThemeSetup::VIEW[URI])  ||--}}
{{--                                        Request::is('admin/system-settings/'.SoftwareUpdate::VIEW[URI]) ||--}}
{{--                                        Request::is('admin/business-settings/'.BusinessSettings::COOKIE_SETTINGS[URI]) ||--}}
{{--                                        Request::is('admin/system-setup/login-settings/'.SystemSetup::OTP_SETUP[URI]) ||--}}
{{--                                        Request::is('admin/system-setup/login-settings/'.SystemSetup::CUSTOMER_LOGIN_SETUP[URI]) ||--}}
{{--                                        Request::is('admin/system-setup/login-settings/'.SystemSetup::LOGIN_URL_SETUP[URI])  ||--}}
{{--                                        Request::is('admin/business-settings/web-config/'.BusinessSettings::APP_SETTINGS[URI]) ||--}}
{{--                                        Request::is('admin/business-settings/email-templates/*')  ||--}}
{{--                                        Request::is('admin/addon'))?'block':'none'}}">--}}
{{--                                    <li class="nav-item {{(--}}
{{--                                            Request::is('admin/business-settings/web-config/'.EnvironmentSettings::VIEW[URI]) ||--}}
{{--                                            Request::is('admin/business-settings/web-config/'.SiteMap::SITEMAP[URI]) ||--}}
{{--                                            Request::is('admin/currency/'.Currency::LIST[URI]) ||--}}
{{--                                            Request::is('admin/currency/'.Currency::UPDATE[URI].'*') ||--}}
{{--                                            Request::is('admin/business-settings/web-config/'.DatabaseSetting::VIEW[URI]) ||--}}
{{--                                            Request::is('admin/business-settings/language*') ||--}}
{{--                                            Request::is('admin/system-settings/'.SoftwareUpdate::VIEW[URI]) ||--}}
{{--                                            Request::is('admin/business-settings/'.BusinessSettings::COOKIE_SETTINGS[URI]) ||--}}
{{--                                            Request::is('admin/business-settings/web-config/'.BusinessSettings::APP_SETTINGS[URI]) ||--}}
{{--                                            Request::is('admin/business-settings/invoice-settings/'.InvoiceSettings::VIEW[URI]) ||--}}
{{--                                            Request::is('admin/business-settings/delivery-restriction'))?'active':''}}">--}}
{{--                                        <a class="nav-link" href="{{route('admin.business-settings.web-config.environment-setup')}}"--}}
{{--                                           title="{{translate('system_Settings')}}">--}}
{{--                                            <span class="tio-circle nav-indicator-icon"></span>--}}
{{--                                            <span class="text-truncate">--}}
{{--                                              {{translate('system_Settings')}}--}}
{{--                                            </span>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                    <li class="nav-item {{--}}
{{--                                            Request::is('admin/system-setup/login-settings/'.SystemSetup::LOGIN_URL_SETUP[URI])  ||--}}
{{--                                            Request::is('admin/system-setup/login-settings/'.SystemSetup::CUSTOMER_LOGIN_SETUP[URI]) ||--}}
{{--                                            Request::is('admin/system-setup/login-settings/'.SystemSetup::OTP_SETUP[URI]) ? 'active' : ''}}">--}}
{{--                                        <a class="nav-link" href="{{ route('admin.system-setup.login-settings.customer-login-setup') }}"--}}
{{--                                           title="{{translate('login_Settings')}}">--}}
{{--                                            <span class="tio-circle nav-indicator-icon"></span>--}}
{{--                                            <span class="text-truncate">--}}
{{--                                              {{translate('login_Settings')}}--}}
{{--                                            </span>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                    <li class="nav-item {{--}}
{{--                                        Request::is('admin/addon') ||--}}
{{--                                        Request::is('admin/business-settings/web-config/theme/'.ThemeSetup::VIEW[URI]) ? 'active' : ''}}"--}}
{{--                                    >--}}
{{--                                        <a class="nav-link" href="{{ route('admin.business-settings.web-config.theme.setup') }}"--}}
{{--                                           title="{{translate('themes_&_Addons')}}">--}}
{{--                                            <span class="tio-circle nav-indicator-icon"></span>--}}
{{--                                            <span class="text-truncate">--}}
{{--                                              {{translate('themes_&_Addons')}}--}}
{{--                                            </span>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                    <li class="nav-item {{Request::is('admin/business-settings/email-templates/*') ? 'active' : ''}}">--}}
{{--                                        <a class="nav-link" href=""--}}
{{--                                           title="{{translate('in-house_Shop')}}">--}}
{{--                                            <span class="tio-circle nav-indicator-icon"></span>--}}
{{--                                            <span class="text-truncate text-capitalize">--}}
{{--                                              {{translate('email_template')}}--}}
{{--                                            </span>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </li>--}}




{{--                            @if(count(config('addon_admin_routes'))>0)--}}
{{--                                <li class="navbar-vertical-aside-has-menu--}}
{{--                                @foreach(config('addon_admin_routes') as $routes)--}}
{{--                                    @foreach($routes as $route)--}}
{{--                                        {{strstr(Request::url(), $route['path'])?'active':''}}--}}
{{--                                    @endforeach--}}
{{--                                @endforeach--}}
{{--                            ">--}}
{{--                                    <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"--}}
{{--                                       href="javascript:" title="{{translate('Pages_&_Media')}}">--}}
{{--                                        <i class="tio-puzzle nav-icon"></i>--}}
{{--                                        <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">--}}
{{--                                        {{translate('addon_Menus')}}--}}
{{--                                    </span>--}}
{{--                                    </a>--}}
{{--                                    @dd($route['name'])--}}
{{--                                    <ul class="js-navbar-vertical-aside-submenu nav nav-sub"--}}
{{--                                        style="display:--}}
{{--                                    @foreach(config('addon_admin_routes') as $routes)--}}
{{--                                        @foreach($routes as $route)--}}
{{--                                            {{ strstr(Request::url(), $route['path'])?'block':'' }}--}}
{{--                                        @endforeach--}}
{{--                                    @endforeach--}}
{{--                                    ">--}}
{{--                                        @foreach(config('addon_admin_routes') as $routes)--}}
{{--                                            @foreach($routes as $route)--}}
{{--                                                <li class="navbar-vertical-aside-has-menu {{strstr(Request::url(), $route['path'])?'active':''}}">--}}

{{--                                                    <a class="js-navbar-vertical-aside-menu-link nav-link"--}}
{{--                                                       href="{{ $route['url'] }}"--}}
{{--                                                       title="{{ translate($route['name']) }}">--}}
{{--                                                        <span class="tio-circle nav-indicator-icon"></span>--}}
{{--                                                        <span--}}
{{--                                                            class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">--}}
{{--                                                        {{ translate($route['name']) }}--}}
{{--                                                    </span>--}}
{{--                                                    </a>--}}

{{--                                                </li>--}}
{{--                                            @endforeach--}}
{{--                                        @endforeach--}}
{{--                                    </ul>--}}
{{--                                </li>--}}
{{--                            @endif--}}
{{--                        @endif--}}
                        <li class="nav-item pt-5">
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </aside>
</div>
