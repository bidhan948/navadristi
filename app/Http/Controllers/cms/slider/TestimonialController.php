<?php

namespace App\Http\Controllers\cms\slider;

use App\Http\Controllers\Controller;
use App\Http\Helper\MediaHelper;
use App\Models\cms\image;
use App\Models\cms\page;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestimonialController extends Controller
{
    public $page;

    public function __construct()
    {
        $this->page = page::query()->where('title', 'testimonial')->first();
    }

    public function index(): View
    {
        return view('cms.slider.testimonial', [
            'testimonials' => $this->page->load('Parents')->Parents
        ]);
    }

    public function create(): View
    {
        return view('cms.slider.create_testimonial');
    }

    public function store(Request $request, MediaHelper $helper): RedirectResponse
    {
        $validateData = $request->validate(['title' => 'required', 'image' => 'required', 'content' => 'required']);

        DB::transaction(function () use ($request, $helper, $validateData) {
            $page = page::create($validateData + ['page_id' => $this->page->id]);
            $imageName = $helper->uploadSingleImage($request->image);

            image::create([
                'imageable_id' => $page->id,
                'imageable_type' => page::NAMESPACE,
                'name' => $imageName
            ]);
        });

        toast('Testimonial created succesfully', "success");
        return redirect()->route('testimonial.index');
    }

    public function edit(page $testimonial): View
    {
        return view(
            'cms.slider.edit_testomonial',
            [
                'testomonial' => $testimonial->load('images')
            ]
        );
    }

    public function update(Request $request, page $testimonial, MediaHelper $helper): RedirectResponse
    {
        $validateData = $request->validate(['title' => 'required', 'content' => 'required']);

        DB::transaction(function () use ($validateData, $helper, $testimonial, $request) {

            if ($request->hasFile('image')) {
                $imageName = $helper->uploadSingleImage($request->image);
            } else {
                $imageName = $request->old_testimonial_image;
            }
            $testimonial->update($validateData);

            image::query()
                ->where('imageable_id', $testimonial->id)
                ->where('imageable_type', page::NAMESPACE)
                ->update([
                    'name' => $imageName
                ]);
        });

        toast('Testimonial updated successfully', 'success');
        return redirect()->route('testimonial.index');
    }
}
