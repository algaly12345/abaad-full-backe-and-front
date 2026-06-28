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
 * - ينشئ كل الصلاحيات المعرّفة في ProviderPermission::LIST.
 * - ينشئ دور ProviderRole::PROVIDER.
 * - يربط الدور بصلاحيات "services.*" فقط (وليس plans.manage-global، المحجوزة
 *   عمدًا لحساب إداري حقيقي مستقبلاً — راجع التعليق في ProviderPermission).
 * - يمنح الدور لكل مستخدم حالي بالفعل من نوع provider (تغطية احتياطية لأي
 *   حساب أُنشئ قبل تفعيل UserObserver أو عبر استعلام DB::table() خام).
 *
 * آمن لإعادة التشغيل (idempotent) بفضل firstOrCreate.
 * التشغيل: php artisan db:seed --class=Database\\Seeders\\ProviderPermissionsSeeder
 */
class ProviderPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        foreach (ProviderPermission::LIST as $permissionName) {
            Permission::firstOrCreate([
                'name' => $permissionName,
                'guard_name' => 'api',
            ]);
        }

        $providerRole = Role::firstOrCreate([
            'name' => ProviderRole::PROVIDER,
            'guard_name' => 'api',
        ]);

        $defaultPermissions = Permission::query()
            ->where('guard_name', 'api')
            ->whereIn('name', [
                ProviderPermission::SERVICES_VIEW,
                ProviderPermission::SERVICES_CREATE,
                ProviderPermission::SERVICES_UPDATE,
                ProviderPermission::SERVICES_DELETE,
                ProviderPermission::SERVICES_TOGGLE_STATUS,
            ])
            ->get();

        $providerRole->syncPermissions($defaultPermissions);

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