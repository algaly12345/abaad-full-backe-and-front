<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\GetReportChartRequest;
use App\Services\Reports\EstateReportService;
use App\Services\Reports\ProviderReportService;
use App\Services\Reports\UserReportService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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

    public function providerDashboard(Request $request): JsonResponse
    {
        $providerId = $request->user(self::AUTH_GUARD)->id;

        return response()->json([
            'status' => 'success',
            'data' => [
                'summary' => $this->providerReportService->summary($providerId),
                'views_by_zone' => $this->providerReportService->viewsByZone($providerId),
                'views_by_category' => $this->providerReportService->viewsByCategory($providerId),
                'subscriptions' => $this->providerReportService->activeSubscriptions($providerId),
            ],
        ], 200);
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
