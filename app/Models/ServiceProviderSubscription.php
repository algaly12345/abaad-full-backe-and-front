<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProviderSubscription extends Model
{
    use HasFactory;
    public $timestamps = true;

 

    protected $table = 'service_provider_subscriptions';

    protected $fillable = [
        'user_id',
        'service_plan_id',
        'duration',
        'expiry_date',
        'subscription_status',
        'payment_status',
        'price',
        'subscription_number',
        'offer_id',
        'number_of_ads',
        'number_of_zone',
        'number_of_categories',
    ];

    public function provider()
    {
        return $this->belongsTo(User::class, 'service_provider_id');
    }

    public function plan()
    {
        return $this->belongsTo(ServicePlan::class, 'service_plan_id');
    }


    public function servicePlan()
    {
        return $this->belongsTo(ServicePlan::class, 'service_plan_id');
    }
    
    
    
    
    
        public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // ✅ الخطة/الباقة
    public function plan_2()
    {
        return $this->belongsTo(SubscriptionPackages::class, 'service_plan_id');
        // لو جدول الخطط اسمه ServicePlan بدل SubscriptionPackages:
        // return $this->belongsTo(ServicePlan::class, 'service_plan_id');
    }

    // ✅ العرض (Offer) لو موجود
    public function offer()
    {
        return $this->belongsTo(Offer::class, 'offer_id');
    }
    

}
