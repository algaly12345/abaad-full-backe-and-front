<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistrictLite extends Model
{
    protected $table="districts_lite";
    use HasFactory;

    protected $casts = [
        'district_id' => 'integer',
        'city_id' => 'integer',
        'region_id' => 'integer',

    ];

}
