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
use Illuminate\Validation\Rule;

class PageController extends Controller
{
    public function index(): View
    {
        return view('cms.page', [
            'page_types' => page_type::query()->get()
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validateData = $request->validate(['title' => ['required', 'unique:pages']]);
        page_type::create($validateData);
        toast('page added successfully', 'success');
        return redirect()->back();
    }

    public function update(Request $request, page_type $page): RedirectResponse
    {
        $validateData = $request->validate(['title' =>
        [
            'required',
            Rule::unique('page_types')->ignore($page)
        ]]);
        $page->update($validateData);
        toast('Page updated successfully', 'success');
        return redirect()->back();
    }

    public function showPageFeature(): View
    {
        return view('cms.page_feature', [
            'pages' => page::query()
                ->Parent()
                ->with('pageType')
                ->get(),
            'page_types' => page_type::query()->get()
        ]);
    }

    public function createPageFeature(): View
    {
        return view('cms.create_page_feature', [
            'page_types' => page::query()->whereNull('page_id')->get()
        ]);
    }

    public function storePageFeature(Request $request, MediaHelper $helper): RedirectResponse
    {
        $request->validate(['page_type_id' => 'required|exists:page_types,id']);

        $imageName = [];

        if ($request->hasFile('new_name')) {
            $imageName = $helper->uploadMultipleImage($request->file('new_name'));
        }

        DB::transaction(function () use ($request, $imageName) {

            $pageType = page::create($request->only('title', 'content') + ['page_id' => $request->page_type_id]);

            if (count($imageName) > 0) {
                foreach ($imageName as $key => $value) {
                    image::create([
                        'imageable_id' => $pageType->id,
                        'imageable_type' => image::NAMESPACE,
                        'name' => $value
                    ]);
                }
            }
        });

        toast('page feature added successfully', 'success');
        return redirect()->route('page_feature.index');
    }

    public function imageStore(Request $request)
    {
        // I Have already validated from frontend :)
        DB::transaction(function () use ($request) {
            foreach ($request->imageArray as $key => $imageId) {
                $imageName = image::query()->where('id', $imageId)->pluck('name');

                image::create([
                    'imageable_id' => $request->pageTypeId,
                    'imageable_type' => image::NAMESPACE,
                    'name' => $imageName
                ]);
            }
        });
        return response()->json($request->all());
    }

    public function createAboutUs(): View
    {
        $aboutus = page_type::query()->where('slug', 'about-us')->whereHas('Page')->get();
        if ($aboutus->count() == 1) {
            return view('cms.page.edit_about_us', [
                'aboutUs' => $aboutus[0]->Page[0],
                'content' => json_decode($aboutus[0]->Page[0]->content, TRUE)
            ]);
        } else {
            return view('cms.page.create_about_us');
        }
    }

    public function storeAboutUs(Request $request, MediaHelper $helper): RedirectResponse
    {
        $request->validate(['title' => 'required']);

        DB::transaction(function () use ($request, $helper) {

            $page_type_id = page_type::query()
                ->where('slug', 'about-us')
                ->first();

            $excutiveImage = $helper->uploadSingleImage($request->excutive_image);
            $excutiveDirectorImage = $helper->uploadSingleImage($request->excutive_director_image);

            page::create([
                'page_type_id' => $page_type_id->id,
                'title' => $request->title,
                'content' => json_encode($request->except('excutive_image', 'excutive_director_image')
                    + [
                        'excutive_image' => $excutiveImage,
                        'excutive_director_image' => $excutiveDirectorImage
                    ])
            ]);
        });

        toast('About us created successfully', 'success');
        return redirect()->route('page.index');
    }

    public function updateAboutUs(Request $request, page $aboutUs, MediaHelper $helper): RedirectResponse
    {
        DB::transaction(function () use ($request, $aboutUs, $helper) {

            if ($request->hasFile('excutive_image')) {
                $excutiveImage = $helper->uploadSingleImage($request->excutive_image);
            } else {
                $excutiveImage = $request->old_excutive_image;
            }

            if ($request->hasFile('excutive_director_image')) {
                $excutiveDirectorImage = $helper->uploadSingleImage($request->excutive_director_image);
            } else {
                $excutiveDirectorImage = $request->old_excutive_director_image;
            }

            $aboutUs->update([
                'title' => $request->title,
                'content' => json_encode($request->except('excutive_image', 'excutive_director_image')
                    + [
                        'excutive_image' => $excutiveImage,
                        'excutive_director_image' => $excutiveDirectorImage
                    ])
            ]);
        });

        toast('About us updated successfully', 'success');
        return redirect()->route('page.index');
    }

    public function createFooter()
    {
        $pageType =  page_type::query()
            ->where('slug', 'footer')
            ->whereHas('Page')
            ->first();

        if ($pageType->count() > 0) {
            $page = page::query()
                ->where('page_type_id', $pageType->id)
                ->first();

            return view('cms.page.edit_footer', [
                'footer' => json_decode($page->content, true),
                'page' => $page
            ]);
        } else {
            return view('cms.page.create_footer');
        }
    }

    public function storeFooter(Request $request): RedirectResponse
    {
        $validateData = $request->validate(['health_package' => 'required', 'ambulance_contact' => 'required']);
        $pageTypeId = page_type::query()->where('slug', 'footer')->first()->content;
        page::create([
            'page_type_id' => $pageTypeId->id,
            'title' => 'footer',
            'content' => json_encode($validateData)
        ]);
        toast('Footer created successfully', 'success');
        return redirect()->route('page.index');
    }

    public function updateFooter(Request $request, page $footer): RedirectResponse
    {
        $validateData =  $request->validate(['health_package' => 'required', 'ambulance_contact' => 'required']);
        $footer->update([
            'content' => json_encode($validateData)
        ]);

        toast('Footer updated successfully', 'success');
        return redirect()->route('page.index');
    }

    public function createSideBannerImage(): View
    {
        return view('cms.gallery.side_banner', [
            'image' => page::query()
            ->where('slug', 'side-banner-image')
            ->with('images')
            ->first()->images[0]
        ]);
    }

    public function storeSideBannerImage(Request $request, MediaHelper $helper): RedirectResponse
    {
        $page = page::query()->where('slug', 'side-banner-image')->first();
        $request->validate(['image' => 'required']);
        $imageName = $helper->uploadSingleImage($request->image);
        if ($page->load('images')->images->count() == 0) {
            image::create([
                'imageable_id' => $page->id,
                'imageable_type' => page::NAMESPACE,
                'name' => $imageName
            ]);
        } else {
            image::query()
                ->where('imageable_id', $page->id)
                ->where('imageable_type', page::NAMESPACE)
                ->update(['name' => $imageName]);
        }

        toast('Side banner image added successfully', 'success');
        return redirect()->back();
    }


    public function getFromSlug($slug) : View
    {
        $page = page::query()->where('title',$slug)->first();
        if ($page != null) {
            return view('cms.edit_page',['page'=>$page,'slug'=>$slug]);
        }else{
            return view('cms.add_page',['slug'=>$slug]);
        }
    }

    public function storeContent(Request $request): RedirectResponse
    {
        $request->validate(['content'=>'required']);
        $pageType = page_type::query()->where('slug',$request->slug)->first();
        page::create([
            'title' => $pageType->title,
            'page_type_id' => $pageType->id,
            'content' => $request->content
        ]);

        toast($request->slug ." content has been added successfully",'success');
        return redirect()->route('page.index');
    }

    public function updateContent(Request $request,$slug): RedirectResponse
    {
        $request->validate(['content'=>'required']);
        page::query()->where('slug',$slug)->update(['content'=>$request->content]);
        toast('Content updated successfully','success');
        return redirect()->route('page.index');
    }
}
