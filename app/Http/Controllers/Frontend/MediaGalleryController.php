<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\VideoGallery;
use App\Models\PhotoGallery;
use App\Models\MediaCategory;
use Illuminate\Http\Request;

class MediaGalleryController extends Controller
{
    /**
     * Display video gallery categories
     */
    public function videoGalleryIndex()
    {
        // Get all media categories that have videos
        $categories = MediaCategory::where('type', 'video')
            ->whereHas('videoGalleries', function($query) {
                $query->where('status', 'active');
            })
            ->withCount(['videoGalleries' => function($query) {
                $query->where('status', 'active');
            }])
            ->get();

        // If no video categories exist, get all video galleries
        if ($categories->isEmpty()) {
            $allVideos = VideoGallery::active()->latest()->get();
            return view('frontend.videoGallery.index', compact('categories', 'allVideos'));
        }

        return view('frontend.videoGallery.index', compact('categories'));
    }

    /**
     * Display videos by category
     */
    public function videoGalleryByCategory($categoryId)
    {
        $category = MediaCategory::findOrFail($categoryId);
        $videos = VideoGallery::where('media_category_id', $categoryId)
            ->where('status', 'active')
            ->latest()
            ->paginate(12);
        return view('frontend.videoGallery.category', compact('category', 'videos'));
    }

    /**
     * Display all videos (fallback when no categories)
     */
    public function videoGalleryAll()
    {
        $videos = VideoGallery::active()->latest()->paginate(12);
        return view('frontend.videoGallery.all', compact('videos'));
    }

    /**
     * Display photo gallery categories
     */
    public function photoGalleryIndex()
    {
        // Get all media categories that have photos
        $categories = MediaCategory::where('type', 'photo')
            ->whereHas('photoGalleries', function($query) {
                $query->where('status', 'active');
            })
            ->withCount(['photoGalleries' => function($query) {
                $query->where('status', 'active');
            }])
            ->get();

        // If no photo categories exist, get all photo galleries
        if ($categories->isEmpty()) {
            $allPhotos = PhotoGallery::active()->latest()->get();
            return view('frontend.photoGallery.index', compact('categories', 'allPhotos'));
        }

        return view('frontend.photoGallery.index', compact('categories'));
    }

    /**
     * Display photos by category
     */
    public function photoGalleryByCategory($categoryId)
    {
        $category = MediaCategory::findOrFail($categoryId);
        $photos = PhotoGallery::where('media_category_id', $categoryId)
            ->where('status', 'active')
            ->latest()
            ->paginate(12);

        return view('frontend.photoGallery.category', compact('category', 'photos'));
    }

    /**
     * Display all photos (fallback when no categories)
     */
    public function photoGalleryAll()
    {
        $photos = PhotoGallery::active()->latest()->paginate(12);
        return view('frontend.photoGallery.all', compact('photos'));
    }
}
