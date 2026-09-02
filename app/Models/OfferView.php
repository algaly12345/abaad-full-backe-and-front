<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * صف واحد لكل مُشاهِد فريد لعرض خدمة في يوم واحد (راجع هجرة create_offer_views_table).
 * يُكتب عبر App\Services\OfferViewRecorder ويُقرأ في App\Services\Reports\ProviderReportService.
 */
class OfferView extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'offer_id',
        'user_id',
        'viewer_hash',
        'viewed_date',
        'created_at',
    ];

    protected $casts = [
        'viewed_date' => 'date',
        'created_at' => 'datetime',
    ];

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }
}
