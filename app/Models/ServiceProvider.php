<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ServiceProvider extends Authenticatable
{
    use HasFactory,Notifiable;



    protected $fillable = [
       'identity_number',
       'identity_type',
       'image',
       'address',
       'user_id',
       'job',
       'service_type_id',
       'commercial_registration_no',
       'latitude',
       'longitude'
    ];



    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class);
    }
}
