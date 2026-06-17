@extends('layouts.front-end.app')

@section('title',  translate('register'))

@push('css_or_js')
    <link rel="stylesheet" href="{{ theme_asset(path: 'public/assets/front-end/plugin/intl-tel-input/css/intlTelInput.css') }}">
@endpush

@section('content')
    <div class="container py-4 __inline-7 text-align-direction">
        <div class="login-card">
            <div class="mx-auto __max-w-760">
                <div class="text-center h4 mb-4 font-bold text-capitalize fs-18-mobile">


                    <img class="__inline-11" width="100" height="100"
                    src="{{ asset('public/assets/images/logo_web.png') }}"
                    alt="{{$web_config['name']->value}}">

                   <img class="__inline-11" width="100" height="100"
                    src="{{ asset('public/assets/images/logo_header.png') }}"

            >

            <h1>انضم كمزود خدمة</h1>
                </div>

              
                {{-- <form class="needs-validation_" id="customer-register-form" action="{{ route('customer.auth.sign-up3')}}"
                        method="post">
                    @csrf --}}


                   <form method="POST" action="{{ route('customer.auth.sign-provider') }}">
                                @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label font-semibold">الاسم</label>
                                <input class="form-control text-align-direction" value="{{ old('f_name')}}" type="text" name="f_name"
                                        placeholder="    عبدالله علي محمد"
                                        required >
                                <div class="invalid-feedback">الرجاء  دخال الاسم كامل </div>
                            </div>
                        </div>
                        {{-- <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label font-semibold">{{ translate('last_name') }}</label>
                                <input class="form-control text-align-direction" type="text" value="{{old('l_name') }}" name="l_name"
                                        placeholder="{{ translate('ex') }}: {{ translate('Doe') }}" required>
                                <div class="invalid-feedback">{{ translate('please_enter_your_last_name') }}!</div>
                            </div>
                        </div> --}}
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label font-semibold">البريد الالكتروني</label>
                                <input class="form-control text-align-direction" type="email" value="{{old('email') }}" name="email"
                                     placeholder="{{ translate('enter_email_address_(required)') }}" required autocomplete="off" 
                                        >
                                <div class="invalid-feedback">{{ translate('please_enter_valid_email_address') }}!</div>
                            </div>
                        </div>





                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label font-semibold"> نوع الخدمة</label>
                                <select name="service_type" id="" class="form-control select-item">
                                    @foreach ($serviceTypes as $serviceType)
                                        <option value="{{ $serviceType->id }}">{{ $serviceType->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">{{ translate('please_enter_valid_email_address') }}!</div>
                            </div>
                        </div>



                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label font-semibold">  أختار المنطقه</label>
                                <select name="zone_id" id="choice_zones" required class="form-control js-select2-custom"
                                    data-placeholder=""">
                                    <option value="" selected disabled></option>
                                    @foreach (\App\Models\Zone::all() as $zone)

                                            <option value="{{ $zone->id }}">{{ $zone->name_ar }}</option>

                                    @endforeach
                                </select>
                                <div class="invalid-feedback">{{ translate('please_enter_valid_email_address') }}!</div>
                            </div>
                        </div>








                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label font-semibold">{{ translate('phone') }}
                                    </label>
                                    <div class="input-group" style="direction: ltr;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="display: flex; align-items: center;">
                                                <img src="{{ asset('public/assets/front-end/png/flag.png') }}" alt="Saudi Flag" style="width: 30px; height: 22px; margin-right: 5px;">
                                                +966
                                            </span>
                                        </div>
                                        <input class="form-control" type="text" name="user_id" id="si-email"
                                               value="{{ old('user_id') }}" placeholder="{{ __('messages.enter_phone') }}"
                                               required style="text-align: left; padding-left: 10px;">
                                    </div>




                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label font-semibold"> كلمة المرور</label>

                        <input class="form-control text-align-direction" name="password" type="text" id="si-password"
                        placeholder="{{ translate('minimum_8_characters_long') }}" >

                    </div>
                </div>


                       
                        {{-- @if ($web_config['ref_earning_status'])
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-label font-semibold">{{ translate('refer_code') }} <small class="text-muted">({{ translate('optional') }})</small></label>
                                <input type="text" id="referral_code" class="form-control"
                                name="referral_code" placeholder="{{ translate('use_referral_code') }}">
                            </div>
                        </div>
                        @endif --}}

                    </div>
                    <div class="col-12">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <div class="rtl">
                                    <label class="custom-control custom-checkbox m-0 d-flex">
                                        <input type="checkbox" class="custom-control-input" name="remember" id="inputChecked">
                                        <span class="custom-control-label">
                                            <span>{{ translate('i_agree_to_Your_terms') }}</span> <a class="font-size-sm text-primary text-force-underline" target="_blank" href="{{ route('terms') }}">{{ translate('terms_and_condition') }}</a>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                @php($recaptcha = getWebConfig(name: 'recaptcha'))
                                @if(isset($recaptcha) && $recaptcha['status'] == 1)
                                    <div id="recaptcha_element" class="w-100" data-type="image"></div>
                                @else
                                <div class="row">
                                    <div class="col-6 pr-2">
                                        <input type="text" class="form-control border __h-40" name="default_recaptcha_value_customer_regi" value=""
                                                placeholder="{{ translate('enter_captcha_value') }}" autocomplete="off">
                                    </div>
                                    <div class="col-6 input-icons mb-2 w-100 rounded bg-white">
                                        <a href="javascript:" class="d-flex align-items-center align-items-center get-regi-recaptcha-verify" data-link="{{ URL('/customer/auth/code/captcha') }}">
                                            <img alt="" src="{{ URL('/customer/auth/code/captcha/1?captcha_session_id=default_recaptcha_id_customer_regi') }}" class="input-field rounded __h-40" id="default_recaptcha_id">
                                            <i class="tio-refresh icon cursor-pointer p-2"></i>
                                        </a>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>






                    {{-- <div class="mb-3">
                        <label class="form-label">نوع الخدمة</label>
                        @error('service_type_id')

                        <span class="error-message">
                            {{ $message }}
                        </span>
                         @enderror
                    <div class="input-group">

                            <select name="service_type" id="" class="form-control select-item">
                                @foreach ($serviceTypes as $serviceType)
                                    <option value="{{ $serviceType->id }}">{{ $serviceType->name }}</option>
                                @endforeach
                            </select>

                        </div>
                        <!-- input-group -->
                    </div> --}}



                    <div class="web-direction">
                        <div class="mx-auto mt-4 __max-w-356">
                            <button class="w-100 btn btn--primary" id="sign-up" type="submit" disabled>
                                {{ translate('sign_up') }}
                            </button>
                        </div>

                        <div class="text-black-50 mt-3 text-center">
                            <small>
                                {{  translate('Already_have_account ') }}?
                                <a class="text-primary text-underline" href="{{route('role.showLogin')}}">
                                    {{ translate('sign_in') }}
                                </a>
                            </small>
                        </div>
                    </div>
                </form>
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
        <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
    @endif

    <script src="{{ asset('public/assets/front-end/plugin/intl-tel-input/js/intlTelInput.js') }}"></script>
    <script src="{{ asset('public/public/assets/front-end/js/country-picker-init.js') }}"></script>
@endpush
