<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Offer;
use App\Models\ServiceType;
use App\Models\Zone;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

/**
 * طبقة الخدمة الخاصة بـ "كتالوج الخدمات داخل العقارات".
 *
 * فلسفة الأداء (لتجنب الضغط على السيرفر):
 * 1) لا N+1: كل العلاقات (أقسام / مناطق / نوع الخدمة / مقدمي الخدمة) تُجلب بـ eager loading
 *    مع تحديد الأعمدة المطلوبة فقط.
 * 2) Cache بنسخة (Cache Versioning): كل نتائج القوائم تُخزن مع مفتاح يحتوي رقم نسخة
 *    عام (services_catalog:cache_version). أي تعديل/إضافة/حذف لعرض يرفع رقم النسخة فيُبطل
 *    كل نتائج الكاش القديمة فورًا دون الحاجة إلى Cache Tags.
 * 3) Pagination محدودة بحد أقصى لعدد العناصر بالصفحة لمنع طلبات ثقيلة.
 * 4) Scopes في الموديل (Offer) لإعادة استخدام منطق الفلترة وقابليته للاختبار.
 *
 * تحديث: دعم فلتر "مزود الخدمة" (provider_id) + قائمة الخدمات الخاصة بمقدّم خدمة
 * معيّن (owner_id) المستخدمة في شاشة "خدماتي" بالتطبيق.
 */
class ServiceCatalogService
{
    private const CACHE_VERSION_KEY = 'services_catalog:cache_version';

    /** مدة بقاء الكاش بالثواني لنتائج القوائم */
    private const CACHE_TTL = 180; // 3 دقائق

    /** مدة بقاء كاش بيانات الفلاتر (أبطأ تغيّرًا) */
    private const FILTERS_CACHE_TTL = 900; // 15 دقيقة

    private const DEFAULT_PER_PAGE = 15;
    private const MAX_PER_PAGE = 50;

    /**
     * جلب قائمة الخدمات مع الفلترة والترتيب والصفحات.
     *
     * ملاحظة مهمة: عند تمرير $filters['owner_id'] (لوحة "خدماتي") يجب أن يكون موجودًا في
     * مفتاح الكاش (buildListCacheKey يضمن ذلك) حتى لا يرى مزود خدمة نتائج مزود آخر.
     */
    public function list(array $filters): LengthAwarePaginator
    {
        $perPage = (int) ($filters['per_page'] ?? self::DEFAULT_PER_PAGE);
        $perPage = max(1, min($perPage, self::MAX_PER_PAGE));

        $page = (int) ($filters['page'] ?? 1);
        $page = max(1, $page);

        $cacheKey = $this->buildListCacheKey($filters, $perPage, $page);

        return Cache::remember($cacheKey, self::CACHE_TTL, function () use ($filters, $perPage, $page) {
            return $this->buildBaseQuery($filters)->paginate($perPage, ['*'], 'page', $page);
        });
    }

    /**
     * جلب خدمة واحدة بكل علاقاتها (للعرض التفصيلي).
     */
    public function find(int $offerId): ?Offer
    {
        $cacheKey = 'services_catalog:show:' . $offerId . ':' . $this->getCacheVersion();

        return Cache::remember($cacheKey, self::CACHE_TTL, function () use ($offerId) {
            return $this->baseRelationsQuery()->find($offerId);
        });
    }

    /**
     * بيانات بناء واجهة الفلترة: الأقسام، المناطق، أنواع الخدمات، مزودو الخدمة المتاحون،
     * ونطاق السعر المتاح حاليًا.
     */
    public function filtersData(): array
    {
        $cacheKey = 'services_catalog:filters_data:' . $this->getCacheVersion();

        return Cache::remember($cacheKey, self::FILTERS_CACHE_TTL, function () {
            $priceRange = Offer::query()
                ->approved()
                ->notExpired()
                ->selectRaw('MIN(service_price) as min_price, MAX(service_price) as max_price')
                ->first();

            return [
                'categories'    => Category::query()->select('id', 'name', 'name_ar')->orderBy('name')->get(),
                'zones'         => Zone::query()->select('id', 'name', 'name_ar')->where('status', 'active')->orderBy('name')->get(),
                'service_types' => ServiceType::query()->select('id', 'name')->orderBy('name')->get(),
                'providers'     => $this->getActiveProviders(),
                'price_range'   => [
                    'min' => (float) ($priceRange->min_price ?? 0),
                    'max' => (float) ($priceRange->max_price ?? 0),
                ],
            ];
        });
    }

    /**
     * يجب استدعاؤها بعد أي إضافة/تعديل/حذف لعرض خدمة، أو بعد ربط/فك ربط
     * categories()/zones()/serviceProviders() عبر attach/sync/detach، لإبطال كل
     * نتائج الكاش القديمة دفعة واحدة.
     */
    public static function flushCache(): void
    {
        $current = (int) Cache::get(self::CACHE_VERSION_KEY, 1);
        Cache::forever(self::CACHE_VERSION_KEY, $current + 1);
    }

