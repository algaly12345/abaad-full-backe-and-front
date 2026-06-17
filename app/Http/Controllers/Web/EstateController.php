<?php

namespace App\Http\Controllers\Web;

use App\Helpers\EstateLogic;
use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\CityLite;
use App\Models\DistrictLite;
use App\Models\Estate;
use App\Models\Report;
use App\Models\SupportTicket;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use App\Models\Agent;

class EstateController extends Controller
{
    public function create_estate(Request $request)
    {


        // $zones = Zone::query()->select('id', 'name')->get();

        // $serviceTypes = ServiceType::query()->select('id', 'name')->get();


        $adLicenseNumber = session('adLicenseNumber');




        $categories = Category::query()->select('id', 'name')->get();
        $user = auth('customer')->user();


        return view('web-views.users-profile.create-estate',compact('categories','user'));


    }




    public function filterCategories(Request $request)
    {
        $type = $request->query('type');
        if ($type == 'all') {
            $categories = Category::all();
        } else {
            $categories = Category::where('type', $type)->get();
        }





        return response()->json($categories);
    }




    public function getCities($zone_id)
    {
        $cities = CityLite::where('region_id', $zone_id)->get(); // جلب المدن بناءً على الـ zone_id
        return response()->json($cities);
    }



    public function getDistricts($cityId)
    {
        // التحقق من وجود المدينة
        $city = City::where("city_id",$cityId)->first();

        if (!$city) {
            return response()->json([], 404);
        }

        // جلب الأحياء التي تنتمي إلى المدينة المحددة
        $districts = DistrictLite::where('city_id', $cityId)->get();

        // إرجاع البيانات بتنسيق JSON
        return response()->json($districts);
    }


//     public function get_details($id)
//     {
//         $restaurant = EstateLogic::get_estate_details($id);

//         $estate= EstateLogic::estate_details_formatting($restaurant);
        
//         // return   $restaurant;
        
       
        
        
        
//          $agent = Agent::where('user_id', $restaurant->users->id)->first();
         

//         //   return $restaurant->estate_type == 1 
//         //                 ? $agent->identity 
//         //                 : ($restaurant->estate_type == 2 
//         //                     ? $agent->fal_license_number 
//         //                     : null),
        
//         $count  =  Estate::select("view")->where('id', '=', $id)->first();

//         $userInfo= User::where("id",$restaurant->users->id)->first();
        
        
//         // return  $agent->identity;

//   $url = "https://integration-gw.nhc.sa/nhc/prod/v2/brokerage/AdvertisementValidator";

       
//         $response = Http::withHeaders([
//               'X-IBM-Client-Id' => 'b4952cd30458e51546b3a9ab24c3fd22',
//               'X-IBM-Client-Secret' => 'b64ec4f278d661809b101c039c66e79b',

    
//             'RefId' => '0',
//         ])->get($url, [
//             'adLicenseNumber' => $restaurant->license_number,
//               'advertiserId' => $restaurant->estate_type == 1 ? $agent->identity : $agent->fal_license_number,
//             'idType' => 1,
//         ]);


   
//         // معالجة الاستجابة
//         if ($response->ok()) {
//             $data = $response->json();
            
            
        

//             if ($data['Body']['result']['isValid']) {
//                 // استخراج البيانات
//                  DB::table('estates')->where('id',$id)->update(['view' => $count->view+1]);
//               return view('web-views.details',compact('estate','userInfo'));




//             } else {
//                 // الترخيص غير صالح
//                 return back()->withErrors(['adLicenseNumber' => $data['Body']['result']['message']]);
//             }

     




//         }


//     }


public function get_details($id)
{
    $restaurant = EstateLogic::get_estate_details($id);
    $estate = EstateLogic::estate_details_formatting($restaurant);
    
 

    $agent = Agent::where('user_id', $restaurant->users->id)->first();
    $count = Estate::select("view")->where('id', $id)->first();
    $userInfo = User::where("id", $restaurant->users->id)->first();
  
    
                return view('web-views.details', compact('estate', 'userInfo','agent'));
    
//     $params = [
//     'adLicenseNumber' => $restaurant->license_number,
//     'advertiserId' => $restaurant->estate_type == 1 
//                         ? $agent->identity 
//                         : $agent->fal_license_number,
//     'idType' => $restaurant->estate_type,
// ];
    
    
  

//     $url = "https://integration-gw.nhc.sa/nhc/prod/v2/brokerage/AdvertisementValidator";

//     $response = Http::withHeaders([
//         'X-IBM-Client-Id' => 'b4952cd30458e51546b3a9ab24c3fd22',
//         'X-IBM-Client-Secret' => 'b64ec4f278d661809b101c039c66e79b',
//         'RefId' => '0',
//     ])->get($url, [
//         'adLicenseNumber' => $restaurant->license_number,
//          'advertiserId' => $restaurant->estate_type == 1 
//                             ? $agent->identity 
//                             : $agent->unified_number,
//         'idType' => $restaurant->estate_type, // بدل 1 خليها داينامك
//     ]);

//     if ($response->ok()) {
//         $data = $response->json();

//         // تأكد من بنية الاستجابة
//         if (isset($data['Body']['result']['isValid']) && $data['Body']['result']['isValid']) {
//             DB::table('estates')->where('id', $id)->update(['view' => $count->view + 1]);

//             return view('web-views.details', compact('estate', 'userInfo'));
//         } else {
//             $message = $data['Body']['result']['message'] ?? 'الترخيص غير صالح';
//             return back()->withErrors(['adLicenseNumber' => $message]);
//         }
//     } else {
//         return back()->withErrors(['api' => 'لم يتم الاتصال بالخدمة بنجاح']);
//     }
}



