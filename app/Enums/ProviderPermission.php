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
 */
enum ProviderPermission
{
    const SERVICES_VIEW = 'services.view';
    const SERVICES_CREATE = 'services.create';
    const SERVICES_UPDATE = 'services.update';
    const SERVICES_DELETE = 'services.delete';
    const SERVICES_TOGGLE_STATUS = 'services.toggle-status';

    const PLANS_MANAGE_GLOBAL = 'plans.manage-global';

    const LIST = [
        self::SERVICES_VIEW,
        self::SERVICES_CREATE,
        self::SERVICES_UPDATE,
        self::SERVICES_DELETE,
        self::SERVICES_TOGGLE_STATUS,
        self::PLANS_MANAGE_GLOBAL,
    ];
}