<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PageController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = Page::latest()->paginate(10);
        return view('backend.page.index-clean', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.page.add-clean');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'detail' => 'required|string',
            'status' => 'required|in:active,inactive',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'pdfs.*' => 'nullable|mimes:pdf|max:10240', // 10MB max for PDFs
        ]);

        $data = $request->only(['title', 'detail', 'status']);
        $data['slug'] = Str::slug($request->title);

        // Debug: Log file upload information
        \Log::info('File upload debug:', [
            'has_images' => $request->hasFile('images'),
            'has_pdfs' => $request->hasFile('pdfs'),
            'images_count' => $request->hasFile('images') ? count($request->file('images')) : 0,
            'pdfs_count' => $request->hasFile('pdfs') ? count($request->file('pdfs')) : 0,
        ]);

        // Handle multiple images
        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $path = 'backend/assets/images/page/' . $filename;
                $uploadPath = public_path('backend/assets/images/page');
                
                // Ensure directory exists
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }
                
                $image->move($uploadPath, $filename);
                $images[] = $path;
                
                \Log::info('Image uploaded:', [
                    'original_name' => $image->getClientOriginalName(),
                    'filename' => $filename,
                    'path' => $path,
                    'upload_path' => $uploadPath
                ]);
            }
            $data['images'] = $images;
        }

        // Handle multiple PDFs
        if ($request->hasFile('pdfs')) {
            $pdfs = [];
            foreach ($request->file('pdfs') as $pdf) {
                $filename = time() . '_' . $pdf->getClientOriginalName();
                $path = 'backend/assets/images/page/' . $filename;
                $uploadPath = public_path('backend/assets/images/page');
                
                // Ensure directory exists
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }
                
                $pdf->move($uploadPath, $filename);
                $pdfs[] = $path;
                
                \Log::info('PDF uploaded:', [
                    'original_name' => $pdf->getClientOriginalName(),
                    'filename' => $filename,
                    'path' => $path,
                    'upload_path' => $uploadPath
                ]);
            }
            $data['pdfs'] = $pdfs;
        }

        Page::create($data);

        return redirect()->route('backend.page.index')
            ->with('success', 'Page created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        return view('backend.page.show-clean', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        return view('backend.page.edit-clean', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'detail' => 'required|string',
            'status' => 'required|in:active,inactive',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'pdfs.*' => 'nullable|mimes:pdf|max:10240',
        ]);

        $data = $request->only(['title', 'detail', 'status']);
        
        // Update slug if title changed
        if ($page->title !== $request->title) {
            $data['slug'] = Str::slug($request->title);
        }

        // Handle new images
        if ($request->hasFile('images')) {
            $newImages = [];
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $path = 'backend/assets/images/page/' . $filename;
                $image->move(public_path('backend/assets/images/page'), $filename);
                $newImages[] = $path;
            }
            
            // Merge with existing images
            $existingImages = $page->images ?? [];
            $data['images'] = array_merge($existingImages, $newImages);
        }

        // Handle new PDFs
        if ($request->hasFile('pdfs')) {
            $newPdfs = [];
            foreach ($request->file('pdfs') as $pdf) {
                $filename = time() . '_' . $pdf->getClientOriginalName();
                $path = 'backend/assets/images/page/' . $filename;
                $pdf->move(public_path('backend/assets/images/page'), $filename);
                $newPdfs[] = $path;
            }
            
            // Merge with existing PDFs
            $existingPdfs = $page->pdfs ?? [];
            $data['pdfs'] = array_merge($existingPdfs, $newPdfs);
        }

        $page->update($data);

        return redirect()->route('backend.page.index')
            ->with('success', 'Page updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
	$page = Page::findOrFail($id);
        // Delete associated files
        if ($page->images) {
            foreach ($page->images as $image) {
                $filePath = public_path($image);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        }

        if ($page->pdfs) {
            foreach ($page->pdfs as $pdf) {
                $filePath = public_path($pdf);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        }

        $page->delete();

        return redirect()->route('backend.page.index')
            ->with('success', 'Page deleted successfully!');
    }
	

    /**
     * Remove a specific image from the page
     */
    public function removeImage(Request $request, $id)
    {
        $imagePath = $request->input('image_path');
		

		
		$page = Page::findOrFail($id);
        
        if ($imagePath && $page->images) {
            $images = $page->images;
            $key = array_search($imagePath, $images);
            
            if ($key !== false) {
                // Delete file from storage
                $filePath = public_path($imagePath);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
                
                // Remove from array
                unset($images[$key]);
                $images = array_values($images); // Re-index array
                
                $page->update(['images' => $images]);
                
                return response()->json(['success' => true]);
            }
        }
        
        return response()->json(['success' => false], 400);
    }

    /**
     * Remove a specific PDF from the page
     */
    public function removePdf(Request $request, $id)
    {
        $pdfPath = $request->input('pdf_path');
		
		$page = Page::findOrFail($id);
        
        if ($pdfPath && $page->pdfs) {
            $pdfs = $page->pdfs;
            $key = array_search($pdfPath, $pdfs);
            
            if ($key !== false) {
                // Delete file from storage
                $filePath = public_path($pdfPath);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
                
                // Remove from array
                unset($pdfs[$key]);
                $pdfs = array_values($pdfs); // Re-index array
                
                $page->update(['pdfs' => $pdfs]);
                
                return response()->json(['success' => true]);
            }
        }
        
        return response()->json(['success' => false], 400);
    }
}
