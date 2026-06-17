<?php

namespace App\Http\Controllers\api\v1;
;

use App\Helpers\EstateLogic;
use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Advantages;

use App\Models\City;
use App\Models\CityLite;
use App\Models\DistrictLite;
use App\Models\Estate;
use App\Models\EstateOffer;
use App\Models\Facilities;
use App\Models\Property;
use App\Models\RegionLite;
use App\Models\RegionsLite;
use App\Models\RegionsLites;
use App\Models\Restaurant;
use App\Models\SubscriptionPackage;
use App\Models\SubscriptionPackages;
use App\Models\SubscriptionTransactions;
use App\Models\User;
use App\Models\Agent;
use App\Models\usersSubscriptions;
use App\Models\Vendor;
use App\Models\Zone;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Report;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Controllers\AdvertisementController;
use App\Models\Category;
use Illuminate\Support\Facades\Http;

class EstateController extends Controller
{
    public function get_estate(Request $request, $filter_data="all")
    {


        $type = $request->query('type', 'all');

        $estate = EstateLogic::get_estate($request['zone_id'], $request['category_id'],$request['user_id'],$request["city"],$request['districts'], $request['space'],$filter_data, 10000, $request['offset'],$request['ar_path'],$request['sv'],$request['type']);
      
        $estate['estate'] = EstateLogic::estate_data_formatting($estate['estate']);

     

        return response()->json($estate, 200);



    }
    
    
    public function list(Request $request, $filter_data = "all")
{
    $estate = EstateLogic::get_estate(
        $request->query('zone_id'),
        $request->query('category_id'),
        $request->query('user_id'),
        $request->query('city'),
        $request->query('districts'),
        $request->query('space'),
        $filter_data,
        $request->query('limit', 10),
        $request->query('offset', 0),
        $request->query('ar_path'),
        $request->query('sv'),
        $request->query('type', 'all')
    );

    $estate['estate'] = EstateLogic::estate_data_formatting($estate['estate']);

    return response()->json($estate, 200);
}


public static function get_estate_by_map(
    $zone_id,
    $category_id,
    $user_id,
    $city,
    $districts,
    $space,
    $filter,
    $limit = 10,
    $offset = 1,
    $ar_path = null,
    $sv = 0,
    $advertisement_type = null,
    $latitude = null,
    $longitude = null,
    $radius = 5000
) {
    $query = Estate::Active()
        ->when($category_id && $category_id != '0', function ($query) use ($category_id) {
            $query->where('category_id', $category_id);
        })
        ->when($city && $city != '0', function ($query) use ($city) {
            $query->where('city', $city);
        })
        ->when($zone_id && $zone_id != '0', function ($query) use ($zone_id) {
            $query->where('zone_id', $zone_id);
        })
        ->when($advertisement_type && $advertisement_type != '0' && $advertisement_type != 'all', function ($query) use ($advertisement_type) {
            $query->where('advertisement_type', $advertisement_type);
        })
        ->when($user_id && $user_id != '0', function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        })
        ->when($districts && $districts != '0', function ($query) use ($districts) {
            $normalized = str_replace('حي', '', $districts);
            $normalized = trim($normalized);

            $query->where(function ($q) use ($districts, $normalized) {
                $q->where('districts', 'LIKE', "%$districts%")
                  ->orWhere('districts', 'LIKE', "%$normalized%");
            });
        })
        ->when($space && $space != '0', function ($query) use ($space) {
            $query->where('space', $space);
        })
        ->with('Images')
        ->when($ar_path === '1', function ($query) {
            $query->whereNotNull('ar_path');
        })
        ->whereNotNull('latitude')
        ->whereNotNull('longitude')
        ->whereRaw("STR_TO_DATE(end_date, '%d/%m/%Y') >= CURDATE()");

    if ($sv == 1) {
        $query->where(function ($query) use ($category_id) {
            $query->whereExists(function ($subquery) {
                $subquery->select(DB::raw(1))
                    ->from('category_offer')
                    ->whereRaw('category_offer.category_id = estates.category_id');
            });

            if ($category_id && $category_id != '0') {
                $query->orWhere('category_id', $category_id);
            }
        });
    }

    if (!empty($latitude) && !empty($longitude)) {
        $lat = (float) $latitude;
        $lng = (float) $longitude;

        // radius بالمتر -> تقريبًا درجات
        $latDelta = ((float) $radius) / 111320;
        $lngDelta = ((float) $radius) / (111320 * cos(deg2rad($lat)));

        $minLat = $lat - $latDelta;
        $maxLat = $lat + $latDelta;
        $minLng = $lng - $lngDelta;
        $maxLng = $lng + $lngDelta;

        $query->whereBetween('latitude', [$minLat, $maxLat])
              ->whereBetween('longitude', [$minLng, $maxLng]);

        // ترتيب تقريبي حسب الأقرب
        $query->orderByRaw(
            'ABS(latitude - ?) + ABS(longitude - ?)',
            [$lat, $lng]
        );
    } else {
        $query->orderBy('id', 'desc');
    }

    $paginator = $query->paginate($limit, ['*'], 'page', $offset);

    return [
        'total_size' => $paginator->total(),
        'limit' => $limit,
        'offset' => $offset,
        'estate' => $paginator->items()
    ];
}


