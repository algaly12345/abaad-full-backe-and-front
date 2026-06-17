<?php


namespace App\Http\Controllers\Dashboard\serviceProvider;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Estate;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\ServiceSubscription;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Zone;
use App\Models\ServiceProviderSubscription; // تأكد من استيراد الموديل في الأعلى


class DashboardController extends Controller
{



public function dashboard()
{
    $userId = auth()->guard('user')->id();

    $approvedOffersCount = Offer::where('offer_owner', 'me')
        ->whereIn('status', ['accept', 'accpet']) // accpet بسبب الخطأ الموجود عندك
        ->count();

    $pendingOffersCount = Offer::where('offer_owner', 'me')
        ->where('status', 'pending')
        ->count();

    $totalViews = Estate::whereIn('category_id', function ($q) {
            $q->select('category_offer.category_id')
                ->from('category_offer')
                ->join('offers', 'offers.id', '=', 'category_offer.offer_id')
                ->where('offers.offer_owner', 'me');
        })
        ->whereIn('zone_id', function ($q) {
            $q->select('offer_zone.zone_id')
                ->from('offer_zone')
                ->join('offers', 'offers.id', '=', 'offer_zone.offer_id')
                ->where('offers.offer_owner', 'me');
        })
        ->sum('view');

    $viewsByZones = Zone::select(
            'zones.id',
            'zones.name',
            DB::raw('COUNT(DISTINCT estates.id) as estates_count'),
            DB::raw('SUM(estates.view) as total_views')
        )
        ->join('estates', 'estates.zone_id', '=', 'zones.id')
        ->whereIn('estates.category_id', function ($q) {
            $q->select('category_offer.category_id')
                ->from('category_offer')
                ->join('offers', 'offers.id', '=', 'category_offer.offer_id')
                ->where('offers.offer_owner', 'me');
        })
        ->whereIn('estates.zone_id', function ($q) {
            $q->select('offer_zone.zone_id')
                ->from('offer_zone')
                ->join('offers', 'offers.id', '=', 'offer_zone.offer_id')
                ->where('offers.offer_owner', 'me');
        })
        ->groupBy('zones.id', 'zones.name')
        ->orderByDesc('total_views')
        ->get();

    $viewsByCategories = Category::select(
            'categories.id',
            'categories.name',
            DB::raw('COUNT(DISTINCT estates.id) as estates_count'),
            DB::raw('SUM(estates.view) as total_views')
        )
        ->join('estates', 'estates.category_id', '=', 'categories.id')
        ->whereIn('categories.id', function ($q) {
            $q->select('category_offer.category_id')
                ->from('category_offer')
                ->join('offers', 'offers.id', '=', 'category_offer.offer_id')
                ->where('offers.offer_owner', 'me');
        })
        ->whereIn('estates.zone_id', function ($q) {
            $q->select('offer_zone.zone_id')
                ->from('offer_zone')
                ->join('offers', 'offers.id', '=', 'offer_zone.offer_id')
                ->where('offers.offer_owner', 'me');
        })
        ->groupBy('categories.id', 'categories.name')
        ->orderByDesc('total_views')
        ->get();
        
        
        
        $approvedOffersCount = Offer::where('offer_owner', 'me')
    ->where('status', 'accept')
    ->count();

$pendingOffersCount = Offer::where('offer_owner', 'me')
    ->where('status', 'pending')
    ->count();

$expiredOffersCount = Offer::where('offer_owner', 'me')
    ->whereDate('expiry_date', '<', now())
    ->count();

    $subscriptions = ServiceProviderSubscription::where('user_id', $userId)
        ->orderBy('expiry_date')
        ->get();

return view('service-provider.dashboard.index', compact(
    'approvedOffersCount',
    'pendingOffersCount',
    'expiredOffersCount',
    'totalViews',
    'viewsByZones',
    'viewsByCategories',
    'subscriptions'
));
}



    public function changeLanguage(Request $request): JsonResponse
{
    // Validate the incoming request
    $request->validate([
        'language_code' => 'required|string',
    ]);

    Log::info('Change language request received', ['language_code' => $request->language_code]);

    // Default language direction
    $direction = 'ltr';
    $language = getWebConfig('language');

    foreach ($language as $data) {
        if ($data['code'] == $request['language_code']) {
            $direction = $data['direction'] ?? 'ltr';
        }
    }

    // Log the direction
    Log::info('Language direction determined', ['direction' => $direction]);

    // Clear the session language settings
    session()->forget('language_settings');
    Helpers::language_load();

    // Set the new language code and direction
    session()->put('local', $request['language_code']);
    session()->put('direction', $direction);

    // Log the session values
    Log::info('Session updated', ['local' => session()->get('local'), 'direction' => session()->get('direction')]);

    // Return a successful JSON response
    return response()->json(['message' => translate('language_change_successfully') . '.']);
}
}
