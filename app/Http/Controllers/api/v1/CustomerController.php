<?php

namespace App\Http\Controllers\api\v1;

use App\Helpers\EstateLogic;
use App\Helpers\EstateManager;
use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Category;
use App\Models\Estate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;



use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

use phpseclib3\Crypt\PublicKeyLoader;

use GuzzleHttp\Client;
use App\Models\ApiResponse;




class CustomerController extends Controller
{


    public function info(Request $request)
    {
        $data = $request->user();
        $data['userinfo'] = $data->agent;
        if ($data->user_type === 'provider') {
            $data['provider'] = $data->provider;
        }
        $data['estate_count'] =(integer)$request->user()->estate->count();
//       $data['member_since_days'] =(integer)$request->user()->created_at->diffInDays();
          unset($data['estate']);
        return response()->json($data, 200);
    }




    public function update_profile(Request $request)
    {




        $image = $request->file('image');

        if ($request->has('image')) {
            $imageName = Helpers::update('profile/', $request->user()->image, 'png', $request->file('image'));
        } else {
            $imageName = $request->user()->image;
        }


        $userDetails = [
            'name' => $request->name,
            'image' => $imageName,
            'youtube' => $request->youtube,
            'snapchat' => $request->snapchat,
            'instagram' => $request->instagram,
            'website' => $request->website,
            'tiktok' => $request->tiktok,
            'twitter' => $request->twitter,
            'updated_at' => now()
        ];

        User::where(['id' => $request->user()->id])->update($userDetails);

            Agent::where(['user_id' => $request->user()->id])->update([
                'name' => $request->name,
                'image' => $imageName
            ]);



        return response()->json(['message' =>'successfully_updated'], 200);
    }




    public function info_by_id(Request $request, $filter_data="all")
    {
        $type = $request->query('type', 'all');

        $estate = EstateLogic::get_estate($request['zone_id'], $request['category_id'],$request->user()->id,$request["city"],$request['districts'], $request['space'],$request['type_add'],$filter_data, $request['limit'], $request['offset'], $type);
        $estate['estate'] = EstateLogic::estate_data_formatting($estate['estate']);
        return response()->json($estate, 200);
    }






    public function update_cm_firebase_token(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cm_firebase_token' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        DB::table('users')->where('id',$request->user()->id)->update([
            'cm_firebase_token'=>$request['cm_firebase_token']
        ]);
        DB::table('agents')->where('user_id',$request->user()->id)->update([
            'firebase_token'=>$request['cm_firebase_token']
        ]);

        return response()->json(['message' => 'updated_successfully'], 200);
    }




    public function delete(Request $request)
    {
        if(!$request->id)
        {
            return response()->json([
                'errors'=>[
                    ['code'=>'unauthorized', 'message'=>'messages.permission_denied']
                ]
            ],403);
        }
        $estate = Estate::findOrFail($request->id);

        if (Storage::disk('public')->exists('estate/' . $estate['image'])) {
            Storage::disk('public')->delete('estate/' . $estate['image']);
        }

        foreach (json_decode($estate['images'], true) as $img) {
            if (Storage::disk('public')->exists('estate/' . $img)) {
                Storage::disk('public')->delete('estate/' . $img);
            }
        }
       // $estate->translations()->delete();
        $estate->delete();

        return response()->json(['message'=>'messages.product_deleted_successfully'], 200);
    }



//       public function sendRequest(Request $request)
//     {

//     $client = new Client();
//     $url = 'https://nafath.api.elm.sa/api/v1/mfa/request?local=ar&requestId=123';

//     try {
//         $response = $client->post($url, [
//             'json' => [
//                 'nationalId' => $request->id_number,
//                 'service' => 'DigitalServiceEnrollmentWithoutBio',
//             ],
//             'headers' => [
//                 'Content-Type' => 'application/json',
//                 'APP-ID' => '51e20fc4',
//                 'APP-KEY' => 'dfbc7d1d30ea80d04671d5478629b4f9',
//             ],
//             'timeout' => 60, // Increase the timeout to 60 seconds
//         ]);

