<?php

namespace App\Http\Controllers\cms\slider;

use App\Http\Controllers\Controller;
use App\Http\Helper\MediaHelper;
use App\Models\cms\image;
use App\Models\cms\page;
use App\Models\meta_page;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarouselController extends Controller
{
    public $page;

    public function __construct()
    {
        $this->page = page::query()->where('title', 'carousel')->first();
    }

    public function index(): View
    {
        return view('cms.slider.carousel', [
            'carousels' => $this->page->load('images'),
            'page' => $this->page
        ]);
    }

    public function create(): View
    {
        return view('cms.slider.create_carousel');
    }

    public function store(Request $request, MediaHelper $helper): RedirectResponse
    {
        $request->validate(['image.*' => 'required', 'title' => 'present']);
        DB::transaction(function () use ($request, $helper) {
            $imageName = $helper->uploadMultipleImage($request->image);

            foreach ($imageName as $image) {
                image::create([
                    'imageable_id' => $this->page->id,
                    'imageable_type' => page::NAMESPACE,
                    'name' => $image
                ]);
            }

            if ($request->content != '') {
                if (!$this->page->has('metaPage')) {
                    meta_page::create($request->except('image') + ['page_id' => $this->page->id]);
                }
            }
        });

        toast('Carousel created successfully', 'success');
        return redirect()->route('carousel.index');
    }

    public function edit(page $carousel): View
    {
        return view('cms.slider.edit_carousel', [
            'page' => $carousel,
            'images' => $carousel->load('images')->images,
            'metaData' => json_encode($carousel->load('metaPage')->metaPage[0]->content, true)
        ]);
    }

    public function update(Request $request, page $carousel, MediaHelper $helper): RedirectResponse
    {
        DB::transaction(function () use ($request, $carousel, $helper) {

            if ($request->hasFile('image')) {
                $imageName = $helper->uploadMultipleImage($request->image);
            } else {
                $imageName = $request->old_carousel_image;
            }

            image::query()
                ->where('imageable_id', $this->page->id)
                ->where('imageable_type', page::NAMESPACE)
                ->delete();

            foreach ($imageName as $image) {
                image::create(
                    [
                        'imageable_id' => $this->page->id,
                        'imageable_type' => page::NAMESPACE,
                        'name' => $image
                    ]
                );
            }
        });

        toast('Carousel updated successfully', 'success');
        return redirect()->route('carousel.index');
    }
}
