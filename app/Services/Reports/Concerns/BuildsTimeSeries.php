<?php

namespace App\Services\Reports\Concerns;

use Carbon\Carbon;
use Illuminate\Support\Collection;

/**
 * منطق مشترك لتعبئة فجوات السلاسل الزمنية في تقارير "النمو عبر الزمن"
 * (عقارات/مستخدمين)، بحيث يحصل الرسم البياني دائمًا على نقطة بيانات لكل
 * فترة (يوم/أسبوع/شهر) حتى لو كان عددها صفرًا في قاعدة البيانات، بدل أن
 * تظهر الفترات الخالية كفجوات مفقودة في الرسم. هذا الـ trait يُستخدم في
 * EstateReportService و UserReportService لتفادي تكرار نفس المنطق مرتين.
 */
trait BuildsTimeSeries
{
    /**
     * يقبل period مرنًا من المستخدم (قد يكون غير صالح) ويُعيد قيمة مضبوطة
     * آمنة دائمًا، مع تحديد سقف أعلى لعدد النقاط (60) لتفادي طلبات ثقيلة جدًا.
     */
    protected function normalizePeriodAndCount(string $period, int $count): array
    {
        $period = in_array($period, ['day', 'week', 'month'], true) ? $period : 'month';
        $count = max(1, min($count, 60));

        return [$period, $count];
    }

    protected function periodDateFormat(string $period): string
    {
        return match ($period) {
            'day' => '%Y-%m-%d',
            'week' => '%x-%v', // سنة-رقم الأسبوع بصيغة ISO-8601، مدعومة في DATE_FORMAT بـ MySQL
            default => '%Y-%m',
        };
    }

    protected function periodStartDate(string $period, int $count): Carbon
    {
        return match ($period) {
            'day' => Carbon::now()->subDays($count - 1)->startOfDay(),
            'week' => Carbon::now()->subWeeks($count - 1)->startOfWeek(),
            default => Carbon::now()->subMonths($count - 1)->startOfMonth(),
        };
    }

    /**
     * @param Collection $rows نتيجة pluck('total', 'period_label') من قاعدة البيانات
     * @return array{labels: array<string>, values: array<int>}
     */
    protected function fillMissingPeriods(Collection $rows, string $period, int $count): array
    {
        $labels = [];
        $values = [];

        for ($i = $count - 1; $i >= 0; $i--) {
            $date = match ($period) {
                'day' => Carbon::now()->subDays($i),
                'week' => Carbon::now()->subWeeks($i),
                default => Carbon::now()->subMonths($i),
            };

            // صيغة المفتاح هنا (PHP) يجب أن تطابق صيغة DATE_FORMAT في MySQL
            // (periodDateFormat) تمامًا حتى يحصل التطابق بين القيمتين عند البحث
            // في $rows بالمفتاح. 'o-W' في PHP = سنة ISO-أسبوع ISO، تمامًا مثل %x-%v.
            $key = match ($period) {
                'day' => $date->format('Y-m-d'),
                'week' => $date->format('o-W'),
                default => $date->format('Y-m'),
            };

            $labels[] = $key;
            $values[] = (int) ($rows[$key] ?? 0);
        }

        return ['labels' => $labels, 'values' => $values];
    }
}
