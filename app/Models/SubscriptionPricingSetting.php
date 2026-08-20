<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

/**
 * إعداد عام واحد (صف بمعرّف 1) لتسعير اشتراك مزوّد الخدمة — يستبدل نظام
 * الباقات الثلاث الثابتة (ServicePlan) القديم. يُدار من لوحة تحكم الأدمن
 * (Dashboard\SubscriptionPricingSettingController) بدل كونه ثابتًا بالكود.
 */
class SubscriptionPricingSetting extends Model
{
    protected $fillable = [
        'base_price',
        'included_zones',
        'included_categories',
        'extra_zone_price',
        'extra_category_price',
    ];

    protected $casts = [
        'base_price' => 'float',
        'included_zones' => 'integer',
        'included_categories' => 'integer',
        'extra_zone_price' => 'float',
        'extra_category_price' => 'float',
    ];

    const CACHE_KEY = 'subscription_pricing_setting';

    /**
     * الإعداد الحالي (الصف الوحيد) — يُنشأ بالقيم الافتراضية تلقائيًا إن لم
     * يُشغَّل SubscriptionPricingSettingSeeder بعد، فلا ينكسر حساب السعر أبدًا.
     */
    public static function current(): self
    {
        return Cache::remember(self::CACHE_KEY, 3600, function () {
            return self::firstOrCreate(['id' => 1], [
                'base_price' => 99,
                'included_zones' => 1,
                'included_categories' => 1,
                'extra_zone_price' => 49,
                'extra_category_price' => 49,
            ]);
        });
    }

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget(self::CACHE_KEY));
    }
}
