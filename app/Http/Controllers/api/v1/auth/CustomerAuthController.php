<?php

namespace App\Http\Controllers\api\v1\auth;

use App\CentralLogics\SMS_module;
use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Model\BusinessSetting;
use App\Models\Agent;
use App\Models\Category;
use App\Models\PhoneOrEmailVerification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class CustomerAuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }
        $data = [
            'phone' => $request->phone,
            'password' => $request->password
        ];

//        $customer_verification = BusinessSetting::where('key','customer_verification')->first()->value;
        //dd($customer_verification);
        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            if(auth()->user()->is_active=='disactive')
            {
                $errors = [];
                array_push($errors, ['code' => 'auth-003', 'message' => 'messages.your_account_is_blocked']);
                return response()->json([
                    'errors' => $errors
                ], 403);
            }
//            if($customer_verification && !auth()->user()->is_phone_verified && env('APP_MODE') != 'demo')
//            {




            $otp = rand(1000, 9999);


            DB::table('phone_or_email_verifications')->updateOrInsert(['phone_or_email' => $request['phone']],
                [
                    'token' => $otp,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

            $ch = curl_init();
            $msg = 'مرحبا' . ' ' . $request->f_name . ' ' . 'كود تفعيل  الرقم الخاص بك ' . ' ' . $otp;
            curl_setopt($ch, CURLOPT_URL, "https://www.msegat.com/gw/sendsms.php");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, TRUE);

            curl_setopt($ch, CURLOPT_POST, TRUE);

            $fields = <<<EOT
{
  "userName": "Abaad",
  "numbers": "0$request->phone",
  "userSender": "ABAAD",
  "apiKey": "d98696cc4de689215daa663a3b5efe62",
  "msg": "$msg"
}
EOT;
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Content-Type: application/json"
            ));
//
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//            end sms code verification

            $server_output = curl_exec($ch);

            curl_close($ch);
            $user = auth()->user();
            if($user->ref_code == null && isset($user->id)){
                $ref_code = Helpers::generate_referer_code($user);
                DB::table('users')->where('phone', $user->phone)->update(['ref_code' => $ref_code]);
            }


            $agent = Agent::where('user_id', $user->id)->first();

            if (!$agent) {
                Agent::create([
                    'user_id' => $user->id,
                    'name' =>'Default User',
                    'phone' =>  $user->phone,
                    'agent_type' => 'فرد',
                    'membership_type' => 'customer',
                ]);
            }
            return response()->json(['token' => $token, 'is_phone_verified'=>auth()->user()->is_phone_verified], 200);
        } else {
            $errors = [];
            array_push($errors, ['code' => 'auth-001', 'message' => 'messages.Unauthorized']);
            return response()->json([
                'errors' => $errors
            ], 401);
        }
    }


    public function all_code()
    {
        try {
            $categories = PhoneOrEmailVerification::orderBy('id', 'desc')->first();
            return response()->json($categories, 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }


        public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required|unique:users',
        ], [
            'name.required' => 'الإسم غير موجود'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        //Save point to refeer
        if($request->ref_code) {
            $ref_status = BusinessSetting::where('key','ref_earning_status')->first()->value;
            if ($ref_status != '1') {
                return response()->json(['errors'=>Helpers::error_formater('ref_code', translate('messages.referer_disable'))], 403);
            }

            $referar_user = User::where('ref_code', '=', $request->ref_code)->first();
            if (!$referar_user || !$referar_user->status) {
                return response()->json(['errors'=>Helpers::error_formater('ref_code',translate('messages.referer_code_not_found'))], 405);
            }

            if(WalletTransaction::where('reference', $request->phone)->first()) {
                return response()->json(['errors'=>Helpers::error_formater('phone',translate('Referrer code already used'))], 203);
            }
            $ref_code_exchange_amt = BusinessSetting::where('key','ref_earning_exchange_rate')->first()->value;

            $refer_wallet_transaction = CustomerLogic::create_wallet_transaction($referar_user->id, $ref_code_exchange_amt, 'referrer',$request->phone);
            //dd($refer_wallet_transaction);
            try{
                if(config('mail.status')) {
                    Mail::to($referar_user->email)->send(new \App\Mail\AddFundToWallet($refer_wallet_transaction));
                }
            }catch(\Exception $ex)
            {
                info($ex);
            }
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'zone_id'=>$request->zone_id,
            'user_type'=>'customer',
            'membership_type'=>$request->membership_type,
            'unified_number'=>$request->unified_number,
        ]);
        $user->ref_code = Helpers::generate_referer_code($user);
        $user->save();

        $token = $user->createToken('LaravelAuthApp')->accessToken;


        $otp = rand(1000, 9999);
        DB::table('phone_or_email_verifications')->updateOrInsert(['phone_or_email' => $request['phone']],
            [
                'token' => $otp,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        Agent::create([

            'name'=>$user->name,
            'phone'=>$user->phone,
            'agent_type' => 'فرد',
            'membership_type' => 'customer',
            'user_id' =>   $user->id ,
        ]);

        $ch = curl_init();
        $msg = 'مرحبا' . ' ' . $request->f_name . ' ' . 'كود تفعيل  الرقم الخاص بك ' . ' ' . $otp;
        curl_setopt($ch, CURLOPT_URL, "https://www.msegat.com/gw/sendsms.php");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, TRUE);

        curl_setopt($ch, CURLOPT_POST, TRUE);

        $fields = <<<EOT
{
  "userName": "Abaad",
  "numbers": "0$request->phone",
  "userSender": "ABAAD",
  "apiKey": "d98696cc4de689215daa663a3b5efe62",
  "msg": "$msg"
}
EOT;
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json"
        ));
