@php
    use App\Utils\Helpers;
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ Session::get('direction') }}"
      style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="nofollow, noindex">
    <title>@yield('title')</title>
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ getStorageImages(path: getWebConfig(name: 'company_fav_icon'), type:'backend-logo') }}">

    <link rel="stylesheet" href="{{ asset('public/assets/back-end/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/back-end/css/vendor.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/back-end/vendor/icon-set/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/back-end/css/theme.minc619.css?v=1.0') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/back-end/css/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/back-end/css/style.css') }}">
    @if (Session::get('direction') === 'rtl')
        <link rel="stylesheet" href="{{ asset('public/assets/back-end/css/menurtl.css') }}">
    @endif
    <link rel="stylesheet" href="{{ asset('public/css/lightbox.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/back-end/css/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/back-end/css/custom.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800;900&display=swap" rel="stylesheet">

    @stack('css_or_js')

    <style>
        :root{
            --ab-bg:#f4f7fb;
            --ab-bg-2:#eef4ff;
            --ab-card:#ffffff;
            --ab-text:#0f172a;
            --ab-muted:#64748b;
            --ab-border:#e2e8f0;
            --ab-primary:#2563eb;
            --ab-primary-dark:#1d4ed8;
            --ab-primary-soft:#eff6ff;
            --ab-success:#059669;
            --ab-warning:#d97706;
            --ab-danger:#dc2626;
            --ab-sidebar-1:#0f172a;
            --ab-sidebar-2:#152238;
            --ab-sidebar-3:#1b2b45;
            --ab-shadow:0 18px 45px rgba(15,23,42,.08);
            --ab-radius:24px;
            --ab-mobile-nav-h:78px;
        }

        html, body {
            font-family: 'Tajawal', sans-serif !important;
            background: linear-gradient(180deg, #f8fbff 0%, #eef4ff 100%);
            color: var(--ab-text);
            min-height: 100%;
            overflow-x: hidden;
        }

        body.footer-offset {
            background: linear-gradient(180deg, #f8fbff 0%, #eef4ff 100%);
        }

        #content.main {
            min-height: 100vh;
            padding-top: 96px;
            transition: all .3s ease;
        }

        .main-content-wrapper {
            padding: 18px 22px 30px;
        }

        select {
            background-image: url('{{ asset('public/assets/back-end/img/arrow-down.png') }}');
            background-size: 7px;
            background-position: 96% center;
            background-repeat: no-repeat;
        }

        .mobile-bottom-nav {
            display: none;
        }

        @media (max-width: 1199.98px) {
            #content.main {
                padding-top: 84px;
            }
        }

        @media (max-width: 767.98px) {
            #content.main {
                padding-top: 76px;
                padding-bottom: calc(var(--ab-mobile-nav-h) + 18px);
            }

            .main-content-wrapper {
                padding: 12px 12px 18px;
            }

            .mobile-bottom-nav {
                position: fixed;
                right: 12px;
                left: 12px;
                bottom: 12px;
                height: var(--ab-mobile-nav-h);
                background: rgba(15,23,42,.95);
                backdrop-filter: blur(18px);
                border: 1px solid rgba(255,255,255,.06);
                border-radius: 24px;
                display: flex;
                align-items: center;
                justify-content: space-around;
                z-index: 1050;
                box-shadow: 0 18px 40px rgba(15,23,42,.25);
            }

            .mobile-bottom-nav a {
                flex: 1;
                text-decoration: none;
                color: rgba(255,255,255,.72);
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                font-size: 11px;
                font-weight: 700;
                gap: 6px;
            }

            .mobile-bottom-nav a i {
                font-size: 20px;
            }

            .mobile-bottom-nav a.active {
                color: #fff;
            }

            .mobile-bottom-nav a.active i {
                color: #60a5fa;
            }
        }
    </style>
</head>
<body class="footer-offset">
@include('layouts.back-end.partials._front-settings')

<div class="row">
    <div class="col-12 position-fixed z-9999 mt-10rem">
        <div id="loading" class="d--none">
            <div id="loader"></div>
        </div>
    </div>
</div>

@include('layouts.back-end.partials-seller._header')
@include('layouts.back-end.partials-seller._side-bar')

<main id="content" role="main" class="main pointer-event">
    <div class="main-content-wrapper">
        @yield('content')
    </div>

    @include('layouts.back-end.partials-seller._footer')
    @include('layouts.back-end.partials-seller._modals')
    @include('layouts.back-end.partials-seller._toggle-modal')
    @include('layouts.back-end._translator-for-js')
    @include('layouts.back-end.partials-seller._sign-out-modal')
    @include('layouts.back-end._alert-message')
</main>

