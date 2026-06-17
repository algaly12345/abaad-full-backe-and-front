@extends('layouts.front-end.app')

@section('title',  translate('register'))

@push('css_or_js')
    <link rel="stylesheet" href="{{ theme_asset(path: 'public/assets/front-end/plugin/intl-tel-input/css/intlTelInput.css') }}">

    <style>
        .register-page-v2{
            padding: 32px 0;
            background:
                radial-gradient(circle at top right, rgba(15,91,215,.10), transparent 24%),
                radial-gradient(circle at bottom left, rgba(17,75,137,.08), transparent 20%),
                #f4f7fb;
            min-height: calc(100vh - 120px);
        }

        .register-page-v2 *{
            box-sizing: border-box;
        }

        .register-page-v2 .register-card{
            max-width: 860px;
            margin: 0 auto;
            background: rgba(255,255,255,.96);
            border: 1px solid #e6edf7;
            border-radius: 28px;
            box-shadow: 0 24px 60px rgba(15,23,42,.12);
            backdrop-filter: blur(16px);
            padding: 28px 22px;
        }

        .register-page-v2 .register-brand{
            text-align: center;
            margin-bottom: 22px;
        }

        .register-page-v2 .register-brand-wrap{
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            flex-wrap: wrap;
            padding: 14px 18px;
            border-radius: 22px;
            background: linear-gradient(180deg, #ffffff, #f8fbff);
            border: 1px solid #e6edf7;
            box-shadow: 0 8px 24px rgba(15,91,215,.06);
        }

        .register-page-v2 .register-brand-wrap img{
            max-width: 90px;
            height: auto;
            object-fit: contain;
        }

        .register-page-v2 .register-title{
            font-size: 1.5rem;
            font-weight: 800;
            color: #0f172a;
            text-align: center;
            margin-bottom: 8px;
        }

        .register-page-v2 .register-subtitle{
            text-align: center;
            color: #64748b;
            font-size: .95rem;
            margin-bottom: 26px;
            line-height: 1.8;
        }

        .register-page-v2 .form-block{
            margin-bottom: 18px;
        }

        .register-page-v2 .register-label{
            display: block;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 8px;
        }

        .register-page-v2 .register-input,
        .register-page-v2 .register-select,
        .register-page-v2 .captcha-input{
            width: 100%;
            min-height: 52px;
            border-radius: 16px;
            border: 1px solid #dbe3ef;
            background: #fff;
            padding: 0 14px;
            font-size: .96rem;
            color: #0f172a;
            box-shadow: none !important;
            transition: .2s ease;
        }

        .register-page-v2 .register-input:focus,
        .register-page-v2 .register-select:focus,
        .register-page-v2 .captcha-input:focus{
            border-color: #0f5bd7;
            box-shadow: 0 0 0 4px rgba(15,91,215,.10) !important;
            outline: 0;
        }

        .register-page-v2 .phone-group{
            display: flex;
            align-items: stretch;
            direction: ltr;
            border: 1px solid #dbe3ef;
            border-radius: 16px;
            background: #fff;
            overflow: hidden;
            transition: .2s ease;
        }

        .register-page-v2 .phone-group:focus-within{
            border-color: #0f5bd7;
            box-shadow: 0 0 0 4px rgba(15,91,215,.10);
        }

        .register-page-v2 .country-code{
            min-width: 105px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: linear-gradient(180deg, #fff, #f8fbff);
            border-left: 1px solid #dbe3ef;
            color: #0f172a;
            font-weight: 700;
            padding: 0 12px;
        }

        .register-page-v2 .country-code img{
            width: 30px;
            height: 22px;
            object-fit: cover;
            border-radius: 4px;
        }

        .register-page-v2 .phone-input{
            width: 100%;
            min-height: 54px;
            border: 0;
            outline: 0;
            box-shadow: none !important;
            padding: 0 14px;
            font-size: 1rem;
            color: #0f172a;
            background: #fff;
            text-align: left;
            direction: ltr;
        }

        .register-page-v2 .phone-input::placeholder,
        .register-page-v2 .register-input::placeholder{
            color: #94a3b8;
        }

        .register-page-v2 .helper-text{
            margin-top: 8px;
            font-size: .85rem;
            color: #64748b;
        }

        .register-page-v2 .error-text{
            margin-top: 8px;
            font-size: .84rem;
            color: #dc2626;
            display: none;
        }

        .register-page-v2 .organization-field{
            display: none;
        }

        .register-page-v2 .terms-wrap{
            margin-top: 8px;
        }

        .register-page-v2 .terms-wrap .custom-control-label{
            font-weight: 600;
            color: #334155;
        }

        .register-page-v2 .terms-wrap a{
            color: #0f5bd7;
            text-decoration: underline;
        }

        .register-page-v2 .captcha-box{
            margin-top: 8px;
        }

        .register-page-v2 .submit-wrap{
            max-width: 360px;
            margin: 24px auto 0;
        }

        .register-page-v2 .register-btn{
            width: 100%;
            min-height: 54px;
            border: none;
            border-radius: 16px;
            font-size: 1rem;
            font-weight: 800;
            color: #fff;
            background: linear-gradient(135deg, #0f5bd7, #114b89);
            box-shadow: 0 14px 28px rgba(15,91,215,.18);
            transition: .2s ease;
        }

        .register-page-v2 .register-btn:hover:not(:disabled){
            transform: translateY(-1px);
        }

        .register-page-v2 .register-btn:disabled{
            opacity: .6;
            cursor: not-allowed;
        }

        .register-page-v2 .signin-link{
            color: #64748b;
            margin-top: 16px;
            text-align: center;
        }

        .register-page-v2 .signin-link a{
            color: #0f5bd7;
            text-decoration: underline;
            font-weight: 700;
        }

        @media (max-width: 768px){
            .register-page-v2 .register-card{
                padding: 24px 16px;
                border-radius: 22px;
            }

            .register-page-v2 .register-title{
                font-size: 1.28rem;
            }

            .register-page-v2 .register-subtitle{
                font-size: .9rem;
            }
        }

        @media (max-width: 576px){
            .register-page-v2{
                padding: 20px 0;
            }

            .register-page-v2 .register-brand-wrap img{
                max-width: 72px;
            }

            .register-page-v2 .country-code{
                min-width: 95px;
                font-size: .9rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="register-page-v2 text-align-direction">
        <div class="container py-4">
            <div class="register-card">
                <div class="register-brand">
                    <div class="register-brand-wrap">
                        <img src="{{ asset('public/assets/images/logo_web.png') }}" alt="{{$web_config['name']->value}}">
                        <img src="{{ asset('public/assets/images/logo_header.png') }}" alt="logo">
                    </div>
                </div>

                <h1 class="register-title">إنشاء حساب جديد</h1>
                <p class="register-subtitle">
                    أدخل بياناتك بشكل صحيح لإتمام التسجيل والوصول إلى خدمات المنصة بسهولة
                </p>

                <form method="POST" action="{{ route('customer.auth.sign-up3') }}" id="customer-register-form">
                    @csrf

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-block">
                                <label class="register-label">الاسم</label>
                                <input
                                    class="register-input text-align-direction"
                                    value="{{ old('f_name')}}"
                                    type="text"
                                    name="f_name"
                                    placeholder="عبدالله علي محمد"
                                    required
                                >
                                <div class="invalid-feedback">الرجاء إدخال الاسم كامل</div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-block">
                                <label class="register-label">البريد الالكتروني</label>
                                <input
                                    class="register-input text-align-direction"
                                    type="email"
                                    value="{{ old('email') }}"
                                    name="email"
                                    placeholder="{{ translate('enter_email_address_(required)') }}"
                                    autocomplete="off"
                                    required
                                >
                                <div class="invalid-feedback">{{ translate('please_enter_valid_email_address') }}!</div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-block">
                                <label class="register-label">{{ translate('phone_number') }}</label>

                                <div class="phone-group">
                                    <div class="country-code">
                                        <img src="{{ asset('public/assets/front-end/png/flag.png') }}" alt="Saudi Flag">
                                        <span>+966</span>
                                    </div>

                                    <input
                                        class="phone-input"
                                        type="tel"
                                        name="user_id"
                                        id="register-phone"
                                        value="{{ old('user_id') }}"
                                        placeholder="5XXXXXXXX"
                                        inputmode="numeric"
                                        maxlength="9"
                                        pattern="5[0-9]{8}"
                                        required
                                    >
                                </div>

                                <div class="helper-text">
                                    يجب إدخال الرقم بدون 0 في البداية، مثال: 5XXXXXXXX
                                </div>

                                <div class="error-text" id="registerPhoneError">
                                    رقم الجوال يجب أن يبدأ بـ 5 ويتكون من 9 أرقام
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-block">
                                <label class="register-label">نوع المستخدم</label>
                                <select class="register-select" name="user_type" required>
                                    <option value="">اختر نوع المستخدم</option>
                                    <option value="باحث عن عقار">باحث عن عقار</option>
                                    <option value="مسوق عقاري">مسوق عقاري</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-block">
                                <label class="register-label">نوع التسجيل</label>
                                <select class="register-select" id="registrationType" name="registration_type" required>
                                    <option value="individual">فرد</option>
                                    <option value="organization">منشأة</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6 organization-field" id="organizationField">
                            <div class="form-block">
                                <label class="register-label">الرقم الموحد</label>
                                <input
                                    class="register-input"
                                    type="text"
                                    name="unified_number"
                                    id="unified_number"
                                    placeholder="ادخل الرقم الموحد"
                                >
                                <div class="invalid-feedback">الرجاء إدخال الرقم الموحد</div>
                            </div>
                        </div>

                        <input
                            class="text-align-direction"
                            name="password"
                            type="hidden"
                            id="si-password"
                            value="1234567"
                            placeholder="{{ translate('minimum_8_characters_long') }}"
                        >

                        <input
                            class="text-align-direction"
                            name="con_password"
                            type="hidden"
                            value="1234567"
                            placeholder="{{ translate('minimum_8_characters_long') }}"
                        >
                    </div>

                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="terms-wrap rtl">
                                <label class="custom-control custom-checkbox m-0 d-flex">
                                    <input type="checkbox" class="custom-control-input" name="remember" id="inputChecked">
                                    <span class="custom-control-label">
                                        <span>{{ translate('i_agree_to_Your') }}</span>
                                        <a target="_blank" href="{{ route('terms') }}">{{ translate('terms_and_condition') }}</a>
                                    </span>
                                </label>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            @php($recaptcha = getWebConfig(name: 'recaptcha'))
                            @if(isset($recaptcha) && $recaptcha['status'] == 1)
                                <div id="recaptcha_element" class="w-100" data-type="image"></div>
                            @else
                                <div class="row captcha-box">
                                    <div class="col-6 pr-2">
                                        <input
                                            type="text"
                                            class="captcha-input"
                                            name="default_recaptcha_value_customer_regi"
                                            value=""
                                            placeholder="{{ translate('enter_captcha_value') }}"
                                            autocomplete="off"
                                        >
                                    </div>
                                    <div class="col-6 input-icons mb-2 w-100 rounded bg-white">
                                        <a href="javascript:" class="d-flex align-items-center get-regi-recaptcha-verify" data-link="{{ URL('/customer/auth/code/captcha') }}">
                                            <img
                                                alt=""
                                                src="{{ URL('/customer/auth/code/captcha/1?captcha_session_id=default_recaptcha_id_customer_regi') }}"
                                                class="input-field rounded __h-40"
                                                id="default_recaptcha_id"
                                            >
                                            <i class="tio-refresh icon cursor-pointer p-2"></i>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="submit-wrap">
                        <button class="register-btn" id="sign-up" type="submit" disabled>
                            {{ translate('sign_up') }}
                        </button>
                    </div>

                    <div class="signin-link">
                        <small>
                            {{ translate('Already_have_account ') }}?
                            <a href="{{ route('customer.auth.login') }}">
                                {{ translate('sign_in') }}
                            </a>
                        </small>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const regType = document.getElementById('registrationType');
        const orgField = document.getElementById('organizationField');
        const unifiedInput = document.getElementById('unified_number');

        const phoneInput = document.getElementById('register-phone');
        const phoneError = document.getElementById('registerPhoneError');
        const registerForm = document.getElementById('customer-register-form');
        const termsCheckbox = document.getElementById('inputChecked');
        const submitBtn = document.getElementById('sign-up');

        function toggleOrganizationField() {
            if (regType.value === 'organization') {
                orgField.style.display = 'block';
                unifiedInput.setAttribute('required', 'required');
            } else {
                orgField.style.display = 'none';
                unifiedInput.removeAttribute('required');
                unifiedInput.value = '';
            }
        }

        function normalizePhone(value) {
            value = value.replace(/\D/g, '');

            if (value.startsWith('966')) {
                value = value.substring(3);
            }

            if (value.startsWith('0')) {
                value = value.replace(/^0+/, '');
            }

            if (value.length > 0 && value[0] !== '5') {
                value = '5' + value.substring(1);
            }

            return value.substring(0, 9);
        }

        function validatePhone() {
            const value = phoneInput.value.trim();
            const isValid = /^5\d{8}$/.test(value);

            if (value.length === 0) {
                phoneError.style.display = 'none';
                phoneInput.setCustomValidity('');
                return false;
            }

            if (!isValid) {
                phoneError.style.display = 'block';
                phoneInput.setCustomValidity('invalid');
                return false;
            }

            phoneError.style.display = 'none';
            phoneInput.setCustomValidity('');
            return true;
        }

        function updateSubmitState() {
            const phoneValid = validatePhone();
            submitBtn.disabled = !termsCheckbox.checked || !phoneValid;
        }

        regType.addEventListener('change', toggleOrganizationField);
        toggleOrganizationField();

        phoneInput.addEventListener('input', function () {
            this.value = normalizePhone(this.value);
            updateSubmitState();
        });

        phoneInput.addEventListener('keydown', function (e) {
            const allowedKeys = ['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight', 'Tab', 'Home', 'End'];

            if (allowedKeys.includes(e.key)) return;

            if (!/^\d$/.test(e.key)) {
                e.preventDefault();
                return;
            }

            if (this.value.length === 0 && e.key !== '5') {
                e.preventDefault();
            }
        });

        phoneInput.addEventListener('paste', function (e) {
            e.preventDefault();
            const pasted = (e.clipboardData || window.clipboardData).getData('text');
            this.value = normalizePhone(pasted);
            updateSubmitState();
        });

        termsCheckbox.addEventListener('change', updateSubmitState);

        registerForm.addEventListener('submit', function (e) {
            phoneInput.value = normalizePhone(phoneInput.value);

            if (!validatePhone()) {
                e.preventDefault();
                phoneInput.focus();
                return;
            }

            if (!termsCheckbox.checked) {
                e.preventDefault();
                termsCheckbox.focus();
                return;
            }
        });

        updateSubmitState();
    });
</script>

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