<?php

namespace App\Http\Helper;

use Illuminate\Support\Str;
use Image;

class MediaHelper
{
    public function uploadSingleImage($image, $folder = "upload")
    {
        $orginalName = Str::before($image->getClientOriginalName(), '.');

        $imageName =  $orginalName . "-" . Str::random(10) . "." . $image->extension();
        $filePath = storage_path().'/app/public/upload/';
        
        // $source = storage_path().'/app/public/upload/'.$imageName;
        //     $target = public_path('\thumbnails' . $imageName);
            
        //     dd($source, $target);
            
        //     Image::make($source)->fit(340, 340)->save($target);
            $img = Image::make($image->path());
            $img->resize(110, 110, function ($const) {
                $const->aspectRatio();
            })->save($filePath . '/' . $imageName);
            
        $image->storeAs($folder, $imageName, 'public');
        $image->storeAs('thumbnails', $imageName, 'public');
        return $imageName;
    }

    public function uploadMultipleImage($image, $folder = "upload")
    {
        foreach ($image as $key => $value) {

            $orginalName = Str::before($value->getClientOriginalName(), '.');
            $imageName =  $orginalName . "-" . Str::random(10) . "." . $value->extension();
            $filePath = storage_path().'/app/public/upload/';

            // $img = Image::make($value->path());
            // $img->resize(110, 110, function ($const) {
            //     $const->aspectRatio();
            // })->save($filePath . '/' . $imageName);

            $value->storeAs($folder, $imageName, 'public');
            $value->storeAs('thumbnails', $imageName, 'public');
            $photo[] = $imageName;
        }
        return $photo;
    }
}
