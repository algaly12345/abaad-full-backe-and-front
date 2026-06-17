@extends('layouts.front-end.app')

@section('title', translate('sign_in'))

@push('css_or_js')
<style>
    .login-page-v2{
        padding: 32px 0;
        background:
            radial-gradient(circle at top right, rgba(15,91,215,.10), transparent 24%),
            radial-gradient(circle at bottom left, rgba(17,75,137,.08), transparent 20%),
            #f4f7fb;
        min-height: calc(100vh - 120px);
    }

    .login-page-v2 *{
        box-sizing: border-box;
    }

    .login-page-v2 .login-card{
        max-width: 460px;
        margin: 0 auto;
        background: rgba(255,255,255,.96);
        border: 1px solid #e6edf7;
        border-radius: 28px;
        box-shadow: 0 24px 60px rgba(15,23,42,.12);
        backdrop-filter: blur(16px);
        padding: 28px 22px;
    }

    .login-page-v2 .login-brand{
        text-align: center;
        margin-bottom: 20px;
    }

    .login-page-v2 .login-brand-wrap{
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

    .login-page-v2 .login-brand-wrap img{
        max-width: 90px;
        height: auto;
        object-fit: contain;
    }

    .login-page-v2 .login-title{
        font-size: 1.45rem;
        font-weight: 800;
        color: #0f172a;
        text-align: center;
        margin-bottom: 8px;
    }

    .login-page-v2 .login-subtitle{
        text-align: center;
        color: #64748b;
        font-size: .95rem;
        margin-bottom: 24px;
        line-height: 1.8;
    }

    .login-page-v2 .login-form-group{
        margin-bottom: 18px;
    }

    .login-page-v2 .login-label{
        display: block;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 8px;
    }

    .login-page-v2 .phone-group{
        display: flex;
        align-items: stretch;
        direction: ltr;
        border: 1px solid #dbe3ef;
        border-radius: 16px;
        background: #fff;
        overflow: hidden;
        transition: .2s ease;
    }

    .login-page-v2 .phone-group:focus-within{
        border-color: #0f5bd7;
        box-shadow: 0 0 0 4px rgba(15,91,215,.10);
    }

    .login-page-v2 .country-code{
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

    .login-page-v2 .country-code img{
        width: 30px;
        height: 22px;
        object-fit: cover;
        border-radius: 4px;
    }

    .login-page-v2 .phone-input{
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

    .login-page-v2 .phone-input::placeholder{
        color: #94a3b8;
    }

    .login-page-v2 .helper-text{
        margin-top: 8px;
        font-size: .85rem;
        color: #64748b;
    }

    .login-page-v2 .error-text{
        margin-top: 8px;
        font-size: .84rem;
        color: #dc2626;
        display: none;
    }

    .login-page-v2 .remember-wrap{
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        margin-bottom: 16px;
    }

    .login-page-v2 .remember-wrap .custom-control-label{
        font-weight: 600;
        color: #0f5bd7;
    }

    .login-page-v2 .captcha-wrap .form-control{
        min-height: 48px;
        border-radius: 14px;
        border: 1px solid #dbe3ef;
        box-shadow: none !important;
    }

    .login-page-v2 .captcha-wrap .form-control:focus{
        border-color: #0f5bd7;
        box-shadow: 0 0 0 4px rgba(15,91,215,.10) !important;
    }

    .login-page-v2 .login-btn{
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

    .login-page-v2 .login-btn:hover{
        transform: translateY(-1px);
    }

    .login-page-v2 .social-login-wrap{
        display: flex;
        justify-content: center;
        gap: 12px;
        flex-wrap: wrap;
        margin-top: 18px;
    }

    .login-page-v2 .social-login-wrap a{
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fff;
        border: 1px solid #e5e7eb;
        box-shadow: 0 6px 18px rgba(15,23,42,.05);
        transition: .2s ease;
    }

    .login-page-v2 .social-login-wrap a:hover{
        transform: translateY(-2px);
        box-shadow: 0 10px 22px rgba(15,23,42,.08);
    }

    .login-page-v2 .social-login-wrap img{
        width: 22px;
        height: 22px;
        object-fit: contain;
    }

    @media (max-width: 576px){
        .login-page-v2{
            padding: 20px 0;
        }

        .login-page-v2 .login-card{
            padding: 22px 16px;
            border-radius: 22px;
        }

        .login-page-v2 .login-title{
            font-size: 1.25rem;
        }

        .login-page-v2 .login-subtitle{
            font-size: .88rem;
        }

        .login-page-v2 .login-brand-wrap img{
            max-width: 72px;
        }

        .login-page-v2 .country-code{
            min-width: 95px;
            font-size: .9rem;
        }
    }
</style>
@endpush

@section('content')
<div class="login-page-v2 text-align-direction">
    <div class="container py-4 py-lg-5 my-4">
        <div class="login-card">
            <div class="login-brand">
                <div class="login-brand-wrap">
                    <img src="{{ asset('public/assets/images/logo_web.png') }}" alt="logo">
                    <img src="{{ asset('public/assets/images/logo_header.png') }}" alt="logo">
                </div>
            </div>

            <h1 class="login-title">تسجيل الدخول</h1>
            <p class="login-subtitle">
                أدخل رقم الجوال للمتابعة إلى حسابك والوصول إلى خدمات المنصة بسهولة
            </p>

            <form class="needs-validation mt-2" autocomplete="off" action="{{ route('customer.auth.login') }}" method="post" id="customer-login-form">
                @csrf

                <div class="login-form-group">
                    <label class="login-label">
                        {{ __('messages.phone') }}
                    </label>

                    <div class="phone-group">
                        <div class="country-code">
                            <img src="{{ asset('public/assets/front-end/png/flag.png') }}" alt="Saudi Flag">
                            <span>+966</span>
                        </div>

                        <input
                            class="phone-input"
                            type="tel"
                            name="user_id"
                            id="si-email"
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

                    <div class="error-text" id="phoneError">
                        رقم الجوال يجب أن يبدأ بـ 5 ويتكون من 9 أرقام
                    </div>

                    <div class="invalid-feedback">
                        {{ __('messages.please_provide_valid_email_or_phone_number') }}.
                    </div>
                </div>

                <input
                    class="text-align-direction"
                    name="password"
                    type="hidden"
                    id="si-password"
                    value="1234567"
                    placeholder="{{ translate('enter_password')}}"
                    required
                >

                <div class="remember-wrap">
                    <div class="rtl">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="remember">{{ translate('remember_me') }}</label>
                        </div>
                    </div>
                </div>

                @php($recaptcha = getWebConfig(name: 'recaptcha'))
                @if(isset($recaptcha) && $recaptcha['status'] == 1)
                    <div id="recaptcha_element" class="w-100" data-type="image"></div>
                    <br/>
                @else
                    <div class="row py-2 captcha-wrap">
                        <div class="col-6 pr-2">
                            <input
                                type="text"
                                class="form-control"
                                name="default_recaptcha_id_customer_login"
                                value=""
                                placeholder="{{ translate('enter_captcha_value') }}"
                                autocomplete="off"
                            >
                        </div>
                        <div class="col-6 input-icons mb-2 w-100 rounded bg-white">
                            <a href="javascript:" class="d-flex align-items-center get-login-recaptcha-verify" data-link="{{ URL('/customer/auth/code/captcha') }}">
                                <img src="{{ URL('/customer/auth/code/captcha/1?captcha_session_id=default_recaptcha_id_customer_login') }}" class="input-field rounded __h-40" id="customer_login_recaptcha_id" alt="">
                                <i class="tio-refresh icon cursor-pointer p-2"></i>
                            </a>
                        </div>
                    </div>
                @endif

                <button class="login-btn" type="submit">
                    {{ translate('sign_in') }}
                </button>
            </form>

            <div class="social-login-wrap">
                @foreach (getWebConfig(name: 'social_login') as $socialLoginService)
                    @if (isset($socialLoginService) && $socialLoginService['status'])
                        <a href="{{ route('customer.auth.service-login', $socialLoginService['login_medium']) }}">
                            <img src="{{ asset('public/assets/front-end/img/icons/'.$socialLoginService['login_medium'].'.png') }}" alt="">
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const phoneInput = document.getElementById('si-email');
        const phoneError = document.getElementById('phoneError');
        const loginForm = document.getElementById('customer-login-form');

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
                return true;
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

        phoneInput.addEventListener('input', function () {
            const cursorPos = this.selectionStart;
            this.value = normalizePhone(this.value);
            validatePhone();
            this.setSelectionRange(this.value.length, this.value.length);
        });

        phoneInput.addEventListener('keydown', function (e) {
            const allowedKeys = [
                'Backspace', 'Delete', 'ArrowLeft', 'ArrowRight', 'Tab', 'Home', 'End'
            ];

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
            validatePhone();
        });

        loginForm.addEventListener('submit', function (e) {
            phoneInput.value = normalizePhone(phoneInput.value);

            if (!validatePhone()) {
                e.preventDefault();
                phoneInput.focus();
            }
        });
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
@endpush