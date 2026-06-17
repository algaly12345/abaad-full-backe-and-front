<?php

namespace App\Http\Controllers\Dashboard\serviceProvider;

use App\Helpers\FileUploder;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Estate;
use App\Models\Offer;
use App\Models\ServicePlan;
use App\Models\ServiceProviderSubscription;
use App\Models\ServiceType;
use App\Models\Zone;
use App\Shop;
use Database\Seeders\ServiceProviderSubscriptionSeeder;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class OfferController extends Controller
{
    public function dispalyOffer(Offer $offer)
    {
        $offer = $offer->load('categories', 'zones');

        return view('service-provider.offers.display', compact('offer'));
    }

    public function createOffer()
    {


        $serviceTypes = ServiceType::all();
        $categories = Category::all();
        $zones = Zone::all();
        $servicePlans = ServicePlan::all();
        return view('service-provider.offers.create-offer', compact('serviceTypes', 'categories', 'zones','servicePlans'));
    }


    public function storeOffer(Request $request)
    {




    
    

        $request->validate([
            'title' => 'required|string',
            'service_type' => 'required',
            'service_price' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'expiry_date' => 'required',
            'description' => 'required',
            'categories' => 'required',
            'zones' => 'required',
            'image' => 'required'
        ]);




        $check_service_type_exists = ServiceType::where('id', $request->service_type)->first();

        $serviceType = new ServiceType();
        $service_type_id = null;

        if (!isset($check_service_type_exists)) {
            $serviceType->name = $request->service_type;
            $serviceType->save();

            $service_type_id = $serviceType->id;
        } else {
            $service_type_id = $request->service_type;
        }

        // DB::beginTransaction();
        // try {
        $image = null;
        if ($request->has('image')) {
            $image = FileUploder::uploadOneImage($request, 'offers');
        }
        $offer =   Offer::create([
            'title' => $request->title,
            'expiry_date' => $request->expiry_date,
            'service_price' => $request->service_price,
            'description' => $request->description,
            'discount' => $request->discount,
            'offer_type' => $request->offer_type,
            'service_type_id' => $service_type_id,
            'offer_owner' => 'me',
            'image' => $image,
            'phone_provider'=>"".auth()->guard('user')->user()->phone.""


        ]);


        $offer->serviceProviders()->attach(auth()->guard('user')->user()->id);
        $offer->categories()->attach($request->categories);
        $offer->zones()->attach($request->zones);
        $offer->updateOfferStatusToSended();

        $subscription_number = 'SUB-' . strtoupper(uniqid());
        ServiceProviderSubscription::create([
            'user_id' => auth()->guard('user')->user()->id,
            'service_plan_id' => $request->service_plan_id, // الباقة المحددة
            'duration' => $request->subscription_duration, // افتراضي: شهر واحد
            'expiry_date' =>  $request->expiry_date, // تحويل التاريخ إلى yyyy-mm-dd
            'subscription_status' => 'pending', // حالة الاشتراك مبدئيًا "معلق"
            'payment_status' => 'unpaid',
            'price' =>  $request->package_price,
            'offer_id' =>  $offer->id,
            'subscription_number' => $subscription_number, // ✅ حفظ رقم الاشتراك
          
            'created_at' => now(), // 👈 أضف هذا إذا لم يتم ملء الحقل تلقائيًا
            'updated_at' => now(),


            'number_of_ads'=>  $request->number_of_ads,
            'number_of_zone'=>  $request->number_of_zone,
            'number_of_categories'=>  $request->number_of_categories,
        ]);

        Session::put('package_price', $request->package_price);

        // $offer->estates()->attach($estae->id);
        toastr()->success('بنجاح', 'تم حفظ البيانات');

        // return redirect()->route('service-provider.estaes.payment', ['offer_id' => $offer->id]);

        return redirect()->route('service-provider.estaes.payment', [
            'offer_id' => $offer->id, 
            'price' => $request->package_price,  // أضف السعر هنا
            'subscription_number' => $subscription_number // أضف رقم الاشتراك هنا
        ]);
        //return back();
        // } catch (\Exception $e) {
        //     DB::rollback();
        //     throw $e;
        // }





        // toastr()->success('بنجاح', 'تم حفظ البيانات');
    }

    public function update(Offer $offer, Request $request)
    {

        // dd($request->all());

        $request->validate([
            'title' => 'required|string',
            'service_type' => 'required',
            'service_price' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'expiry_date' => 'required|date',
            'description' => 'required',
            'categories' => 'required',
            'zones' => 'required',
        ]);

        $check_service_type_exists = ServiceType::where('id', $request->service_type)->first();

        $serviceType = new ServiceType();
        $service_type_id = null;

        if (!isset($check_service_type_exists)) {
            $serviceType->name = $request->service_type;
            $serviceType->save();

            $service_type_id = $serviceType->id;
        } else {
            $service_type_id = $request->service_type;
        }

        $image = null;
        if ($request->has('image')) {
            $image = FileUploder::uploadOneImage($request, 'offers');
        } else {
            $image = $offer->image;
        }

        $offer->update([
            'title' => $request->title,
            'expiry_date' => $request->expiry_date,
            'service_price' => $request->service_price,
            'description' => $request->description,
            'discount' => $request->discount,
            'offer_type' => $request->offer_type,
            'service_type_id' => $service_type_id,
            'offer_owner' => 'me',
            'image' => $image,
            'phone_provider'=>"09070443070"
        ]);


//        $offer->update([
//            'title' => $request->title,
//            'expiry_date' => $request->expiry_date,
//            'service_price' => $request->service_price,
//            'description' => $request->description,
//            'discount' => $request->discount,
//            'offer_type' => $request->offer_type,
//            'service_type_id' => $service_type_id,
//            'offer_owner' => 'me',
//            'phone_provider'=>"09070443070"
//
//        ]);

        $offer->categories()->sync($request->categories);
        $offer->zones()->sync($request->zones);

        toastr()->success('بنجاح', 'تم تعديل البيانات');
        return back();
    }
    public function edit(Offer $offer)
    {
        $serviceTypes = ServiceType::all();
        $categories = Category::all();
        $zones = Zone::all();
        return view('service-provider.offers.edit-offer', compact('serviceTypes', 'categories', 'zones', 'offer'));
    }
    public function pendingOffers()
    {
        $offers = Offer::where('offer_owner', 'all')
        ->whereHas('serviceProviders', function ($q) {
            $q->where('user_id', auth()->guard('user')->id());
        })
        ->with(['serviceProviders' => function ($query) {
            $query->where('user_id', auth()->guard('user')->id())
                  ->with('subscriptions.servicePlan'); // تعديل لاستدعاء الاشتراكات مع الباقة
        }])
        ->get();
    
        return view('service-provider.offers.pending', compact('offers'));
    }
    

    public function acceptOffers()
    {
        $offers = Offer::where('offer_owner', 'all')->whereHas('serviceProviders', function ($q) {
            $q->where('user_id', auth()->guard('user')->id())
            ->where('offer_user.status', 'accpet');
        })->get();

        return view('service-provider.offers.accept', compact('offers'));
    }

    public function changeStatusAccpetOffer(Offer  $offer)
    {
        $offer->accpet();
        toastr()->success('بنجاح', 'تم الموافقة على العرض');
        return back();
    }


    // public function peindingOwnerOffers()
    // {
    //     $offers = Offer::where('offer_owner', 'me')->whereHas('serviceProviders', function ($q) {
    //         $q->where('user_id', auth()->guard('user')->id());
    //         //            ->where('offer_user.status', 'pending');
    //     })->get();

    //     return view('service-provider.offers.pending-owner-offers', compact('offers'));
    // }

    
    public function acceptOwnerOffers()
    {
        $offers = Offer::where('offer_owner', 'me')->whereHas('serviceProviders', function ($q) {
            $q->where('user_id', auth()->guard('user')->id())
            ->where('offer_user.status', 'accpet');
        })->get();

        return view('service-provider.offers.accept-owner-offers', compact('offers'));
    }




    public function index()
    {


        $categories = Category::all();
        $shops = Estate::with(['categories'])
            ->searchResults()
            ->paginate(9);


        $mapShops = $shops->makeHidden([ 'created_at', 'updated_at', 'user_id', 'images']);
        $latitude = $shops->count() && (request()->filled('category') || request()->filled('search')) ? $shops->average('latitude') : 51.5073509;
        $longitude = $shops->count() && (request()->filled('category') || request()->filled('search')) ? $shops->average('longitude') : -0.12775829999998223;

        return view('service-provider.home', compact('categories', 'shops', 'mapShops', 'latitude', 'longitude'));
    }

    public function show(Estate $shop)
    {
        $shop->load(['categories']);

        return view('service-provider.details', compact('shop'));
    }

    public function delete(Offer $offer)
    {

        $offer->categories()->detach();
        $offer->zones()->detach();
        $offer->serviceProviders()->detach();
        $offer->delete();
        toastr()->success('بنجاح', 'تم  حذف العرض');
        return back();

    }



 


    public function payment(Request $request ,$offer_id)
    {
        $offer = Offer::findOrFail($offer_id);

        $price = $request->query('price');
        $subscriptionNumber = $request->query('subscription_number');
        return view('service-provider.offers.payment',compact('offer', 'price', 'subscriptionNumber'));
    }
    
    
    public function toggleStatus(Offer $offer)
{
    $userId = auth()->guard('user')->id();

    $hasAccess = $offer->serviceProviders()
        ->where('user_id', $userId)
        ->exists();

    abort_unless($hasAccess, 403);

    if ($offer->status === 'cancelled') {
        $offer->update([
            'status' => 'accept',
        ]);

        toastr()->success('تم تشغيل العرض بنجاح');
    } else {
        $offer->update([
            'status' => 'cancelled',
        ]);

        toastr()->success('تم إلغاء تفعيل العرض بنجاح');
    }

    return back();
}


public function peindingOwnerOffers()
{
    $userId = auth()->guard('user')->id();

    $offers = Offer::where('offer_owner', 'me')
        ->whereHas('serviceProviders', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })
        ->with([
            'categories',
            'zones',
            'serviceType',
            'subscriptions.servicePlan',
            'serviceProviders' => function ($q) use ($userId) {
                $q->where('user_id', $userId);
            },
        ])
        ->latest()
        ->get();

    return view('service-provider.offers.pending-owner-offers', compact('offers'));
}


}
