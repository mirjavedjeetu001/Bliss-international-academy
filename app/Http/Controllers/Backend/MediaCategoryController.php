<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\MediaCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mediaCategories = MediaCategory::latest()->paginate(10);
        return view('backend.mediaCategory.index-clean', compact('mediaCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.mediaCategory.add-clean');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'type' => 'required|in:photo,video',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->only(['name', 'type', 'status']);
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('backend/assets/images/category'), $imageName);
            $data['image'] = $imageName;
        }
        
        $data['created_by'] = auth()->user()->name ?? 'Admin';
        $data['updated_by'] = auth()->user()->name ?? 'Admin';

        MediaCategory::create($data);

        return redirect()->route('backend.mediacategory.index')
            ->with('success', 'Media category created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($mediacategory)
    {
        $mediaCategory = MediaCategory::findOrFail($mediacategory);
        return view('backend.mediaCategory.show-clean', compact('mediaCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($mediacategory)
    {
        $mediaCategory = MediaCategory::findOrFail($mediacategory);
        return view('backend.mediaCategory.edit-clean', compact('mediaCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $mediacategory)
    {
        $mediaCategory = MediaCategory::findOrFail($mediacategory);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'type' => 'required|in:photo,video',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->only(['name', 'type', 'status']);
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($mediaCategory->image) {
                $oldImagePath = public_path('backend/assets/images/category/' . $mediaCategory->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('backend/assets/images/category'), $imageName);
            $data['image'] = $imageName;
        }
        
        $data['updated_by'] = auth()->user()->name ?? 'Admin';

        $mediaCategory->update($data);

        return redirect()->route('backend.mediacategory.index')
            ->with('success', 'Media category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($mediacategory)
    {
        $mediaCategory = MediaCategory::findOrFail($mediacategory);
        
        // Delete associated image file
        if ($mediaCategory->image) {
            $imagePath = public_path('backend/assets/images/category/' . $mediaCategory->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $mediaCategory->delete();

        return redirect()->route('backend.mediacategory.index')
            ->with('success', 'Media category deleted successfully!');
    }
}
