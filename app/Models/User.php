<?php

namespace App\Models;

use App\Enums\ProviderRole;
use App\Traits\AgentTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, AgentTrait, HasRoles;

    public const TYPE_CUSTOMER = 'customer';
    public const TYPE_AGENT = 'agent';
    public const TYPE_PROVIDER = 'provider';

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

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'wallet_balance' => 'float',
        'loyalty_point' => 'integer',
        'is_phone_verified' => 'integer',
    ];

    /**
     * نفس موديل User يُستخدم تحت ثلاثة حراس مختلفة (customer / user / api)،
     * ولا يوجد بينها ترتيب مضمون في config/auth.php يحدد أيها سيُختار افتراضيًا
     * عند استدعاء دوال Spatie (assignRole, hasPermissionTo, ...).
     *
     * نظام الأدوار/الصلاحيات في هذا المشروع مخصص فقط لمزودي الخدمة عبر واجهة
     * API (حارس api / Passport)، ولا يُستخدم إطلاقًا من جهة العميل أو لوحة
     * الويب الجلسية. لذلك من الآمن تثبيت الحارس الافتراضي على 'api' دائمًا،
     * بدل ترك Spatie يحاول تخمينه.
     */
    public function getDefaultGuardName(): string
    {
        return 'api';
    }

    /**
     * فحص سريع ومختصر: هل هذا الحساب مزود خدمة فعليًا (بحسب user_type)؟
     * هذا لا يتحقق من الأدوار/الصلاحيات؛ فقط نوع الحساب نفسه.
     */
    public function isProvider(): bool
    {
        return $this->user_type === self::TYPE_PROVIDER;
    }

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
        return $q->where('user_type', self::TYPE_AGENT);
    }

    public function scopeProviders($q)
    {
        return $q->where('user_type', self::TYPE_PROVIDER);
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    public function agent()
    {
        return $this->hasOne(Agent::class);
    }

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