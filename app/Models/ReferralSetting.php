<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferralSetting extends Model
{
    protected $fillable = [
        'reward_type',
        'reward_value',
        'attribution_window_days',
        'min_payout_limit',
        'commission_hold_days',
    ];

    protected $casts = [
        'reward_value' => 'float',
        'attribution_window_days' => 'integer',
        'min_payout_limit' => 'float',
        'commission_hold_days' => 'integer',
    ];

    public static function current(): self
    {
        return static::query()->firstOrCreate([], [
            'reward_type' => 'PERCENTAGE',
            'reward_value' => 10.00,
            'attribution_window_days' => 30,
            'min_payout_limit' => 0.00,
            'commission_hold_days' => 14,
        ]);
    }

    public function calculateCommission(float $netAmount): float
    {
        if ($this->reward_type === 'PERCENTAGE') {
            return round($netAmount * ($this->reward_value / 100), 2);
        }

        return round($this->reward_value, 2);
    }
}
