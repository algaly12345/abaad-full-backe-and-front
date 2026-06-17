<?php

namespace App\Http\Controllers\api\v1\auth;

use App\CPU\Helpers;
use App\CPU\SMS_module;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use function App\CPU\translate;

class ForgotPassword extends Controller
{
    public function reset_password_request(Request $request)
    {
//
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        $customer = User::Where(['phone' => $request['phone']])->first();

        if (isset($customer)) {
            if(env('APP_MODE')=='demo')
            {
                return response()->json(['message' => trans('messages.otp_sent_successfull')], 200);
            }
            $token = rand(1000,9999);
            DB::table('password_resets')->insert([
                'identity' => $customer['phone'],
                'token' => $token,
                'created_at' => now(),
            ]);
            // Mail::to($customer['email'])->send(new \App\Mail\PasswordResetMail($token));
            // return response()->json(['message' => 'Email sent successfully.'], 200);
//            $response = SMS_module::send($request['phone'],$token);
//            if($response == 'success')
//            {
//                return response()->json(['message' => trans('messages.otp_sent_successfull')], 200);
//            }
//            else
//            {
//                return response()->json([
//                    'errors' => [
//                        ['code' => 'otp', 'message' => trans('messages.failed_to_send_sms')]
//                ]], 405);
//            }



            $ch = curl_init();
            $msg = 'مرحبا' . ' ' . $request->f_name . ' ' . 'كود تفعيل  الرقم الخاص بك ' . ' ' . $token;
            curl_setopt($ch, CURLOPT_URL, "https://www.msegat.com/gw/sendsms.php");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, TRUE);

            curl_setopt($ch, CURLOPT_POST, TRUE);

            $fields = <<<EOT
{
  "userName": "wael16407",
  "numbers": "$request->phone",
  "userSender": "jadeerapp",
  "apiKey": "12abf3f8017640bc67ce66348157c7a9",
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
            return response()->json(['message' => trans('messages.otp_sent_successfull')], 200);
        }
        return response()->json(['errors' => [
            ['code' => 'not-found', 'message' => 'Phone number not found!']
        ]], 404);
    }

    public function otp_verification_submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'identity' => 'required',
            'otp' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        $id = $request['identity'];
        $data = DB::table('password_resets')->where('user_type','customer')->where(['token' => $request['otp']])
            ->where('identity', 'like', "%{$id}%")
            ->first();

        if (isset($data)) {
            return response()->json(['message' => 'otp verified.'], 200);
        }

        return response()->json(['errors' => [
            ['code' => 'not-found', 'message' => 'invalid OTP']
        ]], 404);
    }

    public function reset_password_submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'identity' => 'required',
            'otp' => 'required',
            'password' => 'required|same:confirm_password|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        $data = DB::table('password_resets')
            ->where('user_type','customer')
            ->where('identity', 'like', "%{$request['identity']}%")
            ->where(['token' => $request['otp']])->first();

        if (isset($data)) {
            DB::table('users')->where('phone', 'like', "%{$data->identity}%")
                ->update([
                    'password' => bcrypt(str_replace(' ', '', $request['password']))
                ]);

            DB::table('password_resets')
                ->where('user_type','customer')
                ->where('identity', 'like', "%{$request['identity']}%")
                ->where(['token' => $request['otp']])->delete();

            return response()->json(['message' => 'Password changed successfully.'], 200);
        }
        return response()->json(['errors' => [
            ['code' => 'invalid', 'message' => 'Invalid token.']
        ]], 400);
    }
}
