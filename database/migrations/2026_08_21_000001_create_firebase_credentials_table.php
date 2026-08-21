<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * تخزين مفتاح حساب خدمة Firebase (service-account.json) في قاعدة البيانات
 * بدل ملف على السيرفر، حتى لا يحتاج نشره عبر Git أو رفعه يدويًا لكل بيئة.
 * الصف الوحيد بالجدول يُدار عبر أمر `firebase:set-credentials`، والعمود
 * payload مشفّر بمفتاح APP_KEY (كاست encrypted:array في FirebaseCredential)
 * حتى نسخة احتياطية من قاعدة البيانات وحدها لا تكفي لكشف المفتاح الخاص.
 */
return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('firebase_credentials')) {
            Schema::create('firebase_credentials', function (Blueprint $table) {
                $table->id();
                $table->text('payload');
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('firebase_credentials');
    }
};
