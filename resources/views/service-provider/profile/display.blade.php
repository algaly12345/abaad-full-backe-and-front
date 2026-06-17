@extends('layouts.back-end.app-seller')

@section('title', 'ملف مزود الخدمة')
@push('css_or_js')
    <link rel="stylesheet" href="{{ dynamicAsset(path: 'public/assets/back-end/plugins/intl-tel-input/css/intlTelInput.css') }}">
    <style>
        /* RTL Support */
        body {
            direction: rtl;
            text-align: right;
        }
        
        .text-end {
            text-align: left !important;
        }
        
        .text-start {
            text-align: right !important;
        }
        
        .me-3 {
            margin-left: 1rem !important;
            margin-right: 0 !important;
        }
        
        .ms-3 {
            margin-right: 1rem !important;
            margin-left: 0 !important;
        }
        
        .pe-3 {
            padding-left: 1rem !important;
            padding-right: 0 !important;
        }
        
        .ps-3 {
            padding-right: 1rem !important;
            padding-left: 0 !important;
        }
        
        .border-left {
            border-right: 1px solid #dee2e6 !important;
            border-left: none !important;
        }
        
        .avatar-xs {
            margin-left: 0.25rem;
            margin-right: 0;
        }
        
        .flex-shrink-0 {
            order: 2;
        }
        
        .flex-grow-1 {
            order: 1;
        }
        
        .d-flex.align-items-center {
            flex-direction: row-reverse;
        }
        
        .list-inline-item {
            margin-left: 0.5rem;
            margin-right: 0;
            float: right;
        }
        
        .card-header .d-flex {
            flex-direction: row-reverse;
        }
        
        .navbar-vertical .navbar-nav {
            padding-right: 0;
            padding-left: 1rem;
        }
        
        .navbar-vertical .nav-link {
            text-align: right;
            justify-content: flex-end;
        }
        
        .navbar-vertical .nav-icon {
            margin-left: 0.5rem;
            margin-right: 0;
        }
        
        /* Fix for form labels */
        .form-label {
            text-align: right;
            display: block;
        }
        
        /* Fix for error messages */
        .text-danger {
            text-align: right;
        }
        
        /* Fix for select options */
        select option {
            text-align: right;
        }
        
        /* Fix for social icons positioning */
        .social-source-list {
            justify-content: center;
        }
        
        /* Fix for avatar positioning */
        .avatar-xl {
            margin-left: auto;
            margin-right: auto;
        }
        
        /* Fix for card headers */
        .card-title {
            text-align: right;
        }
        
        /* Fix for table headers if any */
        th {
            text-align: right;
        }
        
        /* Fix for input placeholders */
        input::placeholder {
            text-align: right;
        }
        
        /* Fix for text-muted elements */
        .text-muted {
            text-align: right;
        }
        
        /* Fix for button icons */
        .btn i {
            margin-left: 0.25rem;
            margin-right: 0;
        }
    </style>
@endpush

@section('content')
    <div class="content container-fluid" dir="rtl">
        <div class="mb-3">
            <div class="row gy-2 align-items-center">
                <div class="col-sm">
                    <h2 class="h1 mb-0 d-flex align-items-center gap-2">
@php
    $user = auth()->guard('user')->user();
@endphp

