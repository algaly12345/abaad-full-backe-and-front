<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicePlan extends Model
{
    use HasFactory;
  

    protected $fillable = [
        'name',
        'description',
        'price',
        'start_date',
        'end_date',

        'number_of_ads',
        'number_of_zone',
        'number_of_categories',
        
        
        
        'distinctive_appearance',
        'interactive_reports',
        'crm'
    ];

    // إذا أردت إضافة علاقة مع الاشتراكات:
    public function subscriptions()
    {
        return $this->hasMany(ServiceSubscription::class);
    }
}
