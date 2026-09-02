<?php

namespace App\Services\Reports;

use App\Helpers\Helpers;
use App\Models\Category;
use App\Models\Offer;
use App\Models\OfferView;
use App\Models\ServiceProviderSubscription;
use App\Models\ServiceType;
use App\Models\User;
use App\Models\Zone;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * إحصائيات لوحة تحكم مزوّد الخدمة — مخصّصة بالكامل لعروض/اشتراكات/مشاهدات هذا
 * المزوّد وحده (عبر Offer::scopeOwnedBy الذي تعتمد عليه شاشة "خدماتي" نفسها،
 * فيدعم قناتي الملكية: offer_owner كرقم مستخدم عبر التطبيق، و offer_owner='me'
 * عبر pivot في النظام القديم على الويب).
 *
 * 🔎 المشاهدات الآن دقيقة: تُقرأ من جدول offer_views (صف واحد لكل مُشاهِد فريد
 * في اليوم، يُكتب في App\Services\OfferViewRecorder عند فتح صفحة تفاصيل العرض).
 * هذا يستبدل التقدير القديم الذي كان يجمع estates.view لكل العقارات الواقعة في
 * نفس مناطق/تصنيفات العرض — أي كان يشمل عروض المنافسين ولا يعكس مشاهدة العرض
 * نفسه. البيانات تبدأ من تاريخ نشر هذه الميزة (لا سجل تاريخي سابق).
 *
 * أسماء الدوال القديمة (summary / viewsByZone / viewsByCategory /
 * subscriptionsOverview / periodSummary / periodSubscriptions) محفوظة كما هي
 * كي لا تُكسر لوحة الويب service-provider.dashboard الأقدم أكثر مما هي عليه.
 */
class ProviderReportService
{
    /** @var array<int, array<int>> تخزين مؤقت لمعرّفات عروض المزوّد داخل الطلب الواحد */
    private array $ownOfferIdsCache = [];

    // ─────────────────────────────────────────────────────────────────────────
    // نظرة عامة
    // ─────────────────────────────────────────────────────────────────────────

    /**
     * يصنّف عروض المزوّد إلى نفس 5 تبويبات شاشة "خدماتي" بالتطبيق بمنطقها
     * الحرفي (نشط / قيد المراجعة / غير مدفوعة / مرفوض / منتهي)، مع أرقام
     * إجمالية ومشاهدات فعلية (كل الوقت + نافذتان متدحرجتان).
     */
    public function summary(int $providerId): array
    {
        $offers = $this->ownOffersWithSubscription($providerId)->get();
        $offerIds = $offers->pluck('id')->all();
        $counts = $this->classifyOffers($offers);

        $activeCount = $counts['active_offers_count'] ?: 1;
        $totalViews = $this->viewsCount($offerIds);

        return $counts + [
            'total_offers_count' => $offers->count(),
            'total_views' => $totalViews,
            'views_last_7d' => $this->viewsCount($offerIds, Carbon::now()->subDays(7)->startOfDay()),
            'views_last_30d' => $this->viewsCount($offerIds, Carbon::now()->subDays(30)->startOfDay()),
            'avg_views_per_active_offer' => $counts['active_offers_count'] > 0
                ? round($totalViews / $activeCount, 1)
                : 0.0,
        ];
    }

    /**
     * نفس تصنيف summary() لكن مقيَّدًا بعروض أُنشئت خلال فترة زمنية محددة
     * (created_at) — يغذّي قسم "خلال الفترة المحددة".
     */
    public function periodSummary(int $providerId, ?Carbon $from, ?Carbon $to): array
    {
        $query = $this->ownOffersWithSubscription($providerId);

        if ($from) {
            $query->where('created_at', '>=', $from);
        }
        if ($to) {
            $query->where('created_at', '<=', $to);
        }

        $offers = $query->get();

        return $this->classifyOffers($offers) + [
            'new_offers_count' => $offers->count(),
        ];
    }

