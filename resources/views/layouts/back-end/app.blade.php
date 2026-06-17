@php
    use App\Utils\Helpers;
    use Carbon\Carbon;
@endphp
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{Session::get('direction')}}"
      style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="nofollow, noindex ">
    <title>@yield('title')</title>
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{getStorageImages(path: getWebConfig(name: 'company_fav_icon'), type:'backend-logo')}}">
    <link rel="stylesheet" href="{{asset( 'public/assets/back-end/css/vendor.min.css')}}">
    <link rel="stylesheet" href="{{asset( 'public/assets/back-end/css/bootstrap.min.css')}}">
  <link href="https://fonts.googleapis.com/css2?family=Cairo&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset( 'public/assets/back-end/css/custom.css')}}">
    <link rel="stylesheet" href="{{asset( 'public/assets/back-end/vendor/icon-set/style.css')}}">
    <link rel="stylesheet" href="{{asset( 'public/assets/back-end/css/theme.minc619.css?v=1.0')}}">
    <link rel="stylesheet" href="{{asset( 'public/assets/back-end/css/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{asset( 'public/assets/back-end/css/style.css')}}">
    <link rel="stylesheet" href="{{asset( 'public/assets/back-end/css/toastr.css')}}">


    <script src="{{ asset( 'public/js/pages/dashboard.js') }}"></script>
 <link href="https://fonts.googleapis.com/css2?family=Cairo&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

   {{-- <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600&display=swap" rel="stylesheet">  --}}
    @if(Session::get('direction') === "rtl")
        <link rel="stylesheet" href="{{asset( 'public/assets/back-end/css/menurtl.css')}}">
    @endif
    <link rel="stylesheet" href="{{asset( 'public/css/lightbox.css')}}">
    @stack('css_or_js')
    <script
        src="{{asset( 'public/assets/back-end/vendor/hs-navbar-vertical-aside/hs-navbar-vertical-aside-mini-cache.js')}}"></script>
    <style>
        select {
            background-image: url('{{asset( 'public/assets/back-end/img/arrow-down.png')}}');
            background-size: 7px;
            background-position: 96% center;
        }
    </style>
    @if(Request::is('admin/payment/configuration/addon-payment-get'))
        <style>
            .form-floating > label {
                position: relative;
                display: block;
                margin-bottom: 12px;
                padding: 0;
                inset-inline: 0 !important;
            }


            :root{
    --sidebar-bg-1:#081120;
    --sidebar-bg-2:#0d2233;
    --sidebar-bg-3:#0f3a39;
    --sidebar-text:#dbe7ef;
    --sidebar-muted:#9fb3c8;
    --sidebar-hover:rgba(20, 184, 166, 0.14);
    --sidebar-active:#14b8a6;
    --sidebar-active-2:#0f766e;
    --sidebar-border:rgba(255,255,255,.08);
    --sidebar-card:rgba(255,255,255,.05);
    --sidebar-white:#ffffff;
}

.vertical-menu{
    width: 280px;
    background:
        linear-gradient(180deg, var(--sidebar-bg-1) 0%, var(--sidebar-bg-2) 55%, var(--sidebar-bg-3) 100%);
    border-left: 1px solid var(--sidebar-border);
    box-shadow: 0 18px 45px rgba(2, 8, 23, .22);
    font-family: 'Cairo', sans-serif !important;
}

.vertical-menu .h-100{
    display: flex;
    flex-direction: column;
    height: 100%;
}

.user-wid{
    margin: 18px 14px 12px;
    padding: 24px 16px !important;
    border-radius: 24px;
    background: var(--sidebar-card);
    border: 1px solid var(--sidebar-border);
    backdrop-filter: blur(8px);
}

.user-img img{
    width: 82px;
    height: 82px;
    object-fit: cover;
    border-radius: 50%;
    border: 3px solid rgba(255,255,255,.14);
    box-shadow: 0 10px 24px rgba(0,0,0,.18);
}

.user-wid a{
    color: var(--sidebar-white) !important;
    font-size: 17px !important;
    font-weight: 700 !important;
    text-decoration: none;
}

.user-wid p{
    color: var(--sidebar-muted) !important;
    font-size: 13px !important;
}

#sidebar-menu{
    padding: 8px 12px 18px;
}

#side-menu{
    margin: 0;
    padding: 0;
}

