<?php

namespace App\Helpers;

use App\Model\Color;
use App\Models\Estate;
use App\Models\Agent;
use App\Models\Offer;
use App\Models\wishlist;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class EstateLogic
{

    public static function get_estate($zone_id,$category_id,$user_id,$city,$districts,$space, $filter, $limit = 400, $offset = 1,$ar_path,$sv,$advertisement_type)
    {

        if($sv==1){
            $paginator = Estate::Active()
                ->when($category_id, function ($query) use ($category_id) {
                    $query->where('category_id', $category_id);
                })
                ->when($city, function ($query) use ($city) {
                    $query->where('city', $city);
                })->
                when($zone_id, function ($query) use ($zone_id) {
                    $query->where('zone_id',$zone_id);
                })->  
                when($advertisement_type, function ($query) use ($advertisement_type) {
                    $query->where('advertisement_type',$advertisement_type);
                    
                    
                })-> when($user_id, function ($query) use ($user_id) {
                    $query->where('user_id',$user_id);
                })->when($districts, function ($query) use ($districts) {
    $normalized = str_replace('حي', '', $districts); // حذف كلمة "حي" لو كانت موجودة
    $normalized = trim($normalized); // إزالة المسافات
    $query->where(function ($q) use ($districts, $normalized) {
        $q->where("districts", 'LIKE', "%$districts%")
          ->orWhere("districts", 'LIKE', "%$normalized%");
    });
})
->when($space, function ($query) use ($space) {
                    $query->where("space",  $space);
                })->with('Images') ->when($ar_path === '1', function ($query) {
                    $query->whereNotNull('ar_path');
                })-> where(function ($query) use ($category_id) {
                    $query->whereExists(function ($subquery) use ($category_id) {
                        $subquery->select(DB::raw(1))
                            ->from('category_offer')
                            ->whereRaw('category_offer.category_id = estates.category_id');
                    })->orWhere('category_id', $category_id);
                })->whereRaw("STR_TO_DATE(end_date, '%d/%m/%Y') >= CURDATE()")
                
                ->orderBy  ('id', 'desc')
                ->paginate($limit, ['*'], 'page', $offset);

            return [
                'total_size' => $paginator->total(),
                'limit' => $limit,
                'offset' => $offset,
                'estate' => $paginator->items()
            ];
        }else{
            $paginator = Estate::Active()
                ->when($category_id, function ($query) use ($category_id) {
                    $query->where('category_id', $category_id);
                })
                ->when($city, function ($query) use ($city) {
                    $query->where('city', $city);
                })->
                when($zone_id, function ($query) use ($zone_id) {
                    $query->where('zone_id',$zone_id);
                })-> when($user_id, function ($query) use ($user_id) {
                    $query->where('user_id',$user_id);
                })->when($districts, function ($query) use ($districts) {
    $normalized = str_replace('حي', '', $districts); // حذف كلمة "حي" لو كانت موجودة
    $normalized = trim($normalized); // إزالة المسافات
    $query->where(function ($q) use ($districts, $normalized) {
        $q->where("districts", 'LIKE', "%$districts%")
          ->orWhere("districts", 'LIKE', "%$normalized%");
    });
})
->when($space, function ($query) use ($space) {
                    $query->where("space",  $space);
                    
                })->
                  when($advertisement_type, function ($query) use ($advertisement_type) {
                    $query->where('advertisement_type',$advertisement_type);
                    
                    
                })->with('Images') ->when($ar_path === '1', function ($query) {
                    $query->whereNotNull('ar_path');
                })->whereRaw("STR_TO_DATE(end_date, '%d/%m/%Y') >= CURDATE()")
                ->orderBy  ('id', 'desc')
                ->paginate($limit, ['*'], 'page', $offset);

            return [
                'total_size' => $paginator->total(),
                'limit' => $limit,
                'offset' => $offset,
                'estate' => $paginator->items()
            ];
        }
    }




    public static function get_fav($user_id)
    {
        $paginator = wishlist::Active()->where('user_id',$user_id)->orderBy('id', 'desc');
        return [
            'estate' => $paginator->items()
        ];
    }







    public static function estate_data_formatting($estate)
    {


        $data = [];
        $categories=0;
        foreach($estate as $item)
        {
//            foreach($item->categories as $value)
//            {
//               return $value->id;
//            }

$agent = Agent::where('user_id', $item->user_id)->first();

            $data[]=[

                'title'=>$item->category_name."-".$item->city."-".$item->districts ==null?"not avaiable":$item->category_name."-".$item->city."-".$item->districts,
                'service_offers'=>self::get_service($item->category->id,$item->zone_id),
                'category_id'=>$item->category->id,
                'price_negotiation'=>$item->price_negotiation,
                'video_url'=>$item->video_url,



//                    $item->offers,
                //   'title'=>$item->city==null?"omeromer":$item->category->name."-".$estate->city."-".$estate->districts,
                'category'=>$item->category->position,

                'estate_id'=> $item->id,
                'city'=> $item->city==null?"":$item->city,

                'category_name'=>$item->category->name,
                'zone_name'=>$item->zones->name,

                'category_name_ar'=>$item->category->name_ar,
                'zone_name_ar'=>$item->zones->name_ar,

                'id'=> $item->id ,
                'address' => $item->address,
                'space' =>  $item->space,
                'price' => $item->price,
                'ownership_type' => $item->ownership_type,
                'property'=> json_decode($item->property),
                'view' => $item->view,
                'planned' => json_decode($item->planned),
                'status' => $item->status,
                'districts' =>$item->districts,
                'network_type' => json_decode($item->network_type),
                'height' => $item->height,
                'width' => $item->width,
                'qr' => $item->qr,

                'images' => json_decode($item->images),
                'ar_path' => $item->ar_path,
                'zone_id' => $item->zone_id,

                'type_add' => $item->type_add,
                'territory_id' => $item->territory_id,

                'age_estate' => $item->age_estate,
                'long_description' => $item->long_description,
                'national_address' => $item->national_address,


                'floors' => $item->floors,
                'near'=> $item->near,
                'created_at'=>Carbon::parse($item->updated_at)->locale('ar')->translatedFormat('Y/M/d'),

                'user_id' => $item->user_id,
                'updated_at' => $item->updated_at,
                'latitude' => $item->latitude,
                'longitude' => $item->longitude,
                'short_description' => $item->short_description,
                'ad_number' => $item->ad_number,
                'advertiser_no' => $item->advertiser_no,
                "other_advantages"=>json_decode($item->other_advantages),
                'interface' => json_decode($item->interface),
                'street_space' => $item->street_space,
                'build_space'=>$item->build_space,
                'document_number'=>$item->document_number,
                'users' => $item->users,
                'property_type' => $item->property_type,
                'skyview' => $item->skyview,
                "estate_type"=>$item->estate_type,
                "authorization_number"=>$item->authorization_number,
                
                "identityـorـunified" =>    $item->identityـorـunified,


                'creation_date' => $item->creation_date,
                "end_date"=>$item->end_date,
                "deed_number"=>$item->deed_number,
                "ad_license_number"=>$item->ad_license_number,
            //     'agent_identity' => $agent ? $agent->identity : null,
            // 'agent_fal_license_number' => $agent ? $agent->fal_license_number : null,
            
            
            //  'unified_number' => $agent ? $agent->unified_number : null,
            
            
            
                
                
                  "brokerageAndMarketingLicenseNumber"=>$item->brokerageAndMarketingLicenseNumber,
                  
                  "titleDeedTypeName"=>$item->titleDeedTypeName,
                  
                  
                  
                 'north_limit' => $item->north_limit,
                "east_limit"=>$item->east_limit,
                "west_limit"=>$item->west_limit,
                "south_limit"=>$item->south_limit,
                
                
                
                "street_width"=>$item->street_width,
                "property_face"=>$item->property_face,
                
                
                "category_name"=>$item->category_name,
                "advertisement_type"=>$item->advertisement_type,
                
                "total_price"=>$item->total_price,
                
                "license_number"=>$item->license_number,
                
                "plan_number"=>$item->plan_number,
                
                  "obligationsOnTheProperty" => $item->obligationsOnTheProperty,
              "guaranteesAndTheirDuration" => $item->guaranteesAndTheirDuration,
             "locationDescriptionOnMOJDeed" => $item->locationDescriptionOnMOJDeed,
             "numberOfRooms" => $item->numberOfRooms,
              "mainLandUseTypeName" => $item->mainLandUseTypeName,
              
                "landNumber" => $item->landNumber,
                      'propertyUtilities' => json_decode($item->propertyUtilities),
                "propertyUsages" => $item->propertyUsages,
                 "adLicenseUrl" => $item->adLicenseUrl,
                 
                 
                 
                  "advertiserName"=>$item->advertiserName,
                
                "phoneNumber"=>$item->phoneNumber,
                
                "isValid"=>$item->isValid,
                
                
                
             
         

                
                
                
                
                
                  
                  
                  
                
                
                
       
                






            ];

        }
        return $data;

    }






    public static function estate_details_formatting($estate)
    {



        $data = [];

        $data['title']=$estate->category->name."-".$estate->city."-".$estate->districts;
        $data["category"]=$estate->category->position;
        $data['price']= $estate->price;

        $data['city']= $estate->city;
        $data['service_offers']=self::get_service($estate->category_id,0);
        $data['video_url']= $estate->video_url;

        $data['id']= $estate->id ;
        $data['address'] = $estate->address;
        $data[  'space'] = $estate->space ;
        $data[ 'ownership_type'] = $estate->ownership_type;
        $data[   'property']= json_decode($estate->property);
        $data[  'view'] = $estate->view;
        $data[  'planned'] = json_decode($estate->planned);
        $data[ 'status'] = $estate->status;
        $data[ 'districts'] =$estate->districts;
        $data[ 'network_type'] =json_decode($estate->network_type);

        $data['qr'] = $estate->qr;

        $data['images'] = json_decode($estate->images);
        $data['ar_path'] = $estate->ar_path;
        $data[ 'zone_id'] = $estate->zone_id;

        $data[ 'type_add'] = $estate->type_add;
        $data[ 'territory_id'] = $estate->territory_id;

        $data[ 'age_estate'] = $estate->age_estate;
        $data[ 'long_description'] = $estate->long_description;
        $data[ 'national_address'] = $estate->national_address;
        $data[ 'user_id']= $estate->user_id;
        $data[ 'near']= $estate->near;

        $data[ 'created_at'] =  Carbon::parse($estate->created_at)->locale('ar')->translatedFormat('Y/M/d');;

        $data[ 'updated_at'] =Carbon::parse($estate->created_at)->locale('ar')->translatedFormat('Y/M/d') ;
        $data[ 'latitude'] = $estate->latitude;
        $data[ 'longitude'] = $estate->longitude;
        $data[ 'short_description'] = $estate->short_description;
        $data[ 'ad_number'] = $estate->ad_number;
        $data[ 'advertiser_no'] = $estate->advertiser_no;
        $data['other_advantages'] = json_decode($estate->other_advantages, true);

        $data[ 'interface'] = json_decode($estate->interface);
        $data[ 'street_space'] = $estate->street_space;
        $data["price_negotiation"]=$estate->price_negotiation;
        $data["build_space"]=$estate->build_space;
        $data['document_number']=$estate->document_number;
        $data['users']=$estate->users;
        $data['category_id']=$estate->category_id;
        $data['estate_type']=$estate->estate_type;
        $data['authorization_number']=$estate->authorization_number;





        $data["category_name"]=$estate->category->name;
        $data['zone_name']=$estate->zones->name;
        $data['category_name_ar']=$estate->category->name_ar;
        $data['zone_name_ar']=$estate->zones->name_ar;

        $data['property_type']=$estate->property_type;
        $data['skyview']=$estate->skyview;


        $data['creation_date']=$estate->creation_date;

        $data['end_date']=$estate->end_date;
        $data['ad_license_number']=$estate->ad_license_number;

        $data['deed_number']=$estate->deed_number;
        
        
        $data['brokerageAndMarketingLicenseNumber']=$estate->brokerageAndMarketingLicenseNumber;
        
        $data['titleDeedTypeName']=$estate->titleDeedTypeName;
        
        
        
                
                
                
                
         $data['north_limit']=$estate->north_limit;

        $data['east_limit']=$estate->east_limit;
        $data['west_limit']=$estate->west_limit;

        $data['south_limit']=$estate->south_limit;
        
        
        
        
        $data['street_width']=$estate->street_width;
        
        $data['property_face']=$estate->property_face;
        
        
        
        
        $data['category_name']=$estate->category_name;
        
        $data['advertisement_type']=$estate->advertisement_type;
        
        
          $data['total_price']=$estate->total_price;
        
          $data['license_number']=$estate->license_number;
        
        
          $data['identityـorـunified']=$estate->identityـorـunified;
        
        $data['plan_number']=$estate->plan_number;
        
        $data['obligationsOnTheProperty'] = $estate->obligationsOnTheProperty;
    $data['guaranteesAndTheirDuration'] = $estate->guaranteesAndTheirDuration;
   $data['locationDescriptionOnMOJDeed'] = $estate->locationDescriptionOnMOJDeed;
  $data['numberOfRooms'] = $estate->numberOfRooms;
  $data['mainLandUseTypeName'] = $estate->mainLandUseTypeName;
   $data['propertyUtilities'] = json_decode($estate->propertyUtilities);
     $data['landNumber'] = $estate->landNumber;
        $data['propertyUsages'] = $estate->propertyUsages;
        $data['adLicenseUrl'] = $estate->adLicenseUrl;
    
  


          




        $data['advertiserName'] = $estate->advertiserName;
        $data['phoneNumber'] = $estate->phoneNumber;

  $data['isValid'] = $estate->isValid;


      
    
          
        
        
        




      
        return $data;

    }




    public static function get_estate_details($estate_id)
    {
        return Estate::active()->whereId($estate_id)->first();
    }


    public static function generateUniqueCode()

    {

        do {

            $code = random_int(100000, 999999);

        } while (Estate::where("ad_number", "=", $code)->first());



        return $code;

    }



    // public static function get_service($category_id)
    // {

    //     $data = DB::table('offers')
    //         ->join('category_offer', 'offers.id', '=', 'category_offer.offer_id')->where("category_id",$category_id)
    //         ->get();

    //     $res = json_decode($data, true);


    //     return $res;
    // }


    

//     public static function get_service($category_id)
// {
//     $data = DB::table('offers')
//             ->join('category_offer', 'offers.id', '=', 'category_offer.offer_id')->where("category_id",$category_id)
//             ->get();

//     // إضافة الاستعلام للحصول على اسم مقدم الخدمة (افترض أن مقدمي الخدمة هم المستخدمين في جدول users)
//     foreach ($data as &$offer) {
//         // استعلام للحصول على اسم مقدم الخدمة بناءً على user_id أو provider_id
//         $provider = DB::table('users')
//             ->where('phone', $offer->phone_provider)  // أو استبدل بـ provider_id إذا كان لديك هذا الحقل
//             ->select('name', 'snapchat', 'instagram', 'website', 'tiktok', 'twitter')
//             ->first();
        
//         // إضافة اسم مقدم الخدمة إلى العروض
//         $offer->provider_name = $provider ? $provider->name : 'غير متوفر';
//         $offer->snapchat = $provider ? $provider->snapchat : 'غير متوفر';
//         $offer->instagram = $provider ? $provider->instagram : 'غير متوفر';
//         $offer->website = $provider ? $provider->website : 'غير متوفر';
//         $offer->tiktok = $provider ? $provider->tiktok : 'غير متوفر';
//         $offer->twitter = $provider ? $provider->twitter : 'غير متوفر';
//     }

//      $res = json_decode($data, true);


//         return $res;
// }

public static function get_service($category_id, $zone_id)
{
    $data = DB::table('offers')
        ->join('category_offer', 'offers.id', '=', 'category_offer.offer_id')
        ->join('offer_zone', 'offers.id', '=', 'offer_zone.offer_id')
        ->where('category_offer.category_id', $category_id)
        ->where('offer_zone.zone_id', $zone_id)
        ->get();

    foreach ($data as &$offer) {
        $provider = DB::table('users')
            ->where('phone', $offer->phone_provider)
            ->select('name', 'snapchat', 'instagram', 'website', 'tiktok', 'twitter')
            ->first();

        $offer->provider_name = $provider ? $provider->name : 'غير متوفر';
        $offer->snapchat = $provider ? $provider->snapchat : 'غير متوفر';
        $offer->instagram = $provider ? $provider->instagram : 'غير متوفر';
        $offer->website = $provider ? $provider->website : 'غير متوفر';
        $offer->tiktok = $provider ? $provider->tiktok : 'غير متوفر';
        $offer->twitter = $provider ? $provider->twitter : 'غير متوفر';
    }

    return json_decode($data, true);
}




    public static function category_data_formatting($data, $multi_data = false, $trans = false)
    {
        $storage = [];
        if ($multi_data == true) {
            foreach ($data as $item) {
                if (count($item->translations) > 0) {
                    $item->name = $item->translations[0]['value'];
                }

                if (!$trans) {
                    unset($item['translations']);
                }

                $storage[] = $item;
            }
            $data = $storage;
        } else if (isset($data)) {
            if (count($data->translations) > 0) {
                $data->name = $data->translations[0]['value'];
            }

            if (!$trans) {
                unset($data['translations']);
            }
        }
        return $data;
    }


public static function get_estate_by_map_bounds(
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
    $northEastLat = null,
    $northEastLng = null,
    $southWestLat = null,
    $southWestLng = null
) {
    if ($sv == 1) {
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
                    $q->where("districts", 'LIKE', "%$districts%")
                      ->orWhere("districts", 'LIKE', "%$normalized%");
                });
            })
            ->when($space && $space != '0', function ($query) use ($space) {
                $query->where("space", $space);
            })
            ->with('Images')
            ->when($ar_path === '1', function ($query) {
                $query->whereNotNull('ar_path');
            })
            ->where(function ($query) use ($category_id) {
                $query->whereExists(function ($subquery) {
                    $subquery->select(DB::raw(1))
                        ->from('category_offer')
                        ->whereRaw('category_offer.category_id = estates.category_id');
                });

                if ($category_id && $category_id != '0') {
                    $query->orWhere('category_id', $category_id);
                }
            })
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->whereRaw("STR_TO_DATE(end_date, '%d/%m/%Y') >= CURDATE()");
    } else {
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
                    $q->where("districts", 'LIKE', "%$districts%")
                      ->orWhere("districts", 'LIKE', "%$normalized%");
                });
            })
            ->when($space && $space != '0', function ($query) use ($space) {
                $query->where("space", $space);
            })
            ->with('Images')
            ->when($ar_path === '1', function ($query) {
                $query->whereNotNull('ar_path');
            })
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->whereRaw("STR_TO_DATE(end_date, '%d/%m/%Y') >= CURDATE()");
    }

    if (
        !empty($northEastLat) &&
        !empty($northEastLng) &&
        !empty($southWestLat) &&
        !empty($southWestLng)
    ) {
        $query->whereBetween('latitude', [(float)$southWestLat, (float)$northEastLat])
              ->whereBetween('longitude', [(float)$southWestLng, (float)$northEastLng]);
    }

    $paginator = $query->orderBy('id', 'desc')
        ->paginate($limit, ['*'], 'page', $offset);

    return [
        'total_size' => $paginator->total(),
        'limit' => $limit,
        'offset' => $offset,
        'estate' => $paginator->items()
    ];
}

}
