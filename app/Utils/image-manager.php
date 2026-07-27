<?php

namespace App\Utils;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;


class ImageManager
{

    public static function upload(string $dir, string $format, $image, $file_type = 'image')
    {
        $storage = config('filesystems.disks.default') ?? 'public';

        if ($image != null) {
            if (!Storage::disk($storage)->exists($dir)) {
                Storage::disk($storage)->makeDirectory($dir);
            }

            $originalExtension = $image->getClientOriginalExtension();
            $imageName = Carbon::now()->toDateString() . "-" . uniqid() . "." . $originalExtension;

            // حفظ الصورة الأصلية
            Storage::disk($storage)->put($dir . $imageName, file_get_contents($image));

            // إذا لم تكن الصورة في التنسيق المطلوب، قم بتحويلها
            if (!in_array($originalExtension, ['gif', 'svg']) && $originalExtension !== $format) {
                $convertedImageName = Carbon::now()->toDateString() . "-" . uniqid() . "." . $format;

                // تحويل الصورة إلى التنسيق المطلوب باستخدام GD (في الذاكرة، بدون الاعتماد على مسار محلي)
                $sourceImage = imagecreatefromstring(file_get_contents($image));
                ob_start();
                if ($format == 'webp') {
                    imagewebp($sourceImage, null, 90);
                } elseif ($format == 'jpeg' || $format == 'jpg') {
                    imagejpeg($sourceImage, null, 90);
                } elseif ($format == 'png') {
                    imagepng($sourceImage);
                }
                $convertedImageData = ob_get_clean();

                imagedestroy($sourceImage);

                Storage::disk($storage)->put($dir . $convertedImageName, $convertedImageData);

                // حذف الصورة الأصلية إذا لزم الأمر
                Storage::disk($storage)->delete($dir . $imageName);

                return $convertedImageName;
            }

            return $imageName;
        } else {
            return 'def.webp';
        }
    }




    public static function file_upload(string $dir, string $format, $file = null)
    {
        $storage = config('filesystems.disks.default') ?? 'public';
        if ($file != null) {
            $fileName = Carbon::now()->toDateString() . "-" . uniqid() . "." . $format;
            if (!Storage::disk($storage)->exists($dir)) {
                Storage::disk($storage)->makeDirectory($dir);
            }
            Storage::disk($storage)->put($dir . $fileName, file_get_contents($file));
        } else {
            $fileName = 'def.png';
        }

        return $fileName;
    }

   public static function update(string $dir, $old_image, string $format, $image, $file_type = 'image')
{
    if (self::checkFileExists($dir . $old_image)['status']) {
        Storage::disk(self::checkFileExists($dir . $old_image)['disk'])->delete($dir . $old_image);
    }

    $imageName = $file_type == 'file' ? self::file_upload($dir, $format, $image) : self::upload($dir, $format, $image);

    return $imageName;
}


    public static function delete($full_path)
    {
        if (self::checkFileExists(filePath: $full_path)['status']) {
            Storage::disk(self::checkFileExists(filePath: $full_path)['disk'])->delete($full_path);
        }
        return [
            'success' => 1,
            'message' => 'Removed successfully !'
        ];

    }
    public static function checkFileExists(string $filePath): array
    {
        if (Storage::disk('public')->exists($filePath)) {
            return [
                'status' => true,
                'disk' => 'public'
            ];
        } elseif (config('filesystems.disks.default') == 's3' && Storage::disk('s3')->exists($filePath)) {
            return [
                'status' => true,
                'disk' => 's3'
            ];
        } else {
            return [
                'status' => false,
                'disk' => config('filesystems.disks.default') ?? 'public'
            ];
        }
    }

}
