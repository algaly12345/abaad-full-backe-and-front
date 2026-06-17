<?php

namespace App\Http\Controllers;

use App\Helpers\EstateLogic;
use App\Helpers\Helpers;
use App\Models\Agent;
use App\Models\Category;
use App\Models\Estate;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class EstateContrller extends Controller
{

    public function  create(){
        return view("create");
    }


    public function  success(){
        return view("success");
    }


    public function store(Request $request)
    {


        try {


            $request->validate([
                'space' => 'required',
                'category_id' => 'required',
                'price' => 'required',
                'zone_id' => 'required',


            ], [
                'price.required' => ' السعر مطلوب!',
                'zone_id.required' => 'Please select a zone!',
                'space.required' => 'Please select space!'
            ]);


            $categories = [];

            $room= [
                'name' =>'غرف نوم',
                'number' =>  $request->room_number,
            ];


            $number_bathrooms= [
                'name' => 'حمام',
                'number' =>  $request->number_bathrooms,

            ];


            $number_lounges=[
                'name' => 'صلات',
                'number' =>  $request->number_lounges,
            ];



            $kitchen=[
                'name' => 'مطبخ',
                'number' =>  $request->kitchen,
            ];


            $north=[
                'name'=>'الواجهة الشمالية',
                'space'=>$request->north
            ];

            $west=[
                'name'=>'الواجهة الغربية',
                'space'=>$request->west
            ];


            $south=[
                'name'=>'الواجهة الجنوبية',
                'space'=>$request->south
            ];


            $east=[
                'name'=>'الواجهة الشرقية',
                'space'=>$request->east
            ];

            $categories =  [$number_bathrooms,$room,$number_lounges,$kitchen];
            $interface =  [$north,$west,$south,$east];

            $planed_img_names = [];
            $id_img_names = [];
            if (!empty($request->file('estate_image'))) {
                foreach ($request->estate_image as $img) {
                    $estate_image = Helpers::upload('estate/', 'png', $img);
                    array_push($id_img_names, $estate_image);
                }
                $estate_image = json_encode($id_img_names);
            } else {
                $estate_image = json_encode([]);
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







            $estate = new Estate();
            $user= User::where('phone',$request->phone)->first();
            $estate->address = $request->address;
            $estate->property = json_encode($categories );
            $estate->space = $request->space;
//        $estate->cover_photo = Helpers::upload('restaurant/cover/', 'png', $request->file('cover_photo'));
            $estate->category_id = $request->category_id;
            $estate->price = $request->price;
            $estate->ownership_type = $request->ownership_type;

            $estate->status = 'active';
            $estate->districts = $request->districts;
            $estate->network_type = $request->network_type==null?"[]":$request->network_type;
            $estate->planned = $planed_image;

            $estate->age_estate = $request->age_estate;

            $estate->qr = $request->qr;
            $estate->zone_id = $request->zone_id;
            
            $estate->build_space=$request->build_space;

            $estate->images = $estate_image;

            $estate->territory_id ="1";
            $estate->age_estate = $request->images=="[]"?"['not_found.png']": $request->images;
            $estate->long_description = $request->long_description;
            $estate->national_address =$request->national_address;

            $estate->floors =$request->floors;
            $estate->near = $request->near;
            $estate->latitude = $request->latitude;
            $estate->longitude = $request->longitude;

            $estate->short_description = $request->short_description;
            $estate->price_negotiation = $request->price_negotiation;
            $estate->facilities = $request->facilities;
            $estate->other_advantages=$request->other_advantages==null?"[]":$request->other_advantages;
            $estate->advertiser_no="234324";

            $estate->city = $request->city;
            $estate->service_offers="[]";
            $estate->ad_number= $request->ad_number;
            $estate->street_space = $request->street_space;
            $estate->interface=json_encode($interface);
            $estate->ar_path=$request->vr;




            if($user!=null){
                $estate->user_id =$user->id;
            }else {



                $em = new User();

                if ($request->has('license')) {
                    $car_license = Helpers::update('signature/', $em->car_license_image, 'png', $request->file('license'));

                } else {
                    $car_license = $em['image'];
                }
                $em->name = $request->name;
                $em->phone ="+966".$request->phone;
                $em->zone_id =$request->zone_id;
                $em->membership_type =$request->user_type;
                $em->advertiser_no=$request->advertiser_no;
                $em->image =$car_license;
                $em->password=bcrypt("1234567");
                $em->user_type="customer";
                $em->save();


                Agent::create([

                    'name'=>$request->name,
                    'phone'=>"+966".$request->phone,
                    'agent_type' => 'فرد',
                    'membership_type' => 'customer',
                    'user_id' =>  $em->id,
                ]);
                $estate->user_id =$em->id;

            }
            $estate->save();


            toastr()->success('تمت إضافة العرض بنجاح');

            return to_route('estate.success');
        }catch (Exception $e){
            return $e;

        }
    }


}
