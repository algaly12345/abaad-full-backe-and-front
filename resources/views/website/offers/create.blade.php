<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة عرض عقاري</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        *{box-sizing:border-box;font-family:'Cairo',sans-serif}
        body{margin:0;background:#f5f7fb;color:#111827}
        .hero{background:linear-gradient(135deg,#1d4ed8,#06b6d4);padding:50px 20px;color:#fff;text-align:center}
        .hero h1{margin:0;font-size:36px;font-weight:800}
        .hero p{margin-top:10px;font-size:17px}
        .container{width:90%;max-width:1100px;margin:30px auto}
        .card{background:#fff;border-radius:20px;box-shadow:0 15px 35px rgba(0,0,0,.08);padding:30px}
        .grid{display:grid;grid-template-columns:1fr 1fr;gap:20px}
        .form-group{margin-bottom:18px}
        label{display:block;margin-bottom:8px;font-weight:700}
        .form-control{width:100%;min-height:48px;border:1px solid #d1d5db;border-radius:14px;padding:10px 14px}
        .form-control:focus{outline:none;border-color:#2563eb;box-shadow:0 0 0 4px rgba(37,99,235,.10)}
        .preview{width:100%;max-width:320px;height:240px;object-fit:cover;border-radius:18px;border:2px dashed #d1d5db;padding:8px;background:#fff}
        .btn{border:none;border-radius:14px;padding:14px 22px;background:linear-gradient(135deg,#2563eb,#06b6d4);color:#fff;font-weight:800;cursor:pointer}
        .error-box{background:#fee2e2;color:#991b1b;padding:14px 16px;border-radius:12px;margin-bottom:20px}
        @media(max-width:768px){.grid{grid-template-columns:1fr}}
        .hidden{display:none}
    </style>
</head>
<body>
    <section class="hero">
        <h1>إضافة عرض عقاري</h1>
        <p>أنشئ عرضك ثم اختر الباقة المناسبة بطريقة احترافية</p>
    </section>

    <div class="container">
        <div class="card">
            @if(session('error'))
                <div class="error-box">{{ session('error') }}</div>
            @endif

            @if($errors->any())
                <div class="error-box">
                    <ul style="margin:0;padding-right:18px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('website.offers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid">
                    <div>
                        <div class="form-group">
                            <label>عنوان العرض</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="ادخل عنوان العرض">
                        </div>

                        <div class="form-group">
                            <label>اختيار الخدمة</label>
                            <select name="service_type" class="form-control">
                                @foreach($serviceTypes as $serviceType)
                                    <option value="{{ $serviceType->id }}">{{ $serviceType->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>تحديد نوع العرض</label>
                            <select name="offer_type" id="offer_type" class="form-control">
                                <option value="">اختر نوع العرض</option>
                                <option value="discount">خصم</option>
                                <option value="price">سعر</option>
                            </select>
                        </div>

                        <div class="form-group hidden" id="price_box">
                            <label>السعر</label>
                            <input type="number" step="0.01" name="service_price" class="form-control" value="{{ old('service_price') }}">
                        </div>

                        <div class="form-group hidden" id="discount_box">
                            <label>الخصم (%)</label>
                            <input type="number" step="0.01" name="discount" class="form-control" value="{{ old('discount') }}">
                        </div>

                        <div class="form-group">
                            <label>وصف الخدمة</label>
                            <textarea name="description" class="form-control" rows="5" placeholder="اكتب وصف الخدمة">{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <div>
                        <div class="form-group" style="text-align:center;">
                            <img id="viewer" class="preview" src="{{ asset('public/assets/images/default-estate.jpg') }}" alt="preview">
                        </div>

                        <div class="form-group">
                            <label>صورة العرض</label>
                            <input type="file" name="image" class="form-control" id="imageInput" accept="image/*">
                        </div>
                    </div>
                </div>

                <div style="margin-top:20px;">
                    <button type="submit" class="btn">حفظ ومتابعة اختيار الباقة</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const offerType = document.getElementById('offer_type');
        const priceBox = document.getElementById('price_box');
        const discountBox = document.getElementById('discount_box');
        const imageInput = document.getElementById('imageInput');
        const viewer = document.getElementById('viewer');

        function toggleOfferType() {
            const value = offerType.value;
            priceBox.classList.add('hidden');
            discountBox.classList.add('hidden');

            if (value === 'price') {
                priceBox.classList.remove('hidden');
            } else if (value === 'discount') {
                discountBox.classList.remove('hidden');
            }
        }

        offerType.addEventListener('change', toggleOfferType);
        toggleOfferType();

        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                viewer.src = URL.createObjectURL(file);
            }
        });
    </script>
</body>
</html>