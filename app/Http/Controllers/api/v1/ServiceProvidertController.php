<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Estate;
use App\Models\EstateOffer;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class ServiceProvidertController extends Controller
{
public function update(Request $request){
    $offer =   EstateOffer::where([ 'estate_id' => $request['estate_id']])->update([
        'status' => 'accept'
    ]);
    if($offer){
     return "ok";
    }

}



public function index(Request $request)
    {
        $rows = DB::table('service_provider_subscriptions as sps')
            ->leftJoin('users as u', 'u.id', '=', 'sps.user_id')
            ->leftJoin('subscription_packages as sp', 'sp.id', '=', 'sps.service_plan_id')
            ->selectRaw("
                sps.id,
                sps.subscription_number,
                sps.subscription_status,
                sps.payment_status,
                sps.duration,
                sps.expiry_date,
                sps.price,

                u.id AS user_id,
                u.name AS user_name,
                u.email AS user_email,

                sp.package_name,
                sp.price AS package_price,
                sp.validity AS package_validity
            ")
            ->orderByDesc('sps.id')
            ->get();

        return response()->json([
            'success' => true,
            'count' => $rows->count(),
            'data' => $rows,
        ], 200);
    }
}
