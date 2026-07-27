<?php

namespace App\Services\Reports;

use App\Models\User;
use App\Services\Reports\Concerns\BuildsTimeSeries;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

/**
 * إحصائيات المستخدمين على مستوى المنصة بالكامل (لوحة تحكم الإدارة + API).
 *
 * ⚠️ تنبيه مهم: موديل User يعطّل إدارة Laravel التلقائية للطوابع الزمنية
 * ($timestamps = false)، لذلك بعض الحسابات (خصوصًا القديمة، أو أي حساب أُنشئ
 * عبر مسار لا يضبط created_at يدويًا) قد تملك created_at = NULL. كل دوال
 * "النمو عبر الزمن" والعدّادات الزمنية هنا تتجاهل عمدًا السجلات التي
 * created_at فيها NULL (WHERE created_at IS NOT NULL)، حتى لا تُحسب كقيم في
 * أقدم فترة زمنية بالخطأ. نتيجة ذلك: مجموع نقاط منحنى النمو الشهري قد يكون
 * أقل من total في overview() — وهذا فرق متوقّع ناتج عن نقص تاريخي في البيانات
 * لا عن خلل في الاستعلام. (توصية مستقبلية: ضبط created_at يدويًا في كل مسارات
 * تسجيل المستخدمين الجديدة كي تصبح هذه الإحصائيات دقيقة 100% تدريجيًا.)
 */
class UserReportService
{
    use BuildsTimeSeries;

    private const CACHE_TTL = 300;
    private const CACHE_PREFIX = 'reports:users:';

    public function overview(): array
    {
        return Cache::remember(self::CACHE_PREFIX . 'overview', self::CACHE_TTL, function () {
            $now = Carbon::now();

            return [
                'total' => User::query()->count(),
                'customers' => User::query()->where('user_type', User::TYPE_CUSTOMER)->count(),
                'agents' => User::query()->where('user_type', User::TYPE_AGENT)->count(),
                'providers' => User::query()->where('user_type', User::TYPE_PROVIDER)->count(),
                'active' => User::query()->where('is_active', 'active')->count(),
                'suspended' => User::query()->where('is_active', '!=', 'active')->count(),
                'phone_verified' => User::query()->where('is_phone_verified', 1)->count(),
                'phone_unverified' => User::query()->where(function ($q) {
                    $q->whereNull('is_phone_verified')->orWhere('is_phone_verified', '!=', 1);
                })->count(),
                'new_today' => User::query()->whereNotNull('created_at')->whereDate('created_at', $now->toDateString())->count(),
                'new_this_week' => User::query()->whereNotNull('created_at')->where('created_at', '>=', $now->copy()->startOfWeek())->count(),
                'new_this_month' => User::query()->whereNotNull('created_at')->where('created_at', '>=', $now->copy()->startOfMonth())->count(),
            ];
        });
    }

    public function byType(): Collection
    {
        return Cache::remember(self::CACHE_PREFIX . 'by_type', self::CACHE_TTL, function () {
            return User::query()
                ->select('user_type')
                ->selectRaw('COUNT(*) as total')
                ->whereNotNull('user_type')
                ->groupBy('user_type')
                ->orderByDesc('total')
                ->get();
        });
    }

    public function byZone(int $limit = 20): Collection
    {
        return Cache::remember(self::CACHE_PREFIX . 'by_zone:' . $limit, self::CACHE_TTL, function () use ($limit) {
            return User::query()
                ->select('zone_id')
                ->selectRaw('COUNT(*) as total')
                ->whereNotNull('zone_id')
                ->groupBy('zone_id')
                ->with('zone:id,name,name_ar')
                ->orderByDesc('total')
                ->limit($limit)
                ->get()
                ->map(fn ($row) => [
                    'zone_id' => $row->zone_id,
                    'zone_name' => $row->zone?->name,
                    'zone_name_ar' => $row->zone?->name_ar,
                    'total' => (int) $row->total,
                ]);
        });
    }

    public function byMembershipType(int $limit = 20): Collection
    {
        return Cache::remember(self::CACHE_PREFIX . 'by_membership:' . $limit, self::CACHE_TTL, function () use ($limit) {
            return User::query()
                ->select('membership_type')
                ->selectRaw('COUNT(*) as total')
                ->whereNotNull('membership_type')
                ->where('membership_type', '!=', '')
                ->groupBy('membership_type')
                ->orderByDesc('total')
                ->limit($limit)
                ->get();
        });
    }

    /**
     * منحنى نمو تسجيلات المستخدمين عبر الزمن. period: day | week | month.
     * يتجاهل السجلات التي created_at = NULL (انظر التنبيه أعلى الكلاس).
     */
    public function registrationsGrowth(string $period = 'month', int $count = 12): array
    {
        [$period, $count] = $this->normalizePeriodAndCount($period, $count);

        return Cache::remember(self::CACHE_PREFIX . "growth:{$period}:{$count}", self::CACHE_TTL, function () use ($period, $count) {
            $format = $this->periodDateFormat($period);
            $from = $this->periodStartDate($period, $count);

            $rows = User::query()
                ->whereNotNull('created_at')
                ->selectRaw("DATE_FORMAT(created_at, '{$format}') as period_label")
                ->selectRaw('COUNT(*) as total')
                ->where('created_at', '>=', $from)
                ->groupBy('period_label')
                ->orderBy('period_label')
                ->get()
                ->pluck('total', 'period_label');

            return $this->fillMissingPeriods($rows, $period, $count);
        });
    }

    public static function flushCache(): void
    {
        Cache::forget(self::CACHE_PREFIX . 'overview');
    }
}