    /**
     * مزودو الخدمة الذين لديهم على الأقل عرض واحد معتمد وغير منتهٍ ووافقوا عليه فعليًا
     * (status = accept على pivot الـ serviceProviders)، تُستخدم لتعبئة فلتر "مزود الخدمة".
     *
     * نمرّ عبر علاقة Eloquent (لا أسماء أعمدة/جداول pivot يدوية) لتبقى متوافقة حتى لو
     * تغيّر اسم جدول الـpivot، ونحدد فقط الأعمدة المطلوبة من users لتقليل الحمل.
     * (تنبيه: القائمة تشمل كل مزودي الخدمة على مستوى النظام، وليست مفلترة حسب أي
     * فلاتر أخرى محددة حاليًا في الطلب — هذا تبسيط متعمّد لتفادي تعقيد faceted-search).
     */
    private function getActiveProviders()
    {
        $providers = collect();

        Offer::query()
            ->approved()
            ->notExpired()
            ->with(['serviceProviders' => function ($q) {
                $q->select('users.id', 'users.name', 'users.phone', 'users.image')
                  ->wherePivot('status', 'accept');
            }])
            ->get(['id'])
            ->each(function (Offer $offer) use (&$providers) {
                $providers = $providers->merge($offer->serviceProviders);
            });

        return $providers->unique('id')->values();
    }

    private function buildBaseQuery(array $filters)
    {
        $query = $this->baseRelationsQuery();

        $ownerId = $filters['owner_id'] ?? null;

        if ($ownerId) {
            // لوحة "خدماتي": تُعرض كل حالات صاحب العرض (نشطة/قيد المراجعة/ملغية)
            $query->ownedBy($ownerId);
        } elseif ($filters['only_active'] ?? true) {
            $query->approved()->notExpired();
        }

        $query
            ->forCategories($filters['category_id'] ?? [])
            ->forZones($filters['zone_id'] ?? [])
            ->forServiceTypes($filters['service_type_id'] ?? [])
            ->forProviders($filters['provider_id'] ?? [])
            ->offerType($filters['offer_type'] ?? null)
            ->priceBetween($filters['min_price'] ?? null, $filters['max_price'] ?? null)
            ->discountBetween($filters['min_discount'] ?? null, $filters['max_discount'] ?? null)
            ->search($filters['search'] ?? null);

        $this->applySort($query, $filters['sort_by'] ?? 'latest');

        return $query;
    }

    /**
     * استعلام أساسي محدد الأعمدة + eager loading للعلاقات بأعمدة محدودة فقط،
     * هذا هو جوهر تجنّب الضغط على قاعدة البيانات.
     */
    private function baseRelationsQuery()
    {
        return Offer::query()
            ->select([
                'id', 'title', 'image', 'expiry_date', 'service_price', 'discount',
                'offer_type', 'description', 'service_type_id', 'status',
                'offer_owner', 'phone_provider', 'created_at',
            ])
            ->with([
                'categories:id,name,name_ar',
                'zones:id,name,name_ar',
                'serviceType:id,name',
                // لا نعرض إلا مزودي الخدمة الذين وافقوا فعليًا (status = accept)
                'serviceProviders' => function ($q) {
                    $q->select(
                        'users.id', 'users.name', 'users.phone', 'users.snapchat',
                        'users.instagram', 'users.website', 'users.tiktok',
                        'users.twitter', 'users.image'
                    )->wherePivot('status', 'accept');
                },
            ]);
    }

    private function applySort($query, string $sortBy): void
    {
        match ($sortBy) {
            'oldest'        => $query->orderBy('created_at', 'asc'),
            'price_asc'     => $query->orderBy('service_price', 'asc'),
            'price_desc'    => $query->orderBy('service_price', 'desc'),
            'discount_desc' => $query->orderBy('discount', 'desc'),
            'expiry_soon'   => $query->orderBy('expiry_date', 'asc'),
            default         => $query->orderBy('created_at', 'desc'),
        };
    }

    private function buildListCacheKey(array $filters, int $perPage, int $page): string
    {
        $normalized = [
            'category_id'     => $this->normalizeIds($filters['category_id'] ?? []),
            'zone_id'         => $this->normalizeIds($filters['zone_id'] ?? []),
            'service_type_id' => $this->normalizeIds($filters['service_type_id'] ?? []),
            'provider_id'     => $this->normalizeIds($filters['provider_id'] ?? []),
            // مهم: owner_id يجب أن يكون ضمن المفتاح، حتى لا يشترك مزودو الخدمة بكاش واحد
            'owner_id'        => $filters['owner_id'] ?? null,
            'offer_type'      => $filters['offer_type'] ?? null,
            'min_price'       => $filters['min_price'] ?? null,
            'max_price'       => $filters['max_price'] ?? null,
            'min_discount'    => $filters['min_discount'] ?? null,
            'max_discount'    => $filters['max_discount'] ?? null,
            'search'          => mb_strtolower(trim((string) ($filters['search'] ?? ''))),
            'sort_by'         => $filters['sort_by'] ?? 'latest',
            'only_active'     => (bool) ($filters['only_active'] ?? true),
            'per_page'        => $perPage,
            'page'            => $page,
        ];

        return 'services_catalog:list:' . $this->getCacheVersion() . ':' . md5(json_encode($normalized));
    }

    private function normalizeIds($ids): array
    {
        $ids = is_array($ids) ? $ids : [];
        $ids = array_values(array_unique(array_map('intval', $ids)));
        sort($ids);

        return $ids;
    }

    private function getCacheVersion(): int
    {
        return (int) Cache::get(self::CACHE_VERSION_KEY, 1);
    }
}