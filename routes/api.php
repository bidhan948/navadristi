<?php

use App\Http\Controllers\api\ApiHelperController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('get-thumbnail-image', [ApiHelperController::class, 'getThumbnailImage'])->name('api.getAllThumbnail');
Route::get('get-page-type', [ApiHelperController::class, 'getAllPageType'])->name('api.getAllPageType');
Route::get('get-gallery-image', [ApiHelperController::class, 'getGalleryImage'])->name('api.getGallery');
Route::get('remove-gallery-image', [ApiHelperController::class, 'removeGalleryImage'])->name('api.removeImage');
Route::get('down-up', [ApiHelperController::class, 'downUp'])->name('api.downUp');
Route::get('up', [ApiHelperController::class, 'up'])->name('api.up');
