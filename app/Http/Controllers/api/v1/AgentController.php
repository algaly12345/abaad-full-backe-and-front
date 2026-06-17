<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AgentController extends Controller
{

    public function complete_agent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'identity' => 'unique:agents',
            'advertiser_no' => 'required',
            'identity_type' => 'required',

        ], [
            'name.required' => 'الإسم غير موجود',
            'zone_id.required' => 'اسم المنطقة مطلوب'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }








        DB::table('agents')
            ->where('user_id', auth()->user()->id)
            ->update(['identity' => $request->identity,
                'advertiser_no' => $request->advertiser_no,
                'identity_type' => $request->identity_type,
                'membership_type' => $request->membership_type,
                'commercial_registerion_no' => $request->commercial_registerion_no,
                ]);
        DB::table('users')->update(['user_type' => "agent"]);
        // Mail::to($request['email'])->send(new EmailVerification($otp));


        try
        {
//            Mail::to($request->email)->send(new \App\Mail\CustomerRegistration($request->f_name.' '.$request->l_name));
        }
        catch(\Exception $ex)
        {
            info($ex);
        }

        return response()->json(['message' =>'تمت العملية بنجاح'], 200);
    }


}