public function mapList(Request $request, $filter_data = "all")
{
    $estate = EstateLogic::get_estate_by_map_bounds(
        $request->query('zone_id'),
        $request->query('category_id'),
        $request->query('user_id'),
        $request->query('city'),
        $request->query('districts'),
        $request->query('space'),
        $filter_data,
        $request->query('limit', 30),
        $request->query('offset', 1),
        $request->query('ar_path'),
        $request->query('sv', 0),
        $request->query('type', 'all'),
        $request->query('north_east_lat'),
        $request->query('north_east_lng'),
        $request->query('south_west_lat'),
        $request->query('south_west_lng')
    );

    $estate['estate'] = EstateLogic::estate_data_formatting($estate['estate']);

    return response()->json($estate, 200);
}



    public function get_details($id)
    {
        $restaurant = EstateLogic::get_estate_details($id);

        $estate= EstateLogic::estate_details_formatting($restaurant);
        $count  =  Estate::select("view")->where('id', '=', $id)->first();

        DB::table('estates')->where('id',$id)->update(['view' => $count->view+1]);
        return response()->json($estate, 200);


    }

//     public function create(Request $request)
//     {
        
//             return response()->json(['message'=>"666"],200);

//         $validator = Validator::make($request->all(), [
//             'address' => 'required',
//             'property' => 'required',
//             'space' => 'required',
          
//             'price' => 'required',
//             'national_address' => 'required',
//             'zone_id' => 'required',


//         ]);

// //        if($request->zone_id)
// //        {
// //            $point = new Point($request->lat, $request->lng);
// //            $zone = Zone::contains('coordinates', $point)->where('id', $request->zone_id)->first();
// //            if(!$zone){
// //                $validator->getMessageBag()->add('latitude', translate('messages.coordinates_out_of_zone'));
// //            }
// //        }

//         if ($validator->fails()) {
//             return response()->json(['errors' => Helpers::error_processor($validator)], 403);
//         }


//         ///     qrcode
//         ///



//         $planed_img_names = [];
//         $id_img_names = [];
//         if (!empty($request->file('identity_image'))) {
//             foreach ($request->identity_image as $img) {
//                 $identity_image = Helpers::upload('estate/', 'png', $img);
//                 array_push($id_img_names, $identity_image);
//             }
//             $identity_image = json_encode($id_img_names);
//         } else {
//             $identity_image = json_encode([]);
//         }

//         if (!empty($request->file('planed_image'))) {
//             foreach ($request->planed_image as $img) {
//                 $planed_image = Helpers::upload('estate/', 'png', $img);
//                 array_push($planed_img_names, $planed_image);
//             }
//             $planed_image = json_encode($planed_img_names);
//         } else {
//             $planed_image = json_encode([]);
//         }
//         $address= mb_strimwidth($request->address, 0, 8, '');

//         $estate = new Estate();
//         try{
//         $estate->address = $request->address;
//         $estate->property =$request->property;
//         $estate->space = $request->space;
// //        $estate->cover_photo = Helpers::upload('restaurant/cover/', 'png', $request->file('cover_photo'));
//         $estate->category_id = $request->category_id;
//         $estate->price = $request->price;
//         $estate->ownership_type = $request->ownership_type;

//         $estate->status = 'active';
//         $estate->ar_path=$request->ar_path;

//         $estate->districts = $request->districts;
//         $estate->network_type = $request->network_type;
//         $estate->planned = $planed_image;



//         $estate->qr = $request->qr;
//         $estate->zone_id = $request->zone_id;
//         $estate->user_id = $request->user_id;


//         $estate->build_space=$request->build_space;

//         $estate->images = $identity_image;
//         $estate->estate_type=$request->estate_type;

//         $estate->territory_id ="1";
//         $estate->age_estate = $request->age_estate;
//         $estate->long_description = $request->long_description;
//         $estate->national_address =$address;

//         $estate->floors =$request->floors;
//         $estate->near = $request->near;
//         $estate->latitude = $request->latitude;
//         $estate->longitude = $request->longitude;

//         $estate->short_description = $request->short_description;
//         $estate->price_negotiation = $request->price_negotiation;
//         $estate->facilities = $request->facilities;
//         $estate->other_advantages=$request->other_advantages;
//         $estate->advertiser_no="234324";

//         $estate->city = $request->city;
//         $estate->service_offers="[]";

//         $estate->street_space = $request->street_space;
//         $estate->interface=$request->interface;
//         $estate->feature=$request->feature;
//         $estate->property_type=$request->property_type;
//         $estate->authorization_number=$request->authorization_number;
//         $estate->ad_number=$request->ad_number;
//         $estate->document_number = $request->document_number;

//         $estate->save();


// //            if(config('mail.status')){
// //                Mail::to($request['email'])->send(new \App\Mail\SelfRegistration('pending', $vendor->f_name.' '.$vendor->l_name));
// //            }
//         }catch(\Exception $ex){

//             return $ex;
//         }

