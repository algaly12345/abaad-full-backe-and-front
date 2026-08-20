<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

/**
 * نسبة الخصم المطبَّقة على إجمالي قيمة اشتراك مزوّد الخدمة الشهري حسب مدة
 * الاشتراك المختارة (1/3/6/12 شهرًا) — راجع ServiceProviderService::calculatePrice().
 */
class SubscriptionDurationDiscount extends Model
{
    protected $fillable = [
        'duration_months',
        'discount_percent',
    ];

    protected $casts = [
        'duration_months' => 'integer',
        'discount_percent' => 'integer',
    ];

    const CACHE_KEY = 'subscription_duration_discounts';

    /**
     * كل نسب الخصم مفهرسة حسب المدة {1: 0, 3: 10, 6: 25, 12: 30}. مدة غير
     * موجودة في الجدول (لم يُشغَّل Seeder بعد) تُرجع 0% بدل كسر الحساب.
     */
    public static function percentFor(int $durationMonths): int
    {
        $all = Cache::remember(self::CACHE_KEY, 3600, function () {
            return self::query()->pluck('discount_percent', 'duration_months');
        });

        return (int) ($all[$durationMonths] ?? 0);
    }

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget(self::CACHE_KEY));
        static::deleted(fn () => Cache::forget(self::CACHE_KEY));
    }
}
