<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Slider;
use App\Models\Backend\PastEvent;
use App\Models\Backend\LatestUpdate;
use App\Models\VideoGallery;
use App\Models\Page;
use App\Models\Teacher;
use App\Models\Book;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    /**
     * Display the main website homepage
     */
    public function index()
    {
        $sliders = Slider::active()->latest()->get();
        $pastevents = PastEvent::latest()->take(3)->get();
        $latestupdates = LatestUpdate::latest()->take(5)->get();
        $videos = VideoGallery::active()->latest()->take(6)->get();
        return view('frontend.home.index', compact('sliders', 'pastevents', 'latestupdates', 'videos'));
    }

    public function page($id)
    {
        $page = Page::findOrFail($id);
        return view('frontend.page.index', compact('page'));
    }

    /**
     * Display teachers from Satkhira campus
     */
    public function teachersSatkhira()
    {
        $teachers = Teacher::active()
            ->where('campus', 'Satkhira')
            ->orderBy('sort_by', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('frontend.teacher.satkhira', compact('teachers'));
    }

    /**
     * Display teachers from Debhata campus
     */
    public function teachersDebhata()
    {
        $teachers = Teacher::active()
            ->where('campus', 'Debhata')
            ->orderBy('sort_by', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('frontend.teacher.debhata', compact('teachers'));
    }

    /**
     * Display downloads for Satkhira campus (Forms only)
     */
    public function downloadsSatkhira()
    {
        $books = Book::active()
            ->where('book_type', 'form')
            ->where('campus', 'Satkhira')
            ->latest()
            ->get();
            
        return view('frontend.download.satkhira', compact('books'));
    }

    /**
     * Display downloads for Debhata campus (Forms only)
     */
    public function downloadsDebhata()
    {
        $books = Book::active()
            ->where('book_type', 'form')
            ->where('campus', 'Debhata')
            ->latest()
            ->get();
            
        return view('frontend.download.debhata', compact('books'));
    }

    /**
     * Display library books (All Campus)
     */
    public function library()
    {
        $books = Book::active()
            ->where('book_type', 'book')
            // ->where('campus', 'All Campus')
            ->latest()
            ->get();
        return view('frontend.library.index', compact('books'));
    }
    /**
     * Display career opportunities (Latest Updates with type 'career')
     */
    public function career()
    {
        $careers = LatestUpdate::where('type', 'career')
            ->latest()
            ->paginate(10);
        return view('frontend.career.index', compact('careers'));
    }
}
