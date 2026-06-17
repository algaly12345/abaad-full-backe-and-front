<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\City;
use App\Models\DistrictLite;
use App\Models\Estate;
use App\Models\RegionLite;
use App\Models\User;

use App\Models\Zone;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Wishlist;



use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    public function __construct(
        private Estate      $product,
        private User        $order,

        private Category     $category,

        private Banner       $banner,

    )
    {
    }
    
    
    
    
    
    
    
    
    
    public function estates(Request $request)
    {
        $search = $request->search;

        $estates = Estate::with('userad','agent')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('id', $search)
                        ->orWhere('adLicense_number', 'like', "%{$search}%")
                        ->orWhere('identityـorـunified', 'like', "%{$search}%")
                        ->orWhere('short_description', 'like', "%{$search}%")
                        ->orWhere('city', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('estates.index', compact('estates', 'search'));
    }

    public function editEstate(Estate $estate)
    {
        return view('estates.edit', compact('estate'));
    }

public function updateEstate(Request $request, Estate $estate)
{
    $request->validate([
        'adLicense_number' => 'nullable|string|max:255',
        'identityـorـunified' => 'nullable|string|max:255',
        'estate_type' => 'required|in:1,2',
        'adLicenseUrl' => 'nullable|url|max:1000',
    ]);

    $estate->adLicense_number = $request->input('adLicense_number');
    $estate->{'identityـorـunified'} = $request->input('identityـorـunified');
    $estate->estate_type = $request->input('estate_type');
    $estate->adLicenseUrl = $request->input('adLicenseUrl');

    $estate->save();

    return redirect()
        ->route('estates.index2', $estate->id)
        ->with('success', 'تم تحديث بيانات العقار بنجاح');
}


public function transferIdentity(Request $request, Estate $estate)
{
    $value = $request->input('identity_value');

    if (!empty($value)) {
        $estate->{'identityـorـunified'} = $value;
        $estate->save();
    }

    return back()->with('success', 'تم نقل الهوية بنجاح');
}

// public function handle(Request $request)
// {
//     try {

//         // ====== قراءة Authorization Header ======
//         $authHeader = $request->header('Authorization');
//         $username = null;
//         $password = null;

//         if ($authHeader && str_starts_with($authHeader, 'Basic ')) {
//             $encoded = substr($authHeader, 6);
//             $decoded = base64_decode($encoded);

//             if ($decoded && strpos($decoded, ':') !== false) {
//                 [$username, $password] = explode(':', $decoded, 2);
//             }
//         }

//         // ====== بيانات التوثيق (Hardcoded) ======
//         $validCredentials = [
//             ['username' => 'abaad_test', 'password' => 'Test@2026#Rega!'],
//             ['username' => 'Abaad1234', 'password' => 'Abaad@2026#Rega!Secure98'],
//         ];

//         $isAuthorized = false;

//         foreach ($validCredentials as $cred) {
//             if ($username === $cred['username'] && $password === $cred['password']) {
//                 $isAuthorized = true;
//                 break;
//             }
//         }

//         // ====== رفض الطلب ======
//         if (!$isAuthorized) {
//             return response()->json([
//                 "IsReceived" => false,
//                 "Response" => "Unauthorized",
//                 "ResponseTime" => now()->toIso8601String()
//             ], 401);
//         }

//         // ====== Validation ======
//         $data = $request->validate([
//             'NotificationBody' => 'required|array',
//             'NotificationBody.AdlicenseNumber' => 'required',
//             'NotificationBody.AdlicenseStatusCode' => 'required|string',
//             'NotificationBody.AdlicenseStatusNameAR' => 'required|string',
//             'NotificationBody.ActionDateTime' => 'required|string',
//             'NotificationBody.ActionReason' => 'required|string',
//             'ActionType' => 'nullable|string'
//         ]);

//         // ====== Log (اختياري) ======
//         \Log::info('Push Notification Received', [
//             'data' => $data,
//             'ip' => $request->ip()
//         ]);

//         // ====== Success Response ======
//         return response()->json([
//             "IsReceived" => true,
//             "Response" => "Success",
//             "ResponseTime" => now()->toIso8601String()
//         ], 200);

//     } catch (\Illuminate\Validation\ValidationException $e) {

//         return response()->json([
//             "IsReceived" => false,
//             "Response" => "Business Error",
//             "ResponseTime" => now()->toIso8601String(),
//             "Errors" => $e->errors()
//         ], 400);

//     } catch (\Exception $e) {

//         \Log::error('Push Notification Error', [
//             'error' => $e->getMessage()
//         ]);

//         return response()->json([
//             "IsReceived" => false,
//             "Response" => "Technical Error",
//             "ResponseTime" => now()->toIso8601String()
//         ], 500);
//     }
// }



public function handle(Request $request): JsonResponse
    {
        try {
            /*
             |--------------------------------------------------------------
             | 1) Read Basic Authorization
             |--------------------------------------------------------------
             | Per integration guide, auth is Basic Authentication Token
             | passed in Authorization header.
             */
            $authHeader = $request->header('Authorization');
            $username = null;
            $password = null;

            if ($authHeader && str_starts_with($authHeader, 'Basic ')) {
                $encoded = substr($authHeader, 6);
                $decoded = base64_decode($encoded, true);

                if ($decoded !== false && str_contains($decoded, ':')) {
                    [$username, $password] = explode(':', $decoded, 2);
                }
            }

            // Fallback if server exposes standard PHP auth vars
            if ($username === null || $password === null) {
                $username = $request->server('PHP_AUTH_USER');
                $password = $request->server('PHP_AUTH_PW');
            }

            /*
             |--------------------------------------------------------------
             | 2) Validate credentials
             |--------------------------------------------------------------
             | Hardcoded as requested.
             | Test:
             |   abaad_test / Test@2026#Rega!
             | Production:
             |   Abaad1234 / Abaad@2026#Rega!Secure98
             */
            $isAuthorized =
                ($username === 'abaad_test' && $password === 'Test@2026#Rega!') ||
                ($username === 'Abaad1234' && $password === 'Abaad@2026#Rega!Secure98');

            /*
             |--------------------------------------------------------------
             | 3) Validate payload fields required by guide
             |--------------------------------------------------------------
             | Required fields from document:
             | NotificationBody.AdlicenseNumber
             | NotificationBody.AdlicenseStatusCode
             | NotificationBody.AdlicenseStatusNameAR
             | NotificationBody.ActionDateTime
             | NotificationBody.ActionReason
             */
            $validated = $request->validate([
                'NotificationBody' => ['required', 'array'],
                'NotificationBody.AdlicenseNumber' => ['required'],
                'NotificationBody.AdlicenseStatusCode' => ['required', 'string'],
                'NotificationBody.AdlicenseStatusNameAR' => ['required', 'string'],
                'NotificationBody.ActionDateTime' => ['required', 'string'],
                'NotificationBody.ActionReason' => ['required', 'string'],
                'ActionType' => ['nullable', 'string'],
            ]);

            /*
             |--------------------------------------------------------------
             | 4) Business validation based on guide lookups
             |--------------------------------------------------------------
             | Allowed AdlicenseStatusCode:
             | - CancelledDirect
             | - UpdateResponsibleEmployee
             |
             | Allowed ActionReason values from guide:
             | - DealIsDone
             | - OwnerDesire
             | - ChangeInPropertyData
             | - IncorrectPropertyData
             | - IncorrectBrokerData
             | - BrokerUnderInvestigation
             | - OwnerDesire2
             | - ResponsibleEmployee
             */
            $body = $validated['NotificationBody'];

            $allowedStatusCodes = [
                'CancelledDirect',
                'UpdateResponsibleEmployee',
            ];

            $allowedReasons = [
                'DealIsDone',
                'OwnerDesire',
                'ChangeInPropertyData',
                'IncorrectPropertyData',
                'IncorrectBrokerData',
                'BrokerUnderInvestigation',
                'OwnerDesire2',
                'ResponsibleEmployee',
            ];

            if (!$isAuthorized) {
                Log::warning('Brokerage Push Invalid Authorization', [
                    'path' => $request->path(),
                    'ip' => $request->ip(),
                    'received_username' => $username,
                ]);

                // Return 200 with business-style failure body
                // to align with the guide behavior focus.
                return response()->json([
                    'IsReceived'   => true,
                    'Response'     => 'Invalid Authorization',
                    'ResponseTime' => now()->toIso8601String(),
                ], Response::HTTP_OK);
            }

            if (!in_array($body['AdlicenseStatusCode'], $allowedStatusCodes, true)) {
                return response()->json([
                    'IsReceived'   => true,
                    'Response'     => 'Business Error: Invalid AdlicenseStatusCode',
                    'ResponseTime' => now()->toIso8601String(),
                ], Response::HTTP_BAD_REQUEST);
            }

            if (!in_array($body['ActionReason'], $allowedReasons, true)) {
                return response()->json([
                    'IsReceived'   => true,
                    'Response'     => 'Business Error: Invalid ActionReason',
                    'ResponseTime' => now()->toIso8601String(),
                ], Response::HTTP_BAD_REQUEST);
            }

            /*
             |--------------------------------------------------------------
             | 5) Optional consistency checks
             |--------------------------------------------------------------
             */
            if (
                $body['AdlicenseStatusCode'] === 'CancelledDirect' &&
                $body['AdlicenseStatusNameAR'] !== 'ملغي'
            ) {
                return response()->json([
                    'IsReceived'   => false,
                    'Response'     => 'Business Error: AdlicenseStatusNameAR does not match status code',
                    'ResponseTime' => now()->toIso8601String(),
                ], Response::HTTP_BAD_REQUEST);
            }

            if (
                $body['AdlicenseStatusCode'] === 'UpdateResponsibleEmployee' &&
                $body['ActionReason'] !== 'ResponsibleEmployee'
            ) {
                return response()->json([
                    'IsReceived'   => false,
                    'Response'     => 'Business Error: ActionReason must be ResponsibleEmployee for UpdateResponsibleEmployee status',
                    'ResponseTime' => now()->toIso8601String(),
                ], Response::HTTP_BAD_REQUEST);
            }

            /*
             |--------------------------------------------------------------
             | 6) Save / process notification
             |--------------------------------------------------------------
             | Replace this section with your actual DB logic.
             */
            Log::info('Brokerage Push Notification Received', [
                'path' => $request->path(),
                'ip' => $request->ip(),
                'payload' => $validated,
            ]);

            /*
             |--------------------------------------------------------------
             | 7) Success response
             |--------------------------------------------------------------
             */
            return response()->json([
                'IsReceived'   => true,
                'Response'     => 'Notification received successfully',
                'ResponseTime' => now()->toIso8601String(),
            ], Response::HTTP_OK);

        } catch (ValidationException $e) {
            return response()->json([
                'IsReceived'   => false,
                'Response'     => 'Business Error',
                'ResponseTime' => now()->toIso8601String(),
                'Errors'       => $e->errors(),
            ], Response::HTTP_BAD_REQUEST);

        } catch (\Throwable $e) {
            Log::error('Brokerage Push Notification Technical Error', [
                'message' => $e->getMessage(),
                'path' => $request->path(),
                'ip' => $request->ip(),
            ]);

            return response()->json([
                'IsReceived'   => false,
                'Response'     => 'Technical Error',
                'ResponseTime' => now()->toIso8601String(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function index()
    {
         $categories = Category::all();
         $main_banner = Banner::active()->get();

         $zone = RegionLite::all();
         $city =City::all();
         $districts= DistrictLite::all();

         $favoriteEstates = [];
         $user = auth('customer')->user();
         $favoriteEstates = $user ? Wishlist::where('user_id', $user->id)->pluck('estate_id')->toArray() : [];
        









        $homeCategories = Category::where('status_home', true)->get();
        $homeCategories->map(function ($data) {
            $id = '"' . $data['id'] . '"';
            $homeCategoriesProducts = Estate::active()
                // ->withCount('reviews')
                ->where('category_ids', 'like', "%{$id}%");
            // $data['products'] = ProductManager::getPriorityWiseCategoryWiseProductsQuery(query: $homeCategoriesProducts, dataLimit: 12);
        });
        $current_date = date('Y-m-d H:i:s');

        $main_banner = $this->banner->latest()->get();

   DB::table('users')
                ->where('id',  auth('customer')->user()->id ??"" )
                ->update(['is_phone_verified' => 0]);


        return view(  VIEW_FILE_NAMES['home'],
            compact(
                'categories',
                'main_banner',
                'zone',
                'city',
                'districts',
                'favoriteEstates' // ✅ إرسال قائمة العقارات المفضلة إلى الواجهة

            )
        );
    }












    public function map()
    {



        return view('web-views.map');




    }





    public function zones()
    {

     
        $banners = Banner::where('status', 1)->get(); // جلب البنرات النشطة فقط
        $zones = Zone::where('status', 1)->get(); // جلب المناطق النشطة فقط

        return view(  'web-views.zone',
        compact(
            
            'banners',
            'zones'

        ));
     
    }



    public function getPropertiesByZone($zone_id)
{
    // حفظ معرّف المنطقة في الجلسة
    session(['zone_id' => $zone_id]);

    $categories = Category::all();
    $main_banner = Banner::active()->get();

    $zone = RegionLite::all();
    $city =City::all();
    $districts= DistrictLite::all();

    $favoriteEstates = [];
    $user = auth('customer')->user();
    $favoriteEstates = $user ? Wishlist::where('user_id', $user->id)->pluck('estate_id')->toArray() : [];
   









   $homeCategories = Category::where('status_home', true)->get();
   $homeCategories->map(function ($data) {
       $id = '"' . $data['id'] . '"';
       $homeCategoriesProducts = Estate::active()
           // ->withCount('reviews')
           ->where('category_ids', 'like', "%{$id}%");
       // $data['products'] = ProductManager::getPriorityWiseCategoryWiseProductsQuery(query: $homeCategoriesProducts, dataLimit: 12);
   });
   $current_date = date('Y-m-d H:i:s');

   $main_banner = $this->banner->latest()->get();

DB::table('users')
           ->where('id',  auth('customer')->user()->id ??"" )
           ->update(['is_phone_verified' => 0]);


   return view(  VIEW_FILE_NAMES['home'],
       compact(
           'categories',
           'main_banner',
           'zone',
           'city',
           'districts',
           'favoriteEstates' ,
           'zone_id'

       )
   );
}

}