//         $responseBody = json_decode($response->getBody(), true);

//         // Save the response to the database


// $user = User::find($request->user()->id);


// return $user->id;

// // لو unified_number فاضي فقط ساعتها نفذ التحديث أو الإنشاء
// if (empty($user->unified_number)) {
    
    
    

//         Agent::where(['user_id' => $request->user()->id])->update([
//             'identity' =>$request->id_number,
//         ]);





//             $agent = Agent::where('user_id',  $request->user()->id)->first();
            
            
              
//          if (!$agent) {
//             Agent::create([
//                 'user_id' => $request->user()->id,
//                 'name' =>'Default User',
//                 'phone' =>   $request->user()->id,
//                 'agent_type' => 'فرد',
//                 'membership_type' => 'customer',
//                 'identity'=> $request->id_number,
//             ]);
//         }

// }

//         return response()->json($responseBody);

//     } catch (\GuzzleHttp\Exception\ClientException $e) {
//         // Capture the response from the exception
//         $response = $e->getResponse();
//         $responseBody = json_decode($response->getBody()->getContents(), true);

//         // Log the error message for debugging


//         return response()->json(['error' => 'Request failed', 'message' => $responseBody], $response->getStatusCode());
//     } catch (\Exception $e) {
//         return response()->json(['error' => 'Request failed', 'message' => $e->getMessage()], 500);
//     }
// }





public function sendRequest(Request $request)
{
    $user = $request->user();
    $client = new Client();
    $url = 'https://nafath.api.elm.sa/api/v1/mfa/request?local=ar&requestId=123';

    try {
        // إرسال الطلب للـ API
        $response = $client->post($url, [
            'json' => [
                'nationalId' => $request->id_number,
                'service' => 'DigitalServiceEnrollmentWithoutBio',
            ],
            'headers' => [
                'Content-Type' => 'application/json',
                'APP-ID' => '51e20fc4',
                'APP-KEY' => 'dfbc7d1d30ea80d04671d5478629b4f9',
            ],
            'timeout' => 60,
        ]);

        $responseBody = json_decode($response->getBody(), true);

        // التحقق من وجود Active Transaction
        if (isset($responseBody['message']['message']) && strpos($responseBody['message']['message'], 'Active Trx') !== false) {
            return response()->json([
                'error' => true,
                'message' => 'Cannot send request: There is an active transaction.',
                'reference' => $responseBody['message']['reference'] ?? null
            ], 400);
        }

        // تحديث أو إنشاء Agent
        $agent = Agent::firstOrNew(['user_id' => $user->id]);
        $agent->identity = $request->id_number;
        if (!$agent->exists) {
            $agent->name = 'Default User';
            $agent->phone = $user->id;
            $agent->agent_type = 'فرد';
            $agent->membership_type = 'customer';
        }
        $agent->save();

        return response()->json($responseBody);

    } catch (\GuzzleHttp\Exception\ClientException $e) {
        $response = $e->getResponse();
        $responseBody = json_decode($response->getBody()->getContents(), true);

        return response()->json([
            'error' => 'Request failed',
            'message' => $responseBody
        ], $response->getStatusCode());

    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Request failed',
            'message' => $e->getMessage()
        ], 500);
    }
}



