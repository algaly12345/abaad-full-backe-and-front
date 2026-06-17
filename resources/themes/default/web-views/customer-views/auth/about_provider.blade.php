@extends('layouts.front-end.app')

@section('title',  translate('register'))

@push('css_or_js')
    <link rel="stylesheet" href="{{ theme_asset(path: 'public/assets/front-end/plugin/intl-tel-input/css/intlTelInput.css') }}">
@endpush

@section('content')
    <div class="container py-4 __inline-7 text-align-direction">
        <div class="login-card">
            <!DOCTYPE html>
            <html lang="ar" dir="rtl">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>خدمة مزودي الخدمات في منصة أبعاد العقارية</title>
            </head>
            <body style="font-family: Arial, sans-serif; background-color: #f8f9fa; color: #333; line-height: 1.8; padding: 20px;">
                <div style="background-color: #fff; padding: 30px; border-radius: 15px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); margin: auto; max-width: 1200px;">
                    <h1 style="text-align: center; color: #007bff; font-weight: bold; margin-bottom: 20px;">خدمة مزودي الخدمات في منصة أبعاد العقارية</h1>
                    <p style="text-align: center; font-size: 18px;">الحل الشامل لربط الخدمات العقارية بالباحثين عن العقارات عبر نظام إعلاني ذكي وتفاعلي</p>
            
                    <h2 style="color: #007bff; font-weight: bold;">🔹 ميزة الإعلان الذكي لمزودي الخدمات على الخريطة التفاعلية</h2>
                    <p>تقدم منصة أبعاد العقارية خدمة مزودي الخدمات العقارية، والتي تمثل حلقة الوصل الذكية بين مقدمي الخدمات العقارية والمستخدمين النهائيين.</p>
            
                    <h3>📌 كيف تعمل؟</h3>
                    <div style="background-color: #e9ecef; padding: 10px 20px; border-radius: 10px; margin-bottom: 10px;">
                        <p>✔ تظهر إعلانات مزودي الخدمات بطريقة احترافية وتفاعلية على الخريطة.</p>
                        <p>✔ أيقونات مرئية قابلة للتفاعل تعرض تفاصيل الخدمة.</p>
                        <p>✔ نوافذ منبثقة تحتوي على تفاصيل الخدمة، التقييمات، وطرق التواصل.</p>
                        <p>✔ تحديد الخدمات بناءً على نوع العقار واحتياجات المستخدم.</p>
                    </div>
            
                    <h3>🟢 مثال عملي:</h3>
                    <div style="border: 1px solid #dee2e6; border-radius: 10px; padding: 15px; margin-top: 10px; background-color: #f1f1f1;">
                        <p>🔸 عند البحث عن شقة جديدة، ستظهر أيقونات لشركات التأثيث والنقل.</p>
                        <p>🔸 إذا كان العقار قديمًا، ستظهر أيقونات شركات الصيانة.</p>
                        <p>🔸 للعقارات التجارية، ستظهر إعلانات لشركات إدارة العقارات.</p>
                    </div>
            
                    <h3>🔹 مزايا الإعلان التفاعلي:</h3>
                    <ul>
                        <li>✅ إعلانات موجهة بدقة حسب الموقع والاحتياج.</li>
                        <li>✅ عرض فوري وتفاعلي في نفس واجهة الخريطة.</li>
                        <li>✅ تجربة مستخدم متطورة وسهلة.</li>
                        <li>✅ زيادة فرص الوصول إلى العملاء المستهدفين.</li>
                        <li>✅ رفع كفاءة السوق العقاري بشكل عام.</li>
                    </ul>
            
                    <div style="text-align: center; margin-top: 20px;">
                        <h2 style="color: #007bff; font-weight: bold;">🔷 انضم الآن إلى منصة أبعاد العقارية!</h2>
                        <p>📢 إذا كنت مقدم خدمة عقارية، اغتنم الفرصة الآن للوصول إلى عملائك بطريقة ذكية.</p>
                        <a href="{{route('customer.auth.provider')}}" style="display: inline-block; background-color: #007bff; color: #fff; padding: 10px 20px; border-radius: 30px; text-decoration: none; transition: background-color 0.3s;">سجل الآن وابدأ بتقديم خدماتك</a>
                    </div>
                </div>
            </body>
            </html>
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
