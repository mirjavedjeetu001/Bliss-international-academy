<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::latest()->paginate(10);
        return view('backend.slider.index-clean', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.slider.add-clean');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'detail' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive'
        ]);

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            
            // Save to public/frontend for Laravel (backward compatibility)
            $uploadPath1 = public_path('frontend/assets/images/sliders');
            if (!file_exists($uploadPath1)) {
                mkdir($uploadPath1, 0755, true);
            }
            
            // Save to base_path frontend for direct web access (live server)
            $uploadPath2 = base_path('frontend/assets/images/sliders');
            if (!file_exists($uploadPath2)) {
                mkdir($uploadPath2, 0755, true);
            }
            
            // Save to both locations
            $image->move($uploadPath1, $imageName);
            copy($uploadPath1 . '/' . $imageName, $uploadPath2 . '/' . $imageName);
            chmod($uploadPath2 . '/' . $imageName, 0644);
            
            $data['image'] = $imageName;
        }

        Slider::create($data);

        return redirect()->route('backend.slider.index')->with('success', 'Slider created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Slider $slider)
    {
        return view('backend.slider.show', compact('slider'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider)
    {
        return view('backend.slider.edit-clean', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'detail' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive'
        ]);

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image from both locations
            if ($slider->image) {
                $oldPath1 = public_path('frontend/assets/images/sliders/' . $slider->image);
                if (file_exists($oldPath1)) {
                    unlink($oldPath1);
                }
                $oldPath2 = base_path('frontend/assets/images/sliders/' . $slider->image);
                if (file_exists($oldPath2)) {
                    unlink($oldPath2);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            
            // Save to public/frontend for Laravel (backward compatibility)
            $uploadPath1 = public_path('frontend/assets/images/sliders');
            if (!file_exists($uploadPath1)) {
                mkdir($uploadPath1, 0755, true);
            }
            
            // Save to base_path frontend for direct web access (live server)
            $uploadPath2 = base_path('frontend/assets/images/sliders');
            if (!file_exists($uploadPath2)) {
                mkdir($uploadPath2, 0755, true);
            }
            
            // Save to both locations
            $image->move($uploadPath1, $imageName);
            copy($uploadPath1 . '/' . $imageName, $uploadPath2 . '/' . $imageName);
            chmod($uploadPath2 . '/' . $imageName, 0644);
            
            $data['image'] = $imageName;
        } else {
            unset($data['image']);
        }

        $slider->update($data);

        return redirect()->route('backend.slider.index')->with('success', 'Slider updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        // Delete image file from both locations
        if ($slider->image) {
            $path1 = public_path('frontend/assets/images/sliders/' . $slider->image);
            if (file_exists($path1)) {
                unlink($path1);
            }
            $path2 = base_path('frontend/assets/images/sliders/' . $slider->image);
            if (file_exists($path2)) {
                unlink($path2);
            }
        }

        $slider->delete();

        return redirect()->route('backend.slider.index')->with('success', 'Slider deleted successfully!');
    }
}
