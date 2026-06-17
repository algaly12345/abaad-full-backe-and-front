<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تعديل العقار</title>

    <style>
        body {
            margin: 0;
            font-family: Tahoma, Arial;
            background: #f3f6fb;
        }

        .container {
            max-width: 700px;
            margin: 50px auto;
            padding: 0 20px;
        }

        .header {
            background: linear-gradient(135deg, #16a34a, #15803d);
            color: white;
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 20px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,.08);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            border: 1px solid #ddd;
            font-size: 14px;
        }

        input:focus, select:focus {
            border-color: #16a34a;
            box-shadow: 0 0 0 3px rgba(22,163,74,.1);
        }

        .error {
            color: red;
            font-size: 13px;
            margin-top: 5px;
        }

        .info {
            background: #f1f5f9;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .btn {
            padding: 12px 18px;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            color: white;
            font-weight: bold;
        }

        .btn-save {
            background: #16a34a;
        }

        .btn-back {
            background: #6b7280;
        }

        @media(max-width: 600px) {
            .buttons {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">
        <h2>تعديل العقار</h2>
        <p>يمكنك تعديل بيانات الرخصة والهوية ونوع المعلن</p>
    </div>

    <div class="card">

        <!-- معلومات -->
        <div class="info">
            <strong>رقم العقار:</strong> {{ $estate->id }} <br>
            <strong>العنوان:</strong> {{ $estate->short_description ?? '-' }}
        </div>

        <!-- الفورم -->
        <form method="POST" action="{{ route('estates.update', $estate->id) }}">
            @csrf
            @method('PUT')

            <!-- رقم الرخصة -->
            <div class="form-group">
                <label>رقم الرخصة</label>
                <input
                    type="text"
                    name="adLicense_number"
                    value="{{ old('adLicense_number', $estate->adLicense_number) }}"
                >
                @error('adLicense_number')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <!-- الرقم الموحد -->
            <div class="form-group">
                <label>الرقم الموحد / الهوية</label>
                <input
                    type="text"
                    name="identityـorـunified"
                    value="{{ old('identityـorـunified', $estate->{'identityـorـunified'}) }}"
                >
                @error('identityـorـunified')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <!-- نوع المعلن -->
            <div class="form-group">
                <label>نوع المعلن</label>
                <select name="estate_type">
                    <option value="">اختر</option>
                    <option value="1" @selected(old('estate_type', $estate->estate_type) == 1)>
                        فرد
                    </option>
                    <option value="2" @selected(old('estate_type', $estate->estate_type) == 2)>
                        منشأة
                    </option>
                </select>
                @error('estate_type')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            
            
            
            <div class="form-group">
    <label>رابط العقار في الهيئة</label>
    <input
        type="url"
        name="adLicenseUrl"
        value="{{ old('adLicenseUrl', $estate->adLicenseUrl) }}"
        placeholder="https://example.com"
    >

    @error('adLicenseUrl')
        <div class="error">{{ $message }}</div>
    @enderror

    @if(!empty($estate->adLicenseUrl))
        <div style="margin-top:10px;">
            <a href="{{ $estate->adLicenseUrl }}" target="_blank" style="color:#2563eb;font-weight:bold;">
                فتح الرابط الحالي
            </a>
        </div>
    @endif
</div>

            <!-- الأزرار -->
            <div class="buttons">
                <button type="submit" class="btn btn-save">
                    حفظ التعديلات
                </button>

                <a href="{{ route('estates.index') }}" class="btn btn-back">
                    رجوع
                </a>
            </div>

        </form>

    </div>
</div>

</body>
</html>