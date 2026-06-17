<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wishlist extends Model
{
    use HasFactory;

    protected $fillable = ['estate_id','user_id'];

    protected $casts = [
        'user_id' => 'integer',
        'estate_id' => 'integer'
    ];

    public function estate()
    {
        // return $this->hasMany(Estate::class, 'id');

              return $this->belongsTo(Estate::class, 'estate_id')->active();
    }


    public function wishlistProduct()
    {
        return $this->belongsTo(Estate::class, 'id')->active();
    }
    public function product()
    {
        return $this->belongsTo(Estate::class, 'estate_id');
    }

    public function productFullInfo()
    {
        return $this->belongsTo(Estate::class, 'estate_id');
    }
}
