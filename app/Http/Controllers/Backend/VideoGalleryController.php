<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\VideoGallery;
use Illuminate\Http\Request;

class VideoGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videoGalleries = VideoGallery::with('mediaCategory')->latest()->paginate(10);
        return view('backend.videoGallery.index', compact('videoGalleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.videoGallery.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url',
            'type' => 'required|in:youtube,facebook',
            'media_category_id' => 'nullable|exists:media_categories,id',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->only(['title', 'url', 'type', 'media_category_id', 'status']);
        
        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumbnailName = time() . '_' . $thumbnail->getClientOriginalName();
            $thumbnail->move(public_path('backend/assets/images/video-gallery'), $thumbnailName);
            $data['thumbnail'] = $thumbnailName;
        }
        
        $data['created_by'] = auth()->user()->name ?? 'Admin';
        $data['modified_by'] = auth()->user()->name ?? 'Admin';

        VideoGallery::create($data);

        return redirect()->route('backend.videogallery.index')
            ->with('success', 'Video gallery created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $videoGallery = VideoGallery::findOrFail($id);
        return view('backend.videoGallery.show', compact('videoGallery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($videoGallery)
    {
        // dd($videoGallery);
        // $videoGallery = VideoGallery::findOrFail($id);
        return view('backend.videoGallery.edit', compact('videoGallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $videoGallery)
    
    {

        // dd($request->all(), $id);
        // $videoGallery = VideoGallery::findOrFail($id);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url',
            'type' => 'required|in:youtube,facebook',
            'media_category_id' => 'nullable|exists:media_categories,id',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->only(['title', 'url', 'type', 'media_category_id', 'status']);
        
        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail if exists
            if ($videoGallery->thumbnail) {
                $oldThumbnailPath = public_path('backend/assets/images/video-gallery/' . $videoGallery->thumbnail);
                if (file_exists($oldThumbnailPath)) {
                    unlink($oldThumbnailPath);
                }
            }
            
            $thumbnail = $request->file('thumbnail');
            $thumbnailName = time() . '_' . $thumbnail->getClientOriginalName();
            $thumbnail->move(public_path('backend/assets/images/video-gallery'), $thumbnailName);
            $data['thumbnail'] = $thumbnailName;
        }
        
        $data['modified_by'] = auth()->user()->name ?? 'Admin';

        $videoGallery->update($data);

        return redirect()->route('backend.videogallery.index')
            ->with('success', 'Video gallery updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VideoGallery $videoGallery)
    {
        // Delete associated thumbnail file
        if ($videoGallery->thumbnail) {
            $thumbnailPath = public_path('backend/assets/images/video-gallery/' . $videoGallery->thumbnail);
            if (file_exists($thumbnailPath)) {
                unlink($thumbnailPath);
            }
        }

        $videoGallery->delete();

        return redirect()->route('backend.videogallery.index')
            ->with('success', 'Video gallery deleted successfully!');
    }
}
