<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>التحقق من رمز الدخول</title>

    <link rel="stylesheet" href="{{ asset('public/assets/back-end/css/google-fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/back-end/css/vendor.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/back-end/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/back-end/vendor/icon-set/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/back-end/css/theme.minc619.css?v=1.0') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/back-end/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/back-end/css/toastr.css') }}">

    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">

    <style>
        body{
            font-family:'Cairo', sans-serif;
            background: linear-gradient(135deg, #081120, #0f1c33);
            min-height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
            padding:20px;
        }
        .otp-card{
            width:100%;
            max-width:460px;
            background:#fff;
            border-radius:24px;
            padding:32px;
            box-shadow:0 20px 60px rgba(0,0,0,.20);
            text-align:right;
        }
        .otp-title{
            font-size:28px;
            font-weight:800;
            margin-bottom:10px;
            color:#0f172a;
        }
        .otp-subtitle{
            color:#64748b;
            margin-bottom:20px;
            line-height:1.9;
        }
        .form-control{
            height:56px;
            border-radius:16px;
            text-align:center;
            font-size:22px;
            letter-spacing:4px;
        }
        .btn-login{
            width:100%;
            height:56px;
            border:none;
            border-radius:16px;
            background:linear-gradient(135deg, #0f766e, #14b8a6);
            color:#fff;
            font-size:16px;
            font-weight:800;
            margin-top:14px;
        }
        .resend-btn{
            width:100%;
            height:52px;
            border:none;
            border-radius:16px;
            background:#e2e8f0;
            color:#0f172a;
            font-size:15px;
            font-weight:700;
            margin-top:10px;
        }
    </style>
</head>
<body>

<div class="otp-card">
    <h2 class="otp-title">رمز التحقق</h2>
    <p class="otp-subtitle">
        أدخل رمز التحقق المرسل إلى رقم الجوال الخاص بك
    </p>

    <form action="{{ route('role.otp.verify') }}" method="post">
        @csrf
        <input
            type="text"
            class="form-control"
            name="otp"
            placeholder="000000"
            maxlength="6"
            value="{{ old('otp') }}"
            required
        >

        <button type="submit" class="btn-login">
            تأكيد الدخول
        </button>
    </form>

    <form action="{{ route('role.otp.resend') }}" method="post">
        @csrf
        <button type="submit" class="resend-btn">
            إعادة إرسال الرمز
        </button>
    </form>
</div>

<script src="{{asset('public/assets/back-end/js/vendor.min.js')}}"></script>
<script src="{{asset('public/assets/back-end/js/theme.min.js')}}"></script>
<script src="{{asset('public/assets/back-end/js/toastr.js')}}"></script>

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

</body>
</html>