    // ─────────────────────────────────────────────────────────────────────────
    // الأداء والمشاهدات (فعلية من offer_views)
    // ─────────────────────────────────────────────────────────────────────────

    /**
     * كتلة الأداء الكاملة: مشاهدات إجمالية + نوافذ متدحرجة + ترتيب لكل عرض +
     * توزيع حسب المنطقة/التصنيف + سلسلة زمنية.
     */
    public function performance(int $providerId, ?Carbon $from, ?Carbon $to, string $granularity = 'day'): array
    {
        $offerIds = $this->ownOfferIds($providerId);

        return [
            'total_views' => $this->viewsCount($offerIds, $from, $to),
            'views_last_7d' => $this->viewsCount($offerIds, Carbon::now()->subDays(7)->startOfDay()),
            'views_last_30d' => $this->viewsCount($offerIds, Carbon::now()->subDays(30)->startOfDay()),
            'by_offer' => $this->viewsByOffer($providerId, $from, $to),
            'by_zone' => $this->viewsByZone($providerId),
            'by_category' => $this->viewsByCategory($providerId),
            'timeseries' => $this->viewsTimeseries($providerId, $from, $to, $granularity),
        ];
    }

    /**
     * كتلة مشاهدات مقيّدة بالفترة المحددة فقط (لتبويب "الفترة والتفاصيل").
     */
    public function periodViews(int $providerId, ?Carbon $from, ?Carbon $to, string $granularity = 'day'): array
    {
        return [
            'total_views' => $this->viewsCount($this->ownOfferIds($providerId), $from, $to),
            'by_offer' => $this->viewsByOffer($providerId, $from, $to),
            'timeseries' => $this->viewsTimeseries($providerId, $from, $to, $granularity),
        ];
    }

    /**
     * أعلى عروض المزوّد مشاهدةً ضمن الفترة (مع مشاهدات كل الوقت لكل عرض للمقارنة).
     * @return Collection<int, array>
     */
    public function viewsByOffer(int $providerId, ?Carbon $from, ?Carbon $to, int $limit = 10): Collection
    {
        $offers = $this->ownOffersQuery($providerId)
            ->get(['id', 'title', 'status', 'expiry_date', 'created_at'])
            ->keyBy('id');

        if ($offers->isEmpty()) {
            return collect();
        }

        $offerIds = $offers->keys()->all();

        $rangeViews = $this->viewsCountPerOffer($offerIds, $from, $to);
        $allTimeViews = ($from || $to) ? $this->viewsCountPerOffer($offerIds, null, null) : $rangeViews;

        return $offers
            ->map(fn ($offer) => [
                'offer_id' => (int) $offer->id,
                'title' => $offer->title,
                'status' => $offer->status,
                'is_expired' => $offer->expiry_date ? Carbon::parse($offer->expiry_date)->isPast() : false,
                'views' => (int) ($rangeViews[$offer->id] ?? 0),
                'views_all_time' => (int) ($allTimeViews[$offer->id] ?? 0),
                'created_at' => optional($offer->created_at)->toIso8601String(),
            ])
            ->sortByDesc('views')
            ->take($limit)
            ->values();
    }

    /**
     * توزيع مشاهدات عروض المزوّد حسب المنطقة (وليس نشاط السوق العام). عرض في
     * أكثر من منطقة تُنسب مشاهداته لكل منطقة يغطّيها.
     */
    public function viewsByZone(int $providerId): Collection
    {
        $offerIds = $this->ownOfferIds($providerId);

        if (empty($offerIds)) {
            return collect();
        }

        return Zone::query()
            ->select('zones.id', 'zones.name', 'zones.name_ar')
            ->selectRaw('COUNT(DISTINCT offer_zone.offer_id) as offers_count')
            ->selectRaw('COUNT(offer_views.id) as total_views')
            ->join('offer_zone', 'offer_zone.zone_id', '=', 'zones.id')
            ->leftJoin('offer_views', 'offer_views.offer_id', '=', 'offer_zone.offer_id')
            ->whereIn('offer_zone.offer_id', $offerIds)
            ->groupBy('zones.id', 'zones.name', 'zones.name_ar')
            ->orderByDesc('total_views')
            ->get()
            ->each($this->castViewRow(...));
    }

