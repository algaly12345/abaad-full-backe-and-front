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

    protected $casts = [
        'price' => 'float',
        'number_of_ads' => 'integer',
        'number_of_zone' => 'integer',
        'number_of_categories' => 'integer',
        'distinctive_appearance' => 'boolean',
        'interactive_reports' => 'boolean',
        'crm' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    /**
     * علاقة قديمة على موديل/جدول ServiceSubscription غير مستخدم فعليًا حاليًا
     * بالنظام (تُركت كما هي لتجنب كسر أي كود آخر يعتمد عليها).
     */
    public function subscriptions()
    {
        return $this->hasMany(ServiceSubscription::class);
    }

    /**
     * العلاقة الفعلية المُستخدمة في كل النظام الحالي لاشتراكات مزودي الخدمة
     * (جدول service_provider_subscriptions، حقل service_plan_id).
     */
    public function providerSubscriptions()
    {
        return $this->hasMany(ServiceProviderSubscription::class, 'service_plan_id');
    }
}