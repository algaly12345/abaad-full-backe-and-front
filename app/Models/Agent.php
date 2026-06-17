<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;
    protected $fillable = ["name","phone",'latitude','longitude','identity','advertiser_no','identity_type','membership_type','image','commercial_registerion_no','user_id',"agent_type","fal_license_number"  ,'unified_number'];
  
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
