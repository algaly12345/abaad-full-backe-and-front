<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\AgentTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens,AgentTrait;



    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    public $timestamps = false;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'ref_code',
        'is_active',
        'zone_id',
        'user_type',
        'is_phone_verified_at',
        'cm_firebase_token',
        'membership_type',
        'account_verification',
        'unified_number',
        'fal_license_number'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'wallet_balance' => 'float',
        'loyalty_point' => 'integer',
           'is_phone_verified' => 'integer',
        
    ];



    public function subscriptions()
{
    return $this->hasMany(ServiceProviderSubscription::class);
}



    public function provider()
    {
        return $this->hasOne(ServiceProvider::class);
    }


    public function scopeAgents($q)
    {
        return $q->where('user_type', 'agent');
    }

    public function scopeProviders($q)
    {
        return $q->where('user_type', 'provider');
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    public function agent()
    {
        return $this->hasOne(Agent::class);
    }



// app/Models/User.php

public function agentss()
{
    return $this->hasOne(Agent::class, 'user_id');
}

    public function estate()
    {
        return $this->hasMany(Estate::class);
    }


    public function getStatus()
    {
        if ($this->is_active == 'active') {
            return 'فعال';
        } else {
            return 'غير فعال';
        }
    }

    public function offers()
    {
        return $this->belongsToMany(Offer::class)->withPivot('status');
    }


    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }




}
