<?php

namespace App\Observers;

use App\Models\Estate;
use App\Services\EstateCatalogService;

/**
 * يبطل كاش كتالوج العقارات (EstateCatalogService) تلقائيًا عند إنشاء/تعديل/
 * حذف أي عقار، بنفس الفلسفة المتبعة في OfferObserver لكتالوج الخدمات.
 *
 * ⚠️ نفس التنبيه الموجود في OfferObserver ينطبق هنا تمامًا: أحداث Eloquent
 * (created/updated/deleted) لا تُطلق عند استخدام استعلامات DB::table() الخام
 * لتعديل العقارات مباشرة. إن وُجد أي مسار يحدّث جدول estates عبر DB::table()
 * بدل Estate::find()->update()، فلن يُبطل الكاش تلقائيًا في تلك الحالة، ويجب
 * استدعاء EstateCatalogService::flushCache() يدويًا فيها.
 */
class EstateObserver
{
    public function created(Estate $estate): void
    {
        EstateCatalogService::flushCache();
    }

    public function updated(Estate $estate): void
    {
        EstateCatalogService::flushCache();
    }

    public function deleted(Estate $estate): void
    {
        EstateCatalogService::flushCache();
    }
}