    /**
     * توزيع مشاهدات عروض المزوّد حسب التصنيف. عرض في أكثر من تصنيف تُنسب
     * مشاهداته لكل تصنيف يغطّيه.
     */
    public function viewsByCategory(int $providerId): Collection
    {
        $offerIds = $this->ownOfferIds($providerId);

        if (empty($offerIds)) {
            return collect();
        }

        return Category::query()
            ->select('categories.id', 'categories.name', 'categories.name_ar')
            ->selectRaw('COUNT(DISTINCT category_offer.offer_id) as offers_count')
            ->selectRaw('COUNT(offer_views.id) as total_views')
            ->join('category_offer', 'category_offer.category_id', '=', 'categories.id')
            ->leftJoin('offer_views', 'offer_views.offer_id', '=', 'category_offer.offer_id')
            ->whereIn('category_offer.offer_id', $offerIds)
            ->groupBy('categories.id', 'categories.name', 'categories.name_ar')
            ->orderByDesc('total_views')
            ->get()
            ->each($this->castViewRow(...));
    }

    /**
     * سلسلة مشاهدات زمنية متصلة (الفجوات مملوءة بصفر). النطاق الافتراضي بلا
     * from: آخر 30 يومًا (day) أو آخر 12 شهرًا (month). المدى اليومي الأطول من
     * 92 يومًا يُرقّى تلقائيًا إلى تجميع شهري كي لا تتضخّم النقاط.
     * @return array<int, array{date: string, views: int}>
     */
    public function viewsTimeseries(int $providerId, ?Carbon $from, ?Carbon $to, string $granularity = 'day'): array
    {
        $end = $to ? $to->copy() : Carbon::now();

        if ($from) {
            $start = $from->copy();
        } else {
            $start = $granularity === 'month'
                ? $end->copy()->startOfMonth()->subMonthsNoOverflow(11)
                : $end->copy()->subDays(29)->startOfDay();
        }

        if ($granularity === 'day' && $start->diffInDays($end) > 92) {
            $granularity = 'month';
        }

        $isMonth = $granularity === 'month';
        $offerIds = $this->ownOfferIds($providerId);

        $rows = collect();
        if (!empty($offerIds)) {
            $format = $isMonth ? '%Y-%m' : '%Y-%m-%d';
            $rows = OfferView::query()
                ->selectRaw("DATE_FORMAT(viewed_date, '{$format}') as bucket, COUNT(*) as views")
                ->whereIn('offer_id', $offerIds)
                ->whereBetween('viewed_date', [$start->toDateString(), $end->toDateString()])
                ->groupBy('bucket')
                ->pluck('views', 'bucket');
        }

        $points = [];
        $cursor = $isMonth ? $start->copy()->startOfMonth() : $start->copy()->startOfDay();
        $last = $isMonth ? $end->copy()->startOfMonth() : $end->copy()->startOfDay();

        while ($cursor <= $last) {
            $key = $cursor->format($isMonth ? 'Y-m' : 'Y-m-d');
            $points[] = ['date' => $key, 'views' => (int) ($rows[$key] ?? 0)];
            $isMonth ? $cursor->addMonthNoOverflow() : $cursor->addDay();
        }

        return $points;
    }

    // ─────────────────────────────────────────────────────────────────────────
    // المالية والاشتراكات
    // ─────────────────────────────────────────────────────────────────────────

