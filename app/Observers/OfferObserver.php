<?php

namespace App\Observers;

use App\Models\Offer;
use App\Models\User;
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
        $this->notifyAdminNewService($offer);
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
     * معرّف حساب أدمن مراجعة الخدمات في جدول users (الجوال +966 50 373 1637).
     * توكن FCM يُقرأ لحظيًا من users.cm_firebase_token لهذا الصف، فيبقى محدَّثًا
     * تلقائيًا كلما سجّل الأدمن الدخول من التطبيق (update_cm_firebase_token) —
     * لا تخزين توكن يدوي في .env أو business_settings.
     */
    private const REVIEW_ADMIN_USER_ID = 251;

    /**
     * إشعار "push" لأدمن مراجعة الخدمات عبر خدمة الإشعارات على
     * dashboard.abaadapp.sa عند كل إضافة خدمة جديدة من مزوّد خدمة، ليدخل
     * ويطّلع عليها في اللوحة. يمرّ عبر ProviderPushNotifier::notifyToken:
     * يُؤجَّل فعليًا إلى ما بعد commit (مهم لمسار store-offer الملفوف في
     * DB::transaction) ولا يرمي استثناء أبدًا — توكن فاسد/منتهٍ أو فشل شبكة
     * يجب ألا يكسر إنشاء الخدمة.
     *
     * لو الحساب غير موجود أو ما عنده توكن حقيقي بعد (القيمة القديمة "@" أو
     * فارغة) نتجاهل بصمت — يبدأ الإرسال تلقائيًا أول ما يسجّل الأدمن الدخول.
     */
    private function notifyAdminNewService(Offer $offer): void
    {
        $adminToken = optional(User::find(self::REVIEW_ADMIN_USER_ID))->cm_firebase_token;

        if (!is_string($adminToken) || strlen($adminToken) < 30) {
            return;
        }

        $label = $offer->title ?: ('#' . $offer->id);

        ProviderPushNotifier::notifyToken(
            $adminToken,
            'service_review',
            'خدمة جديدة بانتظار المراجعة',
            'أضاف أحد مزوّدي الخدمة خدمة جديدة: "' . $label . '". يمكنك مراجعتها الآن من لوحة التحكم.',
            $offer->id
        );
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