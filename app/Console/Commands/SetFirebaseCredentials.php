<?php

namespace App\Console\Commands;

use App\Models\BusinessSetting;
use App\Models\FirebaseCredential;
use Illuminate\Console\Command;

/**
 * يُشغَّل مرة واحدة (أو عند تدوير المفتاح) لتخزين محتوى service-account.json
 * في قاعدة البيانات (مشفّرًا) بدل الاعتماد على ملف على السيرفر، ولتخزين
 * project_id في جدول business_settings بدل .env. راجع FcmV1Service الذي
 * يقرأ من الجدولين هذين فقط (لا يعتمد على .env إطلاقًا لهذي القيم).
 */
class SetFirebaseCredentials extends Command
{
    protected $signature = 'firebase:set-credentials
        {--path= : مسار محلي لملف service-account.json. إن لم يُحدد، تُقرأ محتويات JSON من stdin}';

    protected $description = 'تخزين/تحديث مفتاح حساب خدمة Firebase في قاعدة البيانات بدل ملف';

    public function handle(): int
    {
        $path = $this->option('path');

        if ($path) {
            if (!is_file($path)) {
                $this->error("الملف غير موجود: {$path}");
                return Command::FAILURE;
            }
            $raw = file_get_contents($path);
        } else {
            $this->info('الصق محتوى JSON ثم اضغط Ctrl+D (أو Ctrl+Z على Windows):');
            $raw = stream_get_contents(STDIN);
        }

        $decoded = json_decode($raw, true);
        if (!is_array($decoded)) {
            $this->error('محتوى غير صالح: ما قدرت أفك ترميز JSON.');
            return Command::FAILURE;
        }

        foreach (['client_email', 'private_key', 'project_id'] as $required) {
            if (empty($decoded[$required])) {
                $this->error("الحقل المطلوب مفقود في JSON: {$required}");
                return Command::FAILURE;
            }
        }

        FirebaseCredential::query()->delete();
        FirebaseCredential::create(['payload' => $decoded]);

        BusinessSetting::where('type', 'fcm_project_id')->delete();
        BusinessSetting::insert(['type' => 'fcm_project_id', 'value' => $decoded['project_id']]);

        $this->info('تم حفظ مفتاح Firebase و project_id في قاعدة البيانات بنجاح.');
        if ($path) {
            $this->warn("لا تنسى حذف الملف الأصلي من السيرفر بعد التأكد: {$path}");
        }

        return Command::SUCCESS;
    }
}
