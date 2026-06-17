<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الدفع</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        *{box-sizing:border-box;font-family:'Cairo',sans-serif}
        body{margin:0;background:#f5f7fb;color:#111827}
        .container{width:90%;max-width:900px;margin:50px auto}
        .card{background:#fff;border-radius:22px;box-shadow:0 15px 35px rgba(0,0,0,.08);padding:30px}
        h1{margin-top:0}
        .row{display:flex;justify-content:space-between;padding:12px 0;border-bottom:1px solid #eee}
        .btn{display:inline-block;background:linear-gradient(135deg,#2563eb,#06b6d4);color:#fff;text-decoration:none;padding:14px 20px;border-radius:14px;font-weight:800;margin-top:20px}
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>ملخص الدفع</h1>

            <div class="row">
                <strong>العرض</strong>
                <span>{{ $offer->title }}</span>
            </div>

            <div class="row">
                <strong>رقم الاشتراك</strong>
                <span>{{ $subscriptionNumber }}</span>
            </div>

            <div class="row">
                <strong>الإجمالي</strong>
                <span>{{ $price }} ريال</span>
            </div>

            <a href="#" class="btn">إتمام عملية الدفع</a>
        </div>
    </div>
</body>
</html>