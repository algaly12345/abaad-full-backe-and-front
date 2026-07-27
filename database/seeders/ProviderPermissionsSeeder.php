<?php

namespace Database\Seeders;

use App\Enums\ProviderPermission;
use App\Enums\ProviderRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/**
 * يهيّئ نظام صلاحيات مزودي الخدمة (guard_name = 'api'):
 *
 * - إنشاء جميع الصلاحيات المعرفة داخل ProviderPermission::LIST.
 * - إنشاء دور مزود الخدمة إذا لم يكن موجودًا.
 * - ربط الدور بالصلاحيات الافتراضية الخاصة بمزود الخدمة.
 * - عدم منح الصلاحيات الإدارية مثل:
 *      - plans.manage-global
 *      - reports.view-global
 * - منح الدور لجميع المستخدمين الحاليين من نوع provider.
 *
 * آمن لإعادة التشغيل (Idempotent).
 *
 * التشغيل:
 * php artisan db:seed --class=Database\\Seeders\\ProviderPermissionsSeeder
 */
class ProviderPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        /*
         |--------------------------------------------------------------
         | إنشاء جميع الصلاحيات
         |--------------------------------------------------------------
         */
        foreach (ProviderPermission::LIST as $permissionName) {
            Permission::firstOrCreate([
                'name'       => $permissionName,
                'guard_name' => 'api',
            ]);
        }

        /*
         |--------------------------------------------------------------
         | إنشاء دور مزود الخدمة
         |--------------------------------------------------------------
         */
        $providerRole = Role::firstOrCreate([
            'name'       => ProviderRole::PROVIDER,
            'guard_name' => 'api',
        ]);

        /*
         |--------------------------------------------------------------
         | الصلاحيات الافتراضية لمزود الخدمة
         |--------------------------------------------------------------
         |
         | لا يتم منح الصلاحيات الإدارية مثل:
         | - PLANS_MANAGE_GLOBAL
         | - REPORTS_VIEW_GLOBAL
         |
         */
        $defaultPermissions = Permission::query()
            ->where('guard_name', 'api')
            ->whereIn('name', [
                ProviderPermission::SERVICES_VIEW,
                ProviderPermission::SERVICES_CREATE,
                ProviderPermission::SERVICES_UPDATE,
                ProviderPermission::SERVICES_DELETE,
                ProviderPermission::SERVICES_TOGGLE_STATUS,

                // صلاحية الاطلاع على تقارير مزود الخدمة نفسه
                ProviderPermission::REPORTS_VIEW_OWN,
            ])
            ->get();

        $providerRole->syncPermissions($defaultPermissions);

        /*
         |--------------------------------------------------------------
         | منح الدور لجميع مزودي الخدمة الحاليين
         |--------------------------------------------------------------
         */
        User::query()
            ->where('user_type', User::TYPE_PROVIDER)
            ->whereDoesntHave('roles', function ($query) use ($providerRole) {
                $query->where('roles.id', $providerRole->id);
            })
            ->each(function (User $user) use ($providerRole) {
                $user->assignRole($providerRole);
            });
    }
}