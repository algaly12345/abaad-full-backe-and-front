<?php

namespace App\Console\Commands;

use App\Models\FirebaseCredential;
use Illuminate\Console\Command;

/**
 * يُشغَّل مرة واحدة (أو عند تدوير المفتاح) لتخزين محتوى service-account.json
 * في قاعدة البيانات (مشفّرًا) بدل الاعتماد على ملف على السيرفر. راجع
 * FcmV1Service::getAccessToken() الذي يقرأ من هذا الجدول أولاً.
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

        $envProjectId = env('FIREBASE_PROJECT_ID');
        if ($envProjectId && $decoded['project_id'] !== $envProjectId) {
            $this->warn("تنبيه: project_id في الملف ({$decoded['project_id']}) يختلف عن FIREBASE_PROJECT_ID في .env ({$envProjectId}).");
        }

        FirebaseCredential::query()->delete();
        FirebaseCredential::create(['payload' => $decoded]);

        $this->info('تم حفظ مفتاح Firebase في قاعدة البيانات بنجاح.');
        if ($path) {
            $this->warn("لا تنسى حذف الملف الأصلي من السيرفر بعد التأكد: {$path}");
        }

        return Command::SUCCESS;
    }
}