public function sendRequestWeb(Request $request)
{
    $client = new Client();
     $url = 'https://nafath.api.elm.sa/api/v1/mfa/request?local=ar&requestId=123';

  //  $url = 'https://nafath.api.elm.sa/stg/api/v1/mfa/request?local=en&requestId=52e16851-f781-47f0-9242-4ef6916efbfa';

    try {
        $response = $client->post($url, [
            'json' => [
                'nationalId' => $request->input('id_number'),
                'service' => 'DigitalServiceEnrollmentWithoutBio',
            ],
            'headers' => [
                'Content-Type' => 'application/json',
                'APP-ID' => '51e20fc4',
                'APP-KEY' => 'dfbc7d1d30ea80d04671d5478629b4f9',
            ],
            'timeout' => 60, // Increase the timeout to 60 seconds
        ]);

        $responseBody = json_decode($response->getBody(), true);

        // Save the response to the database
        Agent::where('user_id', $request->user_id)->update([
            'identity' => $request->input('id_number'),
        ]);



            $agent = Agent::where('user_id', $request->input('user_id'))->first();
              
         if (!$agent) {
            Agent::create([
                'user_id' => $request->input('user_id'),
                'name' =>'Default User',
                'phone' =>   $request->input('user_id'),
                'agent_type' => 'فرد',
                'membership_type' => 'customer',
                'identity'=>  $request->input('id_number'),
            ]);
        }

        return response()->json($responseBody);

    } catch (\GuzzleHttp\Exception\ClientException $e) {
        // Capture the response from the exception
        $response = $e->getResponse();
        $responseBody = json_decode($response->getBody()->getContents(), true);

        // Log the error message for debugging
        Log::error('ClientException', ['response' => $responseBody]);

        return response()->json([
            'error' => 'Request failed',
            'message' => $responseBody
        ], $response->getStatusCode());

    } catch (\Exception $e) {
        // Log the error message for debugging
        Log::error('Exception', ['message' => $e->getMessage()]);

        return response()->json([
            'error' => 'Request failed',
            'message' => $e->getMessage()
        ], 500);
    }
}


// public function checkRequestStatus(Request $request)
//     {
//         $client = new Client();
//         $url = 'https://nafath.api.elm.sa/stg/api/v1/mfa/request/status';

//         try {
//             $response = $client->post($url, [
//                 'json' => [
//                     'nationalId' => $request->nationalId,
//                     'transId' => $request->transId,
//                     'random' => $request->random,
//                 ],
//                 'headers' => [
//                     'Content-Type' => 'application/json',
//                     'APP-ID' => 'd36a9896',  // Replace with your actual APP-ID
//                     'APP-KEY' => 'f24d805e43255f22f93b933f2ad18087',  // Replace with your actual APP-KEY
//                 ],
//                 'timeout' => 60, // Optional: Increase the timeout if needed
//             ]);

//             $responseBody = json_decode($response->getBody(), true);

//             // Save the response to the database
//             // $apiResponse = new ApiResponse();
//             // $apiResponse->status = $responseBody['status'];
//             // $apiResponse->message = $responseBody['message'] ?? '';
//             // $apiResponse->code = $responseBody['code'] ?? '';
//             // $apiResponse->reference = $responseBody['reference'] ?? '';
//             // $apiResponse->save();

//             return response()->json($responseBody);

//         } catch (\GuzzleHttp\Exception\ClientException $e) {
//             // Capture the response from the exception
//             $response = $e->getResponse();
//             $responseBody = json_decode($response->getBody()->getContents(), true);

//             // Log the error message for debugging
//             \Log::error('Client error: ', $responseBody);

//             return response()->json(['error' => 'Request failed', 'message' => $responseBody], $response->getStatusCode());
//         } catch (\Exception $e) {
//             return response()->json(['error' => 'Request failed', 'message' => $e->getMessage()], 500);
//         }
//     }



public function checkRequestStatus(Request $request)
{
    $client = new Client();
    $url = 'https://nafath.api.elm.sa/api/v1/mfa/request/status';

    try {
        $response = $client->post($url, [
            'json' => [
                'nationalId' => $request->nationalId,
                'transId' => $request->transId,
                'random' => $request->random,
            ],
            'headers' => [
                'Content-Type' => 'application/json',
                'APP-ID' => '51e20fc4',  // Replace with your actual APP-ID
                'APP-KEY' => 'dfbc7d1d30ea80d04671d5478629b4f9',  // Replace with your actual APP-KEY
            ],
            'timeout' => 60, // Optional: Increase the timeout if needed
        ]);

        $responseBody = json_decode($response->getBody(), true);

        // Check if the status is "COMPLETED"
        if (isset($responseBody['status']) && $responseBody['status'] === 'COMPLETED') {



            
            // Find the user by national ID and update their status
            // $user = User::where('national_id', $request->nationalId)->first();

            // if ($user) {
            //     $user->status = 'COMPLETED';
            //     $user->save();

            //     // Return success response
            //     return response()->json([
            //         'message' => 'User status updated successfully',
            //         'user' => $user
            //     ], 200);
            // } else {
            //     return response()->json(['message' => 'User not found'], 404);
            // }

            User::where(['id' => $request->user()->id])->update([
                'account_verification' =>1
            ]);
            return response()->json([  'message' => $responseBody['status']], 200);
        } else {
            return response()->json(['message' => 'Status is not COMPLETED', 'response' => $responseBody], 400);
        }

    } catch (\GuzzleHttp\Exception\ClientException $e) {
        // Capture the response from the exception
        $response = $e->getResponse();
        $responseBody = json_decode($response->getBody()->getContents(), true);

        // Log the error message for debugging
        Log::error('Client error: ', $responseBody);

        return response()->json(['error' => 'Request failed', 'message' => $responseBody], $response->getStatusCode());
    } catch (\Exception $e) {
        return response()->json(['error' => 'Request failed', 'message' => $e->getMessage()], 500);
    }
}