    /**
     * ملخّص مالي شامل من اشتراكات المزوّد (لكل عرض اشتراكه المستقل في النموذج
     * الحالي): إنفاق تراكمي، مبالغ مستحقة، أقرب تجديد/انتهاء، إنفاق حسب
     * الباقة وحسب الشهر (آخر 12 شهرًا).
     */
    public function financialSummary(int $providerId): array
    {
        $rows = ServiceProviderSubscription::query()
            ->where('user_id', $providerId)
            ->with('servicePlan:id,name')
            ->get([
                'id', 'service_plan_id', 'price', 'payment_status',
                'subscription_status', 'expiry_date', 'created_at', 'updated_at',
            ]);

        $paid = $rows->where('payment_status', 'paid');
        $outstanding = $rows->whereIn('payment_status', ['unpaid', 'failed']);

        $futurePaidExpiries = $paid
            ->map(fn ($r) => $this->parseDateOrNull($r->expiry_date))
            ->filter(fn ($d) => $d && $d->isFuture())
            ->sort()
            ->values();

        $allFutureExpiries = $rows
            ->map(fn ($r) => $this->parseDateOrNull($r->expiry_date))
            ->filter(fn ($d) => $d && $d->isFuture())
            ->sort()
            ->values();

        $spendByPlan = $paid
            ->groupBy(fn ($r) => $r->servicePlan->name ?? '—')
            ->map(fn ($group, $name) => [
                'plan_name' => $name,
                'paid' => round((float) $group->sum(fn ($r) => (float) $r->price), 2),
                'count' => $group->count(),
            ])
            ->sortByDesc('paid')
            ->values();

        $now = Carbon::now();
        $spendByMonth = [];
        for ($i = 11; $i >= 0; $i--) {
            $key = $now->copy()->startOfMonth()->subMonthsNoOverflow($i)->format('Y-m');
            $sum = $paid
                ->filter(fn ($r) => $r->created_at && $r->created_at->format('Y-m') === $key)
                ->sum(fn ($r) => (float) $r->price);
            $spendByMonth[] = ['month' => $key, 'paid' => round((float) $sum, 2)];
        }

        $lastPayment = $paid
            ->map(fn ($r) => $r->updated_at ?? $r->created_at)
            ->filter()
            ->sort()
            ->last();

        return [
            'lifetime_paid' => round((float) $paid->sum(fn ($r) => (float) $r->price), 2),
            'outstanding_amount' => round((float) $outstanding->sum(fn ($r) => (float) $r->price), 2),
            'subscriptions_total' => $rows->count(),
            'paid_count' => $paid->count(),
            'unpaid_count' => $outstanding->count(),
            'last_payment_at' => optional($lastPayment)->toDateString(),
            'next_renewal_at' => optional($futurePaidExpiries->first())->toDateString(),
            'soonest_expiry_at' => optional($allFutureExpiries->first())->toDateString(),
            'spend_by_plan' => $spendByPlan,
            'spend_by_month' => $spendByMonth,
        ];
    }

    /**
     * كل اشتراكات المزوّد، الأحدث أولًا، مُثراة بكل ما يخص كل اشتراك: مخصّصات
     * الباقة المدفوعة (إعلانات/مناطق/تصنيفات)، العرض المرتبط، حالة الاشتراك
     * وحالة الدفع، رقم الاشتراك ومعرّف دفعة مُيسّر، وتواريخ الإنشاء/التحديث.
     */
    public function subscriptionsOverview(int $providerId): Collection
    {
        return ServiceProviderSubscription::query()
            ->where('user_id', $providerId)
            ->with(['servicePlan:id,name,price', 'offer:id,title'])
            ->orderByDesc('created_at')
            ->get([
                'id', 'service_plan_id', 'offer_id', 'duration', 'expiry_date',
                'subscription_status', 'payment_status', 'price', 'subscription_number',
                'moyasar_payment_id', 'number_of_ads', 'number_of_zone',
                'number_of_categories', 'created_at', 'updated_at',
            ]);
    }

