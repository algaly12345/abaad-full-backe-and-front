<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    use HasFactory;

    public const STATUS_PENDING = 'PENDING';
    public const STATUS_APPROVED = 'APPROVED';
    public const STATUS_AVAILABLE = 'AVAILABLE';
    public const STATUS_WITHDRAWN = 'WITHDRAWN';
    public const STATUS_CANCELLED = 'CANCELLED';

    protected $fillable = [
        'user_id',
        'referral_id',
        'amount',
        'status',
        'approved_at',
        'available_at',
    ];

    protected $casts = [
        'amount' => 'float',
        'approved_at' => 'datetime',
        'available_at' => 'datetime',
    ];

    public function referral()
    {
        return $this->belongsTo(Referral::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
