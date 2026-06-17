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






}