    /**
     * اشتراكات المزوّد المُنشأة خلال الفترة الزمنية — عدد ومبالغ (كل الاشتراكات
     * + المدفوعة فقط)، تغذّي قسم "خلال الفترة المحددة".
     */
    public function periodSubscriptions(int $providerId, ?Carbon $from, ?Carbon $to): array
    {
        $query = ServiceProviderSubscription::query()->where('user_id', $providerId);

        if ($from) {
            $query->where('created_at', '>=', $from);
        }
        if ($to) {
            $query->where('created_at', '<=', $to);
        }

        $rows = $query->get(['id', 'price', 'payment_status']);
        $paid = $rows->where('payment_status', 'paid');

        return [
            'count' => $rows->count(),
            'total_amount' => round((float) $rows->sum(fn ($r) => (float) $r->price), 2),
            'paid_count' => $paid->count(),
            'paid_amount' => round((float) $paid->sum(fn ($r) => (float) $r->price), 2),
        ];
    }

    // ─────────────────────────────────────────────────────────────────────────
    // التغطية مقابل ما دُفع مقابله
    // ─────────────────────────────────────────────────────────────────────────

    /**
     * المناطق/التصنيفات/أنواع الخدمة التي تغطّيها عروض المزوّد (مع عدد العروض
     * لكل عنصر)، مقابل مجموع المخصّصات في اشتراكاته النشطة المدفوعة.
     */
    public function coverageVsPlan(int $providerId): array
    {
        $offerIds = $this->ownOfferIds($providerId);

        $zones = collect();
        $categories = collect();
        $serviceTypes = collect();

        if (!empty($offerIds)) {
            $zones = Zone::query()
                ->select('zones.id', 'zones.name', 'zones.name_ar')
                ->selectRaw('COUNT(DISTINCT offer_zone.offer_id) as offers_count')
                ->join('offer_zone', 'offer_zone.zone_id', '=', 'zones.id')
                ->whereIn('offer_zone.offer_id', $offerIds)
                ->groupBy('zones.id', 'zones.name', 'zones.name_ar')
                ->orderByDesc('offers_count')
                ->get()
                ->each(fn ($r) => $r->offers_count = (int) $r->offers_count);

            $categories = Category::query()
                ->select('categories.id', 'categories.name', 'categories.name_ar')
                ->selectRaw('COUNT(DISTINCT category_offer.offer_id) as offers_count')
                ->join('category_offer', 'category_offer.category_id', '=', 'categories.id')
                ->whereIn('category_offer.offer_id', $offerIds)
                ->groupBy('categories.id', 'categories.name', 'categories.name_ar')
                ->orderByDesc('offers_count')
                ->get()
                ->each(fn ($r) => $r->offers_count = (int) $r->offers_count);

            $serviceTypes = ServiceType::query()
                ->select('service_types.id', 'service_types.name')
                ->selectRaw('COUNT(offers.id) as offers_count')
                ->join('offers', 'offers.service_type_id', '=', 'service_types.id')
                ->whereIn('offers.id', $offerIds)
                ->groupBy('service_types.id', 'service_types.name')
                ->orderByDesc('offers_count')
                ->get()
                ->each(fn ($r) => $r->offers_count = (int) $r->offers_count);
        }

        $activeOffers = $this->ownOffersWithSubscription($providerId)->get();
        $activeOffersCount = $this->classifyOffers($activeOffers)['active_offers_count'];

        $activeSubs = ServiceProviderSubscription::query()
            ->where('user_id', $providerId)
            ->where('payment_status', 'paid')
            ->get(['number_of_ads', 'number_of_zone', 'number_of_categories', 'expiry_date'])
            ->filter(fn ($s) => ($d = $this->parseDateOrNull($s->expiry_date)) === null || $d->isFuture());

        return [
            'zones' => $zones,
            'categories' => $categories,
            'service_types' => $serviceTypes,
            'plan_allowance' => [
                'ads' => (int) $activeSubs->sum(fn ($s) => (int) $s->number_of_ads),
                'zones' => (int) $activeSubs->sum(fn ($s) => (int) $s->number_of_zone),
                'categories' => (int) $activeSubs->sum(fn ($s) => (int) $s->number_of_categories),
                'active_subscriptions' => $activeSubs->count(),
                'active_offers' => $activeOffersCount,
                'zones_used' => $zones->count(),
                'categories_used' => $categories->count(),
            ],
        ];
    }

