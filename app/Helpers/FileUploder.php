<?php


namespace App\Helpers;

class FileUploder
{
    public static function uploadOneImage($request, $folder)
    {
        $imageUrl = $request->image->store($folder, 'public');

        return $imageUrl;
    }


    public static function uploadMultipleImages($model, $request, $folder)
    {
        collect($request->images)->each(function ($image) use ($model, $folder) {
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $model->images()->create([
                'url' =>  $image->storeAs($folder, $image_name, 'public')
            ]);
        });
    }
}
