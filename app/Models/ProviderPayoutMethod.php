<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProviderPayoutMethod extends Model
{
    protected $fillable = [
        'user_id',
        'account_holder_name',
        'iban',
        'bank_name',
        'national_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
