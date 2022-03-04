<?php

namespace App\Http\Controllers;

use App\Models\cms\page;
use App\Models\cms\page_type;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public $page;
    public $page_type;
    public $specialities;
    public $menus;
    public $footer;

    public function __construct()
    {
        $this->page = page::query()->get();
        $this->page_type = page_type::query()->get();

        $this->specialities = $this->page_type
            ->where('title', 'specialities')
            ->load('Page')
            ->values()[0]
            ->Page;

        $this->menus = page_type::query()
            ->where('show_on_homepage', 1)
            ->with('Page')
            ->get();

        $this->footer = json_decode($this->page
            ->where('slug', 'footer')
            ->first()
            ->content, true);
    }

    public function index(): View
    {
        return view('welcome', [
            'menus' => $this->menus,

            'carousels' => page::query()
                ->where('title', 'carousel')
                ->with('images')
                ->get()[0]->images,

            'doctors' =>page::query()->where('slug','!=','department')->where('page_type_id',4)->orderBy('position','DESC')->get(),

            'equipments' => $this->page
                ->where('title', 'equipments')
                ->load('Parents.images')
                ->values()[0]
                ->Parents,

            'testimonials' => $this->page
                ->where('title', 'testimonial')
                ->load('Parents.images')
                ->values()[0]
                ->Parents,

            'specialities' => $this->specialities,

            'footer' => $this->footer
        ]);
    }

    public function dashboard(): View
    {
        $departmentId = page::query()->where('title', page::DEPARTMENT)->pluck('id');

        return view('home', [
            'pages' => page::query()
                ->where('page_id', $departmentId)
                ->with('Parents')
                ->get(),
            'doctors' => page_type::query()
                ->where('slug', 'doctor')
                ->with('Page')
                ->first()
                ->Page,
            'specialities' => page_type::query()
                ->where('slug', 'specialities')
                ->with('Page')
                ->first()
                ->Page,
            'equipments' => page::query()
                ->where('slug', 'equipments')
                ->with('Parents')
                ->first()
                ->Parents,

        ]);
    }

    public function getFromSlug($slug): View
    {
        if ($slug == 'about-us') {
            return view('about-us', [
                'aboutUs' => $this->page_type
                    ->where('slug', $slug)
                    ->load('Page')
                    ->values()[0]
                    ->Page[0],

                'content' => json_decode($this->page_type
                    ->where('slug', $slug)
                    ->load('Page')
                    ->values()[0]
                    ->Page[0]->content, true),

                'specialities' => $this->specialities,
                'menus' => $this->menus,
                'footer' => $this->footer,
                'sideBannerImage' => $this->page
                    ->where('slug', 'side-banner-image')
                    ->load('images')
                    ->values()[0]
            ]);
        } elseif ($slug == 'specialities') {
            return view('specialities', [
                'specialities' => $this->specialities,
                'menus' => $this->menus,
                'speciality' => $this->page_type
                    ->where('slug', $slug)
                    ->load('Page.images')
                    ->values()[0]
                    ->Page,
                'footer' => $this->footer
            ]);
        } elseif ($slug == 'gallery') {
            return view('gallery', [
                'specialities' => $this->specialities,
                'menus' => $this->menus,
                'galleries' => $this->page_type
                    ->where('slug', $slug)
                    ->load('Page.images')
                    ->values()[0]->Page,
                'footer' => $this->footer
            ]);
        } elseif ($slug == 'doctor') {
            return view('doctor', [
                'specialities' => $this->specialities,
                'menus' => $this->menus,
                'footer' => $this->footer,
                'doctors' => $this->page
                    ->where('slug', 'department')
                    ->load('Parents.Parents.metaPage', 'Parents.Parents.images')[0],
                'images' => $this->page
                    ->where('page_id', 1)
                    ->load('Parents.metaPage', 'Parents.images'),
                'content' => $this->page
                    ->where('slug', 'department')
                    ->load('Parents.Parents.metaPage')[0]->Parents
            ]);
        } elseif ($slug == 'news-and-events') {
            $pageTypeId = $this->page_type->where('slug', $slug)->first();

            return view('news-events', [
                'specialities' => $this->specialities,
                'menus' => $this->menus,
                'footer' => $this->footer,
                'newsEvents' => $this->page
                    ->where('page_type_id', $pageTypeId->id)
                    ->load('images')
                    ->values()
            ]);
        } else {
            $pageType = $this->page_type->where('slug', $slug)->values();
            abort_if($pageType->count() == 0,404);
            return view(
                'content',
                [
                    'specialities' => $this->specialities,
                    'menus' => $this->menus,
                    'footer' => $this->footer,
                    'title' => $slug,
                    'content' => $this->page_type->where('slug', $slug)->values()[0]->Page
                ]
            );
        }
    }

    public function getFromSpecialitiesSlug($slug): View
    {
        return view('sub-speciality', [
            'specialities' => $this->specialities,
            'speciality' => $this->page
                ->where('slug', $slug)
                ->load('images', 'metaPage')
                ->values()[0],
            'gallery' => $this->page_type
                ->where('slug', 'gallery')
                ->first()
                ->load('Page')
                ->Page,
            'content' => json_decode($this->page
                ->where('slug', $slug)
                ->load('images', 'metaPage')
                ->values()[0]->metaPage[0]
                ->content, true),
            'menus' => $this->menus,
            'footer' => $this->footer
        ]);
    }

    public function getFromGallerySlug($slug): View
    {
        return view(
            'sub-gallery',
            [
                'specialities' => $this->specialities,
                'menus' => $this->menus,
                'footer' => $this->footer,
                'gallery' => $this->page
                    ->where('slug', $slug)
                    ->load('images')
                    ->values()[0]
            ]
        );
    }

    public function getFromNewsAndEventsSlug($slug): View
    {
        return view(
            'sub-news-events',
            [
                'specialities' => $this->specialities,
                'menus' => $this->menus,
                'footer' => $this->footer,
                'newsEvent' => $this->page
                    ->where('slug', $slug)
                    ->load('images')
                    ->first()
            ]
        );
    }
}
