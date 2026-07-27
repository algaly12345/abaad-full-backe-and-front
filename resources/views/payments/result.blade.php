<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>نتيجة الدفع</title>
    <style>
        body {
            font-family: Tahoma, Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background: #f8fafc;
        }
        .box {
            text-align: center;
            padding: 24px;
        }
        .icon {
            font-size: 48px;
            margin-bottom: 12px;
        }
        .msg {
            font-size: 16px;
            color: #0b1628;
            font-weight: 700;
        }
    </style>
</head>
<body data-status="{{ $success ? 'paid' : 'failed' }}">
    <div class="box">
        <div class="icon">{{ $success ? '✅' : '❌' }}</div>
        <div class="msg">{{ $message }}</div>
    </div>
</body>
</html>