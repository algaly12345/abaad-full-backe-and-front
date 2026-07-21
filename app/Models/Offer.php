<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    public const DISCOUNT_TYPE_PERCENTAGE = 'percentage';
    public const DISCOUNT_TYPE_FIXED = 'fixed';

    protected $fillable = ['title','offer_owner','image','expiry_date','service_price','description','discount','discount_type','service_type_id','offer_type','offer','phone_provider','pending','status','latitude','longitude'];

    public function serviceProviders()
    {
        return $this->belongsToMany(User::class)->withPivot('status');
    }

    public function acceptedProviders()
    {
        return $this->serviceProviders()->wherePivot('status', 'accept');
    }

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

    /**
     * يحدد إن كان $user هو الفعلي مالك هذا العرض، بشكل متوافق مع كل قنوات
     * إنشاء العروض الثلاث الموجودة بالنظام:
     * - النظام الجديد (API): offer_owner = معرف المستخدم الرقمي مباشرة.
     * - النظام القديم (لوحة مزود الخدمة على الويب): offer_owner = النص الثابت 'me'،
     *   وتُحدَّد الملكية الفعلية بكون المستخدم هو مزود الخدمة المرتبط بالعرض
     *   عبر جدول الـ pivot (offer_owner='me' لا تُستخدم إلا للعروض الذاتية
     *   التي ينشئها مزود الخدمة لنفسه، فهي دائمًا مرتبطة بمزود واحد فقط).
     * - عروض الإدارة (broadcast): offer_owner = 'all'، لا تخص أي مزود بعينه
     *   (ستُرجع false دائمًا هنا، وهذا هو السلوك الصحيح).
     */
    public function isOwnedBy($user): bool
    {
        if (!$user) {
            return false;
        }

        if ($this->offer_owner === 'me') {
            return $this->serviceProviders()->where('users.id', $user->id)->exists();
        }

        return (string) $this->offer_owner === (string) $user->id;
    }

    /** تنسيق الخصم للعرض: "10 %" أو "25.00 ريال" */
    public function getFormattedDiscountAttribute(): ?string
    {
        if ($this->discount === null) {
            return null;
        }

        return $this->discount_type === self::DISCOUNT_TYPE_FIXED
            ? number_format((float) $this->discount, 2) . ' ريال'
            : number_format((float) $this->discount, 2) . ' %';
    }

    public function scopeNotExpired($query)
    {
        return $query->where(function ($q) {
            $q->whereNull('expiry_date')
              ->orWhereDate('expiry_date', '>=', now()->toDateString());
        });
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'accept');
    }

    public function scopeForCategories($query, array $categoryIds)
    {
        if (empty($categoryIds)) {
            return $query;
        }

        return $query->whereHas('categories', function ($q) use ($categoryIds) {
            $q->whereIn('categories.id', $categoryIds);
        });
    }

    public function scopeForZones($query, array $zoneIds)
    {
        if (empty($zoneIds)) {
            return $query;
        }

        return $query->whereHas('zones', function ($q) use ($zoneIds) {
            $q->whereIn('zones.id', $zoneIds);
        });
    }

    public function scopeForServiceTypes($query, array $serviceTypeIds)
    {
        if (empty($serviceTypeIds)) {
            return $query;
        }

        return $query->whereIn('service_type_id', $serviceTypeIds);
    }

    public function scopeForProviders($query, array $providerIds)
    {
        if (empty($providerIds)) {
            return $query;
        }

        return $query->whereHas('serviceProviders', function ($q) use ($providerIds) {
            $q->whereIn('users.id', $providerIds)->wherePivot('status', 'accept');
        });
    }

    /**
     * يربط العرض بمالكه الفعلي، مع التوافق نفسه الموجود في isOwnedBy():
     * يدعم offer_owner كرقم (النظام الجديد) أو 'me' (النظام القديم عبر pivot).
     */
    public function scopeOwnedBy($query, $userId)
    {
        if (!$userId) {
            return $query;
        }

        return $query->where(function ($q) use ($userId) {
            $q->where('offer_owner', $userId)
              ->orWhere(function ($legacy) use ($userId) {
                  $legacy->where('offer_owner', 'me')
                      ->whereHas('serviceProviders', function ($pivot) use ($userId) {
                          $pivot->where('users.id', $userId);
                      });
              });
        });
    }

    public function scopeOfferType($query, ?string $offerType)
    {
        return $offerType ? $query->where('offer_type', $offerType) : $query;
    }

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