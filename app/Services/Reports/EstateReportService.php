<?php

namespace App\Services\Reports;

use App\Models\Estate;
use App\Services\Reports\Concerns\BuildsTimeSeries;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

/**
 * إحصائيات العقارات على مستوى المنصة بالكامل (لوحة تحكم الإدارة + API).
 *
 * كل دالة هنا تُغلَّف بكاش قصير الأجل (5 دقائق) لأن هذه استعلامات تجميعية
 * (aggregation) على جدول estates قد تكون مكلفة، وبيانات لوحة التحكم لا
 * تحتاج دقة لحظية بالثانية. لا حاجة لإبطال الكاش يدويًا عند كل تعديل على
 * عقار واحد (بخلاف EstateCatalogService) لأن التأثير على المعدّلات
 * والإحصائيات العامة من تعديل عقار واحد غير ملحوظ عمليًا، والـ TTL القصير
 * كافٍ لتحديثها تلقائيًا.
 */
class EstateReportService
{
    use BuildsTimeSeries;

    private const CACHE_TTL = 300; // 5 دقائق
    private const CACHE_PREFIX = 'reports:estates:';

    public function overview(): array
    {
        return Cache::remember(self::CACHE_PREFIX . 'overview', self::CACHE_TTL, function () {
            $now = Carbon::now();

            return [
                'total' => Estate::query()->count(),
                'active' => Estate::query()->active()->count(),
                'inactive' => Estate::query()->where('status', '!=', 'active')->count(),
                'added_today' => Estate::query()->whereDate('created_at', $now->toDateString())->count(),
                'added_this_week' => Estate::query()->where('created_at', '>=', $now->copy()->startOfWeek())->count(),
                'added_this_month' => Estate::query()->where('created_at', '>=', $now->copy()->startOfMonth())->count(),
                'total_views' => (int) Estate::query()->sum('view'),
                'average_price' => $this->averagePrice(),
                'with_3d_view' => Estate::query()->whereNotNull('ar_path')->where('ar_path', '!=', '')->count(),
            ];
        });
    }

    public function byCategory(int $limit = 20): Collection
    {
        return Cache::remember(self::CACHE_PREFIX . 'by_category:' . $limit, self::CACHE_TTL, function () use ($limit) {
            return Estate::query()
                ->select('category_id')
                ->selectRaw('COUNT(*) as total')
                ->selectRaw('SUM(view) as total_views')
                ->whereNotNull('category_id')
                ->groupBy('category_id')
                ->with('category:id,name,name_ar')
                ->orderByDesc('total')
                ->limit($limit)
                ->get()
                ->map(fn ($row) => [
                    'category_id' => $row->category_id,
                    'category_name' => $row->category?->name,
                    'category_name_ar' => $row->category?->name_ar,
                    'total' => (int) $row->total,
                    'total_views' => (int) $row->total_views,
                ]);
        });
    }

    public function byZone(int $limit = 20): Collection
    {
        return Cache::remember(self::CACHE_PREFIX . 'by_zone:' . $limit, self::CACHE_TTL, function () use ($limit) {
            return Estate::query()
                ->select('zone_id')
                ->selectRaw('COUNT(*) as total')
                ->selectRaw('SUM(view) as total_views')
                ->whereNotNull('zone_id')
                ->groupBy('zone_id')
                ->with('zone:id,name,name_ar')
                ->orderByDesc('total')
                ->limit($limit)
                ->get()
                ->map(fn ($row) => [
                    'zone_id' => $row->zone_id,
                    'zone_name' => $row->zone?->name,
                    'zone_name_ar' => $row->zone?->name_ar,
                    'total' => (int) $row->total,
                    'total_views' => (int) $row->total_views,
                ]);
        });
    }

    public function byCity(int $limit = 15): Collection
    {
        return Cache::remember(self::CACHE_PREFIX . 'by_city:' . $limit, self::CACHE_TTL, function () use ($limit) {
            return Estate::query()
                ->select('city')
                ->selectRaw('COUNT(*) as total')
                ->whereNotNull('city')
                ->where('city', '!=', '')
                ->groupBy('city')
                ->orderByDesc('total')
                ->limit($limit)
                ->get();
        });
    }

