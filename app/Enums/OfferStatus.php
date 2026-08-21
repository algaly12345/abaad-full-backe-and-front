<?php

namespace App\Enums;

/**
 * حالات عرض الخدمة القابلة للتعيين من داشبورد الإدارة الخارجي.
 * PENDING و ACTIVE يحتفظان بنفس القيم القديمة الموجودة أصلاً في عمود
 * offers.status (pending/accept) للتوافق مع البيانات الحالية والكود
 * الحالي (OfferObserver, ServiceCatalogController, Offer::scopeApproved...).
 */
enum OfferStatus
{
    const PENDING = 'pending';   // قيد المراجعة
    const ACTIVE = 'accept';     // نشط
    const UNPAID = 'unpaid';     // غير مدفوع
    const REJECTED = 'rejected'; // مرفوض
    const EXPIRED = 'expired';   // منتهي

    const LIST = [
        OfferStatus::PENDING,
        OfferStatus::ACTIVE,
        OfferStatus::UNPAID,
        OfferStatus::REJECTED,
        OfferStatus::EXPIRED,
    ];

    const LABELS = [
        OfferStatus::PENDING => 'قيد المراجعة',
        OfferStatus::ACTIVE => 'نشط',
        OfferStatus::UNPAID => 'غير مدفوع',
        OfferStatus::REJECTED => 'مرفوض',
        OfferStatus::EXPIRED => 'منتهي',
    ];
}
