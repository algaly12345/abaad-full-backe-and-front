<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityLite extends Model
{
    protected $table="cities_lite";
    use HasFactory;
     protected $casts = [
        'city_id' => 'integer',
        'region_id' => 'integer',

    ];
}
