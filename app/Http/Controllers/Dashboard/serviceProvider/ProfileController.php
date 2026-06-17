<?php

namespace App\Http\Controllers\Dashboard\serviceProvider;

use App\Helpers\FileUploder;
use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function display()
    {
      
        $user = auth()->guard('user')->user()->load('provider');
        
        
    

        $offers_count = $user->offers->where('offer_owner', 'all')->count();

        $your_offers_count = $user->offers->where('offer_owner', 'me')->count();

        $your_pending_offers_count = Offer::where('offer_owner', 'me')->whereHas('serviceProviders', function ($q) {
            $q->where('user_id', auth()->guard('user')->id())
            ->where('offer_user.status', 'pending');
        })->count();

        $pending_offers_count = Offer::where('offer_owner', 'all')->whereHas('serviceProviders', function ($q) {
            $q->where('user_id', auth()->guard('user')->id())
            ->where('offer_user.status', 'pending');
        })->count();

        $your_accept_offers_count = Offer::where('offer_owner', 'me')->whereHas('serviceProviders', function ($q) {
            $q->where('user_id', auth()->guard('user')->id())
            ->where('offer_user.status', 'accept');
        })->count();

        $accept_offers_count = Offer::where('offer_owner', 'all')->whereHas('serviceProviders', function ($q) {
            $q->where('user_id', auth()->guard('user')->id())
            ->where('offer_user.status', 'accept');
        })->count();

        

        return view('service-provider.profile.display', compact('user', 'your_offers_count', 'your_pending_offers_count', 'your_accept_offers_count', 'offers_count', 'pending_offers_count', 'accept_offers_count'));
    }

    public function update(User $user, Request $request)
    {
       
        $request->validate([
            'zone_id' => 'required',
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$user->id
        ]);

        $user->update([
            'zone_id' => $request->zone_id,
            'email' => $request->email,
            'name' => $request->name
        ]);

        $image = null;
        if ($request->has('image')) {
            $image = FileUploder::uploadOneImage($request, 'service-providers');
        } else {
            $image = $user->provider->image;
        }
        $user->provider->update([
            'image' => $image
        ]);



        if(!is_null($request->latitude) && !is_null($request->longitude)) {
            $user->provider->update([
                'latitude' => $request->latitude,
                'longitude' => $request->longitude
            ]);
        }

        toastr()->success('بنجاح', 'تم تعديل البيانات ');
        return back();
    }
}
