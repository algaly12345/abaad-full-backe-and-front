<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\NotificationApp;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    function index()
    {
        $notifications = NotificationApp::latest()->paginate(40);
        return view('dashboard.notifications.index', compact('notifications'));
    }

    function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'notification_title' => 'required|max:191',
            'description' => 'required|max:1000',
            'tergat' => 'required',
            'zone'=>'required'
        ], [
            'notification_title.required' => 'Title is required!',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }


        $notification = new NotificationApp();
        $notification->title = $request->notification_title;
        $notification->description = $request->description;
        $notification->tergat= $request->tergat;
        $notification->status = 1;
        $notification->zone_id = $request->zone=='all'?null:$request->zone;
        $notification->save();

        $topic_all_zone=[
            'customer'=>'all_zone_customer',
            'agent'=>'all_zone_agent',
        ];

        $topic_zone_wise=[
            'customer'=>'zone_'.$request->zone.'_customer',
            'agent'=>'zone_'.$request->zone.'_agent',

        ];
        $topic = $request->zone == 'all'?$topic_all_zone[$request->tergat]:$topic_zone_wise[$request->tergat];



        try {
         Helpers::send_push_notif_to_topic($notification, $topic, 'general');

            Toastr::success("تمت ارسال الأشعار");
            return back();
        } catch (\Exception $e) {
            return $e;
          Toastr::warning('push_notification_faild');
        }

        return response()->json([], 200);
    }


}
