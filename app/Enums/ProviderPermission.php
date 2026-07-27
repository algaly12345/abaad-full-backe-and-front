<?php

namespace App\Enums;

/**
 * أسماء الصلاحيات (Permissions) الخاصة بمزودي الخدمة.
 * هذه القيم تُستخدم حرفيًا كأسماء سجلات في جدول permissions (guard_name = 'api').
 *
 * ملاحظة مهمة حول PLANS_MANAGE_GLOBAL:
 * هذه الصلاحية لا تُمنح للدور الافتراضي ProviderRole::PROVIDER عمدًا (انظر
 * ProviderPermissionsSeeder). الباقات (ServicePlan) هي تعريفات عالمية على
 * مستوى المنصة، ولا يجب أن يديرها أي مزود خدمة عادي. وجودها هنا فقط لإغلاق
 * المسارات أمام كل المزودين حاليًا، تمهيدًا لربطها لاحقًا بحارس إداري حقيقي
 * (مهمة منفصلة: "إدارة الخدمات والباقات").
 *
 * ملاحظة مهمة حول REPORTS_VIEW_GLOBAL (جديدة):
 * بنفس فلسفة PLANS_MANAGE_GLOBAL تمامًا: الإحصائيات العامة (كل العقارات وكل
 * المستخدمين على مستوى المنصة) ليست بيانات يجب أن يصل إليها أي مزود خدمة
 * عادي. الصلاحية موجودة هنا لإغلاق نقاط API الإدارية (Api\v1\ReportController
 * @global*) أمام كل المزودين حاليًا، إلى أن يُستحدث حارس Passport إداري حقيقي
 * منفصل عن حارس مزودي الخدمة. لا تُمنح لأي دور تلقائيًا.
 *
 * REPORTS_VIEW_OWN على العكس صلاحية آمنة تخص بيانات المزود نفسه فقط (عروضه
 * الذاتية، مشاهداته، اشتراكاته)، فتُمنح تلقائيًا لدور PROVIDER في
 * ProviderPermissionsSeeder.
 */
enum ProviderPermission
{
    const SERVICES_VIEW = 'services.view';
    const SERVICES_CREATE = 'services.create';
    const SERVICES_UPDATE = 'services.update';
    const SERVICES_DELETE = 'services.delete';
    const SERVICES_TOGGLE_STATUS = 'services.toggle-status';

    const PLANS_MANAGE_GLOBAL = 'plans.manage-global';

    // إحصائيات المزود نفسه فقط (عروضه/مشاهداته/اشتراكاته) — آمنة، تُمنح افتراضيًا.
    const REPORTS_VIEW_OWN = 'reports.view-own';

    // إحصائيات عامة على مستوى المنصة كلها — إدارية، لا تُمنح لأي دور افتراضيًا.
    const REPORTS_VIEW_GLOBAL = 'reports.view-global';

    const LIST = [
        self::SERVICES_VIEW,
        self::SERVICES_CREATE,
        self::SERVICES_UPDATE,
        self::SERVICES_DELETE,
        self::SERVICES_TOGGLE_STATUS,
        self::PLANS_MANAGE_GLOBAL,
        self::REPORTS_VIEW_OWN,
        self::REPORTS_VIEW_GLOBAL,
    ];
}
