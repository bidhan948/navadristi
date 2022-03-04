<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\cms\{
    ContactUsController,
    DoctorController,
    GalleryController,
    NewsAndEventsController,
    PageController,
    SpecialityController,
    slider\CarouselController,
    slider\EquipmentController,
    slider\TestimonialController
};
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Auth::routes();
Route::get('/', [HomeController::class, 'index']);
Route::get('/{slug}', [HomeController::class, 'getFromSlug'])->name('slug');
Route::get('specialities/{slug}', [HomeController::class, 'getFromSpecialitiesSlug'])->name('speciality.slug');
Route::get('gallery/{slug}', [HomeController::class, 'getFromGallerySlug'])->name('gallery.slug');
Route::get('news-and-events/{slug}', [HomeController::class, 'getFromNewsAndEventsSlug'])->name('news_and_events.slug');
Route::post('contact-us', [ContactUsController::class, 'store'])->name('contact_us');
Route::get('a/v',function(){
    Artisan::call('storage:link');
});


Route::group(['middleware' => 'auth'], function () {
    Route::prefix('admin')->group(function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('home');
        Route::get('/admin/{slug}', [PageController::class, 'getFromSlug'])->name('admin');
        Route::post('/admin', [PageController::class, 'storeContent'])->name('content.store');
        Route::put('/admin/{slug}', [PageController::class, 'updateContent'])->name('content.update');
        Route::get('page-feature', [PageController::class, 'showPageFeature'])->name('page_feature.index');
        Route::get('page-feature/create', [PageController::class, 'createPageFeature'])->name('page_feature.create');
        Route::get('about-us', [PageController::class, 'createAboutUs'])->name('about-us.admin');
        Route::get('footer', [PageController::class, 'createFooter'])->name('footer');
        Route::get('side-banner', [PageController::class, 'createSideBannerImage'])->name('side_banner');
        Route::post('side-banner', [PageController::class, 'storeSideBannerImage'])->name('side_banner.store');
        Route::post('footer', [PageController::class, 'storeFooter'])->name('footer.store');
        Route::put('footer/{footer}', [PageController::class, 'updateFooter'])->name('footer.update');
        Route::post('about-us', [PageController::class, 'storeAboutUs'])->name('about-us.store');
        Route::put('about-us/{aboutUs}', [PageController::class, 'updateAboutUs'])->name('about-us.update');
        Route::post('page-feature', [PageController::class, 'storePageFeature'])->name('page_feature.store');
        Route::post('image-store', [PageController::class, 'imageStore'])->name('image.store');
        Route::post('department', [DoctorController::class, 'storeDepartment'])->name('department.store');
        Route::resource('doctor', DoctorController::class)->except('show', 'destroy');
        Route::post('gallery-up/{gallery}', [GalleryController::class, 'changeTitle'])->name('gallery.add');
        Route::resource('speciality', SpecialityController::class);
        Route::resource('carousel', CarouselController::class);
        Route::resource('page', PageController::class);
        Route::resource('equipment', EquipmentController::class)->except('show', 'destroy');
        Route::resource('testimonial', TestimonialController::class)->except('show', 'destroy');
        Route::resource('gallery', GalleryController::class);
        Route::resource('news-events', NewsAndEventsController::class);
        Route::resource('user', UserController::class)
            ->except('show', 'edit', 'delete')
            ->middleware('isAdmin');
    });
});
