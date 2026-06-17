@extends('layouts.back-end.app-seller')

@section('title', 'إضافة خدمة داخل عقار')

@push('css_or_js')
    <link rel="stylesheet" href="{{ dynamicAsset(path: 'public/assets/back-end/plugins/intl-tel-input/css/intlTelInput.css') }}">

    <style>
        /* ═══════════════════════════════════════════
           ROOT VARIABLES
        ═══════════════════════════════════════════ */
        :root {
            --navy:       #0b1628;
            --navy-2:     #132035;
            --navy-3:     #1c2f4a;
            --gold:       #c9974a;
            --gold-light: #e8b96a;
            --accent:     #2563eb;
            --accent-2:   #7c3aed;
            --success:    #10b981;
            --danger:     #dc2626;
            --surface:    #ffffff;
            --surface-2:  #f8fafc;
            --border:     #e5eaf2;
            --text:       #0b1628;
            --muted:      #64748b;
            --radius:     22px;
            --radius-sm:  14px;
            --shadow:     0 4px 24px rgba(11,22,40,.07);
            --shadow-lg:  0 12px 40px rgba(11,22,40,.13);
        }

        body { background: #f0f4f9; direction: rtl; text-align: right; }

        /* تعديل المسافة السفلى وإصلاح الاتجاه */
        .create-offer-page {
            padding-bottom: 30px;
            direction: rtl;
            text-align: right;
        }

        /* ─── HERO ─────────────────────────────── */
        .offer-hero {
            background: var(--navy);
            border-radius: 28px;
            padding: 32px 36px;
            margin-bottom: 22px;
            position: relative;
            overflow: hidden;
        }
        .offer-hero::before {
            content: '';
            position: absolute;
            top: -60px; right: -60px;
            width: 220px; height: 220px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(201,151,74,.16) 0%, transparent 70%);
        }
        .offer-hero::after {
            content: '';
            position: absolute;
            bottom: -40px; left: 100px;
            width: 160px; height: 160px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(37,99,235,.12) 0%, transparent 70%);
        }
        .hero-content { position: relative; z-index: 1; }
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(201,151,74,.15);
            border: 1px solid rgba(201,151,74,.3);
            color: var(--gold-light);
            border-radius: 999px;
            padding: 6px 14px;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 14px;
        }
        .offer-hero-title {
            font-size: 28px;
            font-weight: 900;
            color: #fff;
            margin-bottom: 10px;
        }
        .offer-hero-text {
            font-size: 14px;
            color: rgba(255,255,255,.65);
            line-height: 1.8;
            margin-bottom: 0;
            max-width: 560px;
        }
        .hero-chips { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 18px; }
        .offer-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255,255,255,.07);
            border: 1px solid rgba(255,255,255,.12);
            color: rgba(255,255,255,.8);
            border-radius: 999px;
            padding: 7px 14px;
            font-size: 13px;
            font-weight: 600;
        }
        .offer-chip i { font-size: 14px; }

        /* ─── SECTION CARD ─────────────────────── */
        .offer-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            height: auto;
            margin-bottom: 0;
        }
        .offer-card-body { padding: 24px; }

        .offer-section-title {
            font-size: 19px;
            font-weight: 900;
            color: var(--text);
            margin-bottom: 4px;
        }
        .offer-section-subtitle {
            color: var(--muted);
            font-size: 13px;
            margin-bottom: 0;
        }
        .offer-divider {
            height: 1px;
            background: var(--border);
            margin: 18px 0 20px;
        }

        /* ─── FORM CONTROLS ────────────────────── */
        .offer-label {
            font-weight: 800;
            color: var(--text);
            margin-bottom: 8px;
            display: block;
            font-size: 14px;
        }
        .offer-control,
        .select2-container--default .select2-selection--single,
        .select2-container--default .select2-selection--multiple,
        .custom-file-label {
            min-height: 50px !important;
            border-radius: var(--radius-sm) !important;
            border: 1.5px solid var(--border) !important;
            box-shadow: none !important;
            font-size: 14px !important;
            text-align: right;
        }
        .offer-control:focus {
            border-color: rgba(37,99,235,.4) !important;
            box-shadow: 0 0 0 4px rgba(37,99,235,.08) !important;
        }
        .offer-textarea { min-height: 110px !important; padding-top: 14px !important; }

        .mini-note { font-size: 12px; color: var(--muted); margin-top: 8px; }
        .error-message { color: var(--danger); font-size: 12px; margin-top: 6px; display: block; }

        /* ─── OFFER TYPE ───────────────────────── */
        .offer-type-box {
            display: grid;
            grid-template-columns: repeat(2, minmax(0,1fr));
            gap: 12px;
        }
        .offer-type-card {
            border: 2px solid var(--border);
            border-radius: 16px;
            padding: 16px;
            cursor: pointer;
            background: var(--surface);
            transition: all .22s;
            position: relative;
            overflow: hidden;
        }
        .offer-type-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, var(--accent), var(--accent-2));
            opacity: 0;
            transition: opacity .22s;
        }
        .offer-type-card.active {
            border-color: var(--accent);
            box-shadow: 0 8px 24px rgba(37,99,235,.14);
        }
        .offer-type-card.active::before { opacity: .05; }
        .offer-type-icon {
            width: 40px; height: 40px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 10px;
            position: relative; z-index: 1;
        }
        .offer-type-icon.blue  { background: #dbeafe; }
        .offer-type-icon.purple { background: #ede9fe; }
        .offer-type-card h6 {
            font-size: 15px;
            font-weight: 900;
            color: var(--text);
            margin-bottom: 4px;
            position: relative; z-index: 1;
        }
        .offer-type-card p {
            font-size: 12px;
            color: var(--muted);
            margin: 0;
            position: relative; z-index: 1;
        }

        /* ─── IMAGE UPLOAD ─────────────────────── */
        .image-upload-area {
            border: 2px dashed var(--border);
            border-radius: 18px;
            background: var(--surface-2);
            overflow: hidden;
            transition: border-color .2s, background .2s;
            cursor: pointer;
        }
        .image-upload-area:hover {
            border-color: var(--accent);
            background: #f0f7ff;
        }
        .upload-img-view {
            width: 100%;
            height: 240px;
            object-fit: cover;
            display: block;
        }
        .upload-btn-label {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: var(--navy);
            color: #fff;
            border-radius: 12px;
            padding: 10px 18px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: background .2s;
            width: 100%;
            margin-top: 10px;
            border: none;
        }
        .upload-btn-label:hover { background: var(--navy-3); }

        /* ─── PLAN SECTION WRAPPER ─────────────── */
        .selection-section {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 24px;
            box-shadow: var(--shadow);
            margin-top: 20px;
        }

        #subscription-options { margin-top: 20px; }

        .selection-title {
            font-size: 19px;
            font-weight: 900;
            color: var(--text);
            margin-bottom: 4px;
        }
        .selection-subtitle {
            color: var(--muted);
            font-size: 13px;
            margin-bottom: 20px;
        }

        /* ─── PLAN CARDS ───────────────────────── */
        .plan-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
        }
        .modern-plan-card {
            position: relative;
            border: 2px solid var(--border);
            border-radius: 20px;
            background: var(--surface);
            overflow: hidden;
            cursor: pointer;
            transition: all .25s;
        }
        .modern-plan-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
            border-color: rgba(37,99,235,.3);
        }
        .modern-plan-card.active {
            border-color: var(--accent);
            box-shadow: 0 16px 40px rgba(37,99,235,.18);
        }
        .chosen-badge {
            position: absolute;
            top: 12px; right: 12px;
            background: var(--success);
            color: #fff;
            padding: 5px 12px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 800;
            display: none;
            z-index: 2;
        }
        .modern-plan-card.active .chosen-badge { display: inline-block; }

        .modern-plan-head {
            background: var(--navy);
            padding: 22px 16px 26px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .modern-plan-head::after {
            content: '';
            position: absolute;
            bottom: -18px; left: 50%;
            transform: translateX(-50%);
            width: 80%; height: 36px;
            background: var(--surface);
            border-radius: 50%;
        }
        .plan-tier-badge {
            display: inline-block;
            background: rgba(201,151,74,.2);
            border: 1px solid rgba(201,151,74,.35);
            color: var(--gold-light);
            border-radius: 999px;
            padding: 3px 12px;
            font-size: 10px;
            font-weight: 700;
            margin-bottom: 10px;
            letter-spacing: .04em;
        }
        .modern-plan-head h4 {
            font-size: 32px;
            font-weight: 900;
            color: #fff;
            margin: 0 0 2px;
            line-height: 1;
        }
        .modern-plan-head span {
            display: block;
            font-size: 12px;
            color: rgba(255,255,255,.5);
            font-weight: 600;
        }
        .modern-plan-body { padding: 26px 18px 18px; }
        .modern-plan-name {
            font-size: 17px;
            font-weight: 900;
            color: var(--text);
            margin-bottom: 6px;
        }
        .modern-plan-desc {
            color: var(--muted);
            font-size: 13px;
            margin-bottom: 14px;
            min-height: 38px;
            line-height: 1.7;
        }
        .modern-plan-meta { display: grid; gap: 8px; }
        .modern-plan-meta-item {
            background: var(--surface-2);
            border-radius: 12px;
            padding: 9px 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
        }
        .modern-plan-meta-item .meta-label { color: var(--muted); font-weight: 600; }
        .modern-plan-meta-item .meta-val {
            font-weight: 900;
            color: var(--text);
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .modern-plan-meta-item .meta-val svg {
            width: 13px; height: 13px;
            color: var(--accent);
        }

        /* ─── PROPERTY TYPE CARDS ──────────────── */
        .prop-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 10px;
        }
        .prop-card {
            border: 1.5px solid var(--border);
            border-radius: 16px;
            padding: 16px 12px;
            text-align: center;
            cursor: pointer;
            background: var(--surface);
            transition: all .22s;
            position: relative;
        }
        .prop-card:hover {
            border-color: rgba(37,99,235,.3);
            background: #f8fbff;
            transform: translateY(-3px);
        }
        .prop-card.active {
            border-color: var(--accent);
            background: #eff6ff;
            box-shadow: 0 6px 20px rgba(37,99,235,.12);
        }
        .prop-card.active .prop-icon-wrap { background: var(--accent); }
        .prop-card.active .prop-icon-wrap svg { color: #fff; }
        .prop-card.active .prop-check { display: flex; }
        .prop-icon-wrap {
            width: 48px; height: 48px;
            border-radius: 14px;
            background: var(--surface-2);
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 8px;
            transition: background .22s;
        }
        .prop-icon-wrap svg {
            width: 22px; height: 22px;
            color: var(--accent);
            transition: color .22s;
        }
        .prop-name { font-size: 13px; font-weight: 800; color: var(--text); }
        .prop-check {
            position: absolute;
            top: 7px; right: 7px;
            width: 18px; height: 18px;
            background: var(--success);
            border-radius: 50%;
            display: none;
            align-items: center; justify-content: center;
        }
        .prop-check svg { width: 10px; height: 10px; color: #fff; }

        /* ─── ZONE CHIPS ───────────────────────── */
        .zone-grid { display: flex; flex-wrap: wrap; gap: 10px; }
        .zone-chip {
            display: flex;
            align-items: center;
            gap: 7px;
            padding: 9px 16px;
            border: 1.5px solid var(--border);
            border-radius: 999px;
            background: var(--surface);
            cursor: pointer;
            font-size: 13px;
            font-weight: 700;
            color: var(--text);
            transition: all .2s;
            user-select: none;
        }
        .zone-chip:hover {
            border-color: rgba(37,99,235,.3);
            background: #f0f7ff;
        }
        .zone-chip.active {
            background: var(--navy);
            border-color: var(--navy);
            color: #fff;
            box-shadow: 0 6px 18px rgba(11,22,40,.2);
        }
        .zone-chip svg { width: 14px; height: 14px; flex-shrink: 0; }
        .zone-chip.active svg { color: var(--gold-light); }

        /* ─── LIMIT BADGE ──────────────────────── */
        .limit-note {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #fef9ec;
            border: 1px solid #fbbf24;
            color: #92400e;
            border-radius: 999px;
            padding: 5px 14px;
            font-size: 12px;
            font-weight: 700;
            margin-top: 14px;
        }
        .limit-note svg { width: 13px; height: 13px; }

        /* ─── DURATION BUTTONS ─────────────────── */
        .duration-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }
        .dur-btn {
            border: 2px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 14px 8px;
            text-align: center;
            cursor: pointer;
            background: var(--surface);
            transition: all .2s;
        }
        .dur-btn:hover { border-color: rgba(37,99,235,.3); background: #f8fbff; }
        .dur-btn.active {
            border-color: var(--accent);
            background: #eff6ff;
            box-shadow: 0 5px 16px rgba(37,99,235,.12);
        }
        .dur-num {
            display: block;
            font-size: 22px;
            font-weight: 900;
            color: var(--text);
            margin-bottom: 2px;
        }
        .dur-label { font-size: 11px; color: var(--muted); font-weight: 700; }

        /* ─── SELECTION SUMMARY BOX ────────────── */
        .selected-summary-box {
            background: var(--navy);
            border-radius: 18px;
            padding: 18px;
            margin-top: 20px;
        }
        .selected-summary-box h6 {
            font-size: 13px;
            font-weight: 700;
            color: rgba(255,255,255,.45);
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: .05em;
        }
        .selected-tags { display: flex; flex-wrap: wrap; gap: 8px; }
        .selected-tag {
            background: rgba(255,255,255,.1);
            border: 1px solid rgba(255,255,255,.1);
            color: rgba(255,255,255,.85);
            border-radius: 999px;
            padding: 6px 13px;
            font-size: 12px;
            font-weight: 700;
        }
        .selected-tag.plan-tag {
            background: rgba(201,151,74,.18);
            border-color: rgba(201,151,74,.3);
            color: var(--gold-light);
        }

        /* ─── CART SIDEBAR ─────────────────────── */
        .cart-summary {
            background: var(--navy);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            margin-top: 0;
        }
        .cart-gold-line {
            height: 3px;
            background: linear-gradient(90deg, var(--gold), var(--gold-light), var(--gold));
        }
        .cart-summary-head {
            padding: 18px 20px;
            border-bottom: 1px solid rgba(255,255,255,.08);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }
        .cart-summary-head h4 {
            font-size: 18px;
            font-weight: 900;
            color: #fff;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .cart-icon-wrap {
            width: 36px; height: 36px;
            border-radius: 10px;
            background: rgba(255,255,255,.08);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .cart-icon-wrap svg { width: 18px; height: 18px; color: var(--gold-light); }
        .cart-count-badge {
            background: var(--gold);
            color: #fff;
            width: 20px; height: 20px;
            border-radius: 50%;
            font-size: 11px;
            font-weight: 900;
            display: inline-flex;
            align-items: center; justify-content: center;
        }
        .cart-header-badge {
            background: rgba(56,189,248,.14);
            color: #7dd3fc;
            border: 1px solid rgba(56,189,248,.2);
            padding: 5px 12px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 800;
        }

        .cart-summary-body { padding: 18px 20px; }
        .cart-line {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 11px 0;
            border-bottom: 1px solid rgba(255,255,255,.07);
            font-size: 13px;
        }
        .cart-line:last-child { border-bottom: none; }
        .cart-line-label { color: rgba(255,255,255,.55); font-weight: 600; }
        .cart-line-val { color: #fff; font-weight: 900; }

        .cart-total {
            background: rgba(255,255,255,.05);
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 16px;
            padding: 16px;
            margin-top: 14px;
        }
        .cart-total-label {
            font-size: 12px;
            color: rgba(255,255,255,.45);
            font-weight: 700;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: .04em;
        }
        .cart-total-price {
            font-size: 30px;
            font-weight: 900;
            color: #38bdf8;
            margin: 0;
            line-height: 1;
        }
        .cart-total-currency {
            font-size: 14px;
            color: rgba(255,255,255,.45);
            font-weight: 600;
            margin-right: 4px;
        }

        .cart-items-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-top: 14px;
        }
        .cart-pill {
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.08);
            color: rgba(255,255,255,.7);
            border-radius: 999px;
            padding: 4px 10px;
            font-size: 11px;
            font-weight: 700;
        }

        .cart-actions-wrap {
            display: flex;
            gap: 10px;
            margin-top: 16px;
        }
        .btn-cart-reset {
            flex: 1;
            background: rgba(255,255,255,.06);
            border: 1px solid rgba(255,255,255,.1);
            color: rgba(255,255,255,.7);
            border-radius: 14px;
            padding: 12px;
            font-weight: 800;
            font-size: 13px;
            transition: all .2s;
            cursor: pointer;
        }
        .btn-cart-reset:hover {
            background: rgba(239,68,68,.15);
            border-color: rgba(239,68,68,.3);
            color: #fca5a5;
        }
        .btn-cart-submit {
            flex: 2;
            background: linear-gradient(135deg, var(--accent), var(--accent-2));
            border: none;
            color: #fff;
            border-radius: 14px;
            padding: 12px 16px;
            font-weight: 800;
            font-size: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all .2s;
            cursor: pointer;
        }
        .btn-cart-submit:not(:disabled):hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 22px rgba(37,99,235,.3);
            color: #fff;
        }
        .btn-cart-submit:disabled { opacity: .45; cursor: not-allowed; }
        .btn-cart-submit svg { width: 15px; height: 15px; }

        /* ─── RESPONSIVE ───────────────────────── */
        @media (max-width: 1199.98px) {
            .plan-grid { grid-template-columns: 1fr; }
        }
        @media (max-width: 991.98px) {
            .plan-grid { grid-template-columns: repeat(2, 1fr); }
            .duration-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 767.98px) {
            .create-offer-page { padding-bottom: 20px; }
            .offer-hero { border-radius: 20px; padding: 20px; }
            .offer-hero-title { font-size: 22px; }
            .plan-grid { grid-template-columns: 1fr; }
            .duration-grid { grid-template-columns: repeat(4, 1fr); }
            .prop-grid { grid-template-columns: repeat(auto-fill, minmax(100px,1fr)); }
            .offer-type-box { grid-template-columns: 1fr; }
            .cart-actions-wrap { flex-direction: column; }
        }
    </style>
@endpush

@section('content')
<div class="content container-fluid create-offer-page {{ Session::get('direction') }}">

    {{-- ══════════ HERO ══════════ --}}
    <div class="offer-hero">
        <div class="hero-content">
            <div class="hero-badge">
                <i class="tio-home-vs-1-outlined"></i>
                خدمة داخل عقار
            </div>
            <h1 class="offer-hero-title">إضافة خدمة داخل عقار</h1>
            <p class="offer-hero-text">
                أنشئ عرض الخدمة باحترافية — اختر نوع العرض وأضف الصورة والوصف، ثم اربطه بالباقة والمناطق وأنواع العقار المناسبة.
            </p>
            <div class="hero-chips">
                <span class="offer-chip"><i class="tio-home-vs-1-outlined"></i> داخل عقار</span>
                <span class="offer-chip"><i class="tio-location-on"></i> حسب المناطق</span>
                <span class="offer-chip"><i class="tio-layers"></i> حسب نوع العقار</span>
            </div>
        </div>
    </div>

    <form class="user" action="{{ route('service-provider.estaes.store-offer') }}" method="post" enctype="multipart/form-data" id="add-vendor-form">
        @csrf
        <input type="hidden" name="status"              value="approved">
        <input type="hidden" name="service_plan_id"     id="selected-plan-id">
        <input type="hidden" name="number_of_categories" id="number-of-categories">
        <input type="hidden" name="number_of_zone"      id="number-of-zones">
        <input type="hidden" name="number_of_ads"       id="number-of-ads">
        <input type="hidden" name="package_price"       id="total-price">
        <input type="hidden" name="subscription_duration" id="subscription-duration-input" value="1">
        <input type="hidden" name="from_submit"         value="admin">

        <div class="row g-3">

            {{-- ══ LEFT COLUMN ══════════════════════════════════════ --}}
            <div class="col-xl-8">

                {{-- ─── Service Info Card ─── --}}
                <div class="offer-card">
                    <div class="offer-card-body">
                        <h3 class="offer-section-title">معلومات الخدمة</h3>
                        <p class="offer-section-subtitle">أدخل البيانات الأساسية للخدمة التي ستظهر داخل العقار</p>
                        <div class="offer-divider"></div>

                        <div class="row g-3">
                            {{-- Title --}}
                            <div class="col-md-6">
                                <label for="title" class="offer-label">عنوان العرض</label>
                                <input type="text" class="form-control offer-control" id="title" name="title"
                                       value="{{ old('title') }}" placeholder="اكتب عنوان العرض" required>
                            </div>

                            {{-- Service Type --}}
                            <div class="col-md-6">
                                <label for="service_type" class="offer-label">اختر الخدمة</label>
                                <select name="service_type" class="form-control offer-control select-item" id="service_type">
                                    @foreach ($serviceTypes as $serviceType)
                                        <option value="{{ $serviceType->id }}">{{ $serviceType->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Offer Type --}}
                            <div class="col-12">
                                <label class="offer-label">نوع العرض</label>
                                <div class="offer-type-box">
                                    <div class="offer-type-card" data-offer-type="discount" onclick="selectOfferType('discount',this)">
                                        <div class="offer-type-icon blue">
                                            <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#3b82f6" stroke-width="2">
                                                <path d="M7 7h.01M17 17h.01M7 17L17 7"/><circle cx="7" cy="7" r="2.5"/><circle cx="17" cy="17" r="2.5"/>
                                            </svg>
                                        </div>
                                        <h6>خصم %</h6>
                                        <p>يظهر العرض بنسبة خصم على السعر الأصلي</p>
                                    </div>
                                    <div class="offer-type-card" data-offer-type="price" onclick="selectOfferType('price',this)">
                                        <div class="offer-type-icon purple">
                                            <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#7c3aed" stroke-width="2">
                                                <path d="M12 2v20M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/>
                                            </svg>
                                        </div>
                                        <h6>سعر مباشر</h6>
                                        <p>يظهر العرض بسعر ثابت ومحدد بشكل مباشر</p>
                                    </div>
                                </div>
                                <select class="form-control offer-control d-none" name="offer_type" id="offerType" required>
                                    <option value="#">اختر نوع العرض</option>
                                    <option value="discount">خصم</option>
                                    <option value="price">سعر</option>
                                </select>
                            </div>

                            {{-- Price / Discount --}}
                            <div class="col-md-6" id="priceSection" style="display:none;">
                                <label class="offer-label">السعر (ريال)</label>
                                <span class="error-message" id="priceError" style="display:none;"></span>
                                <input type="number" name="service_price" class="form-control offer-control" placeholder="مثال: 250">
                            </div>
                            <div class="col-md-6" id="discountSection" style="display:none;">
                                <label class="offer-label">نسبة الخصم (%)</label>
                                <span class="error-message" id="discountError" style="display:none;"></span>
                                <input type="number" name="discount" class="form-control offer-control" placeholder="مثال: 20">
                            </div>

                            {{-- Description --}}
                            <div class="col-12">
                                <label class="offer-label">وصف الخدمة</label>
                                <textarea class="form-control offer-control offer-textarea" name="description"
                                          placeholder="اكتب وصفًا واضحًا للخدمة...">{{ old('description') }}</textarea>
                                <div class="mini-note">يفضل كتابة وصف مختصر وواضح يساعد العميل على فهم تفاصيل الخدمة بسرعة.</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ─── Plans ─── --}}
                <div class="selection-section">
                    <h3 class="selection-title">اختر الباقة المناسبة</h3>
                    <p class="selection-subtitle">حدد الباقة أولاً لتفعيل خيارات المناطق وأنواع العقار</p>

               <div class="plan-grid">
    @foreach($servicePlans as $plan)
        <div class="modern-plan-card"
             data-plan-id="{{ $plan->id }}"
             data-plan-name="{{ $plan->name }}"
             data-plan-price="{{ $plan->price }}"
             data-categories="{{ $plan->number_of_categories ?? 0 }}"
             data-zones="{{ $plan->number_of_zone ?? 0 }}"
             data-ads="{{ $plan->number_of_ads ?? 0 }}"
             onclick="selectPlanCard(this)">

                <span class="chosen-badge">✓ تم الاختيار</span>

                <div class="modern-plan-head">
                    <div class="plan-tier-badge">باقة</div>
                    <h4>{{ number_format($plan->price, 2) }}</h4>
                    <span>ريال / شهر</span>
                </div>

                <div class="modern-plan-body">
                    <div class="modern-plan-name">{{ $plan->name }}</div>
                    <div class="modern-plan-desc">{{ $plan->description }}</div>

                    <div class="modern-plan-meta">
                        {{-- الميزات الأساسية --}}
                        <div class="modern-plan-meta-item">
                            <span class="meta-label">الإعلانات</span>
                            <span class="meta-val">
                                <svg fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/></svg>
                                {{ $plan->number_of_ads }}
                            </span>
                        </div>
                        <div class="modern-plan-meta-item">
                            <span class="meta-label">أنواع العقار</span>
                            <span class="meta-val">
                                <svg fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/></svg>
                                {{ $plan->number_of_categories }}
                            </span>
                        </div>
                        <div class="modern-plan-meta-item">
                            <span class="meta-label">المناطق</span>
                            <span class="meta-val">
                                <svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                                {{ $plan->number_of_zone }}
                            </span>
                        </div>

                        {{-- الميزات الجديدة (تظهر فقط إذا كانت القيمة 1) --}}

                        @if($plan->distinctive_appearance == 1)
                        <div class="modern-plan-meta-item">
                            <span class="meta-label">ظهور مميز</span>
                            <span class="meta-val" style="color: var(--success);">
                                <svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                متاح
                            </span>
                        </div>
                        @endif

                        @if($plan->interactive_reports == 1)
                        <div class="modern-plan-meta-item">
                            <span class="meta-label">تقارير تفاعلية</span>
                            <span class="meta-val" style="color: var(--success);">
                                <svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                متاح
                            </span>
                        </div>
                        @endif

                        @if($plan->crm == 1)
                        <div class="modern-plan-meta-item">
                            <span class="meta-label">نظام CRM</span>
                            <span class="meta-val" style="color: var(--success);">
                                <svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                متاح
                            </span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
                </div>

                {{-- ─── Zones & Property Types ─── --}}
                <div class="selection-section" id="subscription-options" style="display:none;">
                    <h3 class="selection-title">اختر المناطق وأنواع العقار</h3>
                    <p class="selection-subtitle">بعد اختيار الباقة، اختر العناصر التي تريد أن تظهر فيها خدمتك.</p>

                    <div class="row g-4">
                        {{-- Property Types --}}
                        <div class="col-lg-6">
                            <label class="offer-label">أنواع العقار</label>
                            <div class="prop-grid mt-2" id="property-type-grid">
                                @foreach ($categories as $category)
                                    @php
                                        $icons = [
                                            'شقة'     => '<path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm1 4h12v9a1 1 0 01-1 1H5a1 1 0 01-1-1V8zm3 2v5h6v-5H7z"/>',
                                            'فيلا'    => '<path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>',
                                            'default' => '<path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"/>',
                                        ];
                                        $icon = $icons[$category->name_ar] ?? $icons['default'];
                                    @endphp
                                    <div class="prop-card property-chip"
                                         data-id="{{ $category->id }}"
                                         data-name="{{ $category->name_ar }}"
                                         onclick="togglePropertyType(this)">
                                        <span class="prop-check">
                                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                                <path d="M5 13l4 4L19 7"/>
                                            </svg>
                                        </span>
                                        <div class="prop-icon-wrap">
                                            <svg fill="currentColor" viewBox="0 0 20 20">{!! $icon !!}</svg>
                                        </div>
                                        <div class="prop-name">{{ $category->name_ar }}</div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="limit-note">
                                <svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                                الحد المتاح: <span id="property-limit-view">0</span> أنواع
                            </div>
                            <div id="property-hidden-inputs"></div>
                        </div>

                        {{-- Zones --}}
                        <div class="col-lg-6">
                            <label class="offer-label">المناطق</label>
                            <div class="zone-grid mt-2" id="zone-grid">
                                @foreach ($zones as $zone)
                                    <div class="zone-chip"
                                         data-id="{{ $zone->id }}"
                                         data-name="{{ $zone->name_ar }}"
                                         onclick="toggleZone(this)">
                                        <svg fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $zone->name_ar }}
                                    </div>
                                @endforeach
                            </div>
                            <div class="limit-note">
                                <svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                                الحد المتاح: <span id="zone-limit-view">0</span> (زيادة بـ 50 ريال)
                            </div>
                            <div id="zone-hidden-inputs"></div>
                        </div>

                        {{-- Duration --}}
                        <div class="col-12">
                            <label class="offer-label">مدة الاشتراك</label>
                            <div class="duration-grid mt-2">
                                <div class="dur-btn active" data-months="1" data-label="شهر" onclick="selectDuration(this)">
                                    <span class="dur-num">1</span>
                                    <span class="dur-label">شهر</span>
                                </div>
                                <div class="dur-btn" data-months="3" data-label="3 أشهر" onclick="selectDuration(this)">
                                    <span class="dur-num">3</span>
                                    <span class="dur-label">أشهر</span>
                                </div>
                                <div class="dur-btn" data-months="6" data-label="6 أشهر" onclick="selectDuration(this)">
                                    <span class="dur-num">6</span>
                                    <span class="dur-label">أشهر</span>
                                </div>
                                <div class="dur-btn" data-months="12" data-label="سنة كاملة" onclick="selectDuration(this)">
                                    <span class="dur-num">12</span>
                                    <span class="dur-label">شهر (سنة)</span>
                                </div>
                            </div>
                        </div>

                        {{-- Expiry Date --}}
                        <div class="col-md-6">
                            <label for="expiry-date" class="offer-label">تاريخ الانتهاء</label>
                            <input type="text" id="expiry-date" name="expiry_date" class="form-control offer-control" readonly>
                        </div>

                        {{-- Selection Summary --}}
                        <div class="col-12">
                            <div class="selected-summary-box">
                                <h6>الاختيارات الحالية</h6>
                                <div class="selected-tags" id="selected-summary-tags">
                                    <span class="selected-tag">لم يتم اختيار شيء بعد</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>{{-- end col-xl-8 --}}

            {{-- ══ RIGHT COLUMN ═════════════════════════════════════ --}}
            <div class="col-xl-4">

                {{-- ─── Image Upload ─── --}}
                <div class="offer-card">
                    <div class="offer-card-body">
                        <h3 class="offer-section-title">صورة العرض</h3>
                        <p class="offer-section-subtitle">أضف صورة احترافية تعبّر عن الخدمة</p>
                        <div class="offer-divider"></div>

                        <label for="custom-file-upload" style="cursor:pointer;display:block;">
                            <div class="image-upload-area">
                                <img class="upload-img-view" id="viewer"
                                     src="{{ asset('public/assets/images/default-estate.jpg') }}"
                                     alt="{{ translate('banner_image') }}"/>
                            </div>
                        </label>

                        <div class="custom-file mt-3">
                            <input type="file" name="image" id="custom-file-upload"
                                   class="custom-file-input image-input" data-image-id="viewer"
                                   accept=".jpg,.png,.jpeg,.gif,.bmp,.tif,.tiff|image/*">
                            <label class="upload-btn-label" for="custom-file-upload">
                                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                اختيار صورة العرض
                            </label>
                        </div>
                        <div class="mini-note">يفضل صورة واضحة ومربعة أو قريبة من المربع.</div>
                    </div>
                </div>

                {{-- ─── Cart Summary ─── --}}
                <div class="cart-summary">
                    <div class="cart-gold-line"></div>

                    <div class="cart-summary-head">
                        <h4>
                            <div class="cart-icon-wrap">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            سلة الاشتراك
                            <span class="cart-count-badge" id="cart-count">0</span>
                        </h4>
                        <span class="cart-header-badge">ملخص الطلب</span>
                    </div>

                    <div class="cart-summary-body">
                        <div class="cart-line">
                            <span class="cart-line-label">الباقة المختارة</span>
                            <span class="cart-line-val" id="cart-plan-name">—</span>
                        </div>
                        <div class="cart-line">
                            <span class="cart-line-label">مدة الاشتراك</span>
                            <span class="cart-line-val" id="cart-duration-name">شهر</span>
                        </div>
                        <div class="cart-line">
                            <span class="cart-line-label">أنواع العقار</span>
                            <span class="cart-line-val" id="cart-property-count">0 مختار</span>
                        </div>
                        <div class="cart-line">
                            <span class="cart-line-label">المناطق</span>
                            <span class="cart-line-val" id="cart-zone-count">0 مختار</span>
                        </div>
                        <div class="cart-line" id="extra-zones-line" style="display:none;">
                            <span class="cart-line-label" style="color: #fbbf24;">تكلفة مناطق إضافية</span>
                            <span class="cart-line-val" id="extra-zones-cost" style="color: #fbbf24;">+ 0.00 ريال</span>
                        </div>
                        <div class="cart-line">
                            <span class="cart-line-label">تاريخ الانتهاء</span>
                            <span class="cart-line-val" id="cart-expiry-date">—</span>
                        </div>

                        <div class="cart-total">
                            <div class="cart-total-label">الإجمالي النهائي</div>
                            <h3 class="cart-total-price">
                                <span class="cart-total-currency">ريال</span>
                                <span id="final-price">0.00</span>
                            </h3>
                        </div>

                        {{-- Selections Preview Pills --}}
                        <div class="cart-items-pills" id="cart-items-pills">
                            <span class="cart-pill" style="color:rgba(255,255,255,.3);">اختر باقة للبدء...</span>
                        </div>

                        <div class="cart-actions-wrap">
                            <button type="reset" class="btn-cart-reset" onclick="resetAll()">مسح الكل</button>
                            <button type="submit" id="complete-payment" class="btn-cart-submit" disabled>
                                إكمال والدفع
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

            </div>{{-- end col-xl-4 --}}
        </div>
    </form>
