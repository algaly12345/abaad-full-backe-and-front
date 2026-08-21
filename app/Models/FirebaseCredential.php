<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * صف وحيد يحمل محتوى ملف service-account.json الخاص بـ Firebase، مشفّرًا
 * في قاعدة البيانات بدل ملف على السيرفر. راجع FcmV1Service للاستخدام
 * وأمر firebase:set-credentials لتعبئة/تحديث الصف.
 */
class FirebaseCredential extends Model
{
    protected $fillable = ['payload'];

    protected $casts = [
        'payload' => 'encrypted:array',
    ];

    public static function current(): ?array
    {
        return static::query()->first()?->payload;
    }
}
