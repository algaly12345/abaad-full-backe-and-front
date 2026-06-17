@extends('layouts.front-end.app')

@section('title', translate('verify'))

@section('content')





{{-- <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card p-4 shadow" style="width: 400px; border-radius: 10px;">
        <h4 class="text-center mb-4">التحقق من رقم الهاتف</h4>
        <p class="text-center text-muted">أدخل رمز التحقق المرسل إلى رقم هاتفك</p>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('customer.auth.verify') }}">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user_id }}">

            <div class="mb-3">
                <label for="otp" class="form-label">رمز التحقق</label>
                <input type="text" name="otp" id="otp" class="form-control text-center" maxlength="6" required placeholder="أدخل الرمز المكون من 6 أرقام">
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">تحقق</button>
            </div>

            <div class="mt-3 text-center">
                <p>لم تستلم الرمز؟ <a href="{{ route('customer.auth.resend-register', ['user_id' => $user_id]) }}" class="text-primary">إعادة الإرسال</a></p>
            </div>
        </form>
    </div>
</div> --}}



<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh; background-color: #f8f9fa;">
    <div class="card shadow-lg p-5" style="width: 500px; border-radius: 15px; border: none;">
        <h4 class="text-center mb-3" style="font-weight: bold; color: #001f3f;">التحقق من رقم الهاتف</h4>
        <p class="text-center text-muted mb-4">أدخل رمز التحقق المرسل إلى رقم هاتفك المسجل</p>

        @if (session('error'))
            <div class="alert alert-danger text-center">{{ session('error') }}</div>
        @endif

        @if (session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('customer.auth.verify') }}">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user_id }}">

            <div class="mb-4">
                <label for="otp" class="form-label fw-bold">رمز التحقق</label>
                <input type="text" name="otp" id="otp" class="form-control text-center fs-5" maxlength="6" required placeholder="أدخل الرمز المكون من 4 أرقام">
            </div>

            <div class="d-grid">
                <button type="submit" class="btn w-100" style="background-color: #174c81; color: white; font-size: 18px; padding: 12px 0; border-radius: 8px;">
                    تحقق
                </button>
            </div>

            <div class="mt-4 text-center">
                <p class="mb-0">لم تستلم الرمز؟ <a href="{{ route('customer.auth.resend-register', ['user_id' => $user_id]) }}" class="fw-bold" style="color: #001f3f;">إعادة الإرسال</a></p>
            </div>
        </form>
    </div>
</div>



@endsection

@push('script')
    <script src="{{ theme_asset(path: 'public/assets/front-end/js/verify-otp.js') }}"></script>
@endpush
