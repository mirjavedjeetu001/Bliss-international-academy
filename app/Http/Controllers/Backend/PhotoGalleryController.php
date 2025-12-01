<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PhotoGallery;
use App\Models\MediaCategory;
use Illuminate\Http\Request;

class PhotoGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $photoGalleries = PhotoGallery::with('mediaCategory')->latest()->paginate(10);
        return view('backend.photoGallery.index-clean', compact('photoGalleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mediaCategories = MediaCategory::where('type', 'photo')->active()->get();
        return view('backend.photoGallery.add-clean', compact('mediaCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'media_category_id' => 'required|exists:media_categories,id',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->only(['title', 'media_category_id', 'status']);
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('backend/assets/images/photo-gallery'), $imageName);
            $data['image'] = $imageName;
        }
        
        $data['created_by'] = auth()->user()->name ?? 'Admin';
        $data['updated_by'] = auth()->user()->name ?? 'Admin';

        PhotoGallery::create($data);

        return redirect()->route('backend.photogallery.index')
            ->with('success', 'Photo gallery created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($photogallery)
    {
        $photoGallery = PhotoGallery::findOrFail($photogallery);
        $photoGallery->load('mediaCategory');
        return view('backend.photoGallery.show-clean', compact('photoGallery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($photogallery)
    {
        $photoGallery = PhotoGallery::findOrFail($photogallery);
        $mediaCategories = MediaCategory::where('type', 'photo')->active()->get();
        return view('backend.photoGallery.edit-clean', compact('photoGallery', 'mediaCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $photogallery)
    {
        $photoGallery = PhotoGallery::findOrFail($photogallery);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'media_category_id' => 'required|exists:media_categories,id',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->only(['title', 'media_category_id', 'status']);
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($photoGallery->image) {
                $oldImagePath = public_path('backend/assets/images/photo-gallery/' . $photoGallery->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('backend/assets/images/photo-gallery'), $imageName);
            $data['image'] = $imageName;
        }
        
        $data['updated_by'] = auth()->user()->name ?? 'Admin';

        $photoGallery->update($data);

        return redirect()->route('backend.photogallery.index')
            ->with('success', 'Photo gallery updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($photogallery)
    {
        $photoGallery = PhotoGallery::findOrFail($photogallery);
        
        // Delete associated image file
        if ($photoGallery->image) {
            $imagePath = public_path('backend/assets/images/photo-gallery/' . $photoGallery->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $photoGallery->delete();

        return redirect()->route('backend.photogallery.index')
            ->with('success', 'Photo gallery deleted successfully!');
    }
}
