<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\QueryException;

return new class extends Migration
{
    public function up(): void
    {
        // إضافة الفهارس بأمان (إذا كانت موجودة سيتم تخطيها)
        $this->addIndexSafely('offers', 'status', 'offers_status_index');
        $this->addIndexSafely('offers', 'expiry_date', 'offers_expiry_date_index');
        $this->addIndexSafely('offers', 'service_type_id', 'offers_service_type_id_index');
        $this->addIndexSafely('offers', ['status', 'expiry_date'], 'offers_status_expiry_index');

        $this->addIndexSafely('category_offer', ['category_id', 'offer_id'], 'category_offer_category_offer_index');
        $this->addIndexSafely('offer_zone', ['zone_id', 'offer_id'], 'offer_zone_zone_offer_index');
    }

    public function down(): void
    {
        // حذف الفهارس بأمان (إذا كانت غير موجودة سيتم تخطيها)
        $this->dropIndexSafely('offers', 'offers_status_index');
        $this->dropIndexSafely('offers', 'offers_expiry_date_index');
        $this->dropIndexSafely('offers', 'offers_service_type_id_index');
        $this->dropIndexSafely('offers', 'offers_status_expiry_index');

        $this->dropIndexSafely('category_offer', 'category_offer_category_offer_index');
        $this->dropIndexSafely('offer_zone', 'offer_zone_zone_offer_index');
    }

    /**
     * دالة مساعدة لإنشاء الفهرس مع تجاهل خطأ "الفهرس موجود مسبقاً"
     */
    private function addIndexSafely(string $tableName, array|string $columns, string $indexName): void
    {
        try {
            Schema::table($tableName, function (Blueprint $table) use ($columns, $indexName) {
                $table->index($columns, $indexName);
            });
        } catch (QueryException $e) {
            // كود 1061 في MySQL يعني أن الفهرس موجود مسبقاً
            if (!str_contains($e->getMessage(), '1061 Duplicate key')) {
                throw $e; // إذا كان الخطأ مختلفاً، قم بإظهاره
            }
        }
    }

    /**
     * دالة مساعدة لحذف الفهرس مع تجاهل خطأ "الفهرس غير موجود"
     */
    private function dropIndexSafely(string $tableName, string $indexName): void
    {
        try {
            Schema::table($tableName, function (Blueprint $table) use ($indexName) {
                $table->dropIndex($indexName);
            });
        } catch (QueryException $e) {
            // كود 1091 في MySQL يعني أن الفهرس غير موجود أساساً لكي يتم حذفه
            if (!str_contains($e->getMessage(), '1091')) {
                throw $e;
            }
        }
    }
};