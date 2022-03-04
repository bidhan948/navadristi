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

class EquipmentController extends Controller
{
    public $page;
    public function __construct()
    {
        $this->page = page::query()
            ->where('title', 'equipments')
            ->whereNull('page_id')
            ->first();
    }

    public function index(): View
    {
        return view(
            'cms.slider.equipment',
            [
                'equipments' => $this->page->load('Parents', 'images'),
                'page' => $this->page
            ]
        );
    }

    public function create(): View
    {
        return view('cms.slider.create_equipment');
    }

    public function store(Request $request, MediaHelper $helper): RedirectResponse
    {
        $request->validate(['image' => 'required', 'title' => 'required']);
        DB::transaction(function () use ($request, $helper) {
            $page = page::create([
                'title' => $request->title,
                'page_id' => $this->page->id,
            ]);

            $imageName = $helper->uploadSingleImage($request->image);

            image::create([
                'imageable_id' => $page->id,
                'imageable_type' => page::NAMESPACE,
                'name' => $imageName
            ]);
        });
        toast('Equipment added successfully', 'success');
        return redirect()->route('equipment.index');
    }

    public function edit(page $equipment): View
    {
        return view('cms.slider.edit_equipment', [
            'equipment' => $equipment->load('images')
        ]);
    }

    public function update(Request $request, page $equipment, MediaHelper $helper): RedirectResponse
    {
        $validateData = $request->validate(['title' => 'required']);
        DB::transaction(function () use ($request, $helper, $equipment, $validateData) {
            if ($request->hasFile('image')) {
                $imageName = $helper->uploadSingleImage($request->image);
            } else {
                $imageName = $request->old_equipment_image;
            }

            $equipment->update($validateData);

            image::query()
                ->where('imageable_id', $equipment->id)
                ->where('imageable_type', page::NAMESPACE)
                ->update([
                    'name' => $imageName
                ]);
        });
        return redirect()->route('equipment.index');
    }
}
