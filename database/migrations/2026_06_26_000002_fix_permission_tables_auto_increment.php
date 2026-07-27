<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * يُصلح مشكلة بنية حقيقية موجودة في قاعدة البيانات: عمود `id` في جدولي
 * `permissions` و `roles` فاقد خاصية AUTO_INCREMENT (سبب شائع: استيراد الجدول
 * عبر SQL dump/أداة نقل فقدت هذه الخاصية أثناء العملية).
 *
 * النتيجة: أي محاولة إدراج (firstOrCreate / create) عبر Eloquent بدون تمرير
 * id يدويًا تفشل بخطأ:
 *   SQLSTATE[HY000]: General error: 1364 Field 'id' doesn't have a default value
 *
 * هذا الملف لا يفعل شيئًا إذا كانت الأعمدة سليمة أصلًا (آمن للتشغيل في كل
 * البيئات بدون أي أثر جانبي إذا لم تكن المشكلة موجودة).
 */
return new class extends Migration
{
    public function up(): void
    {
        $this->fixAutoIncrement('permissions');
        $this->fixAutoIncrement('roles');
    }

    public function down(): void
    {
        // لا تراجع — هذا تصحيح بنية، وليس تغييرًا منطقيًا يجب عكسه.
    }

    private function fixAutoIncrement(string $table): void
    {
        if (!Schema::hasTable($table) || !Schema::hasColumn($table, 'id')) {
            return;
        }

        $databaseName = DB::connection()->getDatabaseName();

        $columnInfo = DB::selectOne("
            SELECT EXTRA, COLUMN_TYPE
            FROM information_schema.COLUMNS
            WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ? AND COLUMN_NAME = 'id'
        ", [$databaseName, $table]);

        if (!$columnInfo) {
            return;
        }

        $isAutoIncrement = str_contains(strtolower($columnInfo->EXTRA ?? ''), 'auto_increment');

        if ($isAutoIncrement) {
            // العمود سليم أصلًا، لا حاجة لأي تعديل.
            return;
        }

        $primaryKeyRow = DB::selectOne("
            SELECT COUNT(*) as cnt
            FROM information_schema.STATISTICS
            WHERE TABLE_SCHEMA = ?
              AND TABLE_NAME = ?
              AND INDEX_NAME = 'PRIMARY'
              AND COLUMN_NAME = 'id'
        ", [$databaseName, $table]);

        $hasPrimaryKey = $primaryKeyRow && (int) $primaryKeyRow->cnt > 0;

        $maxId = (int) (DB::table($table)->max('id') ?? 0);

        if ($hasPrimaryKey) {
            // id موجود كمفتاح أساسي فعلًا، فقط نضيف AUTO_INCREMENT.
            DB::statement("ALTER TABLE `{$table}` MODIFY `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT");
        } else {
            // لا يوجد مفتاح أساسي على id أصلًا — نضيفه مع AUTO_INCREMENT معًا.
            DB::statement("ALTER TABLE `{$table}` MODIFY `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY");
        }

        if ($maxId > 0) {
            // نضبط نقطة البداية بعد آخر id موجود فعليًا، لتجنّب تضارب مع بيانات قديمة.
            DB::statement("ALTER TABLE `{$table}` AUTO_INCREMENT = " . ($maxId + 1));
        }
    }
};