    public function byAdvertisementType(): Collection
    {
        return Cache::remember(self::CACHE_PREFIX . 'by_ad_type', self::CACHE_TTL, function () {
            return Estate::query()
                ->select('advertisement_type')
                ->selectRaw('COUNT(*) as total')
                ->groupBy('advertisement_type')
                ->orderByDesc('total')
                ->get();
        });
    }

    /**
     * بيانات منحنى نمو عدد العقارات المضافة عبر الزمن، جاهزة للاستخدام
     * المباشر في رسم بياني (Chart.js وغيره): {labels: [...], values: [...]}.
     * period: day | week | month.
     */
    public function growthOverTime(string $period = 'month', int $count = 12): array
    {
        [$period, $count] = $this->normalizePeriodAndCount($period, $count);

        return Cache::remember(self::CACHE_PREFIX . "growth:{$period}:{$count}", self::CACHE_TTL, function () use ($period, $count) {
            $format = $this->periodDateFormat($period);
            $from = $this->periodStartDate($period, $count);

            $rows = Estate::query()
                ->selectRaw("DATE_FORMAT(created_at, '{$format}') as period_label")
                ->selectRaw('COUNT(*) as total')
                ->where('created_at', '>=', $from)
                ->groupBy('period_label')
                ->orderBy('period_label')
                ->get()
                ->pluck('total', 'period_label');

            return $this->fillMissingPeriods($rows, $period, $count);
        });
    }

    public function topViewed(int $limit = 10): Collection
    {
        return Cache::remember(self::CACHE_PREFIX . 'top_viewed:' . $limit, self::CACHE_TTL, function () use ($limit) {
            return Estate::query()
                ->select('id', 'short_description', 'city', 'view', 'category_id', 'zone_id', 'created_at')
                ->with(['category:id,name,name_ar', 'zone:id,name,name_ar'])
                ->orderByDesc('view')
                ->limit($limit)
                ->get();
        });
    }

    public function mostActiveAgents(int $limit = 10): Collection
    {
        return Cache::remember(self::CACHE_PREFIX . 'top_agents:' . $limit, self::CACHE_TTL, function () use ($limit) {
            return Estate::query()
                ->select('user_id')
                ->selectRaw('COUNT(*) as total_estates')
                ->selectRaw('SUM(view) as total_views')
                ->whereNotNull('user_id')
                ->groupBy('user_id')
                ->with('users:id,name,phone,membership_type')
                ->orderByDesc('total_estates')
                ->limit($limit)
                ->get()
                ->map(fn ($row) => [
                    'user_id' => $row->user_id,
                    'name' => $row->users?->name,
                    'phone' => $row->users?->phone,
                    'membership_type' => $row->users?->membership_type,
                    'total_estates' => (int) $row->total_estates,
                    'total_views' => (int) $row->total_views,
                ]);
        });
    }

    /**
     * عمود price مخزّن كنص (string) لا رقم، وقد يحتوي على فراغ أو نص غير
     * رقمي بالخطأ. نستخدم "price + 0" بدل CAST/REGEXP لأن MySQL يحوّل أي
     * نص يبدأ بأرقام إلى قيمته الرقمية تلقائيًا (ويُرجع 0 بهدوء لما هو غير
     * رقمي تمامًا)، دون الحاجة لـ regex معقّد عرضة لأخطاء escaping.
     */
    private function averagePrice(): float
    {
        $value = Estate::query()
            ->whereNotNull('price')
            ->where('price', '!=', '')
            ->avg(DB::raw('price + 0'));

        return round((float) $value, 2);
    }

    public static function flushCache(): void
    {
        Cache::forget(self::CACHE_PREFIX . 'overview');
        // باقي المفاتيح متغيرة (تتضمن limit/period داخل اسم المفتاح)، لذلك من
        // الأسهل تركها تنتهي طبيعيًا حسب TTL القصير (5 دقائق) بدل تتبّع كل
        // مفتاح محتمل بالتفصيل.
    }
}