public function checkRequestStatusWeb(Request $request)
{
    $client = new Client();
    $url = 'https://nafath.api.elm.sa/api/v1/mfa/request/status';

    try {
        $response = $client->post($url, [
            'json' => [
                'nationalId' => $request->nationalId,
                'transId' => $request->transId,
                'random' => $request->random,
            ],
            'headers' => [
                'Content-Type' => 'application/json',
                'APP-ID' => '51e20fc4',  // Replace with your actual APP-ID
                'APP-KEY' => 'dfbc7d1d30ea80d04671d5478629b4f9',  // Replace with your actual APP-KEY
            ],
            'timeout' => 60, // Optional: Increase the timeout if needed
        ]);

        $responseBody = json_decode($response->getBody(), true);

        // Check if the status is "COMPLETED"
        if (isset($responseBody['status']) && $responseBody['status'] === 'COMPLETED') {


            User::where(['id' =>  $request->input('user_id')])->update([
                'account_verification' =>1
            ]);
            return response()->json([  'message' => $responseBody['status']], 200);
        } else {
            return response()->json(['message' => 'Status is not COMPLETED', 'response' => $responseBody], 400);
        }

    } catch (\GuzzleHttp\Exception\ClientException $e) {
        // Capture the response from the exception
        $response = $e->getResponse();
        $responseBody = json_decode($response->getBody()->getContents(), true);

        // Log the error message for debugging
        Log::error('Client error: ', $responseBody);

        return response()->json(['error' => 'Request failed', 'message' => $responseBody], $response->getStatusCode());
    } catch (\Exception $e) {
        return response()->json(['error' => 'Request failed', 'message' => $e->getMessage()], 500);
    }
}



public function callbackHandler(Request $request)
{
    $token = $request->input('token');

    // احضر المفاتيح العامة من JWK
    $jwkResponse = Http::get('https://nafath.api.elm.sa/stg/api/v1/mfa/jwk');
    $jwks = $jwkResponse->json()['keys'];

    // استخراج kid من الـ JWT header
    $kid = JWT::getHeader($token)['kid'];
    $jwk = collect($jwks)->firstWhere('kid', $kid);

    if (!$jwk) {
        return response()->json(['error' => 'Public key not found'], 400);
    }

    try {
        $publicKey = $this->convertJwkToPem($jwk);
        $decoded = JWT::decode($token, new Key($publicKey, 'RS256'));

        return response()->json([
            'status' => 'success',
            'decoded' => (array) $decoded
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Token decode failed',
            'message' => $e->getMessage()
        ], 400);
    }
}

private function convertJwkToPem(array $jwk): string
{
    $n = $this->base64UrlDecode($jwk['n']);
    $e = $this->base64UrlDecode($jwk['e']);

    $rsa = PublicKeyLoader::load([
        'kty' => 'RSA',
        'n' => $n,
        'e' => $e,
    ]);

    return $rsa->toString('PKCS8');
}

private function base64UrlDecode($data)
{
    return base64_decode(strtr($data, '-_', '+/'));
}
}
