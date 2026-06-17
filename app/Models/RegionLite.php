<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegionLite extends Model
{
    protected $table ='regions_lite';
    use HasFactory;
    protected $casts = [
        'region_id' => 'integer',
        'capital_city_id' => 'integer',
        'population' => 'integer',
    ];
 
}
