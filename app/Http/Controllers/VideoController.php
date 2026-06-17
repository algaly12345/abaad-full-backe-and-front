<?php

namespace App\Http\Controllers;

use App\Models\Estate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function  create(Request $request){
        session()->put('estate_id', $request->estate_id);
        return view("video");
    }
  


    public function uploadVideo(Request $request)
    {
        $this->validate($request, [
            'video' => 'required|file|mimetypes:video/mp4',
        ]);
        $estate = Estate::find($request->estate_id);

        $fileName = $request->video->getClientOriginalName();
        $filePath = 'videos/' . $fileName;

        $isFileUploaded = Storage::disk('public')->put($filePath, file_get_contents($request->video));

        // File URL to access the video in frontend
        $url = Storage::disk('public')->url($filePath);

        if ($isFileUploaded) {
            $estate->service_offers=$filePath;
            $estate->save();

            return back()
                ->with('success', 'Video has been successfully uploaded.');
        }

        return back()
            ->with('error', 'Unexpected error occured');

    }





}
