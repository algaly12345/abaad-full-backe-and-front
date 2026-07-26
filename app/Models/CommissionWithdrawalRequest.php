<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommissionWithdrawalRequest extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'status',
        'requested_at',
        'processed_at',
        'note',
    ];

    protected $casts = [
        'amount' => 'float',
        'requested_at' => 'datetime',
        'processed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