    public function store_estate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address' => 'required',
            'property' => 'required',
            'space' => 'required',
            // 'category_id' => 'required',
            'price' => 'required',
            // 'national_address' => 'required',
            'zone_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        }

        try {
            $plannedImages = [];
            $estateImages = [];

            if ($request->hasFile('estate_image')) {
                foreach ($request->file('estate_image') as $image) {
                    $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->storeAs('public/estate', $imageName);
                    $estateImages[] = $imageName;
                }
            }

            if ($request->hasFile('planned_image')) {
                foreach ($request->file('planned_image') as $image) {
                    $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->storeAs('public/estate', $imageName);
                    $plannedImages[] = $imageName;
                }
            }



            $address = mb_strimwidth($request->address, 0, 8, '');
            $adLicenseNumber = session('adLicenseNumber');
            
            
              $locationLatitude = session('location_latitude');
            $locationLongitude = session('location_longitude');

     $category = Category::where('name_ar', $request->category_name)->first();



            $estate = new Estate();
            $estate->address = $request->address;
            $estate->property = $request->property;
            $estate->space = $request->space;
            $estate->category_id = $request->category_id;
            $estate->price = $request->price;
            $estate->ownership_type = $request->ownership_type;
            $estate->status = 'active';
            $estate->ar_path = $request->ar_path;
            $estate->districts = session('location_district');
            $estate->network_type = $request->network_type;
            $estate->planned = json_encode($plannedImages);
            $estate->qr = $request->qr;
            $estate->zone_id = $request->zone_id;
            $estate->user_id = $request->user_id;
            $estate->build_space = $request->build_space;
            $estate->images = json_encode($estateImages);
            $estate->estate_type = $request->estate_type;
            $estate->territory_id = "1";
            $estate->age_estate = $request->age_estate;
            $estate->long_description = $request->long_description;
            $estate->national_address = $address;
            $estate->floors = $request->floors;
            $estate->near = $request->near;
            $estate->latitude = $locationLatitude;
            $estate->longitude =$locationLongitude;
            $estate->short_description = $request->short_description;
            $estate->price_negotiation = $request->price_negotiation;
            $estate->facilities = $request->facilities;
            $estate->other_advantages = $request->other_advantages;
            $estate->advertiser_no = $request->advertiser_no; // Ensure this is provided if required
            $estate->city = $request->city;
            $estate->service_offers = "[]";
            $estate->street_space = $request->street_space;
            $estate->interface = $request->interface;
            $estate->feature = $request->feature;
            $estate->property_type = $request->property_type;
            $estate->authorization_number = $request->authorization_number;
            $estate->ad_number = $request->ad_number;
            $estate->document_number = $request->document_number;
            $estate->ad_license_number =$request->adLicenseNumber;


            $estate->creation_date =$request->creationDate;
            $estate->end_date =$request->endDate;
            $estate->deed_number =$request->deedNumber;
            
            
            
            $estate->north_limit = $request->north_limit;
            $estate->east_limit = $request->east_limit;
            $estate->west_limit = $request->west_limit;
            $estate->south_limit =$request->south_limit;



            $estate->titleDeedTypeName =$request->titleDeedTypeName;


            $estate->license_number =$request->brokerageAndMarketingLicenseNumber;
            
            
            $estate->street_width = $request->streetWidth;
            $estate->property_face =$request->propertyFace;
            
            
            $estate->category_name = $request->category_name;
            $estate->advertisement_type =$request->advertisementType;
            
            
            
             $estate->total_price =$request->total_price;
             
             
             $estate->obligationsOnTheProperty = $request->obligationsOnTheProperty;
$estate->guaranteesAndTheirDuration = $request->guaranteesAndTheirDuration;
$estate->locationDescriptionOnMOJDeed = $request->locationDescriptionOnMOJDeed;
$estate->numberOfRooms = $request->numberOfRooms;
$estate->mainLandUseTypeName = $request->mainLandUseTypeName;

$estate->propertyUsages =  $request->mainLandUseTypeName;


 $estate->plan_number =session('planNumber');
 $estate->landNumber = session('landNumber');
    $estate->propertyUtilities = json_encode( session('propertyUtilities'));
   

            
            
            


             if ($category) {
                $estate->category_id = $category->id;
            } else {
                // في حال لم يتم العثور على القسم
                return back()->with('error', 'القسم غير موجود');
            }




            $estate->save();

            $adLicenseNumber = session('adLicenseNumber');
            $advertiserName = session('advertiserName');
            $phoneNumber = session('phoneNumber');
            $advertiserId = session('advertiserId');
            $deedNumber = session('deedNumber');
            $locationRegion = session('location_region');
            $locationCity = session('location_city');
            $locationLatitude = session('location_latitude');
            $locationLongitude = session('location_longitude');
            
            
            
            $northLimitName = session('north_limit_name');
            $northLimitDescription = session('north_limit_description');
            $northLimitLengthChar= session('north_limit_length_char');
            
            
            
            $eastLimitName = session('east_limit_name');
            $eastLimitDescription = session('east_limit_description');
            $eastLimitLengthChar= session('east_limit_length_char');
            
            
            
            
            $westLimitName = session('west_limit_name');
            $westLimitDescription = session('west_limit_description');
            $westLimitLengthChar= session('west_limit_length_char');
            
            
            
            
             $southLimitName = session('south_limit_name');
            $southLimitDescription = session('south_limit_description');
            $southLimitLengthChar= session('south_limit_length_char');
            
            
             $streetWidth= session('streetWidth');
             
             $propertyFace= session('propertyFace');
             
             
              $advertisementType= session('advertisementType');
             
             $propertyType= session('propertyType');
            
            
            
            
              
            
            
            
           

            // إرسال البيانات إلى API
            $url = "https://integration-gw.nhc.sa/nhc/prod/v1/brokerage/PlatformCompliance";
            $apiData = [
                "platformOwnerId" => "7031535292",
                "platformId" => "08dcdc5b-c987-4d9c-84d0-b662ea8018d8",
                "operationType" => "DisplayAd",
                "operationReason" => "Other",
                "adLinkInPlatform" => url('/estate/' . $estate->id),
                "adLicenseNumber" => $request->adLicenseNumber,
                "brokerageAndMarketingLicenseNumber" => $request->brokerageAndMarketingLicenseNumber,
                "titleDeedNumber" => $request->deedNumber,
                "creationDate" => $request->creationDate,
                "endDate" => $request->endDate,
                "advertiserId" => $advertiserId,
                "advertiserName" =>$advertiserName,
                "advertiserMobile" =>$phoneNumber,
                "channels" => ["LicensedPlatform"],
                "nationalAddress" => [
                    "region" => $request->region,
                    "city" => $request->city,
                    "district" => $request->district,
                    "postalCode" => $request->postal_code,
                    "streetName" => $request->street_name,
                    "buildingNo" => $request->building_no,
                    "additionalNo" => $request->additional_no,
                    "adMapLongitude" => $request->longitude,
                    "adMapLatitude" => $request->latitude,
                ],
                "propertyFace" => $streetWidth,
                "propertyType" =>$request->category_name,
                "propertyArea" => $request->space,
                "propertyUsage" => $request->property_usage,
                "streetWidth" => $request->street_space,
                "propertyAge" => $request->age_estate,
                "price" => $request->price,
                "roomsNumber" => $request->rooms_number,
                "propertyUtilities" =>  [
                    ""  //// ملاحظة يجب المراجعة
                ],
                "adType" => "Sell",
                "constraints" => $request->constraints,
                "obligationsOnTheProperty" => $request->obligations,
                "guaranteesAndTheirDuration" => $request->guarantees,
                "planNumber" => $request->plan_number,
                "landNumber" => $request->land_number,
                "complianceWithTheSaudiBuildingCode" => true,
                "qrCode" => $request->qr,
                "titleDeedType" => "ElectronicDeed",
                "northLimitName" =>$northLimitName,
                "northLimitDescription" => $northLimitDescription,
                "northLimitLengthChar" => $northLimitLengthChar,
                "eastLimitName" =>$eastLimitName,
                "eastLimitDescription" =>$eastLimitDescription,
                "eastLimitLengthChar" => $eastLimitLengthChar,
                "westLimitName" => $westLimitName,
                "westLimitDescription" => $westLimitDescription,
                "westLimitLengthChar" => $westLimitLengthChar,
                "southLimitName" => $southLimitName,
                "southLimitDescription" => $southLimitDescription,
                "southLimitLengthChar" => $southLimitLengthChar,
                "borders" => $request->borders,
                "adSource" => "REGA",
                "notes" => $request->notes,
                "locationDescriptionAccordingToDeed" => $request->location_description,
                // أضف بقية الحقول المطلوبة هنا حسب API
            ];

            $response = Http::withHeaders([
             'X-IBM-Client-Id' => 'b4952cd30458e51546b3a9ab24c3fd22',
            'X-IBM-Client-Secret' => 'b64ec4f278d661809b101c039c66e79b',
                'RefId' => '0',
            ])->post($url, $apiData);

            if ($response->ok()) {
                //  return response()->json(['message' => 'Estate created and sent to API successfully', 'estate_id' => $response->json()], 200);
            return response()->json(['message' => 'Estate created and sent to API successfully', 'estate_id' => $estate->id], 200);
            } else {
                return response()->json(['warning' => 'Estate created, but API response failed: ' . $response->body()], 200);
            }

           // return response()->json(['message' => 'Estate created successfully', 'estate_id' => $estate->id], 200);

        } catch (\Exception $ex) {
            \Log::error('Error storing estate: '.$ex->getMessage(), [
                'line' => $ex->getLine(),
                'file' => $ex->getFile()
            ]);

            return response()->json(['error' => 'An error occurred while storing the estate.'.$ex->getMessage(),], 500);
        }
    }




    public function check_license(Request $request)
    {




        // التحقق من المدخلات
        $request->validate([
            'adLicenseNumber' => 'required|string',
//            'advertiserId' => 'required|string',
        ]);

        $adLicenseNumber = $request->input('adLicenseNumber');
        $advertiserId = $request->input('advertiserId');
        $url = "https://integration-gw.housingapps.sa/nhc/dev/v2/brokerage/AdvertisementValidator";

        // إرسال الطلب إلى API
        $response = Http::withHeaders([
            'X-IBM-Client-Id' => '77ade3ca8d69a99f37a92afb79f07a67',
            'X-IBM-Client-Secret' => '3978f6284fa6cad973f080627fe980da',
            'RefId' => '0',
        ])->get($url, [
            'adLicenseNumber' => $adLicenseNumber,
            'advertiserId' => $advertiserId,
            'idType' => '1',
        ]);


        return $request;

        // معالجة الاستجابة
        if ($response->ok()) {
            $data = $response->json();
            
            return $data;

            if ($data['Body']['result']['isValid']) {
                // استخراج البيانات
                $advertisement = $data['Body']['result']['advertisement'];

                session(['adLicenseNumber' => $adLicenseNumber]);



//                Advertisement::create([
//                    'adLicenseNumber' => $advertisement['adLicenseNumber'],
//                    'advertiserId' => $advertisement['advertiserId'],
//                    'advertiserName' => $advertisement['advertiserName'],
//                    'phoneNumber' => $advertisement['phoneNumber'],
//                    'brokerageAndMarketingLicenseNumber' => $advertisement['brokerageAndMarketingLicenseNumber'],
//                    'isConstrained' => $advertisement['isConstrained'],
//                    'isPawned' => $advertisement['isPawned'],
//                    'isHalted' => $advertisement['isHalted'],
//                    'isTestment' => $advertisement['isTestment'],
//                    'rerConstraints' => $advertisement['rerConstraints'],
//                    'streetWidth' => $advertisement['streetWidth'],
//                    'propertyArea' => $advertisement['propertyArea'],
//                    'propertyPrice' => $advertisement['propertyPrice'],
//                    'landTotalPrice' => $advertisement['landTotalPrice'],
//                    'landTotalAnnualRent' => $advertisement['landTotalAnnualRent'],
//                    'numberOfRooms' => $advertisement['numberOfRooms'],
//                    'propertyType' => $advertisement['propertyType'],
//                    'propertyAge' => $advertisement['propertyAge'],
//                    'advertisementType' => $advertisementType,
//                    'location' => $advertisement['location'],
//                    'propertyFace' => $advertisement['propertyFace'],
//                    'planNumber' => $advertisement['planNumber'],
//                    'landNumber' => $advertisement['landNumber'],
//                    'obligationsOnTheProperty' => $advertisement['obligationsOnTheProperty'],
//                    'guaranteesAndTheirDuration' => $advertisement['guaranteesAndTheirDuration'],
//                    'complianceWithTheSaudiBuildingCode' => $advertisement['complianceWithTheSaudiBuildingCode'],
//                    'channels' => $advertisement['channels'],
//                    'propertyUsages' => $advertisement['propertyUsages'],
//                    'propertyUtilities' => $advertisement['propertyUtilities'],
//                    'creationDate' => $advertisement['creationDate'],
//                    'endDate' => $advertisement['endDate'],
//                    'adLicenseUrl' => $advertisement['adLicenseUrl'],
//                    'adSource' => $advertisement['adSource'],
//                    'titleDeedTypeName' => $advertisement['titleDeedTypeName'],
//                    'locationDescriptionOnMOJDeed' => $advertisement['locationDescriptionOnMOJDeed'],
//                    'notes' => $advertisement['notes'],

                //  'advertisement_id' => $advertisement->id,
//                        'north_limit_name' => $advertisement['borders']['northLimitName'],
//                        'north_limit_description' => $advertisement['borders']['northLimitDescription'],
//                        'north_limit_length_char' => $advertisement['borders']['northLimitLengthChar'],
//                        'east_limit_name' => $advertisement['borders']['eastLimitName'],
//                        'east_limit_description' => $advertisement['borders']['eastLimitDescription'],
//                        'east_limit_length_char' => $advertisement['borders']['eastLimitLengthChar'],
//                        'west_limit_name' => $advertisement['borders']['westLimitName'],
//                        'west_limit_description' => $advertisement['borders']['westLimitDescription'],
//                        'west_limit_length_char' => $advertisement['borders']['westLimitLengthChar'],
//                        'south_limit_name' => $advertisement['borders']['southLimitName'],
//                        'south_limit_description' => $advertisement['borders']['southLimitDescription'],
//                        'south_limit_length_char' => $advertisement['borders']['southLimitLengthChar'],
//
//                ]);
//



                // الترخيص صالح
              //  return redirect()->route('create-estate')->with('success', ' تم التحقق بنجاح رقم الترخيص صالح!');




            } else {
                // الترخيص غير صالح
                return back()->withErrors(['adLicenseNumber' => $data['Body']['result']['message']]);
            }
        }

        // حدث خطأ في الطلب
        return back()->withErrors(['adLicenseNumber' => 'حدث خطأ أثناء التحقق. حاول مرة أخرى.']);

    }
    
    
       public function search(Request $request)
    {
        if (!$request->has('name')) {
            return response()->json(['message' => 'يرجى إدخال كلمة البحث'], 400);
        }

        $query = Estate::query();

        if ($request->filled('name')) {
            $query->where('category_name', 'LIKE', "%{$request->name}%")
                  ->orWhere('short_description', 'LIKE', "%{$request->name}%")
                  ->orWhere('city', 'LIKE', "%{$request->name}%");
        }

        $estates = $query->get();

        return response()->json(['estates' => $estates]);
    }

    public function wishlist(Request $request)
    {
        try {
            $user = auth('customer')->user();
            $estateId = $request->input('estate_id');
    
            if (!$user) {
                return response()->json(['status' => 'error', 'message' => 'يجب تسجيل الدخول.'], 401);
            }
    
            if (!$estateId) {
                return response()->json(['status' => 'error', 'message' => 'معرف العقار مطلوب.'], 400);
            }
    
            $wishlist = Wishlist::where('user_id', $user->id)
                                ->where('estate_id', $estateId)
                                ->first();
    
            if ($wishlist) {
                $wishlist->delete();
                return response()->json(['status' => 'removed']);
            } else {
                Wishlist::create([
                    'user_id' => $user->id,
                    'estate_id' => $estateId
                ]);
                return response()->json(['status' => 'added']);
            }
        } catch (\Exception $e) {
            \Log::error('Wishlist Error: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' =>  $e->getMessage()], 500);
        }
    }
    
    

    public function getfv()
{
    $user =  auth('customer')->user();
    if (!$user) {
        return response()->json([]);
    }

    $favorites = wishlist::where('user_id', $user->id)
                         ->pluck('estate_id') // جلب الـ IDs فقط
                         ->toArray();

    return response()->json(
        Estate::whereIn('id', $favorites)
              ->get()
              ->map(function ($estate) {
                  return [
                      'id' => $estate->id,
                      'is_favorited' => true
                  ];
              })
    );
}





