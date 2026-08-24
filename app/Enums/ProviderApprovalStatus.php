<?php

namespace App\Enums;

/**
 * حالة اعتماد طلب "الترقية إلى مزوّد خدمة" (service_providers.approval_status).
 * منفصلة تمامًا عن users.is_active (حظر عام للحساب بأكمله يمنع حتى تسجيل
 * الدخول) وعن users.account_verification (توثيق هوية نفاذ) — هذه الحالة
 * خاصة فقط بمراجعة الأدمن لطلب مزوّد الخدمة قبل تفعيل user_type=provider.
 */
enum ProviderApprovalStatus
{
    const PENDING = 'pending';   // قيد المراجعة (بعد نجاح أول دفعة)
    const APPROVED = 'approved'; // اعتمده الأدمن — أصبح مزوّد خدمة فعلي
    const REJECTED = 'rejected'; // رفضه الأدمن

    const LIST = [
        ProviderApprovalStatus::PENDING,
        ProviderApprovalStatus::APPROVED,
        ProviderApprovalStatus::REJECTED,
    ];

    const LABELS = [
        ProviderApprovalStatus::PENDING => 'قيد المراجعة',
        ProviderApprovalStatus::APPROVED => 'معتمد',
        ProviderApprovalStatus::REJECTED => 'مرفوض',
    ];
}
