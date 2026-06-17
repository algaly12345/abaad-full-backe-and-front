<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name','name_ar','slug','position','home_status','image','parent_id','type'];

    //     protected $casts = [
    //         'name' => 'string',
    //         'slug' => 'string',
    //         'position' => 'integer',
    //         'home_status' => 'string',
    //         'image'=>'string',
    //         'parent_id'=>'integer '
    //     ];

    public function childs()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }


    public function childes(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }




    public function translations()
    {
        return $this->morphMany(Translation::class, 'translationable');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }


    public function estate(): HasMany
    {
        return $this->hasMany(Estate::class, 'category_id', 'id');
    }


    public function scopeSubCategories($q)
    {
        $q->where('parent_id', '!=', null);
    }


    public function offers()
    {
        return $this->belongsToMany(Offer::class);
    }
}