public function report(Request $request)
{
    // التحقق من البيانات المدخلة
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'estate_id' => 'required|integer|exists:estates,id',
       
    ]);

    // حفظ البيانات في قاعدة البيانات
    Report::create([
        'title' => $request->title,
        'description' => $request->description,
        'estate_id' => $request->estate_id,

    ]);

    return response()->json(['message' => 'Report submitted successfully']);
}





    public function uploadVideosWeb(Request $request)
{
    $request->validate([
        'property_video' => 'nullable|file|max:51200',
        'aerial_view_video' => 'nullable|file|max:51200'
    
    ]);

    $user = auth('customer')->user();

$estate = Estate::where('user_id', $user->id)
                ->latest()
                ->first();
    $uploadedFiles = [];

    if ($request->hasFile('property_video')) {
        $propertyPath = $request->file('property_video')->store('videos/property', 'public');
        $uploadedFiles['property_video'] = $propertyPath;
        $estate->video_url = $propertyPath;
    }

    if ($request->hasFile('aerial_view_video')) {
        $aerialPath = $request->file('aerial_view_video')->store('videos/aerial', 'public');
        $uploadedFiles['aerial_view_video'] = $aerialPath;
        $estate->skyview = $aerialPath;
    }

    $estate->save();

    return response()->json([
        'success' => true,
        'message' => 'تم رفع الفيديوهات بنجاح.',
        'files' => $uploadedFiles
    ]);
}








}
