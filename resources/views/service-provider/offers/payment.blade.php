@extends('layouts.back-end.app-seller')


@section('title', '      شاشة الدفع ')
@push('css_or_js')


    <link rel="stylesheet" href="{{ dynamicAsset(path: 'public/assets/back-end/plugins/intl-tel-input/css/intlTelInput.css') }}">

    <style>
        .plan-card {
    transition: border 0.3s ease-in-out;
    border: 2px solid #ddd; /* لون الإطار الافتراضي */
}

.plan-card.selected-plan {
    border: 3px solid #291578 !important; /* تغيير الإطار إلى اللون الأخضر */
    box-shadow: 0 0 10px rgba(41, 8, 87, 0.5);
}

    </style>
@endpush
@section('content')
<div class="content container-fluid main-card {{Session::get('direction')}}">
    <div class="mb-4">
        <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
            <img src="{{dynamicAsset(path: 'public/assets/back-end/img/add-new-seller.png')}}" class="mb-1" alt="">
            إضافة خدمة للعروض العقارية
        </h2>
    </div>




        <link rel="stylesheet" href="https://cdn.moyasar.com/mpf/1.15.0/moyasar.css" />
      
        <!-- Moyasar Scripts -->
        <script src="https://cdnjs.cloudflare.com/polyfill/v3/polyfill.min.js?version=4.8.0&features=fetch"></script>
        <script src="https://cdn.moyasar.com/mpf/1.15.0/moyasar.js"></script>
      
        <!-- Download CSS and JS files in case you want to test it locally, but use CDN in production -->
        <div class="mysr-form"></div>

</div>
@endsection

@push('script')
    <script src="{{ dynamicAsset(path: 'public/assets/back-end/plugins/intl-tel-input/js/intlTelInput.js') }}"></script>
    <script src="{{ dynamicAsset(path: 'public/assets/back-end/js/country-picker-init.js') }}"></script>
    <script src="{{dynamicAsset(path: 'public/assets/back-end/js/admin/user.js')}}"></script>


 

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let amount = {{ $price }} * 100; // تحويل الريال إلى هللة
        let subscriptionNumber = "{{ $subscriptionNumber }}"; // رقم الاشتر
    
            Moyasar.init({
                element: '.mysr-form',
                amount: amount, // ✅ استخدام السعر المخزن في الجلسة
                currency: 'SAR',
                description: `اشتراك رقم: ${subscriptionNumber}`, // ✅ تمرير رقم الاشتراك في الوصف
                publishable_api_key: 'pk_test_AQpxBV31a29qhkhUYFYUFjhwllaDVrxSq5ydVNui',
                callback_url: 'https://moyasar.com/thanks',
                methods: ['creditcard']
            });
        });
    </script>
    

@endpush
