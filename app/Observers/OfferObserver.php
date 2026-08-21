<?php

namespace App\Observers;

use App\Models\Offer;
use App\Services\ProviderPushNotifier;
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
        $this->notifyStatusChange($offer);
    }

    public function deleted(Offer $offer): void
    {
        ServiceCatalogService::flushCache();
    }

    /**
     * إشعار مزوّدي الخدمة عند تغيّر حالة عرضهم إلى أي من الحالات المعروفة.
     */
    private function notifyStatusChange(Offer $offer): void
    {
        if (!$offer->wasChanged('status')) {
            return;
        }

        switch ($offer->status) {
            case 'accept':
                $title = 'تم تفعيل عرضك';
                $description = 'أصبح عرضك مفعّلاً وظاهرًا للعملاء.';
                break;
            case 'pending':
                $title = 'عرضك قيد المراجعة';
                $description = 'تم وضع عرضك قيد المراجعة، سيتم إشعارك عند اعتماده.';
                break;
            case 'cancelled':
                $title = 'تم إلغاء تفعيل عرضك';
                $description = 'تم إلغاء تفعيل عرضك من قِبل الإدارة.';
                break;
            case 'rejected':
                $title = 'تم رفض عرضك';
                $description = 'تم رفض عرضك من قِبل الإدارة.';
                break;
            case 'unpaid':
                $title = 'عرضك بحاجة إلى دفع';
                $description = 'يرجى إتمام عملية الدفع لتفعيل عرضك.';
                break;
            case 'expired':
                $title = 'انتهت صلاحية عرضك';
                $description = 'لقد انتهت صلاحية عرضك ولم يعد ظاهرًا للعملاء.';
                break;
            default:
                return;
        }

        foreach ($offer->serviceProviders as $provider) {
            ProviderPushNotifier::notify($provider, 'offer_status', $title, $description, $offer->id);
        }
    }
}