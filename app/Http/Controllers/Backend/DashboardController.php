<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Get dashboard statistics
        $totalContacts = \App\Models\Contact::count();
        $unreadContacts = \App\Models\Contact::where('is_read', false)->count();
        $totalPages = \App\Models\Page::count();
        $totalMediaCategories = \App\Models\MediaCategory::count();
        $totalPhotoGalleries = \App\Models\PhotoGallery::count();
        $totalVideoGalleries = \App\Models\VideoGallery::count();
        $totalSliders = \App\Models\Backend\Slider::count();
        $totalPastEvents = \App\Models\Backend\PastEvent::count();
        $recentContacts = \App\Models\Contact::latest()->take(5)->get();
        
        return view('backend.dashboard-clean', compact(
            'totalContacts',
            'unreadContacts',
            'totalPages',
            'totalMediaCategories',
            'totalPhotoGalleries',
            'totalVideoGalleries',
            'totalSliders',
            'totalPastEvents',
            'recentContacts'
        ));
    }
}
