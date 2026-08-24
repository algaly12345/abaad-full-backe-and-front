<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

/**
 * أداة اختبار: تعيد حساب مزوّد خدمة إلى "مستخدم عادي" بلا بيانات هوية —
 * تحذف سجل service_providers (فرد/منشأة)، تُرجع user_type إلى customer،
 * وتسحب دور provider. تُستخدَم لإعادة تجربة معالج "الانضمام كمزوّد خدمة"
 * من الصفر على نفس رقم الهاتف دون تكرار الطلب يدوياً في كل مرة.
 */
class ResetProviderTestAccount extends Command
{
    protected $signature = 'provider:reset-test {phone} {--id= : استهدف id محدداً لو الرقم مكرراً على أكثر من حساب}';

    protected $description = 'إعادة ضبط حساب مزوّد خدمة (بيانات الهوية + user_type + دور provider) لأغراض التجربة';

    public function handle(): int
    {
        $normalizedPhone = $this->normalizePhone((string) $this->argument('phone'));

        $matches = User::where('phone', $normalizedPhone)->orderBy('id')->get();

        if ($matches->isEmpty()) {
            $this->error("لا يوجد أي حساب بالرقم {$normalizedPhone}");
            return self::FAILURE;
        }

        if ($matches->count() > 1 && ! $this->option('id')) {
            $this->warn("تنبيه: هذا الرقم مكرر على {$matches->count()} حسابات:");
            foreach ($matches as $m) {
                $this->line("  id={$m->id} user_type={$m->user_type} roles=" . $m->getRoleNames()->implode(','));
            }
            $this->line('سأستهدف أقدم حساب (id=' . $matches->first()->id . ') — نفس ما يختاره تسجيل الدخول فعلياً. لاستهداف حساب آخر: --id=X');
        }

        $user = $this->option('id')
            ? $matches->firstWhere('id', (int) $this->option('id'))
            : $matches->first();

        if (! $user) {
            $this->error('لا يوجد حساب بهذا الـ id لهذا الرقم');
            return self::FAILURE;
        }

        $this->info("قبل: id={$user->id} user_type={$user->user_type} provider_id=" . ($user->provider->id ?? 'none') . ' roles=' . $user->getRoleNames()->implode(','));

        $user->provider()->delete();
        $user->update(['user_type' => 'customer']);
        $user->removeRole('provider');

        $user = $user->fresh();
        $this->info("بعد: id={$user->id} user_type={$user->user_type} provider=" . ($user->provider ? 'still exists!' : 'deleted') . ' roles=[' . $user->getRoleNames()->implode(',') . ']');

        return self::SUCCESS;
    }

    private function normalizePhone(string $raw): string
    {
        $digits = preg_replace('/\D/', '', $raw) ?? '';

        if (str_starts_with($digits, '966')) {
            return '+' . $digits;
        }

        if (str_starts_with($digits, '0')) {
            return '+966' . substr($digits, 1);
        }

        return '+966' . $digits;
    }
}
