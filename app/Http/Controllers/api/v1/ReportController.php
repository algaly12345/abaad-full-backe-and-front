<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\GetProviderDashboardRequest;
use App\Http\Requests\Api\GetReportChartRequest;
use App\Services\Reports\EstateReportService;
use App\Services\Reports\ProviderReportService;
use App\Services\Reports\UserReportService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

/**
 * تقارير وإحصائيات عبر API. المسارات مقسّمة لمستويين بحراسة مختلفة تمامًا
 * (راجع ملف الراوت routes-snippets/ROUTES_api_v1_reports_snippet.php):
 *
 * - provider/* : إحصائيات مزود الخدمة الحالي فقط (آمنة، صلاحية
 *   reports.view-own المُمنوحة افتراضيًا لكل مزود).
 * - global/*   : إحصائيات عامة على مستوى المنصة كلها (إدارية، صلاحية
 *   reports.view-global التي لا تُمنح لأي مزود افتراضيًا — تمامًا بنفس
 *   فلسفة plans.manage-global في ServicePlanManagementController، إلى أن
 *   يُستحدث حارس Passport إداري حقيقي منفصل عن حارس مزودي الخدمة).
 */
class ReportController extends Controller
{
    private const AUTH_GUARD = 'api';

    public function __construct(
        private readonly EstateReportService $estateReportService,
        private readonly UserReportService $userReportService,
        private readonly ProviderReportService $providerReportService,
    ) {
    }

    public function providerDashboard(GetProviderDashboardRequest $request): JsonResponse
    {
        $providerId = $request->user(self::AUTH_GUARD)->id;
        $data = $request->validated();
        $periodKey = $data['period'] ?? 'all';
        [$from, $to] = $this->resolvePeriodRange($periodKey, $data['from'] ?? null, $data['to'] ?? null);

        return response()->json([
            'status' => 'success',
            'data' => [
                'summary' => $this->providerReportService->summary($providerId),
                'views_by_zone' => $this->providerReportService->viewsByZone($providerId),
                'views_by_category' => $this->providerReportService->viewsByCategory($providerId),
                'subscriptions' => $this->providerReportService->subscriptionsOverview($providerId),
                'period' => [
                    'key' => $periodKey,
                    'from' => $from?->toDateString(),
                    'to' => $to?->toDateString(),
                ],
                'period_summary' => $this->providerReportService->periodSummary($providerId, $from, $to),
                'period_subscriptions' => $this->providerReportService->periodSubscriptions($providerId, $from, $to),
            ],
        ], 200);
    }

    /**
     * يحوّل مفتاح الفترة المختصر (today/week/month/all/custom) إلى حدود
     * تاريخ فعلية [$from, $to]. 'all' تعيد [null, null] (بلا أي تقييد زمني)،
     * وتُستخدم Carbon::now() كحد أعلى للفترات الجاهزة كي لا تتضمن أي بيانات
     * "مستقبلية" لو اختلفت ساعة الخادم عن توقعات العميل.
     *
     * @return array{0: ?Carbon, 1: ?Carbon}
     */
    private function resolvePeriodRange(string $period, ?string $from, ?string $to): array
    {
        $now = Carbon::now();

        return match ($period) {
            'today' => [$now->copy()->startOfDay(), $now],
            'week' => [$now->copy()->startOfWeek(), $now],
            'month' => [$now->copy()->startOfMonth(), $now],
            'custom' => [
                $from ? Carbon::parse($from)->startOfDay() : null,
                $to ? Carbon::parse($to)->endOfDay() : null,
            ],
            default => [null, null],
        };
    }

    public function globalOverview(): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data' => [
                'estates' => $this->estateReportService->overview(),
                'users' => $this->userReportService->overview(),
            ],
        ], 200);
    }

    public function globalEstates(): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data' => [
                'overview' => $this->estateReportService->overview(),
                'by_category' => $this->estateReportService->byCategory(),
                'by_zone' => $this->estateReportService->byZone(),
                'by_city' => $this->estateReportService->byCity(),
                'by_advertisement_type' => $this->estateReportService->byAdvertisementType(),
                'top_viewed' => $this->estateReportService->topViewed(),
                'most_active_agents' => $this->estateReportService->mostActiveAgents(),
            ],
        ], 200);
    }

    public function globalUsers(): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data' => [
                'overview' => $this->userReportService->overview(),
                'by_type' => $this->userReportService->byType(),
                'by_zone' => $this->userReportService->byZone(),
                'by_membership_type' => $this->userReportService->byMembershipType(),
            ],
        ], 200);
    }

    public function globalCharts(GetReportChartRequest $request): JsonResponse
    {
        $data = $request->validated();
        $period = $data['period'] ?? 'month';
        $count = (int) ($data['count'] ?? 12);

        return response()->json([
            'status' => 'success',
            'data' => [
                'estates_growth' => $this->estateReportService->growthOverTime($period, $count),
                'users_growth' => $this->userReportService->registrationsGrowth($period, $count),
            ],
        ], 200);
    }
}