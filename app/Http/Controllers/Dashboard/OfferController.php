<?php

namespace App\Http\Controllers\Dashboard\serviceProvider;

use App\Helpers\FileUploder;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Estate;
use App\Models\Offer;
use App\Models\ServiceType;
use App\Models\Zone;
use App\Shop;
use Illuminate\Http\Request;

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
        return view('service-provider.offers.create-offer', compact('serviceTypes', 'categories', 'zones'));
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

        // $offer->estates()->attach($estae->id);
        toastr()->success('بنجاح', 'تم حفظ البيانات');
        return redirect()->route('service-provider.estaes.payment', ['offer_id' => $offer->id]);
        // return back();
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
        // offer_service_provider.status === this for pvoit table


        // $offers = auth()->guard('service_provider')->user()->offers;
        $offers = Offer::where('offer_owner', 'all')->whereHas('serviceProviders', function ($q) {
            $q->where('user_id', auth()->guard('user')->id())
            ->where('offer_user.status', 'pending');
        })->get();

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


    public function peindingOwnerOffers()
    {
        $offers = Offer::where('offer_owner', 'me')->whereHas('serviceProviders', function ($q) {
            $q->where('user_id', auth()->guard('user')->id());
            //            ->where('offer_user.status', 'pending');
        })->get();

        return view('service-provider.offers.pending-owner-offers', compact('offers'));
    }
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
        return view('service-provider.dashboard.index', compact('categories', 'shops', 'mapShops', 'latitude', 'longitude'));
        // return view('service-provider.home', compact('categories', 'shops', 'mapShops', 'latitude', 'longitude'));
    }



    public function dashboard ()
    {




        $categories = Category::all();
        $shops = Estate::with(['categories'])
            ->searchResults()
            ->paginate(9);


        


        $mapShops = $shops->makeHidden([ 'created_at', 'updated_at', 'user_id', 'images']);
        $latitude = $shops->count() && (request()->filled('category') || request()->filled('search')) ? $shops->average('latitude') : 51.5073509;
        $longitude = $shops->count() && (request()->filled('category') || request()->filled('search')) ? $shops->average('longitude') : -0.12775829999998223;
        return view('service-provider.dashboard.index', compact('categories', 'shops', 'mapShops', 'latitude', 'longitude'));
        // return view('service-provider.home', compact('categories', 'shops', 'mapShops', 'latitude', 'longitude'));
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















}
