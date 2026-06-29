<?php

namespace App\Http\Controllers\api\v1\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    /**
     * الإحصائيات الرئيسية لصفحة الداشبورد
     *
     * عدّل أسماء الجداول والموديلات أدناه لتطابق مشروعك بدقة
     * (استنتجتها من routes/v1.php الذي أرسلته، عدّل ما يلزم)
     */
    public function stats(Request $request)
    {
        $stats = [
            'total_estates' => DB::table('estates')->count(),
            'pending_estates' => DB::table('estates')
                ->where('status', 'pending')
                ->count(),
            'approved_estates' => DB::table('estates')
                ->where('status', 'approved')
                ->count(),

            'total_providers' => DB::table('service_providers')->count(),
            'active_providers' => DB::table('service_providers')
                ->where('status', 'active')
                ->count(),

            'total_customers' => DB::table('customers')->count(),

            'total_packages' => DB::table('packages')->count(),

            // إحصائيات اليوم — مفيدة لبطاقات "اليوم" في الداشبورد
            'today_new_estates' => DB::table('estates')
                ->whereDate('created_at', today())
                ->count(),
            'today_new_customers' => DB::table('customers')
                ->whereDate('created_at', today())
                ->count(),
        ];

        return response()->json([
            'success' => true,
            'data' => $stats,
        ]);
    }

    /**
     * آخر النشاطات — للعرض في جدول "آخر التحديثات" بالداشبورد
     */
    public function recentActivities(Request $request)
    {
        $limit = $request->input('limit', 10);

        $recentEstates = DB::table('estates')
            ->select('id', 'title', 'status', 'created_at')
            ->orderByDesc('created_at')
            ->limit($limit)
            ->get();

        $recentProviders = DB::table('service_providers')
            ->select('id', 'name', 'status', 'created_at')
            ->orderByDesc('created_at')
            ->limit($limit)
            ->get();

        return response()->json([
            'success' => true,
            'data' => [
                'recent_estates'   => $recentEstates,
                'recent_providers' => $recentProviders,
            ],
        ]);
    }

    /**
     * بيانات الرسم البياني — مثلاً عدد العقارات المضافة آخر 30 يوم
     * مناسب لرسم بياني خطي أو أعمدة في الداشبورد
     */
    public function chartData(Request $request)
    {
        $days = $request->input('days', 30);

        $data = DB::table('estates')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->where('created_at', '>=', now()->subDays($days))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }
}
