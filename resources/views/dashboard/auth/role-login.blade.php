<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>الدخول كمزود خدمة</title>

    <link rel="stylesheet" href="{{ asset('public/assets/back-end/css/google-fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/back-end/css/vendor.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/back-end/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/back-end/vendor/icon-set/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/back-end/css/theme.minc619.css?v=1.0') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/back-end/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/back-end/css/toastr.css') }}">

    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root{
            --bg-1:#081120;
            --bg-2:#0f1c33;
            --card:#ffffff;
            --text:#0f172a;
            --muted:#64748b;
            --line:#e2e8f0;
            --primary:#0f766e;
            --primary-2:#14b8a6;
            --accent:#22c55e;
            --white:#ffffff;
            --shadow:0 20px 60px rgba(2, 8, 23, .22);
        }

        *{
            box-sizing:border-box;
        }

        html, body{
            margin:0;
            padding:0;
            direction: rtl;
            text-align: right;
            font-family:'Cairo', sans-serif;
            background:
                radial-gradient(circle at top right, rgba(20,184,166,.22), transparent 25%),
                radial-gradient(circle at bottom left, rgba(34,197,94,.16), transparent 22%),
                linear-gradient(135deg, var(--bg-1), var(--bg-2));
            min-height:100vh;
            overflow-x:hidden;
        }

        .page-shell{
            min-height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
            padding:28px;
            position:relative;
        }

        .page-shell::before,
        .page-shell::after{
            content:"";
            position:absolute;
            border-radius:50%;
            filter:blur(12px);
            opacity:.45;
            animation:floatBall 8s ease-in-out infinite;
            z-index:0;
        }

        .page-shell::before{
            width:220px;
            height:220px;
            background:rgba(20,184,166,.18);
            top:70px;
            right:70px;
        }

        .page-shell::after{
            width:300px;
            height:300px;
            background:rgba(34,197,94,.12);
            bottom:40px;
            left:60px;
            animation-delay:1.5s;
        }

        @keyframes floatBall{
            0%,100%{transform:translateY(0px)}
            50%{transform:translateY(-18px)}
        }

        .login-wrap{
            position:relative;
            z-index:1;
            width:100%;
            max-width:1320px;
            display:grid;
            grid-template-columns: .95fr 1.05fr;
            background:rgba(255,255,255,.06);
            backdrop-filter: blur(12px);
            border:1px solid rgba(255,255,255,.08);
            border-radius:32px;
            overflow:hidden;
            box-shadow:var(--shadow);
        }

        .login-side{
            background:rgba(255,255,255,.98);
            padding:44px;
            display:flex;
            align-items:center;
            justify-content:center;
        }

        .login-card{
            width:100%;
            max-width:460px;
        }

        .mobile-logo{
            display:none;
            text-align:center;
            margin-bottom:24px;
        }

        .mini-badge{
            display:inline-flex;
            align-items:center;
            gap:8px;
            padding:8px 14px;
            border-radius:999px;
            background:#ecfeff;
            color:#0f766e;
            font-size:13px;
            font-weight:700;
            margin-bottom:18px;
        }

        .login-title{
            font-size:34px;
            line-height:1.4;
            font-weight:800;
            color:var(--text);
            margin-bottom:10px;
            text-align:right;
        }

        .login-subtitle{
            font-size:15px;
            line-height:2;
            color:var(--muted);
            margin-bottom:26px;
            text-align:right;
        }

        .input-group-wrap{
            margin-bottom:18px;
        }

        .input-label{
            display:block;
            font-size:14px;
            font-weight:700;
            color:#1e293b;
            margin-bottom:10px;
            text-align:right;
        }

        .smart-input{
            position:relative;
        }

        .smart-input .form-control{
            height:58px;
            border-radius:18px;
            border:1px solid var(--line);
            background:#f8fafc;
            font-size:15px;
            padding:14px 18px;
            transition:.25s ease;
            box-shadow:none !important;
            text-align:right;
        }

        .smart-input .form-control:focus{
            border-color:#14b8a6;
            background:#fff;
            transform:translateY(-1px);
            box-shadow:0 0 0 4px rgba(20,184,166,.10) !important;
        }

        .forgot-row{
            display:flex;
            align-items:center;
            justify-content:space-between;
            margin-bottom:10px;
        }

        .forgot-link{
            color:var(--primary);
            text-decoration:none;
            font-size:13px;
            font-weight:700;
        }

        .forgot-link:hover{
            color:var(--primary-2);
            text-decoration:none;
        }

        .input-group{
            direction:ltr;
        }

        .input-group .form-control{
            text-align:right;
            direction:rtl;
            border-top-right-radius:18px !important;
            border-bottom-right-radius:18px !important;
            border-top-left-radius:0 !important;
            border-bottom-left-radius:0 !important;
        }

        .input-group-append .input-group-text{
            border-top-left-radius:18px;
            border-bottom-left-radius:18px;
            border-top-right-radius:0;
            border-bottom-right-radius:0;
            border:1px solid var(--line);
            border-right:none;
            background:#f8fafc;
            min-width:56px;
            display:flex;
            align-items:center;
            justify-content:center;
            color:#475569;
        }

        .remember-row{
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:12px;
            margin:8px 0 24px;
        }

        .custom-control-label{
            color:var(--muted);
            font-size:14px;
        }

        .btn-login{
            width:100%;
            height:58px;
            border:none;
            border-radius:18px;
            background:linear-gradient(135deg, var(--primary), var(--primary-2));
            color:#fff;
            font-size:16px;
            font-weight:800;
            box-shadow:0 16px 35px rgba(15,118,110,.28);
            transition:.28s ease;
        }

        .btn-login:hover{
            transform:translateY(-3px);
            box-shadow:0 22px 40px rgba(15,118,110,.34);
            color:#fff;
        }

        .secure-note{
            text-align:center;
            margin-top:18px;
            color:var(--muted);
            font-size:13px;
        }

        .bottom-points{
            display:flex;
            align-items:center;
            justify-content:center;
            flex-wrap:wrap;
            gap:10px;
            margin-top:18px;
        }

        .bottom-points span{
            background:#f1f5f9;
            color:#334155;
            border-radius:999px;
            padding:8px 12px;
            font-size:12px;
            font-weight:700;
        }

        .showcase-side{
            position:relative;
            padding:54px;
            color:#fff;
            background:
                linear-gradient(180deg, rgba(255,255,255,.02), rgba(255,255,255,.01)),
                linear-gradient(135deg, #081120 0%, #0a1630 40%, #0d3b39 100%);
            text-align:right;
        }

        .top-badge{
            display:inline-flex;
            align-items:center;
            gap:10px;
            padding:10px 16px;
            border:1px solid rgba(255,255,255,.12);
            background:rgba(255,255,255,.06);
            border-radius:999px;
            font-size:13px;
            margin-bottom:28px;
        }

        .brand-logo img{
            max-width:220px;
            margin-bottom:22px;
        }

        .hero-title{
            font-size:42px;
            line-height:1.5;
            font-weight:800;
            margin:0 0 12px;
            max-width:580px;
            text-align:right;
        }

        .hero-title span{
            color:#5eead4;
        }

        .hero-text{
            color:rgba(255,255,255,.82);
            font-size:16px;
            line-height:2;
            max-width:560px;
            margin-bottom:28px;
            text-align:right;
        }

        .features{
            display:grid;
            grid-template-columns:repeat(2,minmax(0,1fr));
            gap:14px;
            margin-top:28px;
            direction:rtl;
        }

        .feature-card{
            background:rgba(255,255,255,.07);
            border:1px solid rgba(255,255,255,.09);
            border-radius:20px;
            padding:18px;
            transition:.3s ease;
            cursor:default;
        }

        .feature-card:hover{
            transform:translateY(-6px);
            background:rgba(255,255,255,.10);
            box-shadow:0 12px 30px rgba(0,0,0,.15);
        }

        .feature-icon{
            width:48px;
            height:48px;
            display:flex;
            align-items:center;
            justify-content:center;
            border-radius:14px;
            background:linear-gradient(135deg, rgba(94,234,212,.22), rgba(34,197,94,.22));
            margin-bottom:12px;
            font-size:20px;
        }

        .feature-title{
            font-size:15px;
            font-weight:700;
            margin-bottom:6px;
        }

        .feature-desc{
            font-size:13px;
            line-height:1.9;
            color:rgba(255,255,255,.75);
        }

        @media (max-width: 1100px){
            .login-wrap{
                grid-template-columns:1fr;
            }

            .showcase-side{
                display:none;
            }

            .login-side{
                padding:28px 20px;
            }

            .mobile-logo{
                display:block;
            }

            .login-title{
                font-size:28px;
            }
        }

        @media (max-width: 576px){
            .page-shell{
                padding:14px;
            }

            .login-side{
                padding:22px 16px;
            }

            .login-title{
                font-size:24px;
            }

            .login-subtitle{
                font-size:14px;
            }

            .smart-input .form-control,
            .btn-login{
                height:54px;
            }
        }
    </style>
</head>

<body>
<main class="page-shell">
    <div class="login-wrap">
        <section class="login-side">
            <div class="login-card">
                @php($eCommerceLogo = getWebConfig(name: 'company_web_logo'))

                <div class="mobile-logo">
                    <a href="{{ route('home') }}">
                        <img width="130" src="{{ asset('public/assets/images/logo_web.png') }}" alt="Logo">
                    </a>
                </div>

                <div class="mini-badge">
                    <i class="tio-lock-outlined"></i>
                    دخول مزود خدمة
                </div>

                <h2 class="login-title">مرحبًا بك</h2>
                <p class="login-subtitle">
                    سجّل الدخول للوصول إلى لوحة مزود الخدمة وإدارة الخدمات المرتبطة بالعقارات والمناطق التابعة لها.
                </p>

           <form action="{{ route('role.login') }}" method="post">
    @csrf

    

    <div class="input-group-wrap">
        <label class="input-label" for="phone">رقم الجوال</label>
        <div class="smart-input">
     <div class="input-group">
    <div class="input-group-append">
        <span class="input-group-text">🇸🇦 +966</span>
    </div>

    <input
        type="text"
        class="form-control"
        name="phone"
        id="phone"
        placeholder="5xxxxxxxx"
        maxlength="9"
        pattern="5[0-9]{8}"
        dir="ltr"
        style="text-align: left;"
        required
    >
</div>
        </div>
    </div>

    <div class="remember-row">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="termsCheckbox" name="remember">
            <label class="custom-control-label" for="termsCheckbox">تذكرني</label>
        </div>
    </div>

    <button type="submit" class="btn-login">
        إرسال رمز التحقق
    </button>

    <div class="secure-note">
        أدخل رقم الجوال المسجل وسيتم إرسال رمز تحقق إلى هاتفك
    </div>

    <div class="bottom-points">
        <span>دخول سريع</span>
        <span>OTP آمن</span>
        <span>برقم الجوال فقط</span>
    </div>
</form>
            </div>
        </section>

        <section class="showcase-side">
            <div class="top-badge">
                <i class="tio-home-vs-1"></i>
                منصة مزودي الخدمات للعروض العقارية
            </div>

            <div class="brand-logo">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('public/assets/images/logo_web.png') }}" alt="Logo">
                </a>
            </div>

            <h1 class="hero-title">
                إدارة خدماتك العقارية <span>بواجهة حديثة</span> وواضحة
            </h1>

            <p class="hero-text">
                بوابة مخصصة لمزودي الخدمات لربط الخدمات بالعقارات والمناطق التابعة لها،
                ومتابعة الخدمات المسندة بشكل منظم وسهل واحترافي.
            </p>

            <div class="features">
                <div class="feature-card">
                    <div class="feature-icon"><i class="tio-pin"></i></div>
                    <div class="feature-title">ربط الخدمة بالموقع</div>
                    <div class="feature-desc">إسناد الخدمة حسب العقار والمنطقة التابعة له بدقة وسرعة.</div>
                </div>

                <div class="feature-card">
                    <div class="feature-icon"><i class="tio-city"></i></div>
                    <div class="feature-title">إدارة حسب العقار</div>
                    <div class="feature-desc">عرض الخدمات والطلبات المرتبطة بكل أصل عقاري بسهولة.</div>
                </div>

                <div class="feature-card">
                    <div class="feature-icon"><i class="tio-settings-vs"></i></div>
                    <div class="feature-title">متابعة الخدمات</div>
                    <div class="feature-desc">الوصول السريع للخدمات المسندة ومراجعتها من حساب واحد.</div>
                </div>

                <div class="feature-card">
                    <div class="feature-icon"><i class="tio-shield"></i></div>
                    <div class="feature-title">دخول آمن</div>
                    <div class="feature-desc">تجربة تسجيل دخول واضحة ومريحة تعزز الموثوقية والاحترافية.</div>
                </div>
            </div>
        </section>
    </div>
