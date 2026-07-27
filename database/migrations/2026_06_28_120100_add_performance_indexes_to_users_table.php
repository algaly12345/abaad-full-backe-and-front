<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * ⚠️ نفس تنبيه migration الفهارس الخاص بجدول estates: تحقق أولًا من
 * "SHOW INDEX FROM users;" قبل التشغيل لتفادي تكرار فهرس موجود مسبقًا.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->index('user_type', 'users_user_type_index');
            $table->index('zone_id', 'users_zone_id_index');
            $table->index('is_active', 'users_is_active_index');
            $table->index('created_at', 'users_created_at_index');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex('users_user_type_index');
            $table->dropIndex('users_zone_id_index');
            $table->dropIndex('users_is_active_index');
            $table->dropIndex('users_created_at_index');
        });
    }
};
