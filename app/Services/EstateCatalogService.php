<?php

namespace App\Services;

use App\Models\Estate;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

/**
 * خدمة بحث/تصفح العقارات المُحسّنة (أداء + فلترة + بحث + Pagination حقيقي).
 *
 * لماذا خدمة جديدة منفصلة عن App\Helpers\EstateLogic بدل تعديله مباشرة؟
 * - EstateLogic::get_estate() يستخدم dataLimit افتراضي = 10000 سجل بدون
 *   صفحات حقيقية في أكثر من موضع (مثل Api\v1\EstateController::get_estate)،
 *   وهو خطر أداء واضح على جدول كبير (جلب 10 آلاف صف وتنسيقها يدويًا في كل
 *   طلب). تعديل EstateLogic مباشرة كان سيغيّر سلوك كل المسارات القديمة
 *   المستخدمة فعليًا من تطبيقات موبايل منشورة بالفعل، لذلك تم إنشاء مسار جديد
 *   موازٍ (EstateSearchController + هذه الخدمة) بدل التعديل، مع ترك كل
 *   المسارات القديمة كما هي تمامًا لضمان التوافق الرجعي الكامل.
 * - فلاتر المدينة/الحي القديمة تُبنى بـ LIKE حر في كل طلب بدون أي تخزين
 *   مؤقت. هنا تُخزَّن نتيجة كل تركيبة فلاتر فريدة لمدة قصيرة (CACHE_TTL) مع
 *   إبطال فوري عند أي إضافة/تعديل/حذف لعقار (انظر EstateObserver)، بنفس
 *   فلسفة ServiceCatalogService المستخدمة لكتالوج الخدمات.
 *
 * ⚠️ فرق سلوك مقصود عن EstateLogic القديم: scopeNotExpired() في موديل Estate
 * يُظهر العقارات التي لم يُحدَّد لها end_date أصلًا (NULL/فاضي)، بعكس الشرط
 * القديم STR_TO_DATE(NULL,...) الذي كان يُقيَّم دائمًا إلى NULL/false في SQL
 * فيُخفي هذه العقارات بالكامل من النتائج بصمت. هذا تغيير مقصود ومُوثَّق (راجع
 * تعليق scopeNotExpired في موديل Estate) لتفادي اختفاء العقارات القديمة التي
 * أُضيفت قبل ربط نظام الباقات/التراخيص — قد يحتاج هذا قرار منتج إن كان
 * مطلوبًا تطابق تام مع السلوك القديم.
 */
class EstateCatalogService
{
    private const CACHE_VERSION_KEY = 'estates_catalog:cache_version';
    private const CACHE_TTL = 120; // 2 دقائق
    private const DEFAULT_PER_PAGE = 15;
    private const MAX_PER_PAGE = 50;

    public function list(array $filters): LengthAwarePaginator
    {
        $perPage = max(1, min((int) ($filters['per_page'] ?? self::DEFAULT_PER_PAGE), self::MAX_PER_PAGE));
        $page = max(1, (int) ($filters['page'] ?? 1));

        $cacheKey = $this->buildCacheKey($filters, $perPage, $page);

        return Cache::remember($cacheKey, self::CACHE_TTL, function () use ($filters, $perPage, $page) {
            return $this->buildQuery($filters)->paginate($perPage, ['*'], 'page', $page);
        });
    }

    public function find(int $id): ?Estate
    {
        $cacheKey = 'estates_catalog:show:' . $id . ':' . $this->getCacheVersion();

        return Cache::remember($cacheKey, self::CACHE_TTL, function () use ($id) {
            return Estate::query()
                ->with(['category:id,name,name_ar', 'zone:id,name,name_ar', 'users:id,name,phone,image'])
                ->active()
                ->find($id);
        });
    }

    public static function flushCache(): void
    {
        $current = (int) Cache::get(self::CACHE_VERSION_KEY, 1);
        Cache::forever(self::CACHE_VERSION_KEY, $current + 1);
    }

    private function buildQuery(array $filters)
    {
        $query = Estate::query()
            ->with(['category:id,name,name_ar', 'zone:id,name,name_ar', 'users:id,name,phone,image'])
            ->active()
            ->notExpired()
            ->filterByCategory($filters['category_id'] ?? null)
            ->filterByZone($filters['zone_id'] ?? null)
            ->filterByCity($filters['city'] ?? null)
            ->filterByDistrict($filters['districts'] ?? null)
            ->filterBySpace($filters['space'] ?? null)
            ->filterByAdvertisementType($filters['advertisement_type'] ?? null)
            ->filterByUser($filters['user_id'] ?? null)
            ->onlyWithArView($this->isTruthy($filters['ar_path'] ?? null))
            ->searchKeyword($filters['keyword'] ?? null);

        if (!empty($filters['north_east_lat']) && !empty($filters['south_west_lat'])) {
            $query->withinMapBounds(
                $filters['north_east_lat'],
                $filters['north_east_lng'],
                $filters['south_west_lat'],
                $filters['south_west_lng']
            );
        }

        if (!empty($filters['lat']) && !empty($filters['lng'])) {
            $query->nearby($filters['lat'], $filters['lng'], $filters['radius_km'] ?? 10);
        }

        $this->applySort($query, $filters['sort_by'] ?? 'latest');

        return $query;
    }

    private function applySort($query, string $sortBy): void
    {
        match ($sortBy) {
            'oldest' => $query->orderBy('created_at', 'asc'),
            // "price + 0": عمود price نصّي، وهذا يحوّله لرقم بدون regex (انظر
            // نفس الأسلوب والتفسير في EstateReportService::averagePrice).
            'price_asc' => $query->orderByRaw('(price + 0) ASC'),
            'price_desc' => $query->orderByRaw('(price + 0) DESC'),
            'most_viewed' => $query->orderBy('view', 'desc'),
            'nearest' => null, // الترتيب بالأقرب يُضبط تلقائيًا داخل scopeNearby
            default => $query->orderBy('id', 'desc'),
        };
    }

    private function isTruthy($value): bool
    {
        return $value === '1' || $value === 1 || $value === true;
    }

    private function buildCacheKey(array $filters, int $perPage, int $page): string
    {
        $normalized = [
            'category_id' => $filters['category_id'] ?? null,
            'zone_id' => $filters['zone_id'] ?? null,
            'city' => $filters['city'] ?? null,
            'districts' => $filters['districts'] ?? null,
            'space' => $filters['space'] ?? null,
            'advertisement_type' => $filters['advertisement_type'] ?? null,
            'user_id' => $filters['user_id'] ?? null,
            'ar_path' => $filters['ar_path'] ?? null,
            'keyword' => mb_strtolower(trim((string) ($filters['keyword'] ?? ''))),
            'bounds' => [
                $filters['north_east_lat'] ?? null,
                $filters['north_east_lng'] ?? null,
                $filters['south_west_lat'] ?? null,
                $filters['south_west_lng'] ?? null,
            ],
            'near' => [
                $filters['lat'] ?? null,
                $filters['lng'] ?? null,
                $filters['radius_km'] ?? null,
            ],
            'sort_by' => $filters['sort_by'] ?? 'latest',
            'per_page' => $perPage,
            'page' => $page,
        ];

        return 'estates_catalog:list:' . $this->getCacheVersion() . ':' . md5(json_encode($normalized));
    }

    private function getCacheVersion(): int
    {
        return (int) Cache::get(self::CACHE_VERSION_KEY, 1);
    }
}
