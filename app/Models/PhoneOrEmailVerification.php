<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneOrEmailVerification extends Model
{
    use HasFactory;
    protected $fillable = ['phone_or_email','token','otp_hit_count','is_temp_blocked','temp_block_time'];

}
