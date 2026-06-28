<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\Reports\EstateReportService;
use App\Services\Reports\UserReportService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Endpoints التقارير والإحصائيات الخاصة بلوحة تحكم الإدارة (Web/JSON فقط،
 * بدون أي صفحة Blade — يستخدم نفس الـ guard الجلسي `admin` الحالي عبر
 * middleware الموجود في routes/admin.php). الواجهة (Frontend) في لوحة
 * الإدارة هي مسؤولية فريقكم بالكامل وتستهلك هذه الـ endpoints كما تريد.
 */
class ReportController extends Controller
{
    public function __construct(
        private readonly EstateReportService $estateReportService,
        private readonly UserReportService $userReportService,
    ) {
    }

    public function index(): JsonResponse
    {
        return response()->json([
            'estates_overview' => $this->estateReportService->overview(),
            'users_overview' => $this->userReportService->overview(),
        ]);
    }

    public function estatesChartData(Request $request): JsonResponse
    {
        $period = $request->input('period', 'month');
        $count = (int) $request->input('count', 12);

        return response()->json($this->estateReportService->growthOverTime($period, $count));
    }

    public function usersChartData(Request $request): JsonResponse
    {
        $period = $request->input('period', 'month');
        $count = (int) $request->input('count', 12);

        return response()->json($this->userReportService->registrationsGrowth($period, $count));
    }

    public function estatesBreakdown(): JsonResponse
    {
        return response()->json([
            'by_category' => $this->estateReportService->byCategory(),
            'by_zone' => $this->estateReportService->byZone(),
            'by_city' => $this->estateReportService->byCity(),
            'by_advertisement_type' => $this->estateReportService->byAdvertisementType(),
            'top_viewed' => $this->estateReportService->topViewed(),
            'most_active_agents' => $this->estateReportService->mostActiveAgents(),
        ]);
    }

    public function usersBreakdown(): JsonResponse
    {
        return response()->json([
            'by_type' => $this->userReportService->byType(),
            'by_zone' => $this->userReportService->byZone(),
            'by_membership_type' => $this->userReportService->byMembershipType(),
        ]);
    }
}
