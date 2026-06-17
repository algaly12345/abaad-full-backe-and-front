<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceSubscription extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'plan_id',
        'subscription_start_date',
        'subscription_end_date',
        'status',
    ];

    // العلاقة مع الـ User (مقدم الخدمة)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // العلاقة مع الـ ServicePlan
    public function plan()
    {
        return $this->belongsTo(ServicePlan::class);
    }
}
