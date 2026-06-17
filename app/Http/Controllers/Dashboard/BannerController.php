<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    function index()
    {
        $banners = Banner::latest()->paginate(10);
        return view('dashboard.banners.index', compact('banners'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:191',
            'image' => 'required',
            'zone_id' => 'required',
            'provider_id' => 'required',

        ], [
            'zone_id.required' => 'select_a_zone',
            'provider_id.required' => 'select provider',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }

        $banner = new Banner;
        $banner->title = $request->title;
        $banner->provider_id = $request->provider_id;
        $banner->zone_id = $request->zone_id;
        $banner->image = Helpers::upload('banner/', 'png', $request->file('image'));
        $banner->save();
        Toastr::success("تمت ارسال الأشعار");
        return back();
    }



    public function delete(Banner $banner)
    {
        if (Storage::disk('public')->exists('banner/' . $banner['image'])) {
            Storage::disk('public')->delete('banner/' . $banner['image']);
        }
        $banner->delete();
        Toastr::success(translate('messages.banner_deleted_successfully'));
        return back();
    }
}
