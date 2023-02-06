<?php

/**
 *
 */

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;


trait UploadFiles
{
    // store new file
    public static function storeFile($imgProps)
    {
        $file = $imgProps['file'];

        $originalName = $file->getClientOriginalName();
        $file_name = $file->hashName();

        // resize the image to a width of $width and constrain aspect ratio (auto $height)
        $img = Image::make($file);

        $width = $imgProps['width'] ?? null;
        $height = $imgProps['height'] ?? null;
        $quality = $imgProps['quality'] ?? 100;

        if ($width != null) {
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
        }

        $path = $imgProps['storagePath'] . '/' . $file_name;
        $img->save(public_path($path), $quality, "webp");

        $fileInformation = [
            'original_name' => $originalName,
            'file_name' => $file_name,
            'file_extension' => $file->extension(),
            'file_size' => $file->getSize(),
            'file_path' => $path,
        ];

        return $fileInformation;
    }

    // update existing file
    public static function updateFile($imgProps)
    {
        UploadFiles::removeFile($imgProps);
        $fileInformation = UploadFiles::storeFile($imgProps);

        return $fileInformation;
    }

    // remove existing file
    public static function removeFile($imgProps)
    {
        $oldFilePath = $imgProps['old_image'];
        $default = $imgProps['default'];

        if (File::exists(public_path($oldFilePath)) and !strpos($default, "default.png")) {
            @unlink(public_path($oldFilePath));
        }
    }

    // store new file base64
    public static function storeFileBase64($file, $storagePath, $customName = "")
    {
        $image_parts = explode(";base64,", $file);
        $image_type = explode("image/", $image_parts[0])[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file_name = $customName != "" ? $customName : uniqid();
        $file_name = $file_name . '.' . $image_type;
        $path = $storagePath . $file_name;

        file_put_contents(public_path($path), $image_base64);

        $fileInformation = [
            'file_name' => $file_name,
            'path' => $path,
            'file_extension' => $image_type,
        ];

        return $fileInformation;
    }

    // update existing file base64
    public static function updateFileBase64($file, $storagePath, $oldFilePath, $customName = "")
    {
        UploadFiles::removeFile($oldFilePath);

        return UploadFiles::storeFileBase64($file, $storagePath, $customName);
    }

    // convert image to base 64
    public static function fileTo64bit($file)
    {
        $file_type = $file->extension();
        $base64 = "data:image/" . $file_type . ";base64," . base64_encode(file_get_contents($file));

        return $base64;
    }
}
