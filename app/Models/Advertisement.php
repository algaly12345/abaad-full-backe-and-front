<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;
    protected $dates = ['created_at', 'updated_at', 'start_date', 'end_date'];

    protected $casts = [
        'status' => 'integer',
        'provider_id' => 'integer',
    ];
    public function providers()
    {
        return $this -> belongsTo(ServiceProvider::class,'provider_id','id');
    }
}
