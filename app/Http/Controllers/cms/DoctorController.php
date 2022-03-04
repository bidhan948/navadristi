<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use App\Http\Helper\MediaHelper;
use App\Http\Requests\cms\doctor\DoctorRequest;
use App\Http\Requests\cms\doctor\DoctorUpdateRequest;
use App\Models\cms\image;
use App\Models\cms\page;
use App\Models\cms\page_type;
use App\Models\meta_page;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class DoctorController extends Controller
{
    public function index()
    {
        $departmentId = page::query()->where('title', page::DEPARTMENT)->pluck('id');
        $doctor = page_type::query()->where('slug','doctor')->with('Page')->first();
        return view('cms.doctor.doctor', [
            'pages' => page::query()
                ->where('page_id', $departmentId)
                ->with('Parents')
                ->orderBy('position','DESC')
                ->get(),
            'doctors'=> page::query()->where('page_type_id',$doctor->id)->orderBy('position','DESC')->get()
        ]);
    }

    public function create()
    {
        return view('cms.doctor.add-doctor', [
            'departments' => page::query()
                ->where('title', page::DEPARTMENT)
                ->with('Parents')
                ->get()[0]->Parents
        ]);
    }

    public function store(DoctorRequest $request, MediaHelper $helper): RedirectResponse
    {
        DB::transaction(function () use ($request, $helper) {
            $pageTypeId = page_type::query()
                ->where('slug', 'doctor')
                ->with('Page')
                ->first();
            $doctor = page::query()->where('slug','!=','department')->get()->max('position');
            $page = page::create($request->only('title', 'page_id') + ['page_id' => $pageTypeId->id,'page_type_id'=>$pageTypeId->id,'position'=>$doctor+1]);
            $imageName = $helper->uploadSingleImage($request->file('image'));
            $bannerImageName = $helper->uploadSingleImage($request->file('banner_image'));

            // i have itrated two times bcz from same form one is normal another is banner 
            image::create(
                [
                    'imageable_id' => $page->id,
                    'imageable_type' => page::NAMESPACE,
                    'name' => $imageName
                ]
            );

            image::create(
                [
                    'imageable_id' => $page->id,
                    'imageable_type' => page::NAMESPACE,
                    'name' => $bannerImageName,
                    'is_banner' => true
                ]
            );

            meta_page::create([
                'page_id' => $page->id,
                'content' => json_encode($request->except('page_id', 'title', 'image', '_token'))
            ]);
        });

        toast('Doctor added successfully', 'success');
        return redirect()->back();
    }

    public function edit(page $doctor): View
    {
        return view('cms.doctor.doctor_edit', [
            'doctors' => $doctor->load('Children', 'images'),
            'metaData' => json_decode($doctor->load('metaPage')->metaPage[0]->content, true),
            'departments' => page::query()
                ->where('title', page::DEPARTMENT)
                ->with('Parents')
                ->get()[0]->Parents
        ]);
    }

    public function update(page $doctor, DoctorUpdateRequest $request, MediaHelper $helper): RedirectResponse
    {
        DB::transaction(function () use ($doctor, $request, $helper) {
            $doctor->update($request->validated());

            if ($request->hasFile('image')) {
                $imageName = $helper->uploadSingleImage($request->file('image'));
            } else {
                $imageName = $request->old_doctor_image;
            }

            if ($request->hasFile('banner_image')) {
                $bannerImageName = $helper->uploadSingleImage($request->file('banner_image'));
            } else {
                $bannerImageName = $request->old_banner_image;
            }

            image::query()
                ->where('imageable_id', $doctor->id)
                ->where('imageable_type', page::NAMESPACE)
                ->delete();

            // i have itrated two times bcz from same form one is normal another is banner 
            image::create(
                [
                    'imageable_id' => $doctor->id,
                    'imageable_type' => page::NAMESPACE,
                    'name' => $imageName
                ]
            );

            image::create(
                [
                    'imageable_id' => $doctor->id,
                    'imageable_type' => page::NAMESPACE,
                    'name' => $bannerImageName,
                    'is_banner' => true
                ]
            );

            meta_page::where('page_id', $doctor->id)->update([
                'content' => json_encode($request->except('page_id', 'title', 'image', '_token', 'old_banner_image', 'old_doctor_image', 'banner_image'))
            ]);
        });

        toast('Doctor updated successfully', 'success');
        return redirect()->route('doctor.index');
    }

    public function storeDepartment(Request $request): RedirectResponse
    {
        $validateData = $request->validate(['department_name' => 'required']);

        $pageId = page::query()->where('slug', 'department')->first();
        if (page::query()->where('title', $request->department_name)->count() > 0) {
            Alert::error('Department already exist');
            return redirect()->back();
        }

        DB::transaction(function () use ($validateData, $pageId) {
            page::create([
                'title' => $validateData['department_name'],
                'page_id' => $pageId->id
            ]);
        });

        toast('Department added successfully', 'success');
        return redirect()->back();
    }
}
