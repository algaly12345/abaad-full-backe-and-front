<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>إضافة خدمة وعرض الباقات</title>

    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        * { box-sizing: border-box; font-family: 'Cairo', sans-serif; }
        body { margin: 0; background: #f5f7fb; color: #1f2937; }

        .top-cart {
            position: sticky;
            top: 0;
            z-index: 999;
            background: linear-gradient(135deg, #111827, #1e3a8a);
            color: #fff;
            padding: 16px 24px;
            box-shadow: 0 10px 25px rgba(0,0,0,.15);
        }

        .top-cart-inner {
            max-width: 1300px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            flex-wrap: wrap;
        }

        .top-cart-title {
            font-size: 22px;
            font-weight: 800;
        }

        .top-cart-summary {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            align-items: center;
        }

        .top-pill {
            background: rgba(255,255,255,.12);
            border: 1px solid rgba(255,255,255,.12);
            border-radius: 999px;
            padding: 10px 16px;
            font-size: 14px;
        }

        .top-total {
            font-size: 24px;
            font-weight: 800;
            color: #38bdf8;
        }

        .hero {
            background: linear-gradient(135deg, #2563eb, #06b6d4);
            color: #fff;
            padding: 55px 20px;
            text-align: center;
        }

        .hero h1 {
            margin: 0 0 8px;
            font-size: 36px;
            font-weight: 800;
        }

        .hero p {
            margin: 0;
            font-size: 18px;
            opacity: .95;
        }

        .container {
            width: 92%;
            max-width: 1300px;
            margin: 30px auto 50px;
        }

        .card {
            background: #fff;
            border-radius: 22px;
            box-shadow: 0 15px 35px rgba(15,23,42,.08);
            padding: 24px;
            margin-bottom: 24px;
        }

        .section-title {
            margin: 0 0 20px;
            font-size: 24px;
            font-weight: 800;
            color: #111827;
        }

        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 700;
            color: #111827;
        }

        .form-control {
            width: 100%;
            min-height: 48px;
            border-radius: 14px;
            border: 1px solid #d1d5db;
            padding: 10px 14px;
            font-size: 15px;
            outline: none;
            background: #fff;
        }

        .form-control:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 4px rgba(37,99,235,.10);
        }

        .preview-box {
            text-align: center;
        }

        .preview-img {
            width: 100%;
            max-width: 340px;
            height: 260px;
            border-radius: 18px;
            object-fit: cover;
            border: 2px dashed #d1d5db;
            padding: 8px;
            background: #fff;
        }

        .plans-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 18px;
        }

        .plan-card {
            position: relative;
            border: 2px solid #e5e7eb;
            border-radius: 22px;
            overflow: hidden;
            background: #fff;
            cursor: pointer;
            transition: .3s ease;
        }

        .plan-card:hover {
            transform: translateY(-5px);
            border-color: #60a5fa;
            box-shadow: 0 18px 35px rgba(0,0,0,.08);
        }

        .plan-card.active {
            border-color: #2563eb;
            box-shadow: 0 18px 35px rgba(37,99,235,.14);
        }

        .plan-badge {
            position: absolute;
            top: 14px;
            left: 14px;
            background: #10b981;
            color: #fff;
            font-size: 12px;
            padding: 6px 10px;
            border-radius: 999px;
            display: none;
        }

        .plan-card.active .plan-badge {
            display: inline-block;
        }

        .plan-top {
            background: linear-gradient(135deg, #1d4ed8, #06b6d4);
            color: #fff;
            text-align: center;
            padding: 22px 16px;
        }

        .plan-price {
            font-size: 30px;
            font-weight: 800;
            margin: 0;
        }

        .plan-body {
            padding: 20px;
        }

        .plan-name {
            font-size: 20px;
            font-weight: 800;
            text-align: center;
            margin-bottom: 8px;
        }

        .plan-desc {
            text-align: center;
            color: #6b7280;
            min-height: 44px;
            margin-bottom: 14px;
            font-size: 14px;
        }

        .feature {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #f8fafc;
            border-radius: 12px;
            padding: 10px 12px;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .submit-box {
            text-align: center;
        }

        .btn-submit {
            border: none;
            border-radius: 14px;
            background: linear-gradient(135deg, #2563eb, #06b6d4);
            color: #fff;
            padding: 14px 28px;
            font-size: 17px;
            font-weight: 800;
            cursor: pointer;
            min-width: 220px;
        }

        .btn-submit:disabled {
            background: #9ca3af;
            cursor: not-allowed;
        }

        .error-box {
            background: #fee2e2;
            color: #991b1b;
            border-radius: 12px;
            padding: 14px 16px;
            margin-bottom: 20px;
        }

        .select2-container .select2-selection--multiple {
            min-height: 48px !important;
            border-radius: 14px !important;
            border: 1px solid #d1d5db !important;
            padding: 6px !important;
        }

        @media (max-width: 768px) {
            .grid-2 {
                grid-template-columns: 1fr;
            }

            .top-cart-inner {
                flex-direction: column;
                align-items: flex-start;
            }

            .top-cart-summary {
                width: 100%;
            }
        }
    </style>
</head>
<body>

    <div class="top-cart">
        <div class="top-cart-inner">
            <div class="top-cart-title">سلة الطلب</div>

            <div class="top-cart-summary">
                <div class="top-pill">الباقة: <strong id="cart-plan-name">لم يتم الاختيار</strong></div>
                <div class="top-pill">المدة: <strong id="cart-duration">1</strong> شهر</div>
                <div class="top-pill">الأقسام: <strong id="cart-category-count">0</strong></div>
                <div class="top-pill">المناطق: <strong id="cart-zone-count">0</strong></div>
                <div class="top-pill">تاريخ الانتهاء: <strong id="cart-expiry">-</strong></div>
                <div class="top-total"><span id="cart-total">0.00</span> ريال</div>
            </div>
        </div>
    </div>

    <section class="hero">
        <h1>إنشاء الخدمة واختيار الباقة</h1>
        <p>أدخل بيانات الخدمة ثم اختر نوع العقار والمنطقة والباقة المناسبة</p>
    </section>

    <div class="container">
        @if(session('error'))
            <div class="error-box">{{ session('error') }}</div>
        @endif

        @if($errors->any())
            <div class="error-box">
                <ul style="margin:0; padding-right:18px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('website.offers.store-session') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="card">
                <h2 class="section-title">تفاصيل الخدمة</h2>

                <div class="grid-2">
                    <div>
                        <div class="form-group">
                            <label>اسم الخدمة / عنوان العرض</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="أدخل اسم الخدمة">
                        </div>

                        <div class="form-group">
                            <label>نوع الخدمة</label>
                            <select name="service_type" class="form-control">
                                <option value="">اختر نوع الخدمة</option>
                                @foreach($serviceTypes as $serviceType)
                                    <option value="{{ $serviceType->id }}">{{ $serviceType->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>نوع العرض</label>
                            <select name="offer_type" id="offer_type" class="form-control">
                                <option value="">اختر نوع العرض</option>
                                <option value="discount">خصم</option>
                                <option value="price">سعر</option>
                            </select>
                        </div>

                        <div class="form-group" id="price_box" style="display:none;">
                            <label>السعر</label>
                            <input type="number" step="0.01" name="service_price" class="form-control" value="{{ old('service_price') }}">
                        </div>

                        <div class="form-group" id="discount_box" style="display:none;">
                            <label>الخصم (%)</label>
                            <input type="number" step="0.01" name="discount" class="form-control" value="{{ old('discount') }}">
                        </div>

                        <div class="form-group">
                            <label>الوصف</label>
                            <textarea name="description" class="form-control" rows="6" placeholder="أدخل وصف الخدمة">{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <div>
                        <div class="preview-box">
                            <img id="viewer" class="preview-img" src="{{ asset('public/assets/images/default-estate.jpg') }}" alt="preview">
                        </div>

                        <div class="form-group" style="margin-top:18px;">
                            <label>صورة الخدمة</label>
                            <input type="file" name="image" id="image_input" class="form-control" accept="image/*">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <h2 class="section-title">أنواع العقار والمناطق</h2>

                <div class="grid-2">
                    <div class="form-group">
                        <label>أنواع العقار التي يظهر فيها العرض</label>
                        <select class="form-control" id="categories" name="categories[]" multiple>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name_ar }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>المناطق التي يظهر فيها العرض</label>
                        <select class="form-control" id="zones" name="zones[]" multiple>
                            @foreach($zones as $zone)
                                <option value="{{ $zone->id }}">{{ $zone->name_ar }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="card">
                <h2 class="section-title">اختر الباقة</h2>

                <div class="plans-grid">
                    @foreach($servicePlans as $plan)
                        <div class="plan-card"
                             data-id="{{ $plan->id }}"
                             data-name="{{ $plan->name }}"
                             data-price="{{ $plan->price }}"
                             data-ads="{{ $plan->number_of_ads ?? 0 }}"
                             data-categories="{{ $plan->number_of_categories ?? 0 }}"
                             data-zones="{{ $plan->number_of_zone ?? 0 }}">
                            <span class="plan-badge">مختارة</span>

                            <div class="plan-top">
                                <p class="plan-price">{{ number_format($plan->price, 2) }} ريال</p>
                            </div>

                            <div class="plan-body">
                                <div class="plan-name">{{ $plan->name }}</div>
                                <div class="plan-desc">{{ $plan->description }}</div>

                                <div class="feature">
                                    <span>عدد الإعلانات</span>
                                    <strong>{{ $plan->number_of_ads ?? 0 }}</strong>
                                </div>
                                <div class="feature">
                                    <span>عدد أنواع العقار</span>
                                    <strong>{{ $plan->number_of_categories ?? 0 }}</strong>
                                </div>
                                <div class="feature">
                                    <span>عدد المناطق</span>
                                    <strong>{{ $plan->number_of_zone ?? 0 }}</strong>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="card">
                <h2 class="section-title">مدة الاشتراك</h2>

                <div class="grid-2">
                    <div class="form-group">
                        <label>اختر المدة</label>
                        <select class="form-control" id="subscription_duration" name="subscription_duration">
                            <option value="1">شهر</option>
                            <option value="3">3 شهور</option>
                            <option value="6">6 شهور</option>
                            <option value="12">سنة</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>تاريخ الانتهاء</label>
                        <input type="date" class="form-control" id="expiry_date" name="expiry_date" readonly>
                    </div>
                </div>
            </div>

            <input type="hidden" name="service_plan_id" id="service_plan_id">
            <input type="hidden" name="package_price" id="package_price">
            <input type="hidden" name="number_of_ads" id="number_of_ads">
            <input type="hidden" name="number_of_categories" id="number_of_categories">
            <input type="hidden" name="number_of_zone" id="number_of_zone">

            <div class="card submit-box">
                <button type="submit" id="submit_btn" class="btn-submit" disabled>
                    متابعة وحفظ في الجلسة
                </button>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        let selectedPlanPrice = 0;
        let selectedPlanName = 'لم يتم الاختيار';
        let maxCategories = 0;
        let maxZones = 0;

        $('#categories').select2({ placeholder: 'اختر أنواع العقار' });
        $('#zones').select2({ placeholder: 'اختر المناطق' });

        function updateOfferTypeFields() {
            let value = document.getElementById('offer_type').value;
            document.getElementById('price_box').style.display = value === 'price' ? 'block' : 'none';
            document.getElementById('discount_box').style.display = value === 'discount' ? 'block' : 'none';
        }

        document.getElementById('offer_type').addEventListener('change', updateOfferTypeFields);
        updateOfferTypeFields();

        document.getElementById('image_input').addEventListener('change', function(e) {
            let file = e.target.files[0];
            if (file) {
                document.getElementById('viewer').src = URL.createObjectURL(file);
            }
        });

        function updateExpiryDate(months) {
            let date = new Date();
            date.setMonth(date.getMonth() + parseInt(months));
            let formatted = date.toISOString().split('T')[0];

            document.getElementById('expiry_date').value = formatted;
            document.getElementById('cart-expiry').innerText = formatted;
        }

        function updateCartSummary() {
            let duration = parseInt(document.getElementById('subscription_duration').value || 1);
            let total = selectedPlanPrice * duration;

            document.getElementById('cart-plan-name').innerText = selectedPlanName;
            document.getElementById('cart-duration').innerText = duration;
            document.getElementById('cart-category-count').innerText = ($('#categories').val() || []).length;
            document.getElementById('cart-zone-count').innerText = ($('#zones').val() || []).length;
            document.getElementById('cart-total').innerText = total.toFixed(2);

            document.getElementById('package_price').value = total.toFixed(2);

            updateExpiryDate(duration);
        }

        document.querySelectorAll('.plan-card').forEach(card => {
            card.addEventListener('click', function() {
                document.querySelectorAll('.plan-card').forEach(c => c.classList.remove('active'));
                this.classList.add('active');

                selectedPlanPrice = parseFloat(this.dataset.price);
                selectedPlanName = this.dataset.name;
                maxCategories = parseInt(this.dataset.categories);
                maxZones = parseInt(this.dataset.zones);

                document.getElementById('service_plan_id').value = this.dataset.id;
                document.getElementById('number_of_ads').value = this.dataset.ads;
                document.getElementById('number_of_categories').value = this.dataset.categories;
                document.getElementById('number_of_zone').value = this.dataset.zones;

                $('#categories').val(null).trigger('change');
                $('#zones').val(null).trigger('change');

                document.getElementById('submit_btn').disabled = false;

                updateCartSummary();
            });
        });

        document.getElementById('subscription_duration').addEventListener('change', updateCartSummary);

        $('#categories').on('change', function() {
            let selected = $(this).val() || [];
            if (maxCategories > 0 && selected.length > maxCategories) {
                selected = selected.slice(0, maxCategories);
                $(this).val(selected).trigger('change.select2');
                alert('الحد الأقصى المسموح لأنواع العقار هو ' + maxCategories);
            }
            updateCartSummary();
        });

        $('#zones').on('change', function() {
            let selected = $(this).val() || [];
            if (maxZones > 0 && selected.length > maxZones) {
                selected = selected.slice(0, maxZones);
                $(this).val(selected).trigger('change.select2');
                alert('الحد الأقصى المسموح للمناطق هو ' + maxZones);
            }
            updateCartSummary();
        });

        updateCartSummary();
    </script>

</body>
</html>