<img src="{{ $user && $user->image
    ? asset('storage/app/public/' . $user->image)
    : asset('storage/app/public/default.png') }}"
     alt="صورة المستخدم">
                        ملف مزود الخدمة
                    </h2>
                </div>
                <div class="col-sm-auto">
                    <a class="btn btn--primary" href="{{route('service-provider.dashboard')}}">
                        <i class="tio-home ml-1"></i> لوحة التحكم
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <img src="{{ $user && $user->image
    ? asset('storage/app/public/' . $user->image)
    : asset('storage/app/public/default.png') }}"
                                 alt="صورة مزود الخدمة" 
                                 class="avatar-xl img-thumbnail rounded-circle">
                            <div class="mt-2">
                                <h4 class="mb-1">{{ $user->name }}</h4>
                                <p class="text-muted">مزود خدمة</p>
                            </div>
                        </div>
                        
                        <div class="mt-3">
                            <div class="d-flex justify-content-center mb-3">
                                <div class="px-2">
                                    <h5 class="mb-0">{{ $offers_count }}</h5>
                                    <p class="text-muted mb-0">العروض</p>
                                </div>
                                <div class="px-2 border-left">
                                    <h5 class="mb-0">{{ $pending_offers_count }}</h5>
                                    <p class="text-muted mb-0">في الانتظار</p>
                                </div>
                                <div class="px-2 border-left">
                                    <h5 class="mb-0">{{ $accept_offers_count }}</h5>
                                    <p class="text-muted mb-0">مقبولة</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <ul class="list-inline social-source-list">
                                @if($user->youtube)
                                <li class="list-inline-item">
                                    <a href="{{ $user->youtube }}" target="_blank" class="avatar-xs">
                                        <span class="avatar-title rounded-circle bg-danger">
                                            <i class="mdi mdi-youtube"></i>
                                        </span>
                                    </a>
                                </li>
                                @endif
                                
                                @if($user->twitter)
                                <li class="list-inline-item">
                                    <a href="{{ $user->twitter }}" target="_blank" class="avatar-xs">
                                        <span class="avatar-title rounded-circle bg-info">
                                            <i class="mdi mdi-twitter"></i>
                                        </span>
                                    </a>
                                </li>
                                @endif
                                
                                @if($user->instagram)
                                <li class="list-inline-item">
                                    <a href="{{ $user->instagram }}" target="_blank" class="avatar-xs">
                                        <span class="avatar-title rounded-circle bg-pink">
                                            <i class="mdi mdi-instagram"></i>
                                        </span>
                                    </a>
                                </li>
                                @endif
                                
                                @if($user->snapchat)
                                <li class="list-inline-item">
                                    <a href="{{ $user->snapchat }}" target="_blank" class="avatar-xs">
                                        <span class="avatar-title rounded-circle bg-warning">
                                            <i class="mdi mdi-snapchat"></i>
                                        </span>
                                    </a>
                                </li>
                                @endif
                                
                                @if($user->website)
                                <li class="list-inline-item">
                                    <a href="{{ $user->website }}" target="_blank" class="avatar-xs">
                                        <span class="avatar-title rounded-circle bg-primary">
                                            <i class="mdi mdi-web"></i>
                                        </span>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="card-title mb-3">معلومات الاتصال</h5>
                        
                        <div class="mt-3">
                            <p class="font-size-12 text-muted mb-1">البريد الإلكتروني</p>
                            <h6 class="mb-3">{{ $user->email }}</h6>
                        </div>
                        
                        <div class="mt-3">
                            <p class="font-size-12 text-muted mb-1">رقم الجوال</p>
                            <h6 class="mb-3">{{ $user->phone }}</h6>
                        </div>
                        
                        <div class="mt-3">
                            <p class="font-size-12 text-muted mb-1">رقم الهوية</p>
                            <h6 class="mb-3">{{ $user->provider->identity_number??"" }}</h6>
                        </div>
                        
                        <div class="mt-3">
                            <p class="font-size-12 text-muted mb-1">الوظيفة</p>
                            <h6 class="mb-3">{{ $user->provider->job??"" }}</h6>
                        </div>
                        
                     @if($user->commercial_registration_no)
                        <div class="mt-3">
                            <p class="font-size-12 text-muted mb-1">السجل التجاري</p>
                            <h6 class="mb-3">{{ $user->commercial_registration_no ??""}}</h6>
                        </div>
                        @endif
                        
                        <div class="mt-3">
                            <p class="font-size-12 text-muted mb-1">العنوان</p>
                            <h6 class="mb-3">{{ $user->provider->address??'' }}</h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <!-- إحصائيات العروض -->
                <div class="row mb-4">
                    <div class="col-md-6 col-xl-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar-sm bg-primary bg-opacity-10 rounded p-2">
                                            <i class="mdi mdi-briefcase-outline text-primary font-size-24"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="text-muted mb-1">العروض</p>
                                        <h4 class="mb-0">{{ $offers_count }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-xl-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar-sm bg-warning bg-opacity-10 rounded p-2">
                                            <i class="mdi mdi-clock-outline text-warning font-size-24"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="text-muted mb-1">العروض في الانتظار</p>
                                        <h4 class="mb-0">{{ $pending_offers_count }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-xl-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar-sm bg-success bg-opacity-10 rounded p-2">
                                            <i class="mdi mdi-check-circle-outline text-success font-size-24"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="text-muted mb-1">العروض المقبولة</p>
                                        <h4 class="mb-0">{{ $accept_offers_count }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-xl-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar-sm bg-info bg-opacity-10 rounded p-2">
                                            <i class="mdi mdi-send-outline text-info font-size-24"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="text-muted mb-1">عروضك المرسلة</p>
                                        <h4 class="mb-0">{{ $your_offers_count }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-xl-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar-sm bg-secondary bg-opacity-10 rounded p-2">
                                            <i class="mdi mdi-clock-outline text-secondary font-size-24"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="text-muted mb-1">عروضك في الانتظار</p>
                                        <h4 class="mb-0">{{ $your_pending_offers_count }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-xl-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar-sm bg-success bg-opacity-10 rounded p-2">
                                            <i class="mdi mdi-check-all text-success font-size-24"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="text-muted mb-1">عروضك المقبولة</p>
                                        <h4 class="mb-0">{{ $your_accept_offers_count }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- تعديل البيانات -->
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center gap-3">
                            <div><img src="{{ dynamicAsset(path: 'public/assets/back-end/img/icons/user-1.svg') }}" alt=""></div>
                            <h4 class="card-title m-0 fs-16">تعديل البيانات</h4>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <form action="{{ route('service-provider.profile.update',$user->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">الاسم</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" style="text-align: right;">
                                    @error('name')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">البريد الإلكتروني</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" style="text-align: right;">
                                    @error('email')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">رقم الجوال</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" style="text-align: right;">
                                    @error('phone')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="zone_id" class="form-label">المنطقة</label>
                                    <select class="form-control" name="zone_id" id="zone_id" style="text-align: right;">
                                        @foreach (\App\Models\Zone::all() as $zone)
                                            <option value="{{ $zone->id }}" {{ $zone->id == $user->zone_id ? 'selected' : '' }}>{{ $zone->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('zone_id')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                 <div class="col-md-6 mb-3">
    <label for="identity_number" class="form-label">رقم الهوية</label>
    <input type="text" class="form-control" id="identity_number" name="identity_number"
           value="{{ $user->identity_number ?? '' }}" style="text-align: right;">
    @error('identity_number')
        <div class="text-danger mt-1">{{ $message }}</div>
    @enderror
</div>

<div class="col-md-6 mb-3">
    <label for="job" class="form-label">الوظيفة</label>
    <input type="text" class="form-control" id="job" name="job"
           value="{{ $user->job ?? '' }}" style="text-align: right;">
    @error('job')
        <div class="text-danger mt-1">{{ $message }}</div>
    @enderror
</div>

<div class="col-md-6 mb-3">
    <label for="commercial_registration_no" class="form-label">السجل التجاري</label>
    <input type="text" class="form-control" id="commercial_registration_no" name="commercial_registration_no"
           value="{{ $user->commercial_registration_no ?? '' }}" style="text-align: right;">
    @error('commercial_registration_no')
        <div class="text-danger mt-1">{{ $message }}</div>
    @enderror
</div>

<div class="col-md-6 mb-3">
    <label for="address" class="form-label">العنوان</label>
    <input type="text" class="form-control" id="address" name="address"
           value="{{ $user->address ?? '' }}" style="text-align: right;">
    @error('address')
        <div class="text-danger mt-1">{{ $message }}</div>
    @enderror
</div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="image" class="form-label">الصورة الشخصية</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                    @error('image')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="youtube" class="form-label">يوتيوب</label>
                                    <input type="text" class="form-control" id="youtube" name="youtube" value="{{ $user->youtube ?? '' }}" style="text-align: right;">
                                    @error('youtube')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="twitter" class="form-label">تويتر</label>
                                    <input type="text" class="form-control" id="twitter" name="twitter" value="{{ $user->twitter ?? '' }}" style="text-align: right;">
                                    @error('twitter')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="instagram" class="form-label">انستغرام</label>
                                    <input type="text" class="form-control" id="instagram" name="instagram" value="{{ $user->instagram ?? '' }}" style="text-align: right;">
                                    @error('instagram')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="snapchat" class="form-label">سناب شات</label>
                                    <input type="text" class="form-control" id="snapchat" name="snapchat" value="{{ $user->snapchat ?? '' }}" style="text-align: right;">
                                    @error('snapchat')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="website" class="form-label">الموقع الإلكتروني</label>
                                    <input type="text" class="form-control" id="website" name="website" value="{{ $user->website ?? '' }}" style="text-align: right;">
                                    @error('website')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- تغيير كلمة المرور -->
                <div class="card mt-4">
                    <div class="card-header">
                        <div class="d-flex align-items-center gap-3">
                            <div><img src="{{ dynamicAsset(path: 'public/assets/back-end/img/icons/password-lock.svg') }}" alt=""></div>
                            <h4 class="card-title m-0 fs-16">تغيير كلمة المرور</h4>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <form action="{{ route('service-provider.profile.update',$user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">كلمة المرور الجديدة</label>
                                    <input type="password" class="form-control" id="password" name="password" required minlength="8" style="text-align: right;">
                                    @error('password')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="password_confirmation" class="form-label">تأكيد كلمة المرور</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required style="text-align: right;">
                                    @error('password_confirmation')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-primary">تغيير كلمة المرور</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ dynamicAsset(path: 'public/assets/back-end/plugins/intl-tel-input/js/intlTelInput.js') }}"></script>
    <script src="{{ dynamicAsset(path: 'public/assets/back-end/js/country-picker-init.js') }}"></script>
@endpush