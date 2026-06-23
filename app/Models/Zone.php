<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use MatanYadaev\EloquentSpatial\Objects\Polygon;

class Zone extends Model
{
    use HasFactory;



    protected $fillable = [
        'name',
        'name_ar',
        'image',
        'territory_id',
        'coordinates',
        'status',
        'latitude',
        'longitude',
    ];



    protected $spatialFields = [
        'coordinates'
    ];

    protected $casts = [
        'coordinates' => Polygon::class,
        'territory_id'=>'integer',
    ];


  public function translations()
    {
        return $this->morphMany(Translation::class, 'translationable');
    }
    public function territory()
    {
        return $this->belongsTo(Territory::class);
    }


    public function estate()
    {
        return $this->hasMany(Estate::class);
    }
    public function offers()
    {
        return $this->belongsToMany(Offer::class, 'offer_zone');
    }
}