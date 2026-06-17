<?php

namespace App\Http\Controllers\api\v1;

use App\Helpers\EstateLogic;
use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Estate;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WishlistController extends Controller
{
    public function add_to_wishlist(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'estate_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        $wishlist = Wishlist::where('user_id', $request->user()->id)->where('estate_id', $request->estate_id)->first();
        if (empty($wishlist)) {
            $wishlist = new wishlist;
            $wishlist->user_id = $request->user()->id;
            $wishlist->estate_id = $request->estate_id;
            $wishlist->save();
           return response()->json(['message' => 'تمت الإضافة بنجاح'], 200);
        }

        return response()->json(['message' => 'مضاف مسبقا  الي العناصر المحفوظة'], 409);
    }


    public function remove_from_wishlist(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'estate_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        $wishlist = Wishlist::when($request->estate_id, function($query)use($request){
            return $query->where('estate_id', $request->estate_id);
        })->where('user_id', $request->user()->id)->first();

        if ($wishlist) {
            $wishlist->delete();
            return response()->json(['message' => 'successfully_removed'], 200);

        }
        return response()->json(['message' => 'not_found'], 404);
    }


    public function wish_list(Request $request)
    {;



$wishlists  = Estate::join("wishlists", "estates.id", "=", "wishlists.estate_id")
    ->where('wishlists.user_id', $request->user()->id)
    ->select('estates.*', 'wishlists.id as wishlist_id') // نحتفظ بمعرف المفضلة في متغير جديد
    ->get();

        // $wishlists  = Estate::join("wishlists", "estates.id", "=", "wishlists.estate_id")->where('wishlists.user_id',$request->user()->id)->get();
        $estate['estate'] = EstateLogic::estate_data_formatting($wishlists);

        $data =  [
            'estate' => $wishlists,

        ];


        return response()->json($estate, 200);
    }
}