    // ─────────────────────────────────────────────────────────────────────────
    // بطاقة الحساب / التوثيق
    // ─────────────────────────────────────────────────────────────────────────

    /**
     * سياق حساب المزوّد: حالة التوثيق (نفاذ/جوال/بريد)، السجل التجاري، نوع
     * الخدمة، عضو منذ، وقياس اكتمال الملف (0–100) من قائمة تحقّق موزونة.
     */
    public function accountProfile(int $providerId): array
    {
        $user = User::query()->find($providerId);

        if (!$user) {
            return [];
        }

        $sp = DB::table('service_providers')->where('user_id', $providerId)->first();

        $serviceTypeName = $sp && $sp->service_type_id
            ? optional(ServiceType::query()->find($sp->service_type_id))->name
            : null;

        $zoneName = $user->zone_id
            ? optional(Zone::query()->find($user->zone_id))->name_ar
            : null;

        $socialLinksCount = collect([
            $user->youtube, $user->snapchat, $user->instagram,
            $user->website, $user->tiktok, $user->twitter,
        ])->filter(fn ($v) => filled($v))->count();

        $crValid = $sp
            && filled($sp->commercial_registration_no)
            && !in_array($sp->commercial_registration_no, ['pending', 'commercial_registration_no'], true);

        $phoneVerified = (bool) ($user->is_phone_verified || $user->is_phone_verified_at);
        $emailVerified = (bool) ($user->email_verified_at || $user->is_email_verified);

        $checks = [
            filled($user->name),
            filled($user->image),
            filled($user->email) && $emailVerified,
            $phoneVerified,
            (bool) $user->account_verification,
            filled($user->unified_number) || filled($user->fal_license_number),
            $crValid,
            (bool) $user->zone_id,
            $serviceTypeName !== null,
            $socialLinksCount > 0,
        ];
        $completeness = (int) round(collect($checks)->filter()->count() / count($checks) * 100);

        return [
            'name' => $user->name,
            'image' => filled($user->image) ? $this->r2Url('profile/' . $user->image) : null,
            'has_image' => filled($user->image),
            'user_type' => $user->user_type,
            'member_since' => optional($user->created_at)->toDateString(),
            'account_verification' => (bool) $user->account_verification,
            'phone_verified' => $phoneVerified,
            'email_verified' => $emailVerified,
            'has_unified_number' => filled($user->unified_number),
            'has_fal_license' => filled($user->fal_license_number),
            'commercial_registration_no' => $crValid ? $sp->commercial_registration_no : null,
            'identity_type' => $sp->identity_type ?? null,
            'service_type_name' => $serviceTypeName,
            'zone_name' => $zoneName,
            'social_links_count' => $socialLinksCount,
            'profile_completeness' => $completeness,
        ];
    }

    // ─────────────────────────────────────────────────────────────────────────
    // مساعدات داخلية
    // ─────────────────────────────────────────────────────────────────────────

    /**
     * يصنّف مجموعة عروض (محمّلة مسبقًا بعلاقة latestSubscription) إلى نفس 5
     * تبويبات شاشة "خدماتي" بمنطقها الحرفي — وليس بعمود status وحده — كي تبقى
     * الأرقام مطابقة لما يراه المزوّد في القائمة نفسها.
     */
    private function classifyOffers(Collection $offers): array
    {
        $counts = [
            'active_offers_count' => 0,
            'pending_offers_count' => 0,
            'unpaid_offers_count' => 0,
            'rejected_offers_count' => 0,
            'expired_offers_count' => 0,
        ];

        foreach ($offers as $offer) {
            $isExpired = $offer->expiry_date && Carbon::parse($offer->expiry_date)->isPast();
            $paymentStatus = $offer->latestSubscription?->payment_status;

            if ($offer->status === 'accept' && !$isExpired) {
                $counts['active_offers_count']++;
            } elseif ($offer->status === 'pending' && in_array($paymentStatus, ['unpaid', 'failed'], true)) {
                $counts['unpaid_offers_count']++;
            } elseif ($offer->status === 'pending') {
                $counts['pending_offers_count']++;
            } elseif ($offer->status === 'rejected') {
                $counts['rejected_offers_count']++;
            } elseif ($offer->status === 'cancelled' || $isExpired) {
                $counts['expired_offers_count']++;
            }
        }

        return $counts;
    }

