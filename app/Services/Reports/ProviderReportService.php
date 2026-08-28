<?php

namespace App\Services\Reports;

use App\Models\Category;
use App\Models\Estate;
use App\Models\Offer;
use App\Models\ServiceProviderSubscription;
use App\Models\Zone;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * إحصائيات لوحة تحكم مزود الخدمة (لكل عروضه المملوكة فعليًا، بصرف النظر عن
 * قناة الإنشاء).
 *
 * هذا الكلاس استُخرج من منطق كان مكتوبًا بالكامل داخل
 * Dashboard\serviceProvider\DashboardController::dashboard() (أكثر من 80
 * سطرًا من الاستعلامات المتداخلة مباشرة في الكنترولر، بدون أي فصل)، مع
 * تصحيح خلل مهم في النطاق (scoping) بالطريق:
 *
 * 🐛 الخلل الذي تم تصحيحه (تسريب بيانات بين الحسابات):
 * كانت كل الاستعلامات الأصلية تُصفّي فقط بـ `offers.offer_owner = 'me'` دون
 * أي ربط بهوية مزود الخدمة الحالي (auth user). هذا يعني عمليًا أن أي مزود
 * خدمة كان يرى إحصائيات مجمّعة لكل العروض الذاتية (offer_owner='me') الخاصة
 * بـ **كل** مزودي الخدمة على المنصة، وليس عروضه الخاصة فقط — أي تسريب بيانات
 * بين الحسابات.
 *
 * 🐛 خلل ثانٍ تم اكتشافه وتصحيحه لاحقًا (نطاق ناقص):
 * الإصلاح الأول ربط الاستعلامات بـ pivot (offer_user) لكنه ظل يقتصر على
 * offer_owner='me' فقط (قناة الويب القديمة لمزود الخدمة)، متجاهلاً كل العروض
 * التي يُنشئها المزود عبر تطبيق الجوال حاليًا (offer_owner = رقم المستخدم
 * مباشرة، عبر ServiceManagementController). كانت النتيجة أرقامًا شبه صفرية
 * لأي مزود يستخدم التطبيق. تم توحيد النطاق هنا مع Offer::scopeOwnedBy()
 * — نفس الـ scope الذي تعتمد عليه شاشة "خدماتي" نفسها
 * (ServiceCatalogService::buildBaseQuery())، فيبقى الاثنان متطابقين دومًا.
 */
class ProviderReportService
{
    /**
     * يصنّف عروض المزود إلى نفس 5 التبويبات المعروضة فعليًا في شاشة "خدماتي"
     * بالتطبيق (my_services_screen.dart)، بنفس منطقها الحرفي — وليس فقط
     * بعمود status المفرد — كي تبقى أرقام هذه الإحصائيات مطابقة دائمًا لما
     * يراه المزود في تبويبات القائمة نفسها:
     * - نشط: status=accept وغير منتهٍ
     * - قيد المراجعة: status=pending وحالة دفع الاشتراك ليست unpaid/failed
     * - غير مدفوعة: status=pending وحالة دفع الاشتراك unpaid أو failed
     * - مرفوض: status=rejected
     * - منتهي: status=cancelled أو تاريخ الانتهاء ماضٍ
     */
    public function summary(int $providerId): array
    {
        $offers = $this->ownOffersWithSubscription($providerId)->get();

        return $this->classifyOffers($offers) + [
            'total_offers_count' => $offers->count(),
            'total_views' => $this->totalViewsForProviderOffers($providerId),
        ];
    }

    /**
     * نفس تصنيف summary() لكن مقيَّدًا بعروض أُنشئت خلال فترة زمنية محددة
     * (created_at بين $from و$to، وأي منهما null يعني بلا حد من تلك الجهة) —
     * تغذّي قسم "خلال الفترة المحددة" في شاشة الإحصائيات، بينما summary()
     * تبقى بلا تغيير (تمثّل الحالة الآنية الكاملة التي تعتمد عليها الشبكة
     * العلوية دائمًا بصرف النظر عن الفترة المختارة).
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

    /**
     * اشتراكات المزود المُنشأة خلال نفس الفترة الزمنية — عدد ومبالغ (كل
     * الاشتراكات + المدفوعة فقط)، تغذّي نفس قسم "خلال الفترة المحددة".
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

    /**
     * يصنّف مجموعة عروض (محمَّلة مسبقًا بعلاقة latestSubscription) إلى نفس 5
     * التبويبات المعروضة فعليًا في شاشة "خدماتي" بالتطبيق
     * (my_services_screen.dart)، بنفس منطقها الحرفي — وليس فقط بعمود status
     * المفرد — كي تبقى أرقام هذه الإحصائيات مطابقة دائمًا لما يراه المزود في
     * تبويبات القائمة نفسها:
     * - نشط: status=accept وغير منتهٍ
     * - قيد المراجعة: status=pending وحالة دفع الاشتراك ليست unpaid/failed
     * - غير مدفوعة: status=pending وحالة دفع الاشتراك unpaid أو failed
     * - مرفوض: status=rejected
     * - منتهي: status=cancelled أو تاريخ الانتهاء ماضٍ
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
     * لا يجوز تقييد أعمدة latestSubscription هنا (راجع نفس التحذير في
     * ServiceCatalogService::baseRelationsQuery()): يولّد خطأ SQL
     * "Column 'offer_id' in field list is ambiguous" عند دمجه مع
     * hasOne->latestOfMany().
     */
    private function ownOffersWithSubscription(int $providerId)
    {
        return $this->ownOffersQuery($providerId)
            ->select('id', 'status', 'expiry_date', 'created_at')
            ->with('latestSubscription');
    }

