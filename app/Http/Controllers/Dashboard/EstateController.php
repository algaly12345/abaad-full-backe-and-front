<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\EstateLogic;
use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Category;
use App\Models\Estate;
use App\Models\ServiceType;
use App\Models\User;
use App\Models\Zone;
use App\Offices;
use App\Sections;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Brian2694\Toastr\Facades\Toastr;

class EstateController extends Controller
{

    public function index(Request $request)
    {





        $data['zones']= Zone::orderBy('id','desc')->get();
        $data['users']= User::orderBy('id','desc')->get();

        $post_query=Estate::where('status',1);





        if($request->users){
            $post_query->whereHas('users',function($q) use ($request){
                $q->where('name',$request->users);
            });
        }

        $data['categories']=Category::orderBy('id','desc')->get();

        $post_query=Estate::where('status',1);


        if($request->categories){
            $post_query->whereHas('categories',function($q) use ($request){
                $q->where('name',$request->categories);
            });
        }

        if($request->zones){
            $post_query->whereHas('zones',function($q) use ($request){
                $q->where('name',$request->zones);
            });
        }


        if($request->keyword){

            $post_query->where('ad_number','LIKE','%'.$request->keyword.'%');
        }


        if($request->sortByComments && in_array($request->sortByComments, ['asc','desc'])){
            return $request->sortByComments;
            $post_query->orderBy('id',$request->sortByComments);
        }
        $data['estates']=$post_query->orderBy('id','DESC')->paginate(30);
        return view('dashboard.estate.index',$data);

    }

    public function create()
    {
        $zones = Zone::query()->select('id', 'name')->get();

        $serviceTypes = ServiceType::query()->select('id', 'name')->get();
        return view('dashboard.estate.create', compact('zones', 'serviceTypes'));
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
                'price.required' => 'price is required!',
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


            $categories =  [$room,$number_bathrooms,$number_lounges];


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
            // $estate->planned = $planed_image;

            $estate->age_estate = $request->age_estate;

            $estate->qr = $request->qr;
            $estate->zone_id = $request->zone_id;

            $estate->type_add=$request->ad_type;
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
            $estate->ad_number= EstateLogic:: generateUniqueCode();
            $estate->street_space = $request->street_space;
            $estate->interface=$request->interface;




            if($user!=null){
                $estate->user_id =$user->id;
            }else {


                $em = new User();
                $em->name = $request->name;
                $em->phone =$request->phone;
                $em->zone_id =$request->zone_id;
                $em->password="1234567";
                $em->user_type="customer";
                $em->save();


                Agent::create([

                    'name'=>$request->name,
                    'phone'=>$request->phone,
                    'agent_type' => 'فرد',
                    'membership_type' => 'customer',
                    'user_id' =>  $em->id,
                ]);
                $estate->user_id =$em->id;

            }
            $estate->save();


            Toastr::success('تمت عملية الإضافة بنجاح');
            return redirect('admin/estate');
        }catch (Exception $e){
            return $e;

        }
    }



    public function edit( $id)
    {

        $estates= Estate::find($id);
        $zones = Zone::all();
        $categories =Category::all();


        return view('dashboard.estate.edit', compact('zones','estates','categories'));


    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'space' => 'required',
            'category_id' => 'required',
            'price' => 'required',
            'zone_id' => 'required',

        ], [
            'price.required' => 'price is required!',
            'zone_id.required' => 'Please select a zone!',
            'space.required' => 'Please select space!'
        ]);
        $estate = Estate::find($id);







        if ($request->has('estate_image')){
            foreach (json_decode($estate['estate_image'], true) as $img) {
                if (Storage::disk('public')->exists('estate/' . $img)) {
                    Storage::disk('public')->delete('estate/' . $img);
                }
            }
            $img_keeper = [];
            foreach ($request->identity_image as $img) {
                $identity_image = Helpers::upload('estate/', 'png', $img);
                array_push($img_keeper, $identity_image);
            }
            $identity_image = json_encode($img_keeper);
        } else {
            $identity_image = $estate['estate_image'];

        }

        $user= User::where('phone',$request->phone)->first();
        $estate->address = $request->address;
//        $estate->property = json_encode($categories );
        $estate->space = $request->space;
//        $estate->cover_photo = Helpers::upload('restaurant/cover/', 'png', $request->file('cover_photo'));
        $estate->category_id = $request->category_id;
        $estate->price = $request->price;
        $estate->ownership_type = $request->ownership_type;

        $estate->status = 'active';
        $estate->districts = $request->districts;
        // $estate->network_type = $request->network_type;
//        $estate->planned = $planed_image;

        $estate->age_estate = $request->age_estate;

        $estate->qr = $request->qr;
        $estate->zone_id = $request->zone_id;

    

        $estate->build_space=$request->build_space;

        // $estate->images = $identity_image;

        $estate->territory_id ="1";
        $estate->age_estate = $request->images;
        $estate->long_description = $request->long_description;
        $estate->national_address =$request->national_address;

        $estate->floors =$request->floors;
        $estate->near = $request->near;
        // $estate->latitude = $request->latitude;
        // $estate->longitude = $request->longitude;

        $estate->short_description = $request->short_description;
        $estate->price_negotiation = $request->price_negotiation;
        $estate->facilities = $request->facilities;
        // $estate->other_advantages=$request->other_advantages;
        $estate->ar_path=$request->ar_path;
        $estate->advertiser_no="234324";

        $estate->city = $request->city;
        $estate->service_offers="[]";
        $estate->ad_number= EstateLogic:: generateUniqueCode();
        $estate->street_space = $request->street_space;
        $estate->interface=$request->interface;


        $estate->ar_path=$request->ar_path;

    //     if($user!=null){
    //         $estate->user_id =$user->id;
    //     }else {


    //         $em = new User();
    //         $em->name = $request->name;
    //         $em->phone =$request->phone;
    //         $em->zone_id =$request->zone_id;
    //         $em->password="1234567";
    //         $em->user_type="customer";
    //         $em->save();
    //         Agent::create([

    //             'name'=>$user->name,
    //             'phone'=>$user->phone,
    //             'agent_type' => 'فرد',
    //             'membership_type' => 'customer',
    //             'user_id' =>   $user->id ,
    //         ]);
    // }
        $estate->save();
        Toastr::success('تمت عملية الإضافة بنجاح');
        return redirect('admin/estate');

    }

    public function getUser(Request $request){
        $search = $request->search;

        if($search == ''){
            $employees = User::orderby('name','asc')->select('id','phone','name','advertiser_no')->limit(5)->get();
        }else{
            $employees = User::orderby('name','asc')->select('id','phone','name','advertiser_no')->where('phone', 'like', '+966' .$search . '%')->limit(5)->get();
        }

        $response = array();
        foreach($employees as $employee){
            $response[] = array("name"=>$employee->name,"label"=>$employee->phone,"job_number"=>$employee->user_type,"advertiser_no"=>$employee->advertiser_no);
        }

        return response()->json($response);
    }





    public function destroy($id)
    {
        $category =Estate::find($id);
        $category->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.estate.index');

    }//



}
