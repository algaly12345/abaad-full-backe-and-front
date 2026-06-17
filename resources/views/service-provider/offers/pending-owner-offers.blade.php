@extends('layouts.back-end.app-seller')

@section('title', 'خدماتي المُسنَدة للعقارات')

@push('css_or_js')
<style>
:root {
    --navy: #0b1628;
    --navy-2: #132035;
    --navy-3: #1c2f4a;
    --gold: #c9974a;
    --gold-light: #e8b96a;
    --accent: #2563eb;
    --success: #10b981;
    --warning: #f59e0b;
    --danger: #ef4444;
    --purple: #7c3aed;
    --surface: #ffffff;
    --surface-2: #f8fafc;
    --border: #e5eaf2;
    --text: #0b1628;
    --muted: #64748b;
    --radius: 20px;
    --shadow: 0 4px 20px rgba(11,22,40,.07);
    --shadow-lg: 0 16px 48px rgba(11,22,40,.14);
}

body {
    background: #f0f4f9 !important;
}

.offers-page {
    padding-bottom: 40px;
}

.page-hero {
    background: var(--navy);
    border-radius: 26px;
    padding: 28px 32px;
    margin-bottom: 24px;
    position: relative;
    overflow: hidden;
}

.hero-title {
    font-size: 26px;
    font-weight: 900;
    color: #fff;
    margin-bottom: 6px;
}

.hero-subtitle {
    font-size: 14px;
    color: rgba(255,255,255,.6);
    margin-bottom: 0;
}

.hero-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(201,151,74,.15);
    border: 1px solid rgba(201,151,74,.3);
    color: var(--gold-light);
    border-radius: 999px;
    padding: 5px 14px;
    font-size: 12px;
    font-weight: 700;
    margin-bottom: 12px;
}

.hero-stats {
    display: flex;
    gap: 14px;
    flex-wrap: wrap;
    margin-top: 20px;
}

.hero-stat {
    background: rgba(255,255,255,.06);
    border: 1px solid rgba(255,255,255,.1);
    border-radius: 14px;
    padding: 12px 18px;
    text-align: center;
    min-width: 90px;
}

.hero-stat-num {
    font-size: 22px;
    font-weight: 900;
    color: #fff;
    display: block;
}

.hero-stat-label {
    font-size: 11px;
    color: rgba(255,255,255,.5);
    font-weight: 600;
    margin-top: 4px;
    display: block;
}

.hero-action {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, var(--accent), var(--purple));
    color: #fff;
    border: none;
    border-radius: 14px;
    padding: 11px 22px;
    font-size: 13px;
    font-weight: 800;
    text-decoration: none;
    box-shadow: 0 8px 20px rgba(37,99,235,.3);
}

.hero-action:hover {
    color: #fff;
    text-decoration: none;
}

.filter-bar {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 18px;
    padding: 14px 18px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
    box-shadow: var(--shadow);
}

.filter-search {
    flex: 1;
    min-width: 200px;
    display: flex;
    align-items: center;
    gap: 10px;
    background: var(--surface-2);
    border: 1.5px solid var(--border);
    border-radius: 12px;
    padding: 9px 14px;
}

.filter-search input {
    border: none;
    background: none;
    outline: none;
    font-size: 13px;
    font-weight: 600;
    color: var(--text);
    width: 100%;
}

.filter-chip {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    border-radius: 10px;
    border: 1.5px solid var(--border);
    background: var(--surface);
    font-size: 12px;
    font-weight: 700;
    color: var(--muted);
    cursor: pointer;
    transition: all .18s;
}

.filter-chip.active {
    background: var(--navy);
    border-color: var(--navy);
    color: #fff;
}

.offers-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
    gap: 18px;
}

.offer-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    overflow: hidden;
    transition: all .25s;
    position: relative;
}

.offer-card:hover {
    transform: translateY(-6px);
    box-shadow: var(--shadow-lg);
}

.card-img-wrap {
    position: relative;
    height: 180px;
    overflow: hidden;
    background: var(--surface-2);
}

.card-img-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.card-img-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(11,22,40,.7), transparent 60%);
}

.card-badges {
    position: absolute;
    top: 12px;
    left: 12px;
    display: flex;
    gap: 6px;
    flex-wrap: wrap;
}

