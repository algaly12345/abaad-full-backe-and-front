<?php

namespace App\Http\Controllers\Dashboard\serviceProvider;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Services\Reports\ProviderReportService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * لوحة تحكم مزود الخدمة.
 *
 * ⚠️ تم نقل كل منطق حساب الإحصائيات (الذي كان مكتوبًا مباشرة هنا بأكثر من
 * 80 سطرًا من الاستعلامات المتداخلة) إلى App\Services\Reports\ProviderReportService،
 * مع تصحيح خلل في النطاق (scoping) كان يُظهر إحصائيات كل مزودي الخدمة مجمّعة
 * بدل إحصائيات المزود الحالي فقط فقط — راجع تعليقات ProviderReportService
 * للتفاصيل الكاملة عن الخلل وطريقة إصلاحه.
 *
 * أسماء المتغيرات الممرَّرة لِview() لم تتغيّر إطلاقًا (approvedOffersCount،
 * pendingOffersCount، expiredOffersCount، totalViews، viewsByZones،
 * viewsByCategories، subscriptions) حتى لا ينكسر القالب الحالي
 * service-provider.dashboard.index الذي يعتمد على هذه الأسماء بالضبط.
 */
class DashboardController extends Controller
{
    public function __construct(
        private readonly ProviderReportService $providerReportService
    ) {
    }

    public function dashboard()
    {
        $providerId = auth()->guard('user')->id();

        $summary = $this->providerReportService->summary($providerId);

        return view('service-provider.dashboard.index', [
            'approvedOffersCount' => $summary['approved_offers_count'],
            'pendingOffersCount' => $summary['pending_offers_count'],
            'expiredOffersCount' => $summary['expired_offers_count'],
            'totalViews' => $summary['total_views'],
            'viewsByZones' => $this->providerReportService->viewsByZone($providerId),
            'viewsByCategories' => $this->providerReportService->viewsByCategory($providerId),
            'subscriptions' => $this->providerReportService->activeSubscriptions($providerId),
        ]);
    }

    public function changeLanguage(Request $request): JsonResponse
    {
        $request->validate([
            'language_code' => 'required|string',
        ]);

        Log::info('Change language request received', ['language_code' => $request->language_code]);

        $direction = 'ltr';
        $language = getWebConfig('language');

        foreach ($language as $data) {
            if ($data['code'] == $request['language_code']) {
                $direction = $data['direction'] ?? 'ltr';
            }
        }

        Log::info('Language direction determined', ['direction' => $direction]);

        session()->forget('language_settings');
        Helpers::language_load();

        session()->put('local', $request['language_code']);
        session()->put('direction', $direction);

        Log::info('Session updated', ['local' => session()->get('local'), 'direction' => session()->get('direction')]);

        return response()->json(['message' => translate('language_change_successfully') . '.']);
    }
}
