<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * ⚠️ تنبيه قبل التشغيل: نفّذ أولًا "SHOW INDEX FROM estates;" على قاعدة
 * بياناتك الفعلية، وتأكد ألا يوجد بالفعل فهرس بنفس أحد الأسماء أدناه (قد يكون
 * بعضها موجودًا مسبقًا كفهارس مفاتيح خارجية ضمنية حسب نسخة المشروع لديك).
 * إن وجدت تكرارًا، احذف السطر المكرر من هذه المigration قبل تشغيلها لتفادي
 * خطأ "Duplicate key name" من MySQL.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('estates', function (Blueprint $table) {
            $table->index('zone_id', 'estates_zone_id_index');
            $table->index('category_id', 'estates_category_id_index');
            $table->index('user_id', 'estates_user_id_index');
            $table->index('status', 'estates_status_index');
            $table->index('city', 'estates_city_index');
            $table->index('advertisement_type', 'estates_advertisement_type_index');
            $table->index(['latitude', 'longitude'], 'estates_lat_lng_index');
            $table->index('view', 'estates_view_index');
            $table->index('created_at', 'estates_created_at_index');
        });
    }

    public function down(): void
    {
        Schema::table('estates', function (Blueprint $table) {
            $table->dropIndex('estates_zone_id_index');
            $table->dropIndex('estates_category_id_index');
            $table->dropIndex('estates_user_id_index');
            $table->dropIndex('estates_status_index');
            $table->dropIndex('estates_city_index');
            $table->dropIndex('estates_advertisement_type_index');
            $table->dropIndex('estates_lat_lng_index');
            $table->dropIndex('estates_view_index');
            $table->dropIndex('estates_created_at_index');
        });
    }
};