//
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//            end sms code verification

        $server_output = curl_exec($ch);

        curl_close($ch);
        
        
        
        
          $msg = "تم تسجيل مستخدم جديد في منصة أبعاد.\n" .
           "الاسم: " . $user->name . "\n" .
           "الجوال: " . $user->phone;

    // رقم المدير (بدون صفر البداية، لأنه ينضاف في sendSMS)
    $managerPhone = "503731637";

    // استدعاء الدالة
    $this->sendSMS($managerPhone, $msg);

        // Mail::to($request['email'])->send(new EmailVerification($otp));


        try
        {
//            Mail::to($request->email)->send(new \App\Mail\CustomerRegistration($request->f_name.' '.$request->l_name));
        }
        catch(\Exception $ex)
        {
            info($ex);
        }

        return response()->json(['token' => $token,'is_phone_verified' => 0, 'phone_verify_end_url'=>"api/v1/auth/verify-phone" ], 200);
    }


    public function verify_phone(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|min:11|max:14',
            'otp'=>'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }
        $user = User::where('phone', $request->phone)->first();
        if($user)
        {
            if($user->is_phone_verified)
            {
                return response()->json([
                    'message' => trans('messages.phone_number_is_already_varified')
                ], 200);

            }

            if(env('APP_MODE')=='demos')
            {
                if($request['otp']=="1234")
                {
//                    $user->is_phone_verified = 1;
                    $user->save();

                    return response()->json([
                        'message' => trans('messages.phone_number_varified_successfully'),
                        'otp' => 'inactive'
                    ], 200);
                }
                return response()->json([
                    'message' => trans('messages.phone_number_and_otp_not_matched')
                ], 404);
            }

            $data = DB::table('phone_or_email_verifications')->where([
                'phone_or_email' => $request['phone'],
                'token' => $request['otp'],
            ])->first();

            if($data)
            {
                DB::table('phone_or_email_verifications')->where([
                    'phone_or_email' => $request['phone'],
                    'token' => $request['otp'],
                ])->delete();

//                $user->is_phone_verified = 1;
                $user->save();

                return response()->json([
                    'message' => trans('messages.phone_number_varified_successfully'),
                    'otp' => 'inactive'
                ], 200);
            }
            else{
                return response()->json([
                    'message' => trans('messages.phone_number_and_otp_not_matched')
                ], 404);
            }
        }
        return response()->json([
            'message' => trans('messages.not_found')
        ], 404);

    }


    public function curl_req($path,$json,$req)
    {
        $ch = curl_init($path);
        $data = json_encode($json);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $req);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
            'app-id:73d8f06c',
            'app-key:fa7e64f860397e4a29c3fd01520a509a',
            'client-id:6af3210f-4450-4fee-9616-3edb80ab6982','Content-Length: ' . strlen($data)));
        $result = curl_exec($ch);
        $result = json_decode($result);
        return $result;
    }
    
    
    public function sendSMS($phone, $msg)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://www.msegat.com/gw/sendsms.php");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);

    $fields = [
        "userName"   => "Abaad",
        "numbers"    => "0" . $phone,
        "userSender" => "ABAAD",
        "apiKey"     => "d98696cc4de689215daa663a3b5efe62",
        "msg"        => $msg
    ];

    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $server_output = curl_exec($ch);

    if (curl_errno($ch)) {
        return "cURL Error: " . curl_error($ch);
    }

    curl_close($ch);

    return $server_output;
}

}