.card-badge {
    padding: 4px 10px;
    border-radius: 999px;
    font-size: 11px;
    font-weight: 800;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

.status-active { background: rgba(16,185,129,.9); color: #fff; }
.status-expired { background: rgba(239,68,68,.9); color: #fff; }
.status-pending { background: rgba(245,158,11,.9); color: #fff; }
.status-cancelled { background: rgba(100,116,139,.9); color: #fff; }
.pay-paid { background: rgba(16,185,129,.9); color: #fff; }
.pay-unpaid { background: rgba(239,68,68,.9); color: #fff; }

.card-offer-type {
    position: absolute;
    bottom: 12px;
    right: 12px;
    background: var(--navy);
    color: var(--gold-light);
    border-radius: 10px;
    padding: 5px 12px;
    font-size: 12px;
    font-weight: 800;
}

.card-body-inner {
    padding: 18px;
}

.card-offer-title {
    font-size: 17px;
    font-weight: 900;
    color: var(--text);
    margin-bottom: 8px;
}

.card-service-name {
    font-size: 13px;
    color: var(--muted);
    font-weight: 600;
    margin-bottom: 12px;
}

.card-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    margin-bottom: 14px;
}

.card-tag {
    background: #eff6ff;
    border: 1px solid #bfdbfe;
    color: #1d4ed8;
    border-radius: 8px;
    padding: 3px 10px;
    font-size: 11px;
    font-weight: 700;
}

.card-tag.zone {
    background: #f0fdf4;
    border-color: #bbf7d0;
    color: #15803d;
}

.card-meta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 12px;
    border-top: 1px solid var(--border);
    gap: 10px;
}

.card-plan {
    font-size: 13px;
    font-weight: 800;
    color: var(--navy);
}

.card-expiry {
    font-size: 12px;
    color: var(--muted);
    font-weight: 600;
}

.card-actions {
    display: flex;
    gap: 8px;
    margin-top: 14px;
}

.card-actions a,
.card-actions button {
    flex: 1;
    border: none;
    border-radius: 12px;
    padding: 10px;
    font-size: 12px;
    font-weight: 800;
    text-align: center;
    text-decoration: none;
}

.btn-view {
    background: var(--navy);
    color: #fff;
}

.btn-view:hover {
    color: #fff;
}

.btn-pay {
    background: var(--success);
    color: #fff;
}

.btn-pay:hover {
    color: #fff;
}

.btn-cancel-offer {
    background: var(--danger);
    color: #fff;
}

.btn-active-offer {
    background: var(--success);
    color: #fff;
}

.empty-state {
    text-align: center;
    padding: 80px 20px;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
}

.empty-title {
    font-size: 18px;
    font-weight: 900;
    color: var(--text);
    margin-bottom: 8px;
}

.empty-text {
    font-size: 14px;
    color: var(--muted);
    margin-bottom: 24px;
}

@media (max-width: 767.98px) {
    .page-hero {
        border-radius: 20px;
        padding: 20px;
    }

    .hero-title {
        font-size: 20px;
    }

    .hero-stats {
        gap: 10px;
    }

    .hero-stat {
        flex: 1;
        min-width: 130px;
    }

    .offers-grid {
        grid-template-columns: 1fr;
    }

    .card-actions {
        flex-direction: column;
    }
}
</style>
@endpush

@section('content')
<div class="content container-fluid offers-page">

    @php
        $totalOffersCount = $offers->count();

        $activeOffersCount = 0;
        $expiredOffersCount = 0;
        $unpaidOffersCount = 0;
        $cancelledOffersCount = 0;

        foreach ($offers as $offerItem) {
            $subscriptionItem = $offerItem->subscriptions
                ->where('user_id', auth()->guard('user')->id())
                ->first();

            $isPaidItem = ($subscriptionItem?->payment_status ?? 'unpaid') === 'paid';

            $isExpiredItem = $offerItem->expiry_date
                ? \Carbon\Carbon::parse($offerItem->expiry_date)->isPast()
                : false;

            if ($offerItem->status === 'cancelled') {
                $cancelledOffersCount++;
            } elseif (! $isPaidItem) {
                $unpaidOffersCount++;
            } elseif ($isExpiredItem) {
                $expiredOffersCount++;
            } elseif (in_array($offerItem->status, ['accept', 'accpet'])) {
                $activeOffersCount++;
            }
        }
    @endphp

    <div class="page-hero">
        <div class="hero-inner">
            <div class="d-flex align-items-start justify-content-between flex-wrap gap-3">
                <div>
                    <div class="hero-eyebrow">
                        لوحة الخدمات
                    </div>

                    <h1 class="hero-title">خدماتي المُسنَدة للعقارات</h1>

                    <p class="hero-subtitle">
                        جميع عروضك الإعلانية المرتبطة بالعقارات في مكان واحد
                    </p>

                    <div class="hero-stats">
                        <div class="hero-stat">
                            <span class="hero-stat-num">{{ $totalOffersCount }}</span>
                            <span class="hero-stat-label">إجمالي العروض</span>
                        </div>

                        <div class="hero-stat">
                            <span class="hero-stat-num">{{ $activeOffersCount }}</span>
                            <span class="hero-stat-label">فعالة</span>
                        </div>

                        <div class="hero-stat">
                            <span class="hero-stat-num">{{ $expiredOffersCount }}</span>
                            <span class="hero-stat-label">منتهية</span>
                        </div>

                        <div class="hero-stat">
                            <span class="hero-stat-num">{{ $unpaidOffersCount }}</span>
                            <span class="hero-stat-label">غير مدفوعة</span>
                        </div>

                        <div class="hero-stat">
                            <span class="hero-stat-num">{{ $cancelledOffersCount }}</span>
                            <span class="hero-stat-label">ملغية</span>
                        </div>
                    </div>
                </div>

                <a href="{{ route('service-provider.estaes.create-offer') }}" class="hero-action">
                    إضافة خدمة جديدة
                </a>
            </div>
        </div>
    </div>

    <div class="filter-bar">
        <div class="filter-search">
            <input type="text" id="search-input" placeholder="ابحث عن عرض...">
        </div>

        <div class="filter-chip active" data-filter="all">الكل</div>
        <div class="filter-chip" data-filter="active">فعالة</div>
        <div class="filter-chip" data-filter="expired">منتهية</div>
        <div class="filter-chip" data-filter="unpaid">غير مدفوعة</div>
        <div class="filter-chip" data-filter="cancelled">ملغية</div>
        <div class="filter-chip" data-filter="pending">قيد المراجعة</div>
    </div>

    @if($offers->isEmpty())
        <div class="empty-state">
            <h3 class="empty-title">لا توجد خدمات مُسنَدة</h3>
            <p class="empty-text">لم تقم بإضافة أي خدمة لعقاراتك بعد.</p>

            <a href="{{ route('service-provider.estaes.create-offer') }}" class="hero-action">
                إضافة أول خدمة
            </a>
        </div>
    @else
        <div class="offers-grid" id="offers-grid">
            @foreach ($offers as $index => $estate)
                @php
                    $subscription = $estate->subscriptions
                        ->where('user_id', auth()->guard('user')->id())
                        ->first();

                    $payStatus = $subscription?->payment_status ?? 'unpaid';
                    $isPaid = $payStatus === 'paid';

                    $isExpired = $estate->expiry_date
                        ? \Carbon\Carbon::parse($estate->expiry_date)->isPast()
                        : false;

                    if ($estate->status === 'cancelled') {
                        $subStatus = 'cancelled';
                    } elseif (! $isPaid) {
                        $subStatus = 'unpaid';
                    } elseif ($isExpired) {
                        $subStatus = 'expired';
                    } elseif (in_array($estate->status, ['accept', 'accpet'])) {
                        $subStatus = 'active';
                    } else {
                        $subStatus = 'pending';
                    }

                    $statusMap = [
                        'active' => ['label' => 'فعال', 'cls' => 'active'],
                        'expired' => ['label' => 'منتهي', 'cls' => 'expired'],
                        'unpaid' => ['label' => 'غير مدفوع', 'cls' => 'pending'],
                        'pending' => ['label' => 'قيد المراجعة', 'cls' => 'pending'],
                        'cancelled' => ['label' => 'ملغي', 'cls' => 'cancelled'],
                    ];

                    $statusInfo = $statusMap[$subStatus];

                    $planName = $subscription?->servicePlan?->name ?? '—';
                    $planPrice = number_format($subscription?->servicePlan?->price ?? $subscription?->price ?? 0, 2);

                    $paymentRoute = $subscription ? route('service-provider.estaes.payment', [
                        'offer_id' => $estate->id,
                        'price' => $subscription->servicePlan?->price ?? $subscription->price ?? 0,
                        'subscription_number' => $subscription->subscription_number ?? $subscription->id,
                    ]) : '#';

                    $viewRoute = route('service-provider.offers.display', $estate->id);

                    $imgSrc = $estate->image
                        ? asset('storage/app/public/' . $estate->image)
                        : asset('public/assets/images/default-estate.jpg');
                @endphp

                <div class="offer-card"
                     data-status="{{ $subStatus }}"
                     data-payment="{{ $payStatus }}"
                     style="animation-delay: {{ $index * 0.04 }}s">

                    <div class="card-img-wrap">
                        <img src="{{ $imgSrc }}"
                             alt="{{ $estate->title }}"
                             onerror="this.src='{{ asset('public/assets/images/default-estate.jpg') }}'">

                        <div class="card-img-overlay"></div>

                        <div class="card-badges">
                            <span class="card-badge status-{{ $statusInfo['cls'] }}">
                                {{ $statusInfo['label'] }}
                            </span>

                            <span class="card-badge {{ $isPaid ? 'pay-paid' : 'pay-unpaid' }}">
                                {{ $isPaid ? 'مدفوع' : 'غير مدفوع' }}
                            </span>
                        </div>

                        <div class="card-offer-type">
                            @if($estate->offer_type === 'price')
                                {{ number_format($estate->service_price ?? 0, 0) }} ريال
                            @else
                                خصم {{ $estate->discount ?? 0 }}%
                            @endif
                        </div>
                    </div>

                    <div class="card-body-inner">
                        <div class="card-offer-title">
                            {{ $estate->title }}
                        </div>

                        <div class="card-service-name">
                            {{ $estate->serviceType?->name ?? '—' }}
                        </div>

                        <div class="card-tags">
                            @foreach($estate->categories->take(2) as $cat)
                                <span class="card-tag">
                                    {{ $cat->name_ar ?? $cat->name ?? '—' }}
                                </span>
                            @endforeach

                            @foreach($estate->zones->take(2) as $zone)
                                <span class="card-tag zone">
                                    {{ $zone->name_ar ?? $zone->name ?? '—' }}
                                </span>
                            @endforeach

                            @if($estate->categories->count() + $estate->zones->count() > 4)
                                <span class="card-tag">
                                    +{{ ($estate->categories->count() + $estate->zones->count()) - 4 }}
                                </span>
                            @endif
                        </div>

                        <div class="card-meta">
                            <div class="card-plan">
                                {{ $planName }}
                            </div>

                            <div class="card-expiry">
                                ينتهي: {{ $estate->expiry_date ?? '—' }}
                            </div>
                        </div>

                        <div class="card-actions">
                            <a href="{{ $viewRoute }}" class="btn-view">
                                عرض التفاصيل
                            </a>

                            @if(! $isPaid && $subscription)
                                <a href="{{ $paymentRoute }}" class="btn-pay">
                                    إكمال الدفع
                                </a>
                            @endif
                        </div>

                        <form action="{{ route('service-provider.offers.toggle-status', $estate->id) }}"
                              method="POST"
                              class="mt-2"
                              onsubmit="return confirm('{{ $estate->status === 'cancelled' ? 'هل تريد تشغيل العرض؟' : 'هل تريد إلغاء تفعيل العرض؟' }}')">
                            @csrf

                            <button type="submit"
                                    class="{{ $estate->status === 'cancelled' ? 'btn-active-offer' : 'btn-cancel-offer' }}"
                                    style="width:100%; border-radius:12px; padding:10px; font-size:12px; font-weight:800;">
                                {{ $estate->status === 'cancelled' ? 'تشغيل العرض' : 'إلغاء تفعيل العرض' }}
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

</div>
@endsection

@push('script')
<script>
const cards = document.querySelectorAll('.offer-card');
let activeFilter = 'all';

document.querySelectorAll('.filter-chip').forEach(chip => {
    chip.addEventListener('click', function () {
        document.querySelectorAll('.filter-chip').forEach(c => c.classList.remove('active'));
        this.classList.add('active');

        activeFilter = this.dataset.filter;
        applyFilters();
    });
});

document.getElementById('search-input')?.addEventListener('input', applyFilters);

function applyFilters() {
    const query = (document.getElementById('search-input')?.value || '').toLowerCase().trim();

    cards.forEach((card, i) => {
        const status = card.dataset.status;
        const text = card.textContent.toLowerCase();

        let visible = true;

        if (activeFilter === 'active' && status !== 'active') visible = false;
        if (activeFilter === 'expired' && status !== 'expired') visible = false;
        if (activeFilter === 'unpaid' && status !== 'unpaid') visible = false;
        if (activeFilter === 'cancelled' && status !== 'cancelled') visible = false;
        if (activeFilter === 'pending' && status !== 'pending') visible = false;

        if (query && !text.includes(query)) visible = false;

        card.style.display = visible ? '' : 'none';

        if (visible) {
            card.style.animationDelay = (i * 0.04) + 's';
        }
    });
}
</script>
@endpush