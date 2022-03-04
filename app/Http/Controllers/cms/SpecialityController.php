<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use App\Http\Helper\MediaHelper;
use App\Http\Requests\cms\speciality\SpecialityRequest;
use App\Http\Requests\cms\speciality\SpecialityUpdateRequest;
use App\Models\cms\image;
use App\Models\cms\page;
use App\Models\cms\page_type;
use App\Models\meta_page;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class SpecialityController extends Controller
{
    public $pageType;

    public function __construct()
    {
        $this->pageType =  page_type::query()
            ->where('title', 'specialities')
            ->first();
    }

    public function index(): View
    {
        return view('cms.speciality.speciality', [
            'specialities' => $this->pageType->load('Page')
        ]);
    }

    public function create(): View
    {
        $gallery = page_type::query()->where('slug', 'gallery')->with('Page')->first()->Page;
        return view('cms.speciality.create_speciality', [
            'speciality' => $this->pageType,
            'galleries' => $gallery
        ]);
    }

    public function store(SpecialityRequest $request, MediaHelper $helper): RedirectResponse
    {
        DB::transaction(function () use ($request, $helper) {

            $page = page::create($request->validated());

            $imageName = $helper->uploadSingleImage($request->image);

            if ($request->hasFile('banner_image')) {
                $bannerImage = $helper->uploadSingleImage($request->banner_image);
                image::create(
                    [
                        'imageable_id' => $page->id,
                        'imageable_type' => page::NAMESPACE,
                        'name' => $bannerImage,
                        'is_banner' => true
                    ]
                );
            }

            if ($request->hasFile('team')) {
                $team = $helper->uploadMultipleImage($request->team);
            } else {
                $team = null;
            }

            if ($request->hasFile('equipment_image')) {
                $equipment = $helper->uploadMultipleImage($request->equipment_image);
            } else {
                $equipment = null;
            }

            // repeating image create two times bcz from same form 2 type of image hits :)
            image::create(
                [
                    'imageable_id' => $page->id,
                    'imageable_type' => page::NAMESPACE,
                    'name' => $imageName
                ]
            );

            $metaData = $request->only('home', 'type_of_service', 'gallery') + ['team' => $team, 'equipment' => $equipment];
            meta_page::create([
                'page_id' => $page->id,
                'content' => json_encode($metaData)
            ]);
        });

        toast('Speciality added successfully', 'success');
        return redirect()->route('speciality.index');
    }

    public function edit(page $speciality): View
    {
        return view('cms.speciality.edit_speciality', [
            'speciality' => $speciality->load('images'),
            'metaData' => json_decode($speciality->load('metaPage')->metaPage[0]->content, true),
            'pageType' => $this->pageType,
            'galleries' => page_type::query()->where('slug', 'gallery')->with('Page')->first()->Page
        ]);
    }

    public function update(SpecialityUpdateRequest $request, page $speciality, MediaHelper $helper): RedirectResponse
    {
        DB::transaction(function () use ($request, $speciality, $helper) {
            $speciality->update($request->validated());

            if ($request->hasFile('image')) {
                $imageName = $helper->uploadSingleImage($request->file('image'));
            } else {
                $imageName = $request->old_image;
            }

            if ($request->hasFile('banner_image')) {
                $bannerImageName = $helper->uploadSingleImage($request->file('banner_image'));
            } else {
                $bannerImageName = $request->old_banner_image;
            }

            if ($request->hasFile('team')) {
                $team = $helper->uploadMultipleImage($request->team);
            } else {
                $team = $request->old_team_image;
            }

            if ($request->hasFile('equipment_image')) {
                $equipment = $helper->uploadMultipleImage($request->equipment_image);
            } else {
                $equipment = $request->old_equipment_image;
            }

            image::query()
                ->where('imageable_id', $speciality->id)
                ->where('imageable_type', page::NAMESPACE)
                ->delete();

            // i have itrated two times bcz from same form one is normal another is banner 
            image::create(
                [
                    'imageable_id' => $speciality->id,
                    'imageable_type' => page::NAMESPACE,
                    'name' => $imageName
                ]
            );

            if ($bannerImageName != '') {
                image::create(
                    [
                        'imageable_id' => $speciality->id,
                        'imageable_type' => page::NAMESPACE,
                        'name' => $bannerImageName,
                        'is_banner' => true
                    ]
                );
            }

            $metaData = $request->only('home', 'type_of_service', 'gallery') + ['team' => $team, 'equipment' => $equipment];

            meta_page::query()
                ->where('page_id', $speciality->id)
                ->update([
                    'content' => json_encode($metaData)
                ]);
        });

        toast('Speciality updated successfully', 'success');
        return redirect()->route('speciality.index');
    }
}
