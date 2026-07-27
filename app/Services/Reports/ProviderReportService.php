<?php

namespace App\Services\Reports;

use App\Models\Category;
use App\Models\Estate;
use App\Models\Offer;
use App\Models\ServiceProviderSubscription;
use App\Models\Zone;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * إحصائيات لوحة تحكم مزود الخدمة (للعروض الذاتية التي أنشأها بنفسه
 * offer_owner='me').
 *
 * هذا الكلاس استُخرج من منطق كان مكتوبًا بالكامل داخل
 * Dashboard\serviceProvider\DashboardController::dashboard() (أكثر من 80
 * سطرًا من الاستعلامات المتداخلة مباشرة في الكنترولر، بدون أي فصل)، مع
 * تصحيح خلل مهم في النطاق (scoping) بالطريق:
 *
 * 🐛 الخلل الذي تم تصحيحه:
 * كانت كل الاستعلامات الأصلية تُصفّي فقط بـ `offers.offer_owner = 'me'` دون
 * أي ربط بهوية مزود الخدمة الحالي (auth user). هذا يعني عمليًا أن أي مزود
 * خدمة كان يرى إحصائيات مجمّعة لكل العروض الذاتية (offer_owner='me') الخاصة
 * بـ **كل** مزودي الخدمة على المنصة، وليس عروضه الخاصة فقط فقط — أي تسريب
 * بيانات بين الحسابات (كل مزود يرى أرقام أكبر من الحقيقية، ومخلوطة مع أرقام
 * منافسيه). تم إصلاحه هنا بربط كل استعلام بجدول الـ pivot (offer_user)
 * وتصفيته بـ user_id الفعلي للمزود الممرر للدالة كمعامل صريح، بدل الاعتماد
 * على auth() داخل الخدمة نفسها (ما يجعلها قابلة لإعادة الاستخدام من الويب
 * و API على حد سواء بدون أي اعتماد ضمني على سياق الجلسة).
 */
class ProviderReportService
{
    public function summary(int $providerId): array
    {
        return [
            'approved_offers_count' => $this->ownOffersQuery($providerId)
                // 'accpet' خطأ إملائي قديم محفوظ بقصد للتوافق الرجعي مع بيانات
                // سابقة قد تحمل هذه القيمة الخاطئة فعليًا في قاعدة البيانات.
                ->whereIn('status', ['accept', 'accpet'])
                ->count(),

            'pending_offers_count' => $this->ownOffersQuery($providerId)
                ->where('status', 'pending')
                ->count(),

            'expired_offers_count' => $this->ownOffersQuery($providerId)
                ->whereDate('expiry_date', '<', now())
                ->count(),

            'total_views' => $this->totalViewsForProviderOffers($providerId),
        ];
    }

    public function viewsByZone(int $providerId): Collection
    {
        [$categoryIds, $zoneIds] = $this->ownOfferCategoryAndZoneIds($providerId);

        if (empty($zoneIds)) {
            return collect();
        }

        return Zone::query()
            ->select('zones.id', 'zones.name')
            ->selectRaw('COUNT(DISTINCT estates.id) as estates_count')
            ->selectRaw('SUM(estates.view) as total_views')
            ->join('estates', 'estates.zone_id', '=', 'zones.id')
            ->whereIn('estates.zone_id', $zoneIds)
            ->when(!empty($categoryIds), fn ($q) => $q->whereIn('estates.category_id', $categoryIds))
            ->groupBy('zones.id', 'zones.name')
            ->orderByDesc('total_views')
            ->get();
    }

    public function viewsByCategory(int $providerId): Collection
    {
        [$categoryIds, $zoneIds] = $this->ownOfferCategoryAndZoneIds($providerId);

        if (empty($categoryIds)) {
            return collect();
        }

        return Category::query()
            ->select('categories.id', 'categories.name')
            ->selectRaw('COUNT(DISTINCT estates.id) as estates_count')
            ->selectRaw('SUM(estates.view) as total_views')
            ->join('estates', 'estates.category_id', '=', 'categories.id')
            ->whereIn('estates.category_id', $categoryIds)
            ->when(!empty($zoneIds), fn ($q) => $q->whereIn('estates.zone_id', $zoneIds))
            ->groupBy('categories.id', 'categories.name')
            ->orderByDesc('total_views')
            ->get();
    }

    public function activeSubscriptions(int $providerId): Collection
    {
        return ServiceProviderSubscription::query()
            ->where('user_id', $providerId)
            ->with('servicePlan:id,name,price')
            ->orderBy('expiry_date')
            ->get();
    }

    /**
     * عروض المزود الذاتية (offer_owner='me') المرتبطة فعليًا بهويته عبر
     * pivot جدول offer_user — هذا هو الإصلاح الجوهري المذكور أعلى الكلاس.
     */
    private function ownOffersQuery(int $providerId)
    {
        return Offer::query()
            ->where('offer_owner', 'me')
            ->whereHas('serviceProviders', function ($q) use ($providerId) {
                $q->where('users.id', $providerId);
            });
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
     * المرتبطة بعروض المزود الذاتية فقط (وليس بكل العروض الذاتية على المنصة).
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
