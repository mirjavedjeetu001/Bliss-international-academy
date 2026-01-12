<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::orderBy('sort_by', 'asc')->orderBy('created_at', 'desc')->paginate(10);
        return view('backend.teacher.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.teacher.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'qualification' => 'required|string',
            'mobile' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'campus' => 'required|in:Satkhira,Debhata',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'required|in:active,inactive',
            'sort_by' => 'required|integer|min:0',
        ]);

        $data = $request->only(['name', 'designation', 'qualification', 'mobile', 'email', 'campus', 'status', 'sort_by']);

        // Handle picture upload
        if ($request->hasFile('picture')) {
            $image = $request->file('picture');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = 'frontend/assets/images/teachers/' . $filename;
            
            // Save to public/frontend for Laravel (backward compatibility)
            $uploadPath1 = public_path('frontend/assets/images/teachers');
            if (!file_exists($uploadPath1)) {
                mkdir($uploadPath1, 0755, true);
            }
            
            // Save to base_path frontend for direct web access (live server)
            $uploadPath2 = base_path('frontend/assets/images/teachers');
            if (!file_exists($uploadPath2)) {
                mkdir($uploadPath2, 0755, true);
            }
            
            // Save to both locations
            $image->move($uploadPath1, $filename);
            copy($uploadPath1 . '/' . $filename, $uploadPath2 . '/' . $filename);
            chmod($uploadPath2 . '/' . $filename, 0644);
            
            $data['picture'] = $path;
        }

        Teacher::create($data);

        return redirect()->route('backend.teacher.index')
            ->with('success', 'Teacher created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        return view('backend.teacher.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        return view('backend.teacher.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'qualification' => 'required|string',
            'mobile' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'campus' => 'required|in:Satkhira,Debhata',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'required|in:active,inactive',
            'sort_by' => 'required|integer|min:0',
        ]);

        $data = $request->only(['name', 'designation', 'qualification', 'mobile', 'email', 'campus', 'status', 'sort_by']);

        // Handle new picture upload
        if ($request->hasFile('picture')) {
            // Delete old picture if exists
            if ($teacher->picture) {
                $oldPath1 = public_path($teacher->picture);
                if (file_exists($oldPath1)) {
                    unlink($oldPath1);
                }
                $oldPath2 = base_path($teacher->picture);
                if (file_exists($oldPath2)) {
                    unlink($oldPath2);
                }
            }

            $image = $request->file('picture');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = 'frontend/assets/images/teachers/' . $filename;
            
            // Save to public/frontend for Laravel (backward compatibility)
            $uploadPath1 = public_path('frontend/assets/images/teachers');
            if (!file_exists($uploadPath1)) {
                mkdir($uploadPath1, 0755, true);
            }
            
            // Save to base_path frontend for direct web access (live server)
            $uploadPath2 = base_path('frontend/assets/images/teachers');
            if (!file_exists($uploadPath2)) {
                mkdir($uploadPath2, 0755, true);
            }
            
            // Save to both locations
            $image->move($uploadPath1, $filename);
            copy($uploadPath1 . '/' . $filename, $uploadPath2 . '/' . $filename);
            chmod($uploadPath2 . '/' . $filename, 0644);
            
            $data['picture'] = $path;
        }

        $teacher->update($data);

        return redirect()->route('backend.teacher.index')
            ->with('success', 'Teacher updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        // Delete associated picture
        if ($teacher->picture) {
            $filePath = public_path($teacher->picture);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $teacher->delete();

        return redirect()->route('backend.teacher.index')
            ->with('success', 'Teacher deleted successfully!');
    }
}