#side-menu > li{
    margin-bottom: 8px;
}

#side-menu > li > a{
    display: flex !important;
    align-items: center;
    gap: 12px;
    min-height: 52px;
    padding: 13px 16px;
    border-radius: 16px;
    color: var(--sidebar-text) !important;
    font-size: 15px;
    font-weight: 600;
    text-decoration: none;
    transition: all .25s ease;
    position: relative;
    overflow: hidden;
}

#side-menu > li > a i{
    font-size: 20px;
    min-width: 24px;
    text-align: center;
    color: #b9ccdc;
    transition: all .25s ease;
}

#side-menu > li > a:hover{
    background: var(--sidebar-hover);
    color: var(--sidebar-white) !important;
    transform: translateX(-2px);
}

#side-menu > li > a:hover i{
    color: #5eead4;
}

#side-menu > li.mm-active > a,
#side-menu > li > a.active{
    background: linear-gradient(135deg, var(--sidebar-active-2), var(--sidebar-active));
    color: var(--sidebar-white) !important;
    box-shadow: 0 12px 28px rgba(20, 184, 166, .22);
}

#side-menu > li.mm-active > a i,
#side-menu > li > a.active i{
    color: var(--sidebar-white) !important;
}

#side-menu > li > a.has-arrow::after{
    color: #cfe5ea;
    left: 18px;
    right: auto;
    transform: rotate(90deg);
}

#side-menu > li.mm-active > a.has-arrow::after{
    transform: rotate(0deg);
}

#side-menu .sub-menu{
    margin-top: 8px;
    padding: 8px 10px 4px 0;
    border-right: 1px solid rgba(255,255,255,.08);
    margin-right: 22px;
    margin-left: 0;
}

#side-menu .sub-menu li{
    margin-bottom: 6px;
}

#side-menu .sub-menu li a{
    display: block;
    padding: 10px 14px;
    border-radius: 12px;
    color: var(--sidebar-muted) !important;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    transition: all .22s ease;
}

#side-menu .sub-menu li a:hover{
    background: rgba(255,255,255,.06);
    color: var(--sidebar-white) !important;
    padding-right: 18px;
}

#side-menu .sub-menu li.mm-active > a,
#side-menu .sub-menu li a.active{
    background: rgba(20, 184, 166, .16);
    color: #ffffff !important;
    border-right: 3px solid #5eead4;
}

.simplebar-scrollbar:before{
    background: rgba(255,255,255,.25) !important;
}

@media (max-width: 991px){
    .vertical-menu{
        width: 260px;
    }
}
        </style>
    @endif
</head>

<body class="footer-offset">

@include('layouts.back-end.partials._front-settings')
<span class="d-none" id="placeholderImg" data-img="{{asset( 'public/assets/back-end/img/400x400/img3.png')}}"></span>
<div class="row">
    <div class="col-12 position-fixed z-9999 mt-10rem">
        <div id="loading" class="d--none">
            <div id="loader"></div>
        </div>
    </div>
</div>
@include('layouts.back-end.partials._header')
@include('layouts.back-end.partials._side-bar')
@include('layouts.back-end._translator-for-js')
<span id="get-root-path-for-toggle-modal-image" data-path="{{asset( 'public/assets/back-end/img/modal')}}"></span>

<main id="content" role="main" class="main pointer-event">
    @yield('content')
    @include('layouts.back-end.partials._footer')
    @include('layouts.back-end.partials._modals')
    @include('layouts.back-end.partials._toggle-modal')
    @include('layouts.back-end.partials._sign-out-modal')
    @include('layouts.back-end._alert-message')
</main>
<span class="please_fill_out_this_field" data-text="{{ translate('please_fill_out_this_field') }}"></span>
<span class="get-application-environment-mode" data-value="{{ env('APP_MODE') == 'demo' ? 'demo':'live' }}"></span>
<span id="get-currency-symbol"
      data-currency-symbol=""></span>

