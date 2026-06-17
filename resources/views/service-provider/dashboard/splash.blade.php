@extends('layouts.back-end.app-seller')
@section('title', translate('dashboard'))

@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* جعل المحتوى في منتصف الشاشة */
        .center-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }

        /* تصميم الـ Card */
        .card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 400px;
        }

        /* تصميم الزر */
        .start-button {
            padding: 15px 40px;
            font-size: 20px;
            background-color: #198398; /* أخضر */
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: 0.3s;
            width: 100%;
        }

        /* تأثير عند تمرير الفأرة */
        .start-button:hover {
            background-color: #218838;
        }
    </style>
@endpush

@section('content')
    <div class="content container-fluid center-container">
        <div class="card">
            <h2>مرحبًا بك</h2>
            
            <form action="{{ route('user.dashboard.index') }}" method="GET" id="startTestForm">
                <button type="submit" class="start-button">بدء التقييم</button>
            </form>
        </div>
    </div>
@endsection


@push('script_2')
    <script>
        document.getElementById("startTestForm").addEventListener("submit", function () {
            // تعطيل الرجوع للخلف بعد الانتقال
            history.pushState(null, null, window.location.href);
            window.onpopstate = function () {
                history.go(1);
            };
        });
    </script>
@endpush