</main>

<script src="{{asset('public/assets/back-end/js/vendor.min.js')}}"></script>
<script src="{{asset('public/assets/back-end/js/theme.min.js')}}"></script>
<script src="{{asset('public/assets/back-end/js/toastr.js')}}"></script>
<script src="{{asset('public/assets/back-end/js/vendor/login.js')}}"></script>

@if ($errors->any())
<script>
    "use strict";
    @foreach($errors->all() as $error)
    toastr.error('{{$error}}', 'خطأ', {
        CloseButton: true,
        ProgressBar: true
    });
    @endforeach
</script>
@endif

@if(env('APP_MODE')=='demo')
<div class="position-fixed" style="left:20px; bottom:20px; z-index:999;">
    <div class="card shadow border-0" style="border-radius:16px; min-width:280px;">
        <div class="card-body">
            <div class="mb-2 font-weight-bold">بيانات الدخول التجريبية</div>
            <div class="small text-muted mb-1">
                البريد: {{ \App\Enums\DemoConstant::VENDOR['email'] }}
            </div>
            <div class="small text-muted mb-3">
                كلمة المرور: {{ \App\Enums\DemoConstant::VENDOR['password'] }}
            </div>
            <button class="btn btn-sm btn-primary" id="copyLoginInfo">
                <i class="tio-copy"></i> نسخ البيانات
            </button>
        </div>
    </div>
</div>
@endif

</body>
</html>
