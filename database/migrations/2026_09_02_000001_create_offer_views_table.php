<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * تتبّع مشاهدات عرض الخدمة الفعلية (لكل عرض على حدة) — يغذّي إحصائيات مزوّد
 * الخدمة الدقيقة بدل التقدير القديم الذي كان يجمع مشاهدات كل العقارات في نفس
 * مناطق/تصنيفات العرض (يشمل عروض المنافسين).
 *
 * صف واحد لكل "مُشاهِد فريد في اليوم": الفهرس الفريد المركّب
 * (offer_id, viewer_hash, viewed_date) يمنع تضخيم الرقم بإعادة فتح نفس العرض
 * مرارًا في اليوم نفسه. البيانات تبدأ من تاريخ نشر هذه الميزة (لا سجل تاريخي).
 */
return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('offer_views')) {
            return;
        }

        Schema::create('offer_views', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('offer_id');
            // معرّف المستخدم إن كان مسجّل الدخول وقت المشاهدة (للتحليل لاحقًا فقط).
            $table->unsignedBigInteger('user_id')->nullable();
            // "u:<id>" للمستخدم المسجّل، أو sha256(ip|user_agent) للزائر — أساس
            // إزالة التكرار اليومي دون تخزين IP خام.
            $table->string('viewer_hash', 64);
            $table->date('viewed_date');
            $table->timestamp('created_at')->nullable();

            $table->unique(['offer_id', 'viewer_hash', 'viewed_date'], 'offer_views_unique_daily');
            $table->index(['offer_id', 'viewed_date'], 'offer_views_offer_date_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('offer_views');
    }
};