<span id="message-select-word" data-text="{{ translate('select') }}"></span>
<span id="message-yes-word" data-text="{{ translate('yes') }}"></span>
<span id="message-no-word" data-text="{{ translate('no') }}"></span>
<span id="message-cancel-word" data-text="{{ translate('cancel') }}"></span>
<span id="message-are-you-sure" data-text="{{ translate('are_you_sure') }} ?"></span>
<span id="message-invalid-date-range" data-text="{{ translate('invalid_date_range') }}"></span>
<span id="message-status-change-successfully" data-text="{{ translate('status_change_successfully') }}"></span>
<span id="message-are-you-sure-delete-this" data-text="{{ translate('are_you_sure_to_delete_this') }} ?"></span>
<span id="message-you-will-not-be-able-to-revert-this"
      data-text="{{ translate('you_will_not_be_able_to_revert_this') }}"></span>

<span id="get-customer-list-route" data-action=""></span>
<span id="get-customer-list-without-all-customer-route" data-action=""></span>

<span id="get-search-product-route" data-action=""></span>
<span id="get-multiple-product-details-route" data-action=""></span>
<span id="get-orders-list-route" data-action=""></span>
<span id="get-stock-limit-status" data-action=""></span>
<span id="get-product-stock-limit-title" data-title="{{translate('warning')}}"></span>
<span id="get-product-stock-limit-image" data-warning-image="{{ asset( 'public/assets/back-end/img/warning-2.png') }}"></span>
<span id="get-product-stock-limit-message"
      data-message-for-multiple="{{ translate('there_is_not_enough_quantity_on_stock').' . '.translate('please_check_products_in_limited_stock').'.' }}"
      data-message-for-three-plus-product="{{translate('_more_products_have_low_stock') }}"
      data-message-for-one-product="{{translate('this_product_is_low_on_stock')}}">
</span>
<span id="get-product-stock-view"
      data-stock-limit-page=""
>
</span>
<span id="getChattingNewNotificationCheckRoute" data-route="{{ route('admin.messages.new-notification') }}"></span>
<span id="route-for-real-time-activities" data-route="{{ route('admin.dashboard.real-time-activities') }}"></span>
<span class="system-default-country-code" data-value="{{ getWebConfig(name: 'country_code') ?? 'us' }}"></span>

<audio id="myAudio">
    <source src="{{ asset( 'public/assets/back-end/sound/notification.mp3') }}" type="audio/mpeg">
</audio>
<script src="{{asset( 'public/js/pages/apexcharts/apexcharts.js') }}"></script>

<script src="{{ asset( 'public/js/pages/dashboard.js') }}"></script>

<script src="{{asset( 'public/assets/back-end/js/vendor.min.js')}}"></script>
<script src="{{asset( 'public/assets/back-end/js/theme.min.js')}}"></script>
<script src="{{asset( 'public/assets/back-end/js/bootstrap.min.js')}}"></script>
<script src="{{asset( 'public/assets/back-end/js/sweet_alert.js')}}"></script>
<script src="{{asset( 'public/assets/back-end/js/toastr.js')}}"></script>
<script src="{{asset( 'public/js/lightbox.min.js')}}"></script>

<script src="{{asset( 'public/assets/back-end/js/moment.min.js')}}"></script>
<script src="{{asset( 'public/assets/back-end/js/daterangepicker.min.js')}}"></script>

<script src="{{asset( 'public/assets/back-end/js/custom.js')}}"></script>
<script src="{{asset( 'public/assets/back-end/js/app-script.js')}}"></script>

{!! Toastr::message() !!}

@if ($errors->any())
    <script>
        'use strict';
        @foreach($errors->all() as $error)
        toastr.error('{{$error}}', Error, {
            CloseButton: true,
            ProgressBar: true
        });
        @endforeach
    </script>
@endif

@stack('script')

@if(Helpers::module_permission_check('order_management') && env('APP_MODE') != 'dev')
    <script>
        'use strict'
        setInterval(function () {
            getInitialDataForPanel();
        }, 5000);
    </script>
@endif

@if(env('APP_MODE') == 'dev')
    <script>
        'use strict'
        function checkDemoResetTime() {
            let currentMinute = new Date().getMinutes();
            if (currentMinute > 55 && currentMinute <= 60) {
                $('#demo-reset-warning').addClass('active');
            } else {
                $('#demo-reset-warning').removeClass('active');
            }
        }
        checkDemoResetTime();
        setInterval(checkDemoResetTime, 60000);
    </script>
@endif

<script src="{{ asset( 'public/assets/back-end/js/admin/common-script.js') }}"></script>

@stack('script_2')

</body>
</html>