    public function viewsByZone(int $providerId): Collection
    {
        [$categoryIds, $zoneIds] = $this->ownOfferCategoryAndZoneIds($providerId);

        if (empty($zoneIds)) {
            return collect();
        }

        return Zone::query()
            ->select('zones.id', 'zones.name', 'zones.name_ar')
            ->selectRaw('COUNT(DISTINCT estates.id) as estates_count')
            ->selectRaw('SUM(estates.view) as total_views')
            ->join('estates', 'estates.zone_id', '=', 'zones.id')
            ->whereIn('estates.zone_id', $zoneIds)
            ->when(!empty($categoryIds), fn ($q) => $q->whereIn('estates.category_id', $categoryIds))
            ->groupBy('zones.id', 'zones.name', 'zones.name_ar')
            ->orderByDesc('total_views')
            ->get()
            ->each($this->castCounts(...));
    }

    public function viewsByCategory(int $providerId): Collection
    {
        [$categoryIds, $zoneIds] = $this->ownOfferCategoryAndZoneIds($providerId);

        if (empty($categoryIds)) {
            return collect();
        }

        return Category::query()
            ->select('categories.id', 'categories.name', 'categories.name_ar')
            ->selectRaw('COUNT(DISTINCT estates.id) as estates_count')
            ->selectRaw('SUM(estates.view) as total_views')
            ->join('estates', 'estates.category_id', '=', 'categories.id')
            ->whereIn('estates.category_id', $categoryIds)
            ->when(!empty($zoneIds), fn ($q) => $q->whereIn('estates.zone_id', $zoneIds))
            ->groupBy('categories.id', 'categories.name', 'categories.name_ar')
            ->orderByDesc('total_views')
            ->get()
            ->each($this->castCounts(...));
    }

    /**
     * COUNT()/SUM() الخام (selectRaw) تصل عبر PDO كسلاسل نصية وليست أعدادًا
     * (مثال: "805786" بدل 805786) — فتُسلسَل إلى JSON كسلاسل نصية أيضًا،
     * ما يكسر أي طرف عميل يتوقع نوع عددي صراحة (كما حدث فعليًا مع نموذج
     * الإحصائيات في تطبيق الجوال: فشل تحليل JSON بصمت لأن total_views وصل
     * كسلسلة نصية بينما الحقل معرَّف كـ int في Dart). التصريح هنا يضمن نوعًا
     * عدديًا حقيقيًا في استجابة JSON.
     */
    private function castCounts($row): void
    {
        $row->estates_count = (int) $row->estates_count;
        $row->total_views = (int) $row->total_views;
    }

    /**
     * كل اشتراكات المزود (وليس "النشطة" فقط كما كان اسم الدالة السابق يوحي —
     * الاسم كان مضللاً: كانت تُعيد كل الصفوف بلا أي تصفية بحالة الاشتراك).
     * الأحدث أولاً (created_at desc) كي يسهل على الواجهة اعتبار أول عنصر هو
     * "الباقة الحالية" دون فرز إضافي في الطرف الآخر.
     */
    public function subscriptionsOverview(int $providerId): Collection
    {
        return ServiceProviderSubscription::query()
            ->where('user_id', $providerId)
            ->with('servicePlan:id,name,price')
            ->orderByDesc('created_at')
            ->get();
    }

    /**
     * كل عروض المزود المملوكة له فعليًا — نفس Offer::scopeOwnedBy() الذي
     * تعتمد عليه شاشة "خدماتي" نفسها (ServiceCatalogService::buildBaseQuery)،
     * فيدعم قناتي الملكية معًا: offer_owner كرقم مستخدم مباشر (النظام الحالي
     * عبر التطبيق) و offer_owner='me' عبر pivot (النظام القديم عبر الويب).
     */
    private function ownOffersQuery(int $providerId)
    {
        return Offer::query()->ownedBy($providerId);
    }

    private function totalViewsForProviderOffers(int $providerId): int
    {
        [$categoryIds, $zoneIds] = $this->ownOfferCategoryAndZoneIds($providerId);

        if (empty($categoryIds) || empty($zoneIds)) {
            return 0;
        }

        return (int) Estate::query()
            ->whereIn('category_id', $categoryIds)
            ->whereIn('zone_id', $zoneIds)
            ->sum('view');
    }

    /**
     * @return array{0: array<int>, 1: array<int>} [أرقام الأقسام, أرقام المناطق]
     * المرتبطة بعروض هذا المزود فقط (وليس بكل عروض المنصة).
     */
    private function ownOfferCategoryAndZoneIds(int $providerId): array
    {
        $offerIds = $this->ownOffersQuery($providerId)->pluck('id');

        if ($offerIds->isEmpty()) {
            return [[], []];
        }

        $categoryIds = DB::table('category_offer')
            ->whereIn('offer_id', $offerIds)
            ->pluck('category_id')
            ->unique()
            ->values()
            ->all();

        $zoneIds = DB::table('offer_zone')
            ->whereIn('offer_id', $offerIds)
            ->pluck('zone_id')
            ->unique()
            ->values()
            ->all();

        return [$categoryIds, $zoneIds];
    }
}