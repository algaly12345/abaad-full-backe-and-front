<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\NotificationApp;
use App\Models\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class NotificationController extends Controller
{
    public function get_notifications(Request $request){


        $zone_id= $request->zone_id;
        try {


            $notifications = NotificationApp::active()->where('tergat', 'customer')->where(function($q)use($zone_id){
                $q->whereNull('zone_id')->orWhere('zone_id', $zone_id);
            })->where('created_at', '>=', \Carbon\Carbon::today()->subDays(15))->orWhere('updated_at', '>=', \Carbon\Carbon::today()->subDays(15))->get();

         //   $notifications->append('data');

            $user_notifications = UserNotification::where('user_id', $request->user()->id)->get();
//            $notificationss =  $notifications->merge($user_notifications);
            return response()->json($notifications, 200);





        } catch (\Exception $e) {
            info(['Notification api issue_____',$e->getMessage()]);
            return response()->json([], 200);
        }
    }
}