//         return response()->json(['message'=>$estate->id],200);
//     }



    public function create(Request $request)
    {
        
        
         try {
        
         $validator = Validator::make($request->all(), [
            'address' => 'required',
            'property' => 'required',
            'space' => 'required',
      
            'price' => 'required',
            'national_address' => 'required',
            'zone_id' => 'required',
            
            
             'license_number' => 'required',
            'advertiser_number' => 'required',
            'idType' => 'required'


        ]);



        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }


     
            $planed_img_names = [];
        $id_img_names = [];
        if (!empty($request->file('identity_image'))) {
            foreach ($request->identity_image as $img) {
                $identity_image = Helpers::upload('estate/', 'png', $img);
                array_push($id_img_names, $identity_image);
            }
            $identity_image = json_encode($id_img_names);
        } else {
            $identity_image = json_encode([]);
        }

        if (!empty($request->file('planed_image'))) {
            foreach ($request->planed_image as $img) {
                $planed_image = Helpers::upload('estate/', 'png', $img);
                array_push($planed_img_names, $planed_image);
            }
            $planed_image = json_encode($planed_img_names);
        } else {
            $planed_image = json_encode([]);
        }
        
       
        $address= mb_strimwidth($request->address, 0, 8, '');



 $url = "https://integration-gw.nhc.sa/nhc/prod/v2/brokerage/AdvertisementValidator";

        $response = Http::withHeaders([
              'X-IBM-Client-Id' => 'b4952cd30458e51546b3a9ab24c3fd22',
              'X-IBM-Client-Secret' => 'b64ec4f278d661809b101c039c66e79b',

            'RefId' => '0',
        ])->get($url, [
            'adLicenseNumber' =>$request->license_number,
            'advertiserId' => $request->advertiser_number,
            'idType' =>$request->idType,
        ]);

    if ($response->ok()) {
        $data = $response->json();

        if (!isset($data['Body']['result']['advertisement'])) {
            return response()->json([
                'success' => false,
                'message' => 'لم يتم العثور على بيانات الإعلان'
            ], 404);
        }

        $ad = $data['Body']['result']['advertisement'];
        
  
        
        
//      if (empty($ad['brokerageAndMarketingLicenseNumber']) || empty($ad['adLicenseNumber']) || empty($request->document_number)) {
//     return response()->json([
//         'success' => false,
//         'message' => 'تأكد من بياناتك في هيئة العقار'
//     ], 422); // 422 يعني Unprocessable Entity
// }
        
       
        
   
       

         $estate = new Estate();
        // $estate->deed_number = $ad['deedNumber'] ?? null;
        // $estate->advertiser_name = $ad['advertiserName'] ?? null;
        // $estate->phone_number = $ad['phoneNumber'] ?? null;
        // $estate->property_type = $ad['propertyType'] ?? null;
        // $estate->advertisement_type = $ad['advertisementType'] ?? null;
        // $estate->postal_code = $ad['location']['postalCode'] ?? null;
        // $estate->city = $ad['location']['city'] ?? null;
        // $estate->district = $ad['location']['district'] ?? null;
        // $estate->street = $ad['location']['street'] ?? null;
        // $estate->latitude = $ad['location']['latitude'] ?? null;
        // $estate->longitude = $ad['location']['longitude'] ?? null;
        // $estate->creation_date = !empty($ad['creationDate']) ? date('Y-m-d', strtotime($ad['creationDate'])) : null;
        // $estate->end_date = !empty($ad['endDate']) ? date('Y-m-d', strtotime($ad['endDate'])) : null;
        // $estate->property_area = $ad['propertyArea'] ?? null;
        // $estate->property_price = $ad['propertyPrice'] ?? null;
        // $estate->number_of_rooms = $ad['numberOfRooms'] ?? null;
        // $estate->property_face = $ad['propertyFace'] ?? null;
        // $estate->property_age = $ad['propertyAge'] ?? null;
        
        
        $estate->address = $request->address;
        $estate->property =$request->property;
        $estate->space = $request->space;


     $category = Category::where('name_ar', $request->category_name)->first();
        $estate->ownership_type = $request->ownership_type;

        $estate->status = 'active';
        $estate->ar_path=$request->ar_path;

        $estate->districts = $request->districts;
        
        $estate->network_type = $request->network_type;
         $estate->planned = $planed_image;



        $estate->qr = $request->qr;
        $estate->zone_id = $request->zone_id;
        $estate->user_id = $request->user_id;


        $estate->build_space=$request->build_space;

        $estate->images = $identity_image;
        $estate->estate_type=$request->estate_type;

        $estate->territory_id ="1";
        $estate->age_estate = $request->age_estate;
        $estate->long_description = $request->long_description;
        $estate->national_address =$address;

        $estate->floors =$request->floors;
        $estate->near = $request->near;
        $estate->latitude = $request->latitude;
        $estate->longitude = $request->longitude;
              $estate->price = $request->price;

        $estate->short_description = $request->short_description;
        $estate->price_negotiation = $request->price_negotiation;
        $estate->facilities = $request->facilities;
        $estate->other_advantages=$request->other_advantages;
        $estate->advertiser_no="234324";

        $estate->city = $request->city;
        $estate->service_offers="[]";

        $estate->street_space = $request->street_space;
        $estate->interface=$request->interface;
        $estate->feature=$request->feature;
        $estate->property_type=$request->property_type;
        $estate->authorization_number=$request->authorization_number;
        $estate->ad_number=$request->ad_number;
        $estate->document_number = $request->document_number;
        
        
        

      $estate->advertisement_type=$request->advertisement_type;
      $estate->postal_code=$request->postal_code;
      $estate->plan_number=$request->plan_number;
      $estate->category_name=$request->category_name;
                       
                 
                 


                                 
                                 
        $estate->license_number =$request->license_number;
                                    
          $estate->ad_license_number =$request->ad_license_number;
                                    
                              $estate->north_limit = $request->north_limit;
            $estate->east_limit = $request->east_limit;
            $estate->west_limit = $request->west_limit;
            $estate->south_limit =$request->south_limit;                 
                                    
                                    
                                    
                               
                             
                                 
                                 
                                 
        
         $estate->mainLandUseTypeName = $ad['propertyUsages'][0] ?? null;

                             
             $estate->landNumber = $ad['landNumber'] ?? null;              
        
        // $estate->mainLandUseTypeName= $ad['mainLandUseTypeName'] ?? null;
        
      $estate->numberOfRooms= $ad['numberOfRooms'] ?? null;
      $estate->locationDescriptionOnMOJDeed= $ad['locationDescriptionOnMOJDeed'] ?? null;  
        
    
      $estate->guaranteesAndTheirDuration= $ad['guaranteesAndTheirDuration'] ?? null;  
    $estate->obligationsOnTheProperty= $ad['obligationsOnTheProperty'] ?? null;    
   $estate->brokerageAndMarketingLicenseNumber= $ad['brokerageAndMarketingLicenseNumber'] ?? null;     
$estate->adLicense_number= $ad['adLicenseNumber'] ?? null;
$estate->ad_license_number= $ad['adLicenseNumber'] ?? null;
$estate->deed_number =$ad['deedNumber'] ?? null;
$estate->creation_date =$ad['creationDate'] ??null;
$estate->end_date =$ad['endDate']??  null;
$estate->titleDeedTypeName = $ad['titleDeedTypeName'] ?? null;
// $estate->end_date = $end_date;
$estate->property_type = $ad['propertyType'] ?? null;
$estate->total_price =  $ad['landTotalPrice'] ?? null;
 $estate->propertyUtilities =  json_encode( $ad['propertyUtilities'] )  ;
$estate->propertyUsages =  $ad['mainLandUseTypeName'] ?? null;

$estate->property_face =  $ad['propertyFace'] ?? null;


$estate->adLicenseUrl= $ad['adLicenseUrl'] ?? null;





$estate->advertiserName = $ad['advertiserName'] ?? null;
// $estate->end_date = $end_date;
$estate->phoneNumber = $ad['phoneNumber'] ?? null;

 $estate-> identityـorـunified=$ad['advertiserId'] ?? null;


        
 




        
             if ($category) {
                $estate->category_id = $category->id;
            } else {
                // في حال لم يتم العثور على القسم
                return back()->with('error', 'القسم غير موجود');
            }




        $estate->save();
        
         Agent::where('user_id',  $estate->user_id)->update([
    'fal_license_number' => $ad['brokerageAndMarketingLicenseNumber'] ?? null,
]);

$this->sendEstateAddedSMS("503731637", $estate->id);

        return response()->json([
            'success' => true,
            'message' => 'تمت إضافة العقار بنجاح',
            'estate_id' => $estate->id
        ]);
    } else {
    return response()->json([
        'success' => false,
        'message' => 'فشل الاتصال بواجهة NHC',
        'status' => $response->status(), // كود الاستجابة HTTP
        'error' => $response->body()     // محتوى الخطأ (قد يكون JSON أو HTML)
    ], $response->status());
    }
    
         } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'خطأ أثناء إضافة العقار',
            'error'   => $e->getMessage(),
            'trace'   => $e->getTraceAsString(), // اختياري: يظهر تفاصيل أكثر
        ], 500);
    }
    }
    public function get_properties(Request $request)
    {
        try {
            $properties = Property::where(['category_id'=>$request->category_id])->orderBy('id','desc')->get();

            return response()->json($properties, 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }
    public function package(){
        $packages= SubscriptionPackages::where('status',1)->get();
        return response()->json(['packages'=> $packages], 200);
    }


    public function package_view(){
        $packages= SubscriptionPackage::where('status',1)->get();
        return response()->json(['packages'=> $packages], 200);
    }

    public function market_plan(Request $request){
        $add_days=0;
        $estate=Estate::find($request->estate_id);

        $package = SubscriptionPackages::findOrFail($request->package_id);
        if($request->business_plan == 'subscription' && $request->package_id != null ) {

            $estate_subscription =   new usersSubscriptions();


            $estate_subscription->package_id=$package->id;
            $estate_subscription->estate_id=$estate->id;


            $estate_subscription->expiry_date= Carbon::now()->addDays($package->validity+$add_days)->format('Y-m-d');
            $estate_subscription->chat=$package->chat;
            $estate_subscription->user_id =$request->user_id;




            $subscription_transaction= new SubscriptionTransactions();
            $subscription_transaction->id= Str::uuid();
            $subscription_transaction->package_id=$package->id;
            $subscription_transaction->estate_id=$estate->id;
            $subscription_transaction->price=$package->price;

            $estate_subscription->save();

            DB::beginTransaction();

            $subscription_transaction->save();

            $data=[
                'restaurant_model' => 'subscription',
                'logo'=> $estate->logo,
                'message' => 'messages.application_placed_successfully'
            ];
            return response()->json($data,200);
        }

        elseif($request->business_plan == 'commission' ){
            $estate->restaurant_model = 'commission';
            $estate->save();

            $data=['restaurant_model' => 'commission',
                'logo'=> $estate->logo,
                'message' => translate('messages.application_placed_successfully')
            ];
            return response()->json($data,200);
        }
    }


    public function get_facilities(){
        try {
            $facilites = Facilities::orderBy('id','desc')->get();

            return response()->json($facilites, 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }



    public function get_advantages(){
        try {
            $advantages = Advantages::orderBy('id','desc')->get();

            return response()->json($advantages, 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }


    public function info_by_id(Request $request)
    {
        $data = User::find($request->user_id);
        $data['userinfo'] = $data->agent;
        //  $data['estate_count'] =(integer)$request->user()->estate->count();
        //   $data['member_since_days'] =(integer)$request->user()->created_at->diffInDays();
        unset($data['estate']);
        return response()->json($data, 200);
    }


    public function get_estate_by_agent(Request $request, $filter_data="all")
    {



        $type = $request->query('type', 'all');

        $estate = EstateLogic::get_estate($request['zone_id'], $request['category_id'],$filter_data, $request['limit'], $request['offset'], $type);
        $estate['estate'] = EstateLogic::estate_data_formatting($estate['estate']);
        return response()->json($estate, 200);



    }



    public function near_by()
    {
        $longitude='50.10942075401544';
        $latitude='26.44692719520837';
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://maps.googleapis.com/maps/api/place/nearbysearch/json', [
            'query' => [
                'location' => $latitude .',' . $longitude,
                'type' => 'restaurant', // replace with the type of place you're looking for
                'key' => 'AIzaSyDa4Ng7nNB5EkPqvcI1yaxcl8QE1Ja-tPA',
            ]
        ]);
        $result = json_decode($response->getBody()->getContents());
        return $result;
        $place = $result->results[0]; // assuming you only want the first result
    }


    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id'=> 'required',
            // 'address' => 'required',

            // 'space' => 'required',
            // 'category_id' => 'required',
            // 'price' => 'required',
            // 'national_address' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)],403);
        }

        $estate = Estate::find($request->id);

        if(!$estate)
        {
            return response()->json([
                'errors'=>[
                    ['code'=>'estate_id', 'message'=>'estate not found ']
                ]
            ],404);
        }

//        if(!$estate)
//        {
//            return response()->json([
//                'errors'=>[
//                    ['code'=>'delivery_man_id', 'message'=>'messages.not_found']
//                ]
//            ],404);
//        }









   
        $estate->ar_path=$request->ar_path;

      

        $estate->long_description = $request->long_description;


        $estate->short_description = $request->short_description;
     
        $estate->save();
        return response()->json(['message'=>'successfully'],200);

//     ;
//
//        return redirect('vendor-panel/delivery-man/list');
    }


    public function uploadVideo(Request $request)
    {
        $estate = Estate::find($request->id);
        if ($request->hasFile('video')) {
            $videoFile = $request->file('video');
            $filename = 'video_' . time() . '.' . $videoFile->getClientOriginalExtension();
            $videoFile->storeAs('videos', $filename, 'public');
//            $isFileUploaded = Storage::disk('public')->put($videoFile, file_get_contents($request->video));
//
//            // Save video metadata to the database


            $estate->video_url=$filename;
            $estate->save();

            return response()->json(['message' => 'Video uploaded successfully']);
        }

        return response()->json(['message' => 'No video file uploaded'], 400);
    }





    public function uploadSkyView(Request $request)
    {
        $estate = Estate::find($request->id);
        if ($request->hasFile('video')) {
            $videoFile = $request->file('video');
            $filename = 'video_' . time() . '.' . $videoFile->getClientOriginalExtension();
            $videoFile->storeAs('videos', $filename, 'public');
//            $isFileUploaded = Storage::disk('public')->put($videoFile, file_get_contents($request->video));
//
//            // Save video metadata to the database


            $estate->skyview=$filename;
            $estate->save();

            return response()->json(['message' => 'Video uploaded successfully']);
        }

        return response()->json(['message' => 'No video file uploaded'], 400);
    }






    public function fetchExistingImages($id)
    {
        $images = Estate::find($id);
        if (!$images) {
            return response()->json(['image_data' => []]);
        }

        return response()->json(['image_data' => json_decode($images->images)]);

    }


    public function fetchExistingPlanned($id)
    {
        $images = Estate::find($id);
        if (!$images) {
            return response()->json(['image_data' => []]);
        }


        return response()->json(['image_data' => json_decode($images->planned)]);
    }

    // public function uploadImages(Request $request, $id)
    // {


    //     if ($request->hasFile('images')) {
    //         $imageUrls = [];

    //         foreach ($request->file('images') as $imageFile) {
    //             $imageName = time() . '_' . $imageFile->getClientOriginalName();
    //             $imageFile->storeAs('public/estate', $imageName);

    //             $imageUrls[] =  $imageName;
    //         }

    //         // Fetch the existing images for the specific record
    //         // For example, if you have a related model (e.g., Post), you might do something like:
    //         $post = Estate::find($id);
    //         $existingImages = $post->image_data ?? [];

    //         // Combine the existing images with the newly uploaded images
    //         $allImages = array_merge($existingImages, $imageUrls);

    //         // Update the specified column (e.g., 'image_data') in your database with the combined images
    //         // For example:
    //         $post->update(['images' => $allImages]);

    //         return response()->json(['message' => 'Images uploaded and updated successfully'], 200);
    //     } else {
    //         return response()->json(['message' => 'No images to upload'], 400);
    //     }
    // }


public function uploadImages(Request $request, $id)
{
    if ($request->hasFile('images')) {
        $imageUrls = [];

        foreach ($request->file('images') as $imageFile) {
            $imageName = time() . '_' . $imageFile->getClientOriginalName();
            $imageFile->storeAs('public/estate', $imageName);

            $imageUrls[] = $imageName;
        }

        // Fetch the estate
        $estate = Estate::findOrFail($id);

        // Get existing images (decode JSON if not null)
        $existingImages = $estate->images ? json_decode($estate->images, true) : [];

        // Merge old and new images
        $allImages = array_merge($existingImages, $imageUrls);

        // Update the images column with new data (encoded as JSON)
        $estate->update(['images' => json_encode($allImages)]);

        return response()->json([
            'message' => 'Images uploaded and added to existing successfully',
            'images' => $allImages
        ], 200);
    } else {
        return response()->json(['message' => 'No images to upload'], 400);
    }
}


    public function deleteImage($id, $imageUrl)
    {
        $images = Estate::find($id);
        if (!$images) {
            return response()->json(['error' => 'No images found'], 404);
        }

        $imagePaths = json_decode($images->images);
        $index = array_search($imageUrl, $imagePaths);

        if ($index !== false) {
            // Delete the actual image file from storage
//            Storage::delete($imageUrl);



            array_splice($imagePaths, $index, 1);

            // Update the image_data column
            $images->update(['images' => json_encode($imagePaths)]);

            return response()->json(['message' => 'Image deleted successfully']);
        }

        return response()->json(['error' => 'Image not found'], 404);
    }



    // public function uploadPlanned(Request $request, $id)
    // {


    //     if ($request->hasFile('planned')) {
    //         $imageUrls = [];

    //         foreach ($request->file('planned') as $imageFile) {
    //             $imageName = time() . '_' . $imageFile->getClientOriginalName();
    //             $imageFile->storeAs('public/estate', $imageName);

    //             $imageUrls[] =  $imageName;
    //         }

    //         // Fetch the existing images for the specific record
    //         // For example, if you have a related model (e.g., Post), you might do something like:
    //         $post = Estate::find($id);
    //         $existingImages = $post->image_data ?? [];

    //         // Combine the existing images with the newly uploaded images
    //         $allImages = array_merge($existingImages, $imageUrls);

    //         // Update the specified column (e.g., 'image_data') in your database with the combined images
    //         // For example:
    //         $post->update(['planned' => $allImages]);

    //         return response()->json(['message' => 'Images uploaded and updated successfully'], 200);
    //     } else {
    //         return response()->json(['message' => 'No images to upload'], 400);
    //     }
    // }


public function uploadPlanned(Request $request, $id)
{
    if ($request->hasFile('planned')) {
        $imageUrls = [];

        foreach ($request->file('planned') as $imageFile) {
            $imageName = time() . '_' . $imageFile->getClientOriginalName();
            $imageFile->storeAs('public/estate', $imageName);

            $imageUrls[] = $imageName;
        }

        // Fetch the estate
        $estate = Estate::findOrFail($id);

        // Get existing planned images (decode JSON if not null)
        $existingImages = $estate->planned ? json_decode($estate->planned, true) : [];

        // Merge old and new images
        $allImages = array_merge($existingImages, $imageUrls);

        // Update the planned column with new data (encoded as JSON)
        $estate->update(['planned' => json_encode($allImages)]);

        return response()->json([
            'message' => 'Images uploaded and added to existing successfully',
            'images' => $allImages
        ], 200);
    } else {
        return response()->json(['message' => 'No images to upload'], 400);
    }
}

    public function deletePlanned($id, $imageUrl)
    {
        $images = Estate::find($id);
        if (!$images) {
            return response()->json(['error' => 'No images found'], 404);
        }

        $imagePaths = json_decode($images->planned);
        $index = array_search($imageUrl, $imagePaths);

        if ($index !== false) {
            // Delete the actual image file from storage
//            Storage::delete($imageUrl);



            array_splice($imagePaths, $index, 1);

            // Update the image_data column
            $images->update(['planned' => json_encode($imagePaths)]);

            return response()->json(['message' => 'Image deleted successfully']);
        }

        return response()->json(['error' => 'Image not found'], 404);
    }




    public function showVideo($id)
    {
        $video = Estate::find($id);
        return response()->json($video);
    }



    public function updatePath(Request $request)
    {
        $video = Estate::find($request->id);
        $video->update(['video_url' => $request->input('path')]);
        return response()->json(['message' => 'Video path updated successfully']);
    }



    public function destroyVideo($id)
    {
        $video = Estate::findOrFail($id);

        // Remove the video file from storage if needed
        // Storage::delete($video->path);

        $video->delete();

        return response()->json(['message' => 'Video removed successfully']);
    }


    public function createReport(Request $request) {
        // Validate incoming data

        $estate = new Report();
        $estate->title = $request->title;
        $estate->description =$request->description;
        $estate->estate_id = $request->estate_id;

        $estate->save();
        $this->sendEstateReportedSMS("503731637", $request->estate_id);

        return response()->json(['message' => 'Estate inserted successfully']);
    }





    public function advantage (){

        try {
            $advantages = Advantages::all();
            return response()->json(['advantages' => $advantages]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch advantages'], 500);
        }
    }





    public function getExistingAdvantages()
    {



        try {
            $estate = Estate::findOrFail(257);
            $advantages = json_decode($estate->other_advantages, true);


            return response()->json(['advantages' => $advantages]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch advantages'], 500);
        }


    }


//   public function validateAdvertisement($adLicenseNumber, $advertiserId, $idType)
//     {
//         // API URL

//      //   $url = 'https://integration-gw.housingapps.sa/nhc/dev/v2/brokerage/AdvertisementValidator';
//      $url = "https://integration-gw.nhc.sa/nhc/prod/v2/brokerage/AdvertisementValidator";

//         // Query Parameters
//         $queryParams = [
//             'adLicenseNumber' => $adLicenseNumber,
//             'advertiserId' => $advertiserId,
//             'idType' => $idType,
//         ];

//         // Headers
//         $headers = [
//             // 'X-IBM-Client-Id' => '77ade3ca8d69a99f37a92afb79f07a67',
//             // 'X-IBM-Client-Secret' => '3978f6284fa6cad973f080627fe980da',
//             'X-IBM-Client-Id' => 'b4952cd30458e51546b3a9ab24c3fd22',
//             'X-IBM-Client-Secret' => 'b64ec4f278d661809b101c039c66e79b',
//             'RefId' => '0',
//         ];

//         try {
//             // Send GET Request
//             $response = Http::withHeaders($headers)->get($url, $queryParams);

//             // Check Response Status
//             if ($response->successful()) {
//                 $body = $response->json('Body'); // Extract Body from response

//                 return response()->json([
//                     'status' => 'success',
//                     'isValid' => $body['result']['isValid'] ?? null,
//                     'advertisement' => $body['result']['advertisement'] ?? null,
//                     'message' => $body['result']['message'] ?? 'No message provided',
//                 ]);
//             } else {
//                 return response()->json([
//                     'status' => 'error',
//                     'message' => $response->body(),
//                 ], $response->status());
//             }
//         } catch (\Exception $e) {
//             // Handle Exception
//             return response()->json([
//                 'status' => 'error',
//                 'message' => $e->getMessage(),
//             ], 500);
//         }
//     }





    public function check_license(Request $request)
    {
        // Validate the input
        $request->validate([
            'adLicenseNumber' => 'required|string',
            'entityType' => 'required',
            'advertiserId' => 'required',
        ]);

        $adLicenseNumber = $request->input('adLicenseNumber');
        $advertiserId = $request->input('advertiserId');
        $entityType = $request->input('entityType');


      //  $url = "https://integration-gw.housingapps.sa/nhc/dev/v2/brokerage/AdvertisementValidator";

      $url = "https://integration-gw.nhc.sa/nhc/prod/v2/brokerage/AdvertisementValidator";
        $entityTypeInt = ($entityType === 'individual') ? 1 : 2;
        // Send the request to the API
        $response = Http::withHeaders([
            // 'X-IBM-Client-Id' => '77ade3ca8d69a99f37a92afb79f07a67',
            // 'X-IBM-Client-Secret' => '3978f6284fa6cad973f080627fe980da',

            'X-IBM-Client-Id' => 'b4952cd30458e51546b3a9ab24c3fd22',
            'X-IBM-Client-Secret' => 'b64ec4f278d661809b101c039c66e79b',
            'RefId' => '0',
        ])->get($url, [
            'adLicenseNumber' => $adLicenseNumber,
            'advertiserId' => $advertiserId,
            'idType' => $entityType,
        ]);



       if (Estate::where('ad_license_number', $adLicenseNumber)->exists()) {
        return response()->json([
            'success' => false,
            'message' => 'الإعلان موجود مسبقاً برقم الترخيص هذا.',
        ], 409); // 409 تعني Conflict
    }
    
        // Process the API response
        if ($response->ok()) {
            $data = $response->json();

            $data = $response->json();
            if ($data['Body']['result']['isValid']) {
                // استخراج البيانات
                $advertisement = $data['Body']['result']['advertisement'];
                
                $advertiserName = $advertisement['advertiserName'];
                $phoneNumber = $advertisement['phoneNumber'];
                $creationDate = $advertisement['creationDate'];
                $endDate = $advertisement['endDate'];
                
    //                 if (now()->gt(Carbon::parse($endDate))) {
    //     return response()->json([
    //         'success' => false,
    //         'message' => 'انتهى ترخيص الإعلان. لا يمكن استخدامه.',
    //     ], 410); // 410 Gone = المحتوى لم يعد متوفراً
    // }

                $deedNumber = $advertisement['deedNumber'];
                
                 $propertyUsages =  $advertisement['propertyUsages'];
                 
                 
                 
                    //  'north_limit_name' => $advertisement['borders']['northLimitName'] ?? null,
                    // 'north_limit_description' => $advertisement['borders']['northLimitDescription'] ?? null,
                    // 'north_limit_length_char' => $advertisement['borders']['northLimitLengthChar'] ?? null,
                    // 'east_limit_name' => $advertisement['borders']['eastLimitName'] ?? null,
                    // 'east_limit_description' => $advertisement['borders']['eastLimitDescription'] ?? null,
                    // 'east_limit_length_char' => $advertisement['borders']['eastLimitLengthChar'] ?? null,
                    // 'west_limit_name' => $advertisement['borders']['westLimitName'] ?? null,
                    // 'west_limit_description' => $advertisement['borders']['westLimitDescription'] ?? null,
                    // 'west_limit_length_char' => $advertisement['borders']['westLimitLengthChar'] ?? null,
                    // 'south_limit_name' => $advertisement['borders']['southLimitName'] ?? null,
                    // 'south_limit_description' => $advertisement['borders']['southLimitDescription'] ?? null,
                    // 'south_limit_length_char' => $advertisement['borders']['southLimitLengthChar'] ?? null,

               if ($data['Body']['result']['isValid']) {
    $advertisement = $data['Body']['result']['advertisement'];
    
    $borders = $advertisement['borders'] ?? [];

    // دمج قيم الحدود مباشرة داخل مصفوفة الإعلان
    $borders['northLimitName'] ?? null;
    $data2=  $advertisement['borders'];
     $data3=  $data['Body']['result'];
    $advertisement['north_limit_length_char'] = $borders['northLimitLengthChar'] ?? null;

    $advertisement['east_limit_name'] = $borders['eastLimitName'] ?? null;
    $advertisement['east_limit_description'] = $borders['eastLimitDescription'] ?? null;
    $advertisement['east_limit_length_char'] = $borders['eastLimitLengthChar'] ?? null;

    $advertisement['west_limit_name'] = $borders['westLimitName'] ?? null;
    $advertisement['west_limit_description'] = $borders['westLimitDescription'] ?? null;
    $advertisement['west_limit_length_char'] = $borders['westLimitLengthChar'] ?? null;

    $advertisement['south_limit_name'] = $borders['southLimitName'] ?? null;
    $advertisement['south_limit_description'] = $borders['southLimitDescription'] ?? null;
    $advertisement['south_limit_length_char'] = $borders['southLimitLengthChar'] ?? null;


    return response()->json([
        'success' => true,
        'message' => 'رقم الترخيص صالح!',
        'data' => $advertisement,
        'data2'=>$data2,
          'data3'=>$data3
    ], 200);
}
 else {
                    return response()->json([
                        'success' => false,
                        'message' => $data['Body']['result']['message'],
                    ], 400);
                }
            }

            // Handle API request error
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء التحقق. حاول مرة أخرى.',
            ], 500);
        }


    }





    public function getCategoriesByType(Request $request)
{
   // التحقق من أن الـ type موجود
 

   // استعلام الفئات حسب النوع
   $categories = Category::get();

   return response()->json($categories);  // إرجاع النتيجة بتنسيق J
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
    
    
    
    public function sendEstateAddedSMS($phone, $estateId)
{
    $ch = curl_init();

    // رابط العقار مع تمرير المعرف (id)
    $estateUrl = "https://app.abaadapp.sa/details/" . $estateId;

    // نص الرسالة
    $msg = "تم إضافة عرض عقاري جديد، يمكنك الاطلاع عبر الرابط: " . $estateUrl;

    curl_setopt($ch, CURLOPT_URL, "https://www.msegat.com/gw/sendsms.php");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);

    $fields = [
        "userName"   => "Abaad",
        "numbers"    => "0" . $phone, // الرقم المستهدف
        "userSender" => "ABAAD",
        "apiKey"     => "d98696cc4de689215daa663a3b5efe62",
        "msg"        => $msg
    ];

    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $server_output = curl_exec($ch);

    if (curl_errno($ch)) {
        return "cURL Error: " . curl_error($ch);
    }

    curl_close($ch);

    return $server_output; // رد API
}

public function sendEstateReportedSMS($phone, $estateId)
{
    $ch = curl_init();

    // رابط العقار مع تمرير المعرف (id)
    $estateUrl = "https://app.abaadapp.sa/details/" . $estateId;

    // نص الرسالة
    $msg = "تم التبليغ عن عرض عقاري، يمكنك الاطلاع عبر الرابط: " . $estateUrl;

    curl_setopt($ch, CURLOPT_URL, "https://www.msegat.com/gw/sendsms.php");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);

    $fields = [
        "userName"   => "Abaad",
        "numbers"    => "0" . $phone,
        "userSender" => "ABAAD",
        "apiKey"     => "d98696cc4de689215daa663a3b5efe62",
        "msg"        => $msg
    ];

    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $server_output = curl_exec($ch);

    if (curl_errno($ch)) {
        return "cURL Error: " . curl_error($ch);
    }

    curl_close($ch);

    return $server_output;
}






public function validate2(Request $request)
    {
        






// Validate incoming request
        $request->validate([
            'adLicenseNumber' => 'required',
            'advertiserId'    => 'required',
            'idType'          => 'required|in:1,2,3', // example
        ]);

        $url = "https://integration-gw.nhc.sa/nhc/prod/v2/brokerage/AdvertisementValidator";

        // Send request to NHC API
        $response = Http::withHeaders([
            'X-IBM-Client-Id'     => 'b4952cd30458e51546b3a9ab24c3fd22',
            'X-IBM-Client-Secret' => 'b64ec4f278d661809b101c039c66e79b',
            'RefId'               => '0',
        ])->get($url, [
            'adLicenseNumber' => $request->adLicenseNumber,
            'advertiserId'    => $request->advertiserId,
            'idType'          => $request->idType,
        ]);
        
        
       

        // Return failure if API doesn't respond
        if (!$response->ok()) {
            return response()->json([
                'success' => false,
                'message' => 'لم يتم الاتصال بالخدمة بنجاح',
            ], 500);
        }

        $data = $response->json();

        // Validate structure
        if (
            isset($data['Body']['result']['isValid']) &&
            $data['Body']['result']['isValid']
        ) {
            return response()->json([
                'success' => true,
                'message' => 'الترخيص صالح',
                'data'    => $data['Body']['result']
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => $data['Body']['result']['message'] ?? 'الترخيص غير صالح',
            'data'    => $data['Body']['result'] ?? null
        ], 422);
    }










    /**
     * جلب العروض والخدمات بناءً على القسم والمنطقة
     */
    public function get_services(Request $request)
    {
        // التحقق من المدخلات
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|integer',
            'zone_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'يرجى إرسال category_id و zone_id',
                'errors' => $validator->errors()
            ], 422);
        }

        $category_id = $request->input('category_id');
        $zone_id = $request->input('zone_id');

        // 1. جلب العروض المطابقة
        $offers = DB::table('offers')
            ->join('category_offer', 'offers.id', '=', 'category_offer.offer_id')
            ->join('offer_zone', 'offers.id', '=', 'offer_zone.offer_id')
            ->where('category_offer.category_id', $category_id)
            ->where('offer_zone.zone_id', $zone_id)
            ->select('offers.*') // تحديد أعمدة العرض فقط
            ->get();

        // 2. تحسين الأداء: جلب بيانات المزودين دفعة واحدة
        $phones = $offers->pluck('phone_provider')->unique()->filter();

        $providers = User::whereIn('phone', $phones)
            ->select('phone', 'name', 'snapchat', 'instagram', 'website', 'tiktok', 'twitter')
            ->get()
            ->keyBy('phone'); // فهرسة النتائج برقم الهاتف للوصول السريع

        // 3. دمج البيانات
        $data = $offers->map(function ($offer) use ($providers) {
            $provider = $providers->get($offer->phone_provider);

            // تحويل العرض إلى مصفوفة لإضافة حقول جديدة
            $offerArray = (array) $offer;
            
            $offerArray['provider_name'] = $provider->name ?? 'غير متوفر';
            $offerArray['snapchat']      = $provider->snapchat ?? 'غير متوفر';
            $offerArray['instagram']     = $provider->instagram ?? 'غير متوفر';
            $offerArray['website']       = $provider->website ?? 'غير متوفر';
            $offerArray['tiktok']        = $provider->tiktok ?? 'غير متوفر';
            $offerArray['twitter']       = $provider->twitter ?? 'غير متوفر';

            return $offerArray;
        });

        return response()->json([
            'status' => true,
            'data' => $data
        ], 200);
    }

}
