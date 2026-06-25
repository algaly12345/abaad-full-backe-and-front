<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = ['title','offer_owner','image','expiry_date','service_price','description','discount','service_type_id','offer_type','offer','phone_provider','pending'];

    public function serviceProviders()
    {
        return $this->belongsToMany(User::class)->withPivot('status');
    }

    /**
     * مزودو الخدمة الذين وافقوا فعليًا على هذا العرض (status = accept على الـpivot).
     * نستخدمها بدل serviceProviders() الخام في أي مكان يُعرض للجمهور (الكتالوج العام)،
     * لتجنّب كشف مزودين لم يوافقوا بعد أو رُفضوا.
     */
    public function acceptedProviders()
    {
        return $this->serviceProviders()->wherePivot('status', 'accept');
    }

    /** صاحب/مُنشئ العرض (مقدّم الخدمة الذي أضاف هذا العرض عبر offer_owner) */
    public function provider()
    {
        return $this->belongsTo(User::class, 'offer_owner');
    }

    public function isSended()
    {
        if ($this->sended_at == null) {
            return "لم يتم الارسال";
        }
        return "تم الارسال";
    }


   public function subscriptions()
    {
        return $this->hasMany(ServiceProviderSubscription::class, 'offer_id', 'id');
    }
    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class);
    }

    public function updateOfferStatusToSended()
    {
        $this->sended_at = Carbon::now();
        $this->save();
    }

    public function accpet()
    {
        $this->serviceProviders()->updateExistingPivot(auth()->id(), ['status' => 'accept']);
    }


    // public function scopePending($q)
    // {
    //     $q->whereHas('serviceProviders', function ($query) {
    //         $query->where('status', 'pending');
    //     });
    // }

    public function estates()
    {
        return $this->belongsToMany(Estate::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function zones()
    {
        return $this->belongsToMany(Zone::class);
    }

    public function scopeSent($q)
    {
        $q->whereNotNull('sended_at');
    }



public function isExpired()
{
    return \Carbon\Carbon::parse($this->expiry_date)->isPast();
}

    /*
    |--------------------------------------------------------------------------
    | Scopes خاصة بكتالوج الخدمات (ServiceCatalogService)
    |--------------------------------------------------------------------------
    | مفصولة كل واحدة عن الأخرى لإعادة الاستخدام، الاختبار، وقابلية القراءة.
    */

    /** عروض غير منتهية (لا تاريخ انتهاء، أو تاريخ الانتهاء لم يأتِ بعد) */
    public function scopeNotExpired($query)
    {
        return $query->where(function ($q) {
            $q->whereNull('expiry_date')
              ->orWhereDate('expiry_date', '>=', now()->toDateString());
        });
    }

    /** عروض معتمدة فقط (status = accept) */
    public function scopeApproved($query)
    {
        return $query->where('status', 'accept');
    }

    /** فلترة حسب أقسام عقارية متعددة */
    public function scopeForCategories($query, array $categoryIds)
    {
        if (empty($categoryIds)) {
            return $query;
        }

        return $query->whereHas('categories', function ($q) use ($categoryIds) {
            $q->whereIn('categories.id', $categoryIds);
        });
    }

    /** فلترة حسب مناطق متعددة */
    public function scopeForZones($query, array $zoneIds)
    {
        if (empty($zoneIds)) {
            return $query;
        }

        return $query->whereHas('zones', function ($q) use ($zoneIds) {
            $q->whereIn('zones.id', $zoneIds);
        });
    }

    /** فلترة حسب نوع/أنواع الخدمة */
    public function scopeForServiceTypes($query, array $serviceTypeIds)
    {
        if (empty($serviceTypeIds)) {
            return $query;
        }

        return $query->whereIn('service_type_id', $serviceTypeIds);
    }

    /**
     * فلترة حسب مزود/مزودي خدمة معتمدين على العرض (status = accept على pivot
     * "offer_user"). هذا هو فلتر "مزود الخدمة" المطلوب في شاشة الكتالوج.
     */
    public function scopeForProviders($query, array $providerIds)
    {
        if (empty($providerIds)) {
            return $query;
        }

        return $query->whereHas('serviceProviders', function ($q) use ($providerIds) {
            $q->whereIn('users.id', $providerIds)->wherePivot('status', 'accept');
        });
    }

    /** عروض مملوكة لمقدّم خدمة معيّن (تُستخدم في لوحة "خدماتي") */
    public function scopeOwnedBy($query, $userId)
    {
        return $userId ? $query->where('offer_owner', $userId) : $query;
    }

    /** فلترة حسب نوع العرض: discount أو price */
    public function scopeOfferType($query, ?string $offerType)
    {
        return $offerType ? $query->where('offer_type', $offerType) : $query;
    }

    /** فلترة نطاق السعر */
    public function scopePriceBetween($query, $min, $max)
    {
        if (!is_null($min)) {
            $query->where('service_price', '>=', $min);
        }
        if (!is_null($max)) {
            $query->where('service_price', '<=', $max);
        }

        return $query;
    }

    /** فلترة نطاق نسبة الخصم */
    public function scopeDiscountBetween($query, $min, $max)
    {
        if (!is_null($min)) {
            $query->where('discount', '>=', $min);
        }
        if (!is_null($max)) {
            $query->where('discount', '<=', $max);
        }

        return $query;
    }

    /** بحث نصي في العنوان والوصف */
    public function scopeSearch($query, ?string $term)
    {
        if (!$term) {
            return $query;
        }

        return $query->where(function ($q) use ($term) {
            $q->where('title', 'like', "%{$term}%")
              ->orWhere('description', 'like', "%{$term}%");
        });
    }
}