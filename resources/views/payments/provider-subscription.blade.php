<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="theme-color" content="#f4f6fb">
    <title>الدفع</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.moyasar.com/mpf/1.15.0/moyasar.css" />
    <style>
        :root {
            --brand: #3b71de;
            --brand-dark: #2e5bc0;
            --ink: #0b1628;
            --muted: #64748b;
            --border: #e5e9f0;
            --bg: #f4f6fb;
        }
        * { box-sizing: border-box; }
        html, body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }
        body {
            font-family: 'Cairo', Tahoma, Arial, sans-serif;
            background: var(--bg);
            color: var(--ink);
            min-height: 100vh;
            -webkit-tap-highlight-color: transparent;
        }

        .page {
            width: 100%;
            max-width: 480px;
            margin: 0 auto;
            padding: 0 16px;
            padding-bottom: max(18px, env(safe-area-inset-bottom));
        }

        /* ---------- Header ---------- */
        .topbar {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 16px 4px 12px;
        }
        .topbar h1 {
            margin: 0;
            font-size: 17px;
            font-weight: 700;
            color: var(--ink);
        }
        .topbar .lock-ic {
            width: 18px;
            height: 18px;
            flex: none;
            color: var(--brand);
        }

        /* ---------- Card ---------- */
        .sheet {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 20px;
            box-shadow: 0 1px 2px rgba(15, 23, 42, .04), 0 10px 30px rgba(15, 23, 42, .07);
            overflow: hidden;
        }

        .amount-block {
            text-align: center;
            padding: 20px 20px 16px;
            border-bottom: 1px solid var(--border);
        }
        .amount-label {
            font-size: 12.5px;
            font-weight: 500;
            color: var(--muted);
            margin-bottom: 4px;
        }
        .amount-row {
            display: flex;
            align-items: baseline;
            justify-content: center;
            gap: 6px;
        }
        .amount-value {
            font-size: 36px;
            font-weight: 800;
            color: var(--ink);
            line-height: 1;
            letter-spacing: -.3px;
        }
        .amount-currency {
            font-size: 18px;
            font-weight: 600;
            color: var(--muted);
        }
        .sub-line {
            margin-top: 6px;
            font-size: 12.5px;
            font-weight: 500;
            color: var(--muted);
        }

        .form-wrap { padding: 16px 16px 4px; }

        .secure-note {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 10px 16px;
            border-top: 1px solid var(--border);
            background: #f8fafc;
            font-size: 11.5px;
            font-weight: 500;
            color: var(--muted);
            text-align: center;
        }
        .secure-note svg { width: 13px; height: 13px; flex: none; color: #94a3b8; }

        /* ---------- Moyasar widget theming ----------
           Every selector below targets the exact class names/specificity
           shipped in moyasar.css v1.15.0 (verified against the real
           stylesheet). Only spacing/size/color is touched — no class is
           renamed, removed, or restructured, so Moyasar's JS keeps working
           against the same DOM it expects. */
        .mysr-form-moyasarForm { font-family: 'Cairo', Tahoma, Arial, sans-serif !important; }

        .mysr-form-label { font-size: 12.5px !important; font-weight: 500 !important; }
        .mysr-form-labelGroup { margin-bottom: .35rem !important; }

        input.mysr-form-input {
            border-radius: 10px !important;
            padding-top: 12px !important;
            padding-bottom: 12px !important;
        }
        .mysr-form-inputGroup { margin-bottom: .85rem !important; }

        /* The card-network logos are absolutely positioned over the number
           field (right:0) regardless of the input's own padding, so we
           shrink them AND reserve matching clearance on that one input only
           — every other field (name/expiry/cvc) is left untouched. */
        .mysr-form-ccIcon {
            width: 20px !important;
            height: 14px !important;
            margin-right: 2px !important;
        }
        .mysr-form-ccIconsGroup { padding-right: 6px !important; }
        .mysr-form-ccInputGroup input.mysr-form-input { padding-right: 104px !important; }

        .mysr-form-method { margin-bottom: 0 !important; }
        .mysr-form-divider { margin-top: 10px !important; padding-top: 2px !important; padding-bottom: 10px !important; }
        .mysr-form-submitGroup { margin-top: 1rem !important; }
        .mysr-form-footer { margin-top: .6rem !important; margin-bottom: 0 !important; }

        .mysr-form-button {
            border-radius: 12px !important;
            background: var(--brand) !important;
            font-size: 16px !important;
            font-weight: 700 !important;
            padding: 15px 14px !important;
        }
        .mysr-form-button:hover { background: var(--brand-dark) !important; }
    </style>
</head>
<body>
    <div class="page">
        <header class="topbar">
            <svg class="lock-ic" viewBox="0 0 24 24" fill="none"><path d="M6 10V8a6 6 0 0 1 12 0v2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><rect x="4" y="10" width="16" height="10" rx="3" stroke="currentColor" stroke-width="1.8"/></svg>
            <h1>الدفع</h1>
        </header>

        <div class="sheet">
            <div class="amount-block">
                <div class="amount-label">المبلغ المستحق</div>
                <div class="amount-row">
                    <span class="amount-value">{{ number_format($amount, 2) }}</span>
                    <span class="amount-currency">ريال</span>
                </div>
                <div class="sub-line">اشتراك رقم {{ $subscription->subscription_number }}</div>
            </div>

            <div class="form-wrap">
                <div class="mysr-form"></div>
            </div>

            <div class="secure-note">
                <svg viewBox="0 0 24 24" fill="none"><path d="M6 10V8a6 6 0 0 1 12 0v2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><rect x="4" y="10" width="16" height="10" rx="3" stroke="currentColor" stroke-width="1.8"/></svg>
                بياناتك محمية ومشفّرة بالكامل عبر Moyasar
            </div>
        </div>
    </div>

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
