<?php

namespace App\Observers;

use App\Enums\ProviderRole;
use App\Models\User;

/**
 * يضمن أن كل حساب من نوع "provider" يحصل تلقائيًا على دور ProviderRole::PROVIDER
 * (وبالتبعية، كل الصلاحيات الافتراضية المرتبطة به) بدون الحاجة لاستدعاء
 * assignRole() يدويًا من كل كنترولر ينشئ مستخدم provider.
 *
 * ⚠️ تنبيه صريح وضروري:
 * هذا الـ Observer يعتمد على أحداث Eloquent (created/updated)، وهي لا تُطلق
 * إطلاقًا عند استخدام استعلامات الـ Query Builder الخام مثل:
 *   DB::table('users')->where('id', $id)->update(['user_type' => 'provider']);
 * هذا النمط موجود فعليًا في أكثر من مكان بالكود القديم (مثل AgentController،
 * بعض مسارات api\v1). إذا كان أي من هذه المسارات يُستخدم فعليًا لتحويل حساب
 * موجود إلى provider، فيجب إما:
 *   1) تحويله لاستخدام $user->update([...]) أو $user->save() بدل DB::table()،
 *      أو
 *   2) استدعاء $user->assignRole(ProviderRole::PROVIDER) يدويًا في تلك النقطة.
 * لم يتم لمس تلك المسارات القديمة هنا لتجنب تغيير سلوكها دون طلب صريح.
 */
class UserObserver
{
    public function created(User $user): void
    {
        $this->ensureProviderRole($user);
    }

    public function updated(User $user): void
    {
        $this->ensureProviderRole($user);
    }

    private function ensureProviderRole(User $user): void
    {
        if (!$user->isProvider()) {
            return;
        }

        if ($user->hasRole(ProviderRole::PROVIDER)) {
            return;
        }

        $user->assignRole(ProviderRole::PROVIDER);
    }
}