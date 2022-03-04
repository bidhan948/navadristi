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

class NewsAndEventsController extends Controller
{
    public $page_type;

    public function __construct()
    {
        $this->page_type = page_type::query()->where('slug', 'news-and-events')->first();
    }
    public function index(): View
    {
        return view('cms.news_events.news_events', [
            'newsEvents' => page::query()
                ->where('page_type_id', $this->page_type->id)
                ->get()
        ]);
    }

    public function create(): View
    {
        return view('cms.news_events.create_news_events');
    }

    public function store(Request $request, MediaHelper $helper): RedirectResponse
    {
        $request->validate(['title' => 'required', 'image' => 'required', 'content' => 'required']);

        DB::transaction(function () use ($request, $helper) {
            $page = page::create(
                [
                    'page_type_id' => $this->page_type->id,
                    'title' => $request->title,
                    'content' => $request->content
                ]
            );
            $imageName = $helper->uploadSingleImage($request->image);
            image::create([
                'imageable_id' => $page->id,
                'imageable_type' => page::NAMESPACE,
                'name' => $imageName
            ]);
        });

        toast('News & Events created successfully', 'success');
        return redirect()->route('news-events.index');
    }

    public function edit(page $news_event): View
    {
        return view('cms.news_events.edit_news_events', [
            'newsEvent' => $news_event->load('images')
        ]);
    }

    public function update(Request $request, page $news_event, MediaHelper $helper): RedirectResponse
    {
        $validateData = $request->validate(['title' => 'required', 'content' => 'required']);

        DB::transaction(function () use ($request, $helper, $news_event, $validateData) {

            $news_event->update($validateData);
            if ($request->hasFile('image')) {
                $imageName = $helper->uploadSingleImage($request->image);
            } else {
                $imageName = $request->old_image;
            }

            image::query()
                ->where('imageable_id', $news_event->id)
                ->where('imageable_type', page::NAMESPACE)
                ->update(['name' => $imageName]);
        });

        toast('News & Events updated successfully', 'success');
        return redirect()->route('news-events.index');
    }
}
