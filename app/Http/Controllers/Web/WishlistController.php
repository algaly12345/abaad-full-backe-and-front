<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    //

    public function viewWishlist()
{
    $user = auth('customer')->user();
    
    if (!$user) {
        return redirect()->route('customer.auth.login')->with('error', 'يجب تسجيل الدخول لعرض المفضلة.');
    }

    $favorites = wishlist::where('user_id', $user->id)
        ->with('wishlistProduct') // تحميل بيانات العقار المرتبط
        ->get();

      


        
    return view('web-views.users-profile.account-wishlist', compact('favorites'));

    
}



public function deleteWishlist(Request $request)
{
    $user = auth('customer')->user();
    
    if (!$user) {
        return response()->json(['status' => 'error', 'message' => 'يجب تسجيل الدخول.'], 401);
    }

    $estateId = $request->input('estate_id');

    Wishlist::where('user_id', $user->id)
        ->where('estate_id', $estateId)
        ->delete();

    return response()->json(['status' => 'removed']);
}


}
