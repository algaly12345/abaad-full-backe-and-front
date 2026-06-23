<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الدفع</title>
    <link rel="stylesheet" href="https://cdn.moyasar.com/mpf/1.15.0/moyasar.css" />
    <style>
        body {
            font-family: Tahoma, Arial, sans-serif;
            padding: 16px;
            background: #f8fafc;
            margin: 0;
        }
        .pay-header {
            text-align: center;
            margin-bottom: 18px;
        }
        .pay-amount {
            font-size: 28px;
            font-weight: 900;
            color: #0b1628;
        }
        .pay-sub {
            color: #64748b;
            font-size: 13px;
            margin-top: 4px;
        }
    </style>
</head>
<body>
    <div class="pay-header">
        <div class="pay-amount">{{ number_format($amount, 2) }} ريال</div>
        <div class="pay-sub">اشتراك رقم: {{ $subscription->subscription_number }}</div>
    </div>

    <div class="mysr-form"></div>

    <script src="https://cdnjs.cloudflare.com/polyfill/v3/polyfill.min.js?version=4.8.0&features=fetch"></script>
    <script src="https://cdn.moyasar.com/mpf/1.15.0/moyasar.js"></script>
    <script>
        Moyasar.init({
            element: '.mysr-form',
            amount: {{ $amountHalalas }},
            currency: 'SAR',
            description: 'اشتراك رقم: {{ $subscription->subscription_number }}',
            publishable_api_key: '{{ $publicKey }}',
            callback_url: '{{ $callbackUrl }}',
            metadata: {
                subscription_number: '{{ $subscription->subscription_number }}'
            },
            methods: ['creditcard']
        });
    </script>
</body>
</html>