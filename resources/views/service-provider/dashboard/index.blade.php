@php use App\Utils\Helpers; @endphp

@extends('layouts.back-end.app-seller')

@section('title', translate('dashboard'))

@push('css_or_js')
<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
    .content.container-fluid {
        background: transparent;
        min-height: calc(100vh - 80px);
        padding: 0;
    }

    .ab3ad-hero {
        background: rgba(255,255,255,.82);
        backdrop-filter: blur(16px);
        border: 1px solid rgba(255,255,255,.7);
        border-radius: 28px;
        box-shadow: var(--ab-shadow);
        padding: 24px;
        margin-bottom: 20px;
    }

    .ab3ad-hero-title {
        font-size: 30px;
        font-weight: 900;
        color: var(--ab-text);
        margin-bottom: 8px;
    }

    .ab3ad-hero-desc {
        color: var(--ab-muted);
        font-size: 15px;
        margin-bottom: 0;
    }

    .hero-chip {
        padding: 10px 14px;
        border-radius: 999px;
        background: rgba(37,99,235,.08);
        color: var(--ab-primary-dark);
        font-weight: 800;
        border: 1px solid rgba(37,99,235,.10);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
    }

    .ab3ad-card {
        border: 1px solid rgba(226,232,240,.75) !important;
        border-radius: 24px !important;
        background: #fff !important;
        box-shadow: var(--ab-shadow) !important;
        overflow: hidden;
    }

    .ab3ad-stat-card,
    .ab3ad-section-card {
        padding: 22px;
        height: 100%;
    }

    .ab3ad-stat-icon {
        width: 56px;
        height: 56px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: #fff;
        flex-shrink: 0;
    }

    .gradient-blue { background: linear-gradient(135deg, #2563eb, #60a5fa); }
    .gradient-green { background: linear-gradient(135deg, #059669, #34d399); }
    .gradient-purple { background: linear-gradient(135deg, #7c3aed, #a78bfa); }
    .gradient-orange { background: linear-gradient(135deg, #ea580c, #fb923c); }
    .gradient-red { background: linear-gradient(135deg, #dc2626, #fb7185); }

    .ab3ad-kpi-label {
        font-size: 14px;
        color: var(--ab-muted);
        font-weight: 700;
    }

    .ab3ad-kpi-value {
        font-size: 30px;
        font-weight: 900;
        color: var(--ab-text);
        line-height: 1.1;
        margin-top: 10px;
        margin-bottom: 0;
    }

    .ab3ad-kpi-meta {
        font-size: 13px;
        font-weight: 700;
        margin-top: 10px;
        display: block;
    }

    .ab3ad-section-title {
        font-size: 20px;
        font-weight: 900;
        color: var(--ab-text);
        margin-bottom: 4px;
    }

    .ab3ad-section-subtitle {
        color: var(--ab-muted);
        font-size: 14px;
        margin-bottom: 0;
    }

    .ab3ad-btn-primary {
        background: linear-gradient(135deg, var(--ab-primary), var(--ab-primary-dark)) !important;
        border: none !important;
        border-radius: 999px !important;
        padding: 12px 22px !important;
        font-weight: 800 !important;
        color: #fff !important;
    }

    .ab3ad-status {
        border-radius: 999px;
        padding: 8px 12px;
        font-size: 12px;
        font-weight: 800;
        display: inline-block;
        white-space: nowrap;
    }

    .status-success { background: rgba(5,150,105,.1); color: #047857; }
    .status-warning { background: rgba(217,119,6,.1); color: #b45309; }
    .status-danger { background: rgba(220,38,38,.1); color: #b91c1c; }

    .ab3ad-list-row {
        padding: 14px 0;
        border-bottom: 1px solid #eef2f7;
    }

    .ab3ad-list-row:last-child {
        border-bottom: none;
    }

    .mini-progress {
        height: 10px;
        border-radius: 999px;
        background: #e9eef7;
        overflow: hidden;
    }

    .mini-progress span {
        display: block;
        height: 100%;
        border-radius: 999px;
        background: linear-gradient(135deg, #2563eb, #7c3aed);
    }

    .views-card {
        background: linear-gradient(135deg, #eff6ff, #ffffff);
        border: 1px solid #dbeafe;
        border-radius: 20px;
        padding: 16px;
    }

    .ab3ad-chart-box {
        position: relative;
        min-height: 330px;
    }

    .ab3ad-table thead th {
        color: var(--ab-muted);
        font-size: 14px;
        font-weight: 800;
        border-bottom: 1px solid var(--ab-border);
        white-space: nowrap;
    }

    .ab3ad-table tbody td {
        vertical-align: middle;
        border-color: #eef2f7;
        font-weight: 600;
        color: var(--ab-text);
    }

    @media (max-width: 767.98px) {
        .ab3ad-hero {
            border-radius: 22px;
            padding: 18px;
        }

        .ab3ad-hero-title {
            font-size: 22px !important;
        }

        .ab3ad-kpi-value {
            font-size: 24px !important;
        }

        .ab3ad-section-card,
        .ab3ad-stat-card {
            padding: 16px !important;
            border-radius: 20px !important;
        }

        .ab3ad-chart-box {
            min-height: 260px !important;
        }

        .ab3ad-btn-primary {
            width: 100%;
            text-align: center;
        }
    }
</style>
@endpush

@section('content')
<div class="content container-fluid">

    <!--<div class="ab3ad-hero">-->
    <!--    <div class="row align-items-center g-3">-->
    <!--        <div class="col-lg-8">-->
    <!--            <h1 class="ab3ad-hero-title">-->
    <!--                مرحباً بك {{ auth('user')->user()->name }}-->
    <!--            </h1>-->

    <!--            <p class="ab3ad-hero-desc">-->
    <!--                لوحة تحكم تعرض أداء خدماتك، مشاهدات العقارات حسب المناطق والأقسام، وحالة الاشتراكات.-->
    <!--            </p>-->

    <!--            <div class="d-flex flex-wrap gap-2 mt-3">-->
    <!--                <span class="hero-chip"><i class="tio-visible"></i> إجمالي المشاهدات</span>-->
    <!--                <span class="hero-chip"><i class="tio-location-on"></i> الأداء حسب المنطقة</span>-->
    <!--                <span class="hero-chip"><i class="tio-category"></i> الأداء حسب القسم</span>-->
    <!--                <span class="hero-chip"><i class="tio-date-range"></i> حالة الاشتراكات</span>-->
    <!--            </div>-->
    <!--        </div>-->

    <!--        <div class="col-lg-4 text-lg-left text-right">-->
    <!--            <a href="{{ route('service-provider.estaes.create-offer') }}" class="btn ab3ad-btn-primary">-->
    <!--                <i class="tio-add mr-1"></i>-->
    <!--                إضافة عرض جديد-->
    <!--            </a>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->

    <div class="row g-3 mb-4">
        <div class="col-6 col-xl-3">
            <div class="card ab3ad-card ab3ad-stat-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="ab3ad-kpi-label">إجمالي العروض</div>
                        <h3 class="ab3ad-kpi-value">
                            {{ number_format(($approvedOffersCount ?? 0) + ($pendingOffersCount ?? 0)) }}
                        </h3>
                        <span class="ab3ad-kpi-meta text-primary">المعتمدة والمعلقة</span>
                    </div>
                    <div class="ab3ad-stat-icon gradient-blue">
                        <i class="tio-layers"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-xl-3">
            <div class="card ab3ad-card ab3ad-stat-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="ab3ad-kpi-label">العروض المعتمدة</div>
                        <h3 class="ab3ad-kpi-value">{{ number_format($approvedOffersCount ?? 0) }}</h3>
                        <span class="ab3ad-kpi-meta text-success">عروض نشطة</span>
                    </div>
                    <div class="ab3ad-stat-icon gradient-green">
                        <i class="tio-checkmark-circle"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-xl-3">
            <div class="card ab3ad-card ab3ad-stat-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="ab3ad-kpi-label">قيد المراجعة</div>
                        <h3 class="ab3ad-kpi-value">{{ number_format($pendingOffersCount ?? 0) }}</h3>
                        <span class="ab3ad-kpi-meta text-warning">بانتظار الاعتماد</span>
                    </div>
                    <div class="ab3ad-stat-icon gradient-purple">
                        <i class="tio-time"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-xl-3">
            <div class="card ab3ad-card ab3ad-stat-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="ab3ad-kpi-label">إجمالي المشاهدات</div>
                        <h3 class="ab3ad-kpi-value">{{ number_format($totalViews ?? 0) }}</h3>
                        <span class="ab3ad-kpi-meta text-primary">مشاهدات العقارات</span>
                    </div>
                    <div class="ab3ad-stat-icon gradient-orange">
                        <i class="tio-visible"></i>
                    </div>
                </div>
            </div>
        </div>
        
        
        
        
        <div class="col-6 col-xl-3">
    <div class="card ab3ad-card ab3ad-stat-card">
        <div class="d-flex justify-content-between align-items-start">
            <div>
                <div class="ab3ad-kpi-label">العروض المنتهية</div>
                <h3 class="ab3ad-kpi-value">{{ number_format($expiredOffersCount ?? 0) }}</h3>
                <span class="ab3ad-kpi-meta text-danger">انتهت صلاحيتها</span>
            </div>
            <div class="ab3ad-stat-icon gradient-red">
                <i class="tio-warning"></i>
            </div>
        </div>
    </div>
</div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-xl-8">
            <div class="card ab3ad-card ab3ad-section-card">
                <div class="mb-4">
                    <h5 class="ab3ad-section-title">المشاهدات حسب المناطق</h5>
                    <p class="ab3ad-section-subtitle">
                        إجمالي مشاهدات العقارات حسب المناطق التي تغطيها خدماتك.
                    </p>
                </div>

                <div class="ab3ad-chart-box">
                    <canvas id="zonesViewsChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card ab3ad-card ab3ad-section-card">
                <div class="mb-4">
                    <h5 class="ab3ad-section-title">أعلى المناطق مشاهدة</h5>
                    <p class="ab3ad-section-subtitle">ترتيب المناطق حسب عدد المشاهدات.</p>
                </div>

                <div class="views-card mb-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <small class="text-muted d-block mb-1">إجمالي المشاهدات</small>
                            <h3 class="font-weight-bold mb-0">{{ number_format($totalViews ?? 0) }}</h3>
                        </div>
                        <div class="ab3ad-stat-icon gradient-blue" style="width:52px;height:52px;">
                            <i class="tio-visible"></i>
                        </div>
                    </div>
                </div>

                @forelse($viewsByZones as $zone)
                    @php
                        $percent = ($totalViews ?? 0) > 0
                            ? round(($zone->total_views / $totalViews) * 100)
                            : 0;
                    @endphp

                    <div class="ab3ad-list-row">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="font-weight-bold">{{ $zone->name ?? 'غير محدد' }}</span>
                            <span class="text-muted">{{ number_format($zone->total_views ?? 0) }} مشاهدة</span>
                        </div>

                        <div class="mini-progress mb-2">
                            <span style="width: {{ $percent }}%"></span>
                        </div>

                        <small class="text-muted">
                            {{ number_format($zone->estates_count ?? 0) }} عقار
                        </small>
                    </div>
                @empty
                    <div class="text-center text-muted py-4">
                        لا توجد بيانات مناطق حالياً
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-xl-7">
            <div class="card ab3ad-card ab3ad-section-card">
                <div class="mb-4">
                    <h5 class="ab3ad-section-title">المشاهدات حسب نوع العقار</h5>
                    <p class="ab3ad-section-subtitle">
                        عدد العقارات ومجموع المشاهدات حسب نوع العقار المرتبط بخدماتك.
                    </p>
                </div>

                <div class="table-responsive">
                    <table class="table ab3ad-table mb-0">
                        <thead>
                            <tr>
                                <th>نوع العقار</th>
                                <th>عدد العقارات</th>
                                <th>عدد المشاهدات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($viewsByCategories as $category)
                                <tr>
                                    <td>{{ $category->name ?? 'غير محدد' }}</td>
                                    <td>{{ number_format($category->estates_count ?? 0) }}</td>
                                    <td>{{ number_format($category->total_views ?? 0) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">
                                        لا توجد بيانات أنواع عقار حالياً
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-xl-5">
            <div class="card ab3ad-card ab3ad-section-card">
                <div class="mb-4">
                    <h5 class="ab3ad-section-title">حالة الاشتراكات</h5>
                    <p class="ab3ad-section-subtitle">
                        الاشتراكات الخاصة بمزود الخدمة.
                    </p>
                </div>

                <div class="table-responsive">
                    <table class="table ab3ad-table mb-0">
                        <thead>
                            <tr>
                                <th>رقم الاشتراك</th>
                                <th>تاريخ الانتهاء</th>
                                <th>الحالة</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($subscriptions as $subscription)
                                @php
                                    $expiryDate = \Carbon\Carbon::parse($subscription->expiry_date);
                                    $isExpired = $expiryDate->isPast();
                                @endphp

                                <tr>
                                    <td>{{ $subscription->subscription_number ?? '-' }}</td>
                                    <td>{{ $expiryDate->format('Y-m-d') }}</td>
                                    <td>
                                        @if($isExpired)
                                            <span class="ab3ad-status status-danger">منتهي</span>
                                        @else
                                            <span class="ab3ad-status status-success">نشط</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">
                                        لا توجد اشتراكات حالياً
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const zonesLabels = @json($viewsByZones->pluck('name'));
    const zonesViews = @json($viewsByZones->pluck('total_views'));
    const zonesEstates = @json($viewsByZones->pluck('estates_count'));

    const zonesCtx = document.getElementById('zonesViewsChart');

    if (zonesCtx) {
        new Chart(zonesCtx, {
            type: 'bar',
            data: {
                labels: zonesLabels,
                datasets: [
                    {
                        label: 'عدد المشاهدات',
                        data: zonesViews,
                        backgroundColor: 'rgba(37, 99, 235, 0.85)',
                        borderRadius: 12,
                        barThickness: 28
                    },
                    {
                        label: 'عدد العقارات',
                        data: zonesEstates,
                        type: 'line',
                        borderColor: 'rgba(124, 58, 237, 1)',
                        backgroundColor: 'rgba(124, 58, 237, 0.18)',
                        borderWidth: 3,
                        tension: 0.35,
                        fill: false,
                        yAxisID: 'y1'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    tooltip: {
                        rtl: true
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'عدد المشاهدات'
                        }
                    },
                    y1: {
                        position: 'right',
                        beginAtZero: true,
                        grid: {
                            drawOnChartArea: false
                        },
                        title: {
                            display: true,
                            text: 'عدد العقارات'
                        }
                    }
                }
            }
        });
    }
</script>
@endpush