<?php

namespace App\Observers;

use App\Models\Offer;
use App\Services\ServiceCatalogService;

/**
 * يبطل كاش كتالوج الخدمات تلقائياً عند إنشاء/تعديل/حذف أي Offer.
 *
 * تنبيه مهم: أحداث Eloquent (created/updated/deleted) لا تُطلق عند استدعاء
 * $offer->categories()->attach()/sync() أو $offer->zones()->attach()/sync() أو
 * $offer->serviceProviders()->attach() لأنها عمليات على جدول pivot منفصل.
 * لذلك يجب استدعاء ServiceCatalogService::flushCache() يدويًا بعد أي عملية
 * attach/sync/detach في الكنترولرات التي تُنشئ أو تُحدّث العروض
 * (راجع ملاحظات التكامل في README.md المرفق).
 */
class OfferObserver
{
    public function created(Offer $offer): void
    {
        ServiceCatalogService::flushCache();
    }

    public function updated(Offer $offer): void
    {
        ServiceCatalogService::flushCache();
    }

    public function deleted(Offer $offer): void
    {
        ServiceCatalogService::flushCache();
    }
}