<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Offer;
use App\Models\ServiceType;
use App\Models\Zone;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ServiceCatalogService
{
    private const CACHE_VERSION_KEY = 'services_catalog:cache_version';
    private const CACHE_TTL = 180;
    private const FILTERS_CACHE_TTL = 900;
    private const DEFAULT_PER_PAGE = 15;
    private const MAX_PER_PAGE = 50;

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

    public function find(int $offerId): ?Offer
    {
        $cacheKey = 'services_catalog:show:' . $offerId . ':' . $this->getCacheVersion();

        return Cache::remember($cacheKey, self::CACHE_TTL, function () use ($offerId) {
            return $this->baseRelationsQuery()->find($offerId);
        });
    }

    public function filtersData(): array
    {
        $cacheKey = 'services_catalog:filters_data:' . $this->getCacheVersion();

        return Cache::remember($cacheKey, self::FILTERS_CACHE_TTL, function () {
            // استثناء عروض الإدارة الداخلية (broadcast) من نطاق السعر المعروض للمستخدمين
            $priceRange = Offer::query()
                ->where('offer_owner', '!=', 'all')
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

    public static function flushCache(): void
    {
        $current = (int) Cache::get(self::CACHE_VERSION_KEY, 1);
        Cache::forever(self::CACHE_VERSION_KEY, $current + 1);
    }

    private function getActiveProviders()
    {
        $providers = collect();

        // استثناء عروض الإدارة الداخلية (broadcast) حتى لا تظهر قبولات مزودي
        // الخدمة لصفقات الإدارة كـ "مزودي خدمة فعّالين" في كتالوج المستخدم النهائي
        Offer::query()
            ->where('offer_owner', '!=', 'all')
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
        } else {
            // عروض الإدارة الداخلية (broadcast, offer_owner='all') ليست جزءًا من
            // كتالوج الخدمات العام أبدًا — هي قناة منفصلة بين الإدارة ومزودي الخدمة
            // (راجع Dashboard\OfferController)، فتُستثنى دائمًا من هذا المسار العام.
            $query->where('offer_owner', '!=', 'all');

            if ($filters['only_active'] ?? true) {
                $query->approved()->notExpired();
            }
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

        $hasDistance = $this->applyDistanceSelection($query, $filters);

        $this->applySort($query, $filters['sort_by'] ?? 'latest', $hasDistance);

        return $query;
    }

    /**
     * العروض لا تحمل إحداثيات خاصة بها، فقط المناطق (zones.latitude/longitude)
     * ترتبط بها — لذا "المسافة" هنا تقريبية: أقرب منطقة من مناطق العرض المرتبطة
     * إلى موقع المستخدم (Haversine بالكيلومتر)، لا مسافة دقيقة لموقع العرض نفسه.
     * تُضاف كعمود select باسم distance_km يُستخدم لاحقًا في applySort()، وإن
     * أُرسل radius_km أيضًا تُستبعد العروض التي تتجاوزه (أو بلا مناطق بإحداثيات).
     */
    private function applyDistanceSelection($query, array $filters): bool
    {
        $lat = $filters['latitude'] ?? null;
        $lng = $filters['longitude'] ?? null;

        if ($lat === null || $lng === null) {
            return false;
        }

        $lat = (float) $lat;
        $lng = (float) $lng;

        $distanceSubquery = DB::table('offer_zone')
            ->join('zones', 'zones.id', '=', 'offer_zone.zone_id')
            ->whereColumn('offer_zone.offer_id', 'offers.id')
            ->whereNotNull('zones.latitude')
            ->whereNotNull('zones.longitude')
            ->selectRaw(
                'MIN(6371 * ACOS(LEAST(1, GREATEST(-1,
                    COS(RADIANS(?)) * COS(RADIANS(zones.latitude)) * COS(RADIANS(zones.longitude) - RADIANS(?))
                    + SIN(RADIANS(?)) * SIN(RADIANS(zones.latitude))
                ))))',
                [$lat, $lng, $lat]
            );

        $query->addSelect(['distance_km' => $distanceSubquery]);

        $radiusKm = $filters['radius_km'] ?? null;
        if ($radiusKm !== null) {
            $query->having('distance_km', '<=', (float) $radiusKm);
        }

        return true;
    }

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
                'serviceProviders' => function ($q) {
                    $q->select(
                        'users.id', 'users.name', 'users.phone', 'users.snapchat',
                        'users.instagram', 'users.website', 'users.tiktok',
                        'users.twitter', 'users.image'
                    )->wherePivot('status', 'accept');
                },
            ]);
    }

    private function applySort($query, string $sortBy, bool $hasDistance = false): void
    {
        // "الأقرب مني" بلا إحداثيات (لم تُرسَل latitude/longitude) لا معنى له
        // فيسقط تلقائيًا لترتيب "الأحدث" الافتراضي عبر match أدناه.
        if ($sortBy === 'nearest' && $hasDistance) {
            // NULL أولًا يعني: العروض بلا منطقة ذات إحداثيات تُدفع لآخر القائمة
            // بدل أن تتصدّرها بسبب معاملة NULL كأصغر قيمة في MySQL ASC العادي.
            $query->orderByRaw('distance_km IS NULL, distance_km ASC');
            return;
        }

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
            'owner_id'        => $filters['owner_id'] ?? null,
            'offer_type'      => $filters['offer_type'] ?? null,
            'min_price'       => $filters['min_price'] ?? null,
            'max_price'       => $filters['max_price'] ?? null,
            'min_discount'    => $filters['min_discount'] ?? null,
            'max_discount'    => $filters['max_discount'] ?? null,
            'search'          => mb_strtolower(trim((string) ($filters['search'] ?? ''))),
            'sort_by'         => $filters['sort_by'] ?? 'latest',
            'only_active'     => (bool) ($filters['only_active'] ?? true),
            // مقرَّبة لمنعة تفتيت الكاش لكل بكسل حركة GPS، مع بقاء دقة كافية (~110م)
            'latitude'        => isset($filters['latitude']) ? round((float) $filters['latitude'], 3) : null,
            'longitude'       => isset($filters['longitude']) ? round((float) $filters['longitude'], 3) : null,
            'radius_km'       => $filters['radius_km'] ?? null,
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