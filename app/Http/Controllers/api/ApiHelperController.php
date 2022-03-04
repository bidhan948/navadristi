<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\cms\image;
use App\Models\cms\page;
use Illuminate\Support\Facades\File;
use App\Models\cms\page_type;
use Illuminate\Http\Request;

class ApiHelperController extends Controller
{
    public function getThumbnailImage()
    {
        return response()->json(image::query()->get());
    }

    public function getAllPageType()
    {
        return response()->json(page::query()->Parent()->get());
    }

    public function getGalleryImage()
    {
        return response()->json(image::query()
            ->where('imageable_id', request('galleryId'))
            ->where('imageable_type', page::NAMESPACE)
            ->get());
    }

    public function removeGalleryImage()
    {
        image::query()->where('id', request('imageId'))->delete();
        return response()->json(['status' => true]);
    }
    
    public function downUp(){
        $doctor = page::query()->where('id',request('doctorId'))->first();
         $doctorMore = page::query()->where('position',$doctor->position - 1)->first();
        $doctorMore->update([
            'position'=> $doctorMore->position +1
            ]);
        $doctor->update([
            'position' => ( $doctor->position - 1 < 0 ? 0 :  $doctor->position )
        ]);
        return response()->json(['status' => true]);
    }
    
    public function up(){
        $doctor = page::query()->where('id',request('doctorId'))->first();
        $doctorLess = page::query()->where('position',$doctor->position + 1)->first();
        $doctorLess->update([
            'position'=> $doctorLess->position -1
            ]);
        $doctor->update([
            'position' =>  $doctor->position + 1
        ]);
        return response()->json(['status' => true]);
    }
}
