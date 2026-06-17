@extends('layouts.front-end.app')

@section('title',translate('contact_us'))

@push('css_or_js')
    <link rel="stylesheet" href="{{ theme_asset(path: 'public/assets/front-end/plugin/intl-tel-input/css/intlTelInput.css') }}">
@endpush

@section('content')
<div class="__inline-58">
    <div class="container rtl">
        <div class="row">
            <div class="col-md-12 contact-us-page sidebar_heading text-center mb-2">
                <h1 class="h3 mb-0 headerTitle">{{ __('messages.Complaints') }}</h1>
            </div>
        </div>
    </div>

    <div class="container rtl text-align-direction">
        <div class="row no-gutters py-5">
            <div class="col-lg-6 iframe-full-height-wrap ">
                <img class="for-contact-image" src="{{asset("public/assets/front-end/png/contact.png")}}" alt="">
            </div>
            <div class="col-lg-6">
                <div class="card">



                    <div class="card-body for-send-message">
                        <h2 class="h4 mb-4 text-center font-semibold text-black">{{__('messages.Contact_information_for_complaints')}}</h2>

                        <div class="card shadow-sm border-0 mb-4">
                            <div class="card-body">

                                <ul class="list-unstyled">
                                    <li class="mb-3">
                                        <i class="fas fa-phone-alt text-primary me-2"></i>
                                        <strong> {{__("messages.phone")}}:</strong>
                                        <a href="{{getWebConfig(name: 'company_phone')}}" class="text-decoration-none">{{getWebConfig(name: 'company_phone')}}</a>
                                    </li>
                                    <li class="mb-3">
                                        <i class="fas fa-envelope text-primary me-2"></i>
                                        <strong> {{__("messages.email")}}:</strong>
                                        <a href="{{getWebConfig(name: 'company_email')}}" class="text-decoration-none">{{getWebConfig(name: 'company_email')}}</a>
                                    </li>
                                    <li class="mb-3">
                                        <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                        <strong>{{__("messages.address")}}:</strong>
                                        <a href="https://www.google.com/maps?q=شارع+الملك+عبد+العزيز,+الرياض,+المملكة+العربية+السعودية" target="_blank" class="text-decoration-none">
                                            {{getWebConfig(name: 'address')}}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('script')

@if(isset($recaptcha) && $recaptcha['status'] == 1)
    <script type="text/javascript">
        "use strict";
        var onloadCallback = function () {
            grecaptcha.render('recaptcha_element', {
                'sitekey': '{{ getWebConfig(name: 'recaptcha')['site_key'] }}'
            });
        };
    </script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async
            defer></script>
    <script>
        "use strict";
        $("#getResponse").on('submit', function (e) {
            var response = grecaptcha.getResponse();
            if (response.length === 0) {
                e.preventDefault();
                toastr.error($('#message-please-check-recaptcha').data('text'));
            }
        });
    </script>
@endif

<script src="{{ asset('public/assets/front-end/plugin/intl-tel-input/js/intlTelInput.js') }}"></script>
<script src="{{ asset('public/assets/front-end/js/country-picker-init.js') }}"></script>
@endpush


