@extends('layouts.front-end.app')

@section('title', (request('filter') && request('filter') == 'top-vendors' ? translate('top_Stores') : "كل العقارات"))


@push('css_or_js')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&display=swap');

    :root{
        --primary:#114b89;
        --primary-dark:#0c3c6d;
        --secondary:#0f5bd7;
        --accent:#ffd166;
        --bg:#f0f4fa;
        --card:#ffffff;
        --text:#0f172a;
        --muted:#64748b;
        --line:#e5e7eb;
        --overlay:rgba(9,20,38,.45);
        --shadow-lg:0 24px 60px rgba(15,23,42,.14);
        --shadow-md:0 12px 30px rgba(15,23,42,.10);
        --shadow-sm:0 8px 18px rgba(15,23,42,.08);
        --radius-xl:28px;
        --radius-lg:22px;
        --radius-md:16px;
        --radius-sm:12px;
    }

    *{ box-sizing:border-box; }

    body{
        background:
            radial-gradient(circle at top right, rgba(17,75,137,.08), transparent 22%),
            radial-gradient(circle at top left, rgba(15,91,215,.06), transparent 20%),
            var(--bg);
        color:var(--text);
        font-family:'Cairo','Segoe UI',Tahoma,Geneva,Verdana,sans-serif;
        -webkit-font-smoothing:antialiased;
    }

    /* ── Hero Banner ── */
    .hero-banner{
        background:linear-gradient(135deg, rgba(6,15,30,.97), rgba(17,75,137,.95));
        border-radius:28px;
        box-shadow:var(--shadow-lg);
        padding:26px 28px;
        margin:20px 0;
        position:relative;
        overflow:hidden;
    }
    .hero-banner::before{
        content:"";
        position:absolute;inset:0;
        background:
            radial-gradient(circle at 88% 14%, rgba(255,255,255,.13), transparent 18%),
            radial-gradient(circle at 10% 88%, rgba(255,255,255,.07), transparent 20%),
            radial-gradient(circle at 50% 50%, rgba(15,91,215,.12), transparent 60%);
        pointer-events:none;
    }
    .hero-dots{
        position:absolute;right:-30px;top:-30px;
        width:200px;height:200px;opacity:.06;
        background-image:radial-gradient(circle, #fff 1.5px, transparent 1.5px);
        background-size:18px 18px;
    }
    .hero-content{ position:relative;z-index:1; }
    .hero-map-btn{
        display:inline-flex;align-items:center;gap:8px;
        background:linear-gradient(135deg,#ffffff,#f0f6ff);
        color:var(--primary);
        border:none;border-radius:14px;
        padding:11px 18px;
        font-weight:900;font-size:14px;
        font-family:'Cairo',sans-serif;
        box-shadow:0 10px 28px rgba(0,0,0,.12);
        cursor:pointer;
        transition:transform .2s,box-shadow .2s;
        text-decoration:none;
    }
    .hero-map-btn:hover{
        transform:translateY(-2px);
        box-shadow:0 16px 36px rgba(0,0,0,.16);
        color:var(--primary);text-decoration:none;
    }
    .hero-map-btn i{ font-size:16px;color:var(--secondary); }

    /* ── Carousel ── */
    .carousel-wrap{
        border-radius:26px;overflow:hidden;
        box-shadow:var(--shadow-lg);background:#dbe4f0;
        position:relative;margin-bottom:28px;
    }
    .carousel-wrap .carousel-inner{ height:380px; }
    .carousel-wrap .carousel-item{ height:380px;position:relative; }
    .carousel-wrap .carousel-item::after{
        content:"";position:absolute;inset:0;
        background:linear-gradient(to top,rgba(9,20,38,.56),rgba(9,20,38,.10));
        pointer-events:none;
    }
    .carousel-wrap .carousel-item img{
        width:100%;height:100%;object-fit:cover;display:block;
    }
    .carousel-wrap .carousel-caption{
        right:22px !important;left:22px !important;bottom:22px !important;
        padding:16px 20px !important;
        background:rgba(255,255,255,.11) !important;
        backdrop-filter:blur(14px);-webkit-backdrop-filter:blur(14px);
        border:1px solid rgba(255,255,255,.13);
        border-radius:18px;
        text-align:right;max-width:580px;
    }
    .carousel-wrap .carousel-caption h5{
        color:#fff !important;font-size:1.3rem;font-weight:900;
        margin-bottom:6px;line-height:1.4;
    }
    .carousel-wrap .carousel-caption p{
        color:rgba(255,255,255,.88) !important;
        font-size:.92rem;line-height:1.8;margin-bottom:0;font-weight:500;
    }
    .carousel-ctrl{
        width:52px;height:52px;top:50%;
        transform:translateY(-50%);
        background:rgba(255,255,255,.16);
        backdrop-filter:blur(12px);-webkit-backdrop-filter:blur(12px);
        border-radius:50%;opacity:1;
        box-shadow:0 8px 22px rgba(0,0,0,.12);
        transition:.2s ease;
        display:flex;align-items:center;justify-content:center;
        margin:0 14px;
    }
    .carousel-ctrl:hover{ background:rgba(255,255,255,.26); }
    .carousel-ctrl i{ font-size:18px !important;color:#fff !important; }

    /* ── Zones Section ── */
    .zones-section{ padding:0 0 36px; }

    .zones-header{
        display:flex;align-items:center;
        justify-content:space-between;
        margin-bottom:20px;padding:0 2px;
    }
    .zones-title{
        font-size:20px;font-weight:900;color:var(--text);
        display:flex;align-items:center;gap:10px;
    }
    .zones-title::before{
        content:'';display:block;
        width:4px;height:26px;
        background:linear-gradient(to bottom,var(--secondary),var(--primary));
        border-radius:4px;
    }
    .zones-view-all{
        font-size:13px;font-weight:700;color:var(--secondary);
        text-decoration:none;
        display:flex;align-items:center;gap:5px;
        transition:gap .2s;
    }
    .zones-view-all:hover{ gap:9px;color:var(--secondary);text-decoration:none; }

    /* ── Grid ── */
    .zones-grid{
        display:grid;
        grid-template-columns:repeat(2, 1fr);
        gap:12px;
    }
    @media (min-width:768px){
        .zones-grid{ grid-template-columns:repeat(3, 1fr); gap:16px; }
    }
    @media (min-width:1200px){
        .zones-grid{ gap:20px; }
    }

    /* ── Zone Card ── */
    .zone-card{
        position:relative;
        border-radius:22px;
        overflow:hidden;
        aspect-ratio:3/4;
        cursor:pointer;
        box-shadow:0 8px 28px rgba(17,75,137,.14);
        transition:transform .34s cubic-bezier(.22,.68,0,1.2),
                   box-shadow .34s ease;
        text-decoration:none !important;
        display:block;
        background:#c8d8ef;
        will-change:transform;
    }
    .zone-card:hover{
        transform:translateY(-8px) scale(1.03);
        box-shadow:0 22px 52px rgba(17,75,137,.24);
    }

    /* البطاقة المميزة – أول بطاقة */
    .zone-card.zone-featured{
        grid-column:span 2;
        aspect-ratio:16/9;
    }
    @media (min-width:768px){
        .zone-card.zone-featured{
            grid-column:span 1;
            aspect-ratio:3/4;
        }
    }

    .zone-card img{
        width:100%;height:100%;
        object-fit:cover;display:block;
        transition:transform .6s cubic-bezier(.22,.68,0,1.2);
    }
    .zone-card:hover img{ transform:scale(1.10); }

    /* الطبقة الشفافة */
    .zone-overlay{
        position:absolute;inset:0;
        background:linear-gradient(
            to top,
            rgba(9,20,38,.92)  0%,
            rgba(9,20,38,.40)  45%,
            rgba(9,20,38,.06)  100%
        );
        transition:opacity .3s;
    }
    .zone-card:hover .zone-overlay{ opacity:.96; }

    /* شارة مميز - أعلى يسار */
    .zone-featured-badge{
        position:absolute;top:13px;left:13px;
        background:linear-gradient(135deg,var(--accent),#f59e0b);
        color:#1a0e00;
        font-size:10px;font-weight:900;
        padding:5px 11px;border-radius:999px;
        font-family:'Cairo',sans-serif;
        display:flex;align-items:center;gap:3px;
        box-shadow:0 4px 14px rgba(245,158,11,.35);
        letter-spacing:.01em;
    }

    /* ── معلومات الزون في الأسفل ── */
    .zone-info{
        position:absolute;bottom:0;left:0;right:0;
        padding:16px;
        display:flex;
        flex-direction:column;
        gap:10px;
    }

    /* اسم المنطقة */
    .zone-name{
        font-size:17px;font-weight:900;
        color:#fff;line-height:1.3;
        font-family:'Cairo',sans-serif;
        text-shadow:0 2px 12px rgba(0,0,0,.4);
    }
    .zone-card.zone-featured .zone-name{ font-size:21px; }

    /* الصف السفلي: عدد العروض + السهم */
    .zone-footer{
        display:flex;align-items:center;
        justify-content:space-between;gap:8px;
    }

    /* pill عدد العروض */
    .zone-count-pill{
        display:flex;align-items:center;gap:6px;
        background:rgba(255,255,255,.15);
        backdrop-filter:blur(12px);-webkit-backdrop-filter:blur(12px);
        border:1px solid rgba(255,255,255,.20);
        border-radius:999px;
        padding:5px 12px 5px 10px;
        font-family:'Cairo',sans-serif;
        line-height:1;
    }
    .zone-count-icon{
        width:18px;height:18px;border-radius:50%;flex-shrink:0;
        background:linear-gradient(135deg,#4ade80,#22c55e);
        display:flex;align-items:center;justify-content:center;
        box-shadow:0 0 8px rgba(74,222,128,.45);
    }
    .zone-count-icon i{ font-size:9px;color:#fff; }
    .zone-count-text{
        font-size:12px;font-weight:800;color:#fff;
        white-space:nowrap;
    }
    .zone-count-num{
        font-size:15px;font-weight:900;color:#fff;
        font-variant-numeric:tabular-nums;
    }
    .zone-count-label{
        font-size:10px;font-weight:600;
        color:rgba(255,255,255,.78);margin-right:1px;
    }

    /* السهم */
    .zone-arrow{
        width:34px;height:34px;border-radius:50%;flex-shrink:0;
        background:rgba(255,255,255,.16);
        backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px);
        border:1px solid rgba(255,255,255,.22);
        display:flex;align-items:center;justify-content:center;
        color:#fff;font-size:13px;
        transition:background .25s,transform .25s;
    }
    .zone-card:hover .zone-arrow{
        background:var(--secondary);
        transform:translateX(-4px);
        box-shadow:0 6px 18px rgba(15,91,215,.40);
    }

    /* ── Popup Modal ── */
    .modal-content{
        border:none;border-radius:24px;
        overflow:hidden;box-shadow:var(--shadow-lg);
    }
    .modal-header{ border-bottom:none; }
    .modal-body{ padding:24px; }
    .close{
        border:none;background:none;
        font-size:30px;line-height:1;
        padding:10px 16px !important;
    }

    /* ── Responsive ── */
    @media (max-width:768px){
        .hero-banner{ padding:18px 16px;border-radius:22px;margin:14px 0; }
        .carousel-wrap .carousel-inner,
        .carousel-wrap .carousel-item{ height:230px; }
        .carousel-wrap .carousel-caption{
            display:block !important;
            right:12px !important;left:12px !important;bottom:12px !important;
            padding:12px 14px !important;border-radius:14px;
        }
        .carousel-wrap .carousel-caption h5{ font-size:1rem;margin-bottom:4px; }
        .carousel-wrap .carousel-caption p{ font-size:.78rem;line-height:1.6; }
        .carousel-ctrl{ width:42px;height:42px;margin:0 10px; }
        .carousel-ctrl i{ font-size:15px !important; }
        .zones-title{ font-size:17px; }
        .zone-name{ font-size:14px; }
        .zone-card.zone-featured .zone-name{ font-size:17px; }
        .zone-count-num{ font-size:13px; }
        .zone-count-label{ font-size:9px; }
        .zone-count-pill{ padding:4px 10px 4px 8px; }
        .zone-info{ padding:12px; gap:8px; }
        .zone-arrow{ width:30px;height:30px; }
    }
    @media (max-width:576px){
        .carousel-wrap .carousel-inner,
        .carousel-wrap .carousel-item{ height:200px; }
        .zones-grid{ gap:10px; }
    }
</style>
@endpush


@section('content')

{{-- ═══════════════════════════ Hero ═══════════════════════════ --}}
<div class="container mb-md-4 {{ Session::get('direction') === 'rtl' ? 'rtl' : '' }} __inline-65">
    <div class="hero-banner">
        <div class="hero-dots"></div>
        <div class="hero-content d-flex flex-column gap-2">
            <a href="{{ route('map') }}" class="hero-map-btn" style="width:fit-content;">
                <i class="fas fa-map-marker-alt"></i>
                {{ translate("search in map") }}
            </a>
        </div>
    </div>
</div>


{{-- ═══════════════════════ Main Content ═══════════════════════ --}}
<div class="container mb-md-4 {{ Session::get('direction') === 'rtl' ? 'rtl' : '' }} __inline-65">

    {{-- ── Carousel ── --}}
    <div class="carousel-wrap">
        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">

                @foreach($banners as $index => $banner)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <img
                            src="{{ asset('storage/app/public/banner/'.$banner->image) }}"
                            class="d-block w-100"
                            alt="{{ $banner->title }}"
                            loading="{{ $index == 0 ? 'eager' : 'lazy' }}"
                            onerror="this.src='{{ asset('storage/app/public/banner/default-banner1.jpg') }}'">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>{{ $banner->title }}</h5>
                            <p>{{ $banner->description }}</p>
                        </div>
                    </div>
                @endforeach

                @if($banners->isEmpty())
                    <div class="carousel-item active">
                        <img src="{{ asset('storage/app/public/banner/default-banner1.jpg') }}"
                             class="d-block w-100" alt="Banner 1">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('storage/app/public/banner/default-banner2.jpg') }}"
                             class="d-block w-100" alt="Banner 2">
                    </div>
                @endif

            </div>

            <div class="carousel-control-prev carousel-ctrl"
                 type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <i class="fas fa-chevron-right"></i>
            </div>
            <div class="carousel-control-next carousel-ctrl"
                 type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <i class="fas fa-chevron-left"></i>
            </div>
        </div>
    </div>


    {{-- ── Zones Grid ── --}}
    <div class="zones-section">

        <div class="zones-header">
            <div class="zones-title">استكشف المناطق</div>
            {{-- يمكنك تغيير الرابط حسب المسار الصحيح لديك --}}
            <a href="#" class="zones-view-all">
                عرض الكل <i class="fas fa-arrow-left fa-xs"></i>
            </a>
        </div>

        <div class="zones-grid">
            @foreach($zones as $index => $zone)

                <a href="{{ route('byZone', ['zone_id' => $zone->id]) }}"
                   class="zone-card {{ $index === 0 ? 'zone-featured' : '' }}">

                    {{-- الصورة --}}
             <img
src="{{ $zone->image ? $r2Base.'/zone/'.$zone->image : asset('storage/app/public/zone/default-zone.jpg') }}"
alt="{{ $zone->name_ar }}"
loading="{{ $index < 3 ? 'eager' : 'lazy' }}"
onerror="this.src='{{ asset('storage/app/public/zone/default-zone.jpg') }}'">
                    {{-- الطبقة الشفافة --}}
                    <div class="zone-overlay"></div>

                    {{-- شارة "الأكثر طلباً" للبطاقة الأولى --}}
                    @if($index === 0)
                        <div class="zone-featured-badge">
                            ⭐ الأكثر طلباً
                        </div>
                    @endif

                    {{-- معلومات الزون --}}
                    <div class="zone-info">

                        {{-- اسم المنطقة --}}
                        <div class="zone-name">{{ $zone->name_ar }}</div>

                        {{-- الصف السفلي: عدد العروض + السهم --}}
                        <div class="zone-footer">

                            {{-- pill عدد العروض --}}
                            <div class="zone-count-pill">
                                <div class="zone-count-icon">
                                    <i class="fas fa-home"></i>
                                </div>
                                <span class="zone-count-num">{{ $zone->estate_count ?? 0 }}</span>
                                <span class="zone-count-label">عرض</span>
                            </div>

                            {{-- السهم --}}
                            <div class="zone-arrow">
                                <i class="fas fa-arrow-left fa-xs"></i>
                            </div>

                        </div>
                    </div>

                </a>

            @endforeach
        </div>

    </div>

</div>





@if($web_config['popup_banner'])
<style>
.popup-modal-content {
    border: none !important;
    border-radius: 28px !important;
    overflow: hidden;
    box-shadow: 0 32px 80px rgba(15,23,42,.22) !important;
}

/* الشريط العلوي الملوّن */
.popup-top-bar {
    background: linear-gradient(135deg, #114b89, #0f5bd7);
    padding: 28px 24px 36px;
    position: relative;
    overflow: hidden;
    text-align: center;
}
.popup-top-bar::before {
    content: '';
    position: absolute; inset: 0;
    background:
        radial-gradient(circle at 90% 10%, rgba(255,255,255,.14), transparent 22%),
        radial-gradient(circle at 8% 90%, rgba(255,255,255,.08), transparent 22%);
    pointer-events: none;
}
.popup-top-dots {
    position: absolute; left: -20px; bottom: -20px;
    width: 140px; height: 140px; opacity: .08;
    background-image: radial-gradient(circle, #fff 1.5px, transparent 1.5px);
    background-size: 16px 16px;
}

/* زر الإغلاق */
.popup-close-btn {
    position: absolute; top: 14px; left: 14px;
    width: 38px; height: 38px; border-radius: 50%;
    background: rgba(255,255,255,.20);
    border: 1.5px solid rgba(255,255,255,.32) !important;
    color: #fff !important;
    font-size: 16px; line-height: 1;
    display: flex !important;
    align-items: center; justify-content: center;
    cursor: pointer;
    transition: background .2s, transform .2s;
    z-index: 10;
    opacity: 1 !important;
}
.popup-close-btn:hover {
    background: rgba(255,255,255,.36);
    transform: scale(1.1);
}

/* أيقونة التطبيق */
.popup-app-icon {
    position: relative; z-index: 1;
    width: 76px; height: 76px; border-radius: 22px;
    background: linear-gradient(135deg, #fff, #e8f0fe);
    margin: 0 auto 14px;
    display: flex; align-items: center; justify-content: center;
    box-shadow: 0 12px 32px rgba(0,0,0,.20);
}
.popup-app-icon i { font-size: 34px; color: #114b89; }

.popup-top-title {
    position: relative; z-index: 1;
    font-size: 18px; font-weight: 900; color: #fff;
    margin-bottom: 4px;
    font-family: 'Cairo', sans-serif;
}
.popup-top-sub {
    position: relative; z-index: 1;
    font-size: 12px; font-weight: 600;
    color: rgba(255,255,255,.75);
    font-family: 'Cairo', sans-serif;
}

/* منطقة الأزرار */
.popup-body-area {
    padding: 18px 20px 24px;
    background: #fff;
}

/* التقييم */
.popup-rating {
    display: flex; align-items: center; justify-content: center;
    gap: 6px; margin-bottom: 16px;
}
.popup-stars { color: #fbbf24; font-size: 13px; letter-spacing: 1px; }
.popup-rating-text { font-size: 11px; font-weight: 700; color: #64748b; font-family: 'Cairo', sans-serif; }

/* أزرار المتاجر */
.popup-store-btn {
    display: flex !important;
    align-items: center;
    gap: 14px;
    width: 100%;
    padding: 13px 16px;
    border-radius: 16px !important;
    border: none !important;
    cursor: pointer;
    text-decoration: none !important;
    transition: transform .22s, box-shadow .22s;
    margin-bottom: 10px;
}
.popup-store-btn:last-child { margin-bottom: 0; }
.popup-store-btn:hover { transform: translateY(-3px); }

.popup-btn-google {
    background: linear-gradient(135deg, #1a1a2e, #16213e) !important;
    box-shadow: 0 10px 28px rgba(26,26,46,.28);
}
.popup-btn-google:hover { box-shadow: 0 16px 36px rgba(26,26,46,.38); }

.popup-btn-apple {
    background: linear-gradient(135deg, #1c1c1e, #2c2c2e) !important;
    box-shadow: 0 10px 28px rgba(0,0,0,.22);
}
.popup-btn-apple:hover { box-shadow: 0 16px 36px rgba(0,0,0,.32); }

.popup-store-icon {
    width: 42px; height: 42px; border-radius: 12px; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
}
.popup-btn-google .popup-store-icon { background: linear-gradient(135deg, #34a853, #1a8a3a); }
.popup-btn-apple  .popup-store-icon { background: linear-gradient(135deg, #aaaaaa, #888888); }
.popup-store-icon i { font-size: 20px; color: #fff !important; }

.popup-store-text { flex: 1; text-align: right; }
.popup-store-sub  { font-size: 10px; font-weight: 600; color: rgba(255,255,255,.58); display: block; margin-bottom: 1px; font-family: 'Cairo', sans-serif; }
.popup-store-main { font-size: 14px; font-weight: 900; color: #fff !important; display: block; font-family: 'Cairo', sans-serif; }

.popup-store-arrow {
    width: 28px; height: 28px; border-radius: 50%; flex-shrink: 0;
    background: rgba(255,255,255,.10);
    border: 1px solid rgba(255,255,255,.15);
    display: flex; align-items: center; justify-content: center;
    font-size: 11px; color: rgba(255,255,255,.6);
}
</style>

<div class="modal fade" id="popup-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:400px;">
        <div class="modal-content popup-modal-content">

            {{-- الشريط العلوي --}}
            <div class="popup-top-bar">
                <div class="popup-top-dots"></div>

                {{-- زر الإغلاق واضح --}}
                <button type="button"
                        class="popup-close-btn"
                        onclick="closeModal()"
                        aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>

                {{-- أيقونة التطبيق --}}
                <div class="popup-app-icon">
                    <i class="fas fa-building"></i>
                </div>

                <div class="popup-top-title">{{ translate('download our app now') }}</div>
                <div class="popup-top-sub">تصفّح آلاف العقارات من هاتفك</div>
            </div>

            {{-- محتوى الأزرار --}}
            <div class="popup-body-area">

                {{-- تقييم --}}
                <div class="popup-rating">
                    <span class="popup-stars">★★★★★</span>
                    <span class="popup-rating-text">تطبيق مجاني 100%</span>
                </div>

                {{-- زر جوجل بلاي --}}
                <a href="{{ $web_config['android']['link'] }}"
                   class="popup-store-btn popup-btn-google">
                    <div class="popup-store-icon">
                        <i class="fab fa-google-play"></i>
                    </div>
                    <div class="popup-store-text">
                        <span class="popup-store-sub">{{ translate('download from') }}</span>
                        <span class="popup-store-main">Google Play</span>
                    </div>
                    <div class="popup-store-arrow">
                        <i class="fas fa-arrow-left fa-xs"></i>
                    </div>
                </a>

                {{-- زر آب ستور --}}
                <a href="{{ $web_config['ios']['link'] }}"
                   class="popup-store-btn popup-btn-apple">
                    <div class="popup-store-icon">
                        <i class="fab fa-apple"></i>
                    </div>
                    <div class="popup-store-text">
                        <span class="popup-store-sub">{{ translate('download from') }}</span>
                        <span class="popup-store-main">App Store</span>
                    </div>
                    <div class="popup-store-arrow">
                        <i class="fas fa-arrow-left fa-xs"></i>
                    </div>
                </a>

            </div>
        </div>
    </div>
</div>
@endif

@endsection


@push('script')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAFuZIjGVfo57sJk3EmCSV0SpP7qVgg7n4&language=ar"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function closeModal() {
        $('#popup-modal').modal('hide');
    }

    $(document).ready(function () {
        @if($web_config['popup_banner'])
            $('#popup-modal').modal('show');
        @endif
    });
</script>
@endpush