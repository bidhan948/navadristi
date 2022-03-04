<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use App\Http\Helper\MediaHelper;
use App\Models\cms\image;
use App\Models\cms\page;
use App\Models\cms\page_type;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class GalleryController extends Controller
{
    public $gallery;

    public function __construct()
    {
        $this->gallery = page_type::query()->where('slug', 'gallery')->first();
    }

    public function index(): View
    {
        return view('cms.gallery.gallery', [
            'galleries' => page::query()
                ->where('page_type_id', $this->gallery->id)
                ->get()
        ]);
    }

    public function create(): View
    {
        return view('cms.gallery.add_gallery');
    }

    public function store(Request $request, MediaHelper $helper): RedirectResponse
    {
        $validateData = $request->validate(['title' => 'required', 'image.*' => 'required']);

        if (
            page::query()
            ->where('title', $request->title)
            ->where('page_type_id', $this->gallery->id)
            ->count() > 0
        ) {
            Alert::error('Album already exist');
            return redirect()->back();
        }

        DB::transaction(function () use ($request, $helper, $validateData) {
            $page = page::create([
                'title' => $validateData['title'],
                'page_type_id' => $this->gallery->id,
            ]);

            $imageName = $helper->uploadMultipleImage($request->image);

            foreach ($imageName as $image) {
                image::create(
                    [
                        'imageable_id' => $page->id,
                        'imageable_type' => page::NAMESPACE,
                        'name' => $image
                    ]
                );
            }
        });

        toast('Gallery created successfully', 'success');
        return redirect()->route('gallery.index');
    }

    public function show(page $gallery): View
    {
        return view('cms.gallery.show_gallery', [
            'gallery' => $gallery,
            'images' => $gallery->load('images')
        ]);
    }

    public function edit(page $gallery)
    {
        return view('cms.gallery.edit_gallery', [
            'gallery' => $gallery,
            'images' => $gallery->load('images')
        ]);
    }
    public function update(Request $request, page $gallery, MediaHelper $helper): RedirectResponse
    {
        $request->validate(['image.*' => 'required']);
        DB::transaction(function () use ($request, $gallery, $helper) {
            // if ($request->hasFile($request->image[0])) {
            $imageName = $helper->uploadMultipleImage($request->image);

            foreach ($imageName as $image) {
                image::create([
                    'imageable_id' => $gallery->id,
                    'imageable_type' => page::NAMESPACE,
                    'name' => $image
                ]);
            }
            // }

            if ($request->has('title')) {
                $gallery->update(['title' => $request->title]);
            }
        });

        toast('Photos added to ' . $gallery->title . ' album successfully', 'success');
        return redirect()->route('gallery.index');
    }

    public function changeTitle(page $gallery, Request $request)
    {
        $request->validate(['title' => 'required']);
        DB::transaction(function () use ($request, $gallery) {
            if ($request->has('title')) {
                $gallery->update(['title' => $request->title]);
            }
        });

        toast('Gallery album name changed successfully', 'success');
        return redirect()->route('gallery.index');
    }
}