<div class="mobile-bottom-nav d-md-none">
    <a href="{{ route('service-provider.dashboard') }}" class="{{ Request::is('user/dashboard*') ? 'active' : '' }}">
        <i class="tio-home-vs-1-outlined"></i>
        <span>الرئيسية</span>
    </a>

    <a href="{{ route('service-provider.estaes.create-offer') }}" class="{{ Request::is('user/questions/create') ? 'active' : '' }}">
        <i class="tio-add-circle-outlined"></i>
        <span>إضافة</span>
    </a>

    <a href="{{ route('service-provider.owner.offers.pending') }}" class="{{ Request::is('user/questions/list') ? 'active' : '' }}">
        <i class="tio-view-list-outlined"></i>
        <span>عروضي</span>
    </a>

    <a href="javascript:void(0)">
        <i class="tio-chart-bar-1"></i>
        <span>إحصاءات</span>
    </a>

    <a href="{{ route('service-provider.profile.dispaly') }}">
        <i class="tio-settings"></i>
        <span>الحساب</span>
    </a>
</div>

<audio id="myAudio">
    <source src="{{ asset('public/assets/back-end/sound/notification.mp3') }}" type="audio/mpeg">
</audio>

<span class="please_fill_out_this_field" data-text="{{ translate('please_fill_out_this_field') }}"></span>
<span id="onerror-chatting" data-onerror-chatting="{{ asset('public/assets/back-end/img/image-place-holder.png') }}"></span>
<span id="onerror-user" data-onerror-user="{{ asset('public/assets/back-end/img/160x160/img1.jpg') }}"></span>
<span id="get-root-path-for-toggle-modal-image" data-path="{{ asset('public/assets/back-end/img/modal') }}"></span>
<span id="get-customer-list-route" data-action=""></span>
<span id="get-search-product-route" data-action=""></span>
<span id="get-orders-list-route" data-action=""></span>
<span class="system-default-country-code" data-value="{{ getWebConfig(name: 'country_code') ?? 'us' }}"></span>
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
<span id="getChattingNewNotificationCheckRoute" data-route=""></span>

<span id="get-stock-limit-status" data-action=""></span>
<span id="get-product-stock-limit-title" data-title="{{ translate('warning') }}"></span>
<span id="get-product-stock-limit-image" data-warning-image="{{ asset('public/assets/back-end/img/warning-2.png') }}"></span>
<span id="get-product-stock-limit-message"
      data-message-for-multiple="{{ translate('there_is_not_enough_quantity_on_stock').' . '.translate('please_check_products_in_limited_stock').'.' }}"
      data-message-for-three-plus-product="{{ translate('_more_products_have_low_stock') }}"
      data-message-for-one-product="{{ translate('this_product_is_low_on_stock') }}">
</span>
<span id="get-product-stock-view" data-stock-limit-page=""></span>
<span id="route-for-real-time-activities" data-route=""></span>

<script src="{{ asset('public/assets/back-end/js/vendor.min.js') }}"></script>
<script src="{{ asset('public/assets/back-end/js/theme.min.js') }}"></script>
<script src="{{ asset('public/assets/back-end/vendor/hs-navbar-vertical-aside/hs-navbar-vertical-aside-mini-cache.js') }}"></script>
<script src="{{ asset('public/assets/back-end/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/assets/back-end/js/sweet_alert.js') }}"></script>
<script src="{{ asset('public/assets/back-end/js/toastr.js') }}"></script>
<script src="{{ asset('public/js/lightbox.min.js') }}"></script>
<script src="{{ asset('public/assets/back-end/js/custom.js') }}"></script>
<script src="{{ asset('public/assets/back-end/js/app-script.js') }}"></script>

@if ($errors->any())
    <script>
        @foreach ($errors->all() as $error)
        toastr.error('{{ $error }}', 'Error', {
            CloseButton: true,
            ProgressBar: true
        });
        @endforeach
    </script>
@endif

<script>
    'use strict';
    setInterval(function () {
        if (typeof getInitialDataForPanel === 'function') {
            getInitialDataForPanel();
        }
    }, 5000);
</script>

<script>
    $('.notification-data-view').on('click', function () {
        let id = $(this).data('id');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.post({
            url: "",
            data: {
                _token: '{{ csrf_token() }}',
                id: id,
            },
            success: function (data) {
                $('.notification_data_new_badge' + id).fadeOut();
                $('#NotificationModalContent').empty().html(data.view);
                $('#NotificationModal').modal('show');
                let notificationDataCount = $('.notification_data_new_count');
                let notificationCount = parseInt(data.notification_count);
                notificationCount === 0 ? notificationDataCount.fadeOut() : notificationDataCount.html(notificationCount);
            }
        });
    });
</script>

@if(env('APP_MODE') == 'demo')
    <script>
        'use strict';
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

@stack('script')
<script src="{{ asset('public/assets/back-end/js/admin/common-script.js') }}"></script>
@stack('script_2')
</body>
</html>