    /**
     * لا يجوز تقييد أعمدة latestSubscription هنا (نفس تحذير
     * ServiceCatalogService::baseRelationsQuery): يولّد "Column 'offer_id' in
     * field list is ambiguous" مع hasOne->latestOfMany().
     */
    private function ownOffersWithSubscription(int $providerId)
    {
        return $this->ownOffersQuery($providerId)
            ->select('id', 'status', 'expiry_date', 'created_at')
            ->with('latestSubscription');
    }

    /**
     * كل عروض المزوّد المملوكة له فعليًا — نفس Offer::scopeOwnedBy() الذي
     * تعتمد عليه شاشة "خدماتي" (يدعم offer_owner كرقم مباشر عبر التطبيق و
     * offer_owner='me' عبر pivot في النظام القديم على الويب).
     */
    private function ownOffersQuery(int $providerId)
    {
        return Offer::query()->ownedBy($providerId);
    }

    /** @return array<int> معرّفات عروض المزوّد (مُخزَّنة مؤقتًا داخل الطلب) */
    private function ownOfferIds(int $providerId): array
    {
        return $this->ownOfferIdsCache[$providerId] ??= $this->ownOffersQuery($providerId)->pluck('id')->all();
    }

    private function viewsCount(array $offerIds, ?Carbon $since = null, ?Carbon $until = null): int
    {
        if (empty($offerIds)) {
            return 0;
        }

        return (int) OfferView::query()
            ->whereIn('offer_id', $offerIds)
            ->when($since, fn ($q) => $q->where('viewed_date', '>=', $since->toDateString()))
            ->when($until, fn ($q) => $q->where('viewed_date', '<=', $until->toDateString()))
            ->count();
    }

    /** @return \Illuminate\Support\Collection<int, int> views مفهرسة بـ offer_id */
    private function viewsCountPerOffer(array $offerIds, ?Carbon $since, ?Carbon $until): Collection
    {
        if (empty($offerIds)) {
            return collect();
        }

        return OfferView::query()
            ->selectRaw('offer_id, COUNT(*) as views')
            ->whereIn('offer_id', $offerIds)
            ->when($since, fn ($q) => $q->where('viewed_date', '>=', $since->toDateString()))
            ->when($until, fn ($q) => $q->where('viewed_date', '<=', $until->toDateString()))
            ->groupBy('offer_id')
            ->pluck('views', 'offer_id');
    }

    /**
     * COUNT()/SUM() الخام تصل عبر PDO كسلاسل نصية — نضمن نوعًا عدديًا حقيقيًا
     * في استجابة JSON (كسر تحليل نموذج الجوال سابقًا بسبب هذا بالضبط).
     */
    private function castViewRow($row): void
    {
        $row->offers_count = (int) ($row->offers_count ?? 0);
        $row->total_views = (int) ($row->total_views ?? 0);
    }

    private function parseDateOrNull(?string $raw): ?Carbon
    {
        if (!filled($raw)) {
            return null;
        }

        try {
            return Carbon::parse($raw);
        } catch (\Throwable) {
            return null;
        }
    }

    private function r2Url(string $path): string
    {
        return rtrim((string) Helpers::get_business_settings('r2_public_url'), '/') . '/' . ltrim($path, '/');
    }
}