</div>
@endsection

@push('script')
    <script src="{{ dynamicAsset(path: 'public/assets/back-end/plugins/intl-tel-input/js/intlTelInput.js') }}"></script>
    <script src="{{ dynamicAsset(path: 'public/assets/back-end/js/country-picker-init.js') }}"></script>
    <script src="{{ dynamicAsset(path: 'public/assets/back-end/js/admin/user.js') }}"></script>

    <script>
        /* ── Select2 ── */
        $(".select-item").select2({ tags: true, dir: "rtl" });

        /* ══ STATE ══════════════════════════════════════ */
        let selectedPlanId    = null;
        let selectedPlanPrice = 0;
        let selectedPlanName  = '';
        let selectedDuration  = 1;
        let selectedDurationLabel = 'شهر';
        let numberOfCategories = 0;
        let numberOfZones      = 0;
        let numberOfAds        = 0;

        /* ══ OFFER TYPE ═════════════════════════════════ */
        function selectOfferType(type, card) {
            document.getElementById('offerType').value = type;
            document.querySelectorAll('.offer-type-card').forEach(c => c.classList.remove('active'));
            card.classList.add('active');
            document.getElementById('discountSection').style.display = type === 'discount' ? 'block' : 'none';
            document.getElementById('priceSection').style.display    = type === 'price'    ? 'block' : 'none';
        }

        /* ══ PLAN SELECTION ═════════════════════════════ */
        function selectPlanCard(card) {
            document.querySelectorAll('.modern-plan-card').forEach(c => c.classList.remove('active'));
            card.classList.add('active');

            selectedPlanId    = card.dataset.planId;
            selectedPlanPrice = parseFloat(card.dataset.planPrice || 0);
            selectedPlanName  = card.dataset.planName;
            numberOfCategories = parseInt(card.dataset.categories || 0);
            numberOfZones      = parseInt(card.dataset.zones || 0);
            numberOfAds        = parseInt(card.dataset.ads || 0);

            document.getElementById('selected-plan-id').value       = selectedPlanId;
            document.getElementById('number-of-categories').value   = numberOfCategories;
            document.getElementById('number-of-zones').value        = numberOfZones;
            document.getElementById('number-of-ads').value          = numberOfAds;
            document.getElementById('property-limit-view').innerText = numberOfCategories;
            document.getElementById('zone-limit-view').innerText     = numberOfZones;
            document.getElementById('cart-plan-name').innerText      = selectedPlanName;

            document.getElementById('subscription-options').style.display = 'block';
            document.getElementById('complete-payment').disabled = false;

            clearSelections();
            updateExpiryDate(selectedDuration);
            updateTotalPrice();
            updateSelectionSummary();
            updateCartCounts();

            setTimeout(() => {
                document.getElementById('subscription-options').scrollIntoView({ behavior: 'smooth', block: 'center' });
            }, 100);
        }

        /* ══ CLEAR SELECTIONS ═══════════════════════════ */
        function clearSelections() {
            document.querySelectorAll('.property-chip').forEach(c => c.classList.remove('active'));
            document.querySelectorAll('.zone-chip').forEach(c => c.classList.remove('active'));
            document.getElementById('property-hidden-inputs').innerHTML = '';
            document.getElementById('zone-hidden-inputs').innerHTML     = '';
        }

        /* ══ PROPERTY TYPE TOGGLE ═══════════════════════ */
        function togglePropertyType(el) {
            if (!selectedPlanId) { alert('اختر الباقة أولاً'); return; }
            const active   = document.querySelectorAll('.property-chip.active').length;
            const isActive = el.classList.contains('active');
            if (!isActive && active >= numberOfCategories) {
                alert('يمكنك اختيار فقط ' + numberOfCategories + ' نوع عقار حسب الباقة.');
                return;
            }
            el.classList.toggle('active');
            syncHiddenInputs('property-chip', 'property-hidden-inputs', 'categories[]');
            updateSelectionSummary();
            updateCartCounts();
        }

        /* ══ ZONE TOGGLE (Updated Logic) ═════════════════ */
        function toggleZone(el) {
            if (!selectedPlanId) { alert('اختر الباقة أولاً'); return; }

            // تم إزالة شرط المنع للسماح باختيار مناطق إضافية
            el.classList.toggle('active');
            syncHiddenInputs('zone-chip', 'zone-hidden-inputs', 'zones[]');
            updateSelectionSummary();
            updateCartCounts();
            updateTotalPrice(); // تحديث السعر فوراً عند تغيير المناطق
        }

        /* ══ SYNC HIDDEN INPUTS ═════════════════════════ */
        function syncHiddenInputs(chipClass, containerId, inputName) {
            const container = document.getElementById(containerId);
            container.innerHTML = '';
            document.querySelectorAll('.' + chipClass + '.active').forEach(item => {
                const inp = document.createElement('input');
                inp.type  = 'hidden';
                inp.name  = inputName;
                inp.value = item.dataset.id;
                container.appendChild(inp);
            });
        }

        /* ══ DURATION ═══════════════════════════════════ */
        function selectDuration(btn) {
            document.querySelectorAll('.dur-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            selectedDuration      = parseInt(btn.dataset.months);
            selectedDurationLabel = btn.dataset.label;
            document.getElementById('subscription-duration-input').value = selectedDuration;
            document.getElementById('cart-duration-name').innerText = selectedDurationLabel;
            updateExpiryDate(selectedDuration);
            updateTotalPrice();
        }

        /* ══ EXPIRY DATE ════════════════════════════════ */
        function updateExpiryDate(months) {
            const d = new Date();
            d.setMonth(d.getMonth() + months);
            const formatted =
                d.getFullYear() + '-' +
                String(d.getMonth() + 1).padStart(2, '0') + '-' +
                String(d.getDate()).padStart(2, '0');
            document.getElementById('expiry-date').value       = formatted;
            document.getElementById('cart-expiry-date').innerText = formatted;
        }

        /* ══ TOTAL PRICE (Updated Logic) ═════════════════ */
        function updateTotalPrice() {
            const zoneCount = document.querySelectorAll('.zone-chip.active').length;
            const extraZones = Math.max(0, zoneCount - numberOfZones);
            const extraCost = extraZones * 50; // 50 ريال لكل منطقة زيادة

            const basePrice = selectedPlanPrice * selectedDuration;
            const total = basePrice + extraCost;

            document.getElementById('total-price').value = total.toFixed(2);
            document.getElementById('final-price').innerText = total.toFixed(2);

            // عرض أو إخفاء سطر التكلفة الإضافية
            const extraLine = document.getElementById('extra-zones-line');
            if(extraLine) {
                if (extraZones > 0) {
                    extraLine.style.display = 'flex';
                    document.getElementById('extra-zones-cost').innerText = '+ ' + extraCost.toFixed(2) + ' ريال';
                } else {
                    extraLine.style.display = 'none';
                }
            }
        }

        /* ══ CART COUNTS ════════════════════════════════ */
        function updateCartCounts() {
            const propCount = document.querySelectorAll('.property-chip.active').length;
            const zoneCount = document.querySelectorAll('.zone-chip.active').length;
            document.getElementById('cart-property-count').innerText = propCount + ' مختار';
            document.getElementById('cart-zone-count').innerText     = zoneCount + ' مختار';

            /* pill preview */
            const pills   = [];
            const pillsEl = document.getElementById('cart-items-pills');
            if (selectedPlanName) pills.push(selectedPlanName);
            document.querySelectorAll('.property-chip.active').forEach(c => pills.push(c.dataset.name));
            document.querySelectorAll('.zone-chip.active').forEach(c => pills.push(c.dataset.name));

            document.getElementById('cart-count').innerText = selectedPlanId ? (1 + propCount + zoneCount) : 0;

            if (pills.length === 0) {
                pillsEl.innerHTML = '<span class="cart-pill" style="color:rgba(255,255,255,.3);">اختر باقة للبدء...</span>';
            } else {
                pillsEl.innerHTML = pills.map(p => `<span class="cart-pill">${p}</span>`).join('');
            }
        }

        /* ══ SELECTION SUMMARY TAGS ═════════════════════ */
        function updateSelectionSummary() {
            const summary = document.getElementById('selected-summary-tags');
            summary.innerHTML = '';
            const tags = [];

            if (selectedPlanName) tags.push({ text: 'الباقة: ' + selectedPlanName, cls: 'plan-tag' });
            document.querySelectorAll('.property-chip.active').forEach(c => tags.push({ text: 'عقار: ' + c.dataset.name, cls: '' }));
            document.querySelectorAll('.zone-chip.active').forEach(c => tags.push({ text: 'منطقة: ' + c.dataset.name, cls: '' }));

            if (tags.length === 0) {
                summary.innerHTML = '<span class="selected-tag">لم يتم اختيار شيء بعد</span>';
                return;
            }
            tags.forEach(t => {
                const span = document.createElement('span');
                span.className = 'selected-tag ' + t.cls;
                span.innerText = t.text;
                summary.appendChild(span);
            });
        }

        /* ══ RESET ══════════════════════════════════════ */
        function resetAll() {
            selectedPlanId    = null;
            selectedPlanPrice = 0;
            selectedPlanName  = '';
            selectedDuration  = 1;
            selectedDurationLabel = 'شهر';
            numberOfCategories = numberOfZones = numberOfAds = 0;

            document.querySelectorAll('.modern-plan-card').forEach(c => c.classList.remove('active'));
            document.querySelectorAll('.dur-btn').forEach(b => b.classList.remove('active'));
            document.querySelector('[data-months="1"]').classList.add('active');

            clearSelections();
            document.getElementById('subscription-options').style.display = 'none';
            document.getElementById('complete-payment').disabled = true;
            document.getElementById('expiry-date').value = '';
            document.getElementById('cart-expiry-date').innerText   = '—';
            document.getElementById('cart-plan-name').innerText     = '—';
            document.getElementById('cart-duration-name').innerText = 'شهر';

            // Reset Extra Line
            const extraLine = document.getElementById('extra-zones-line');
            if(extraLine) extraLine.style.display = 'none';

            document.getElementById('final-price').innerText = '0.00';
            document.getElementById('cart-count').innerText  = '0';
            document.getElementById('cart-property-count').innerText = '0 مختار';
            document.getElementById('cart-zone-count').innerText     = '0 مختار';
            document.getElementById('cart-items-pills').innerHTML =
                '<span class="cart-pill" style="color:rgba(255,255,255,.3);">اختر باقة للبدء...</span>';
            updateSelectionSummary();
        }

        /* ══ ON LOAD ════════════════════════════════════ */
        window.addEventListener('load', function () {
            updateExpiryDate(1);
        });
    </script>
@endpush
