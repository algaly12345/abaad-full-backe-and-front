<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPackages extends Model
{
    use HasFactory;


    protected $casts = [
        'package_name'=>'string',
        'price'=>'float',
        'validity'=>'integer',
        'tergat'=>'string',
        'chat'=>'integer',
        'default'=>'integer',
        'status'=>'integer',
    ];
    
    
     public function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'category_id');
    }


    public function getColor()
    {
        if ($this->color == '#FFD93D') {
            return 'ذهبي';
        } elseif ($this->color == '#FFF3E2') {
            return 'فضي';
        } elseif ($this->color == '#E5E4E2') {
            return 'بلاتيني';
        }
    }
}
