<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\LatestUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LatestUpdateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $latestupdates = LatestUpdate::latest()->paginate(10);
        return view('backend.latestUpdate.index-clean', compact('latestupdates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.latestUpdate.add-clean');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'detail' => 'nullable|string',
            'attachment' => 'nullable|file|mimes:pdf|max:10240'
        ]);

        $data = $request->all();
        $data['created_by'] = auth()->user()->name ?? 'Admin';

        // Handle attachment upload
        if ($request->hasFile('attachment')) {
            $attachment = $request->file('attachment');
            $attachmentName = time() . '_' . Str::slug($request->title) . '.' . $attachment->getClientOriginalExtension();
            
            // Save to public/backend for Laravel (backward compatibility)
            $uploadPath1 = public_path('backend/attachments');
            if (!file_exists($uploadPath1)) {
                mkdir($uploadPath1, 0755, true);
            }
            
            // Save to base_path backend for direct web access (live server)
            $uploadPath2 = base_path('backend/attachments');
            if (!file_exists($uploadPath2)) {
                mkdir($uploadPath2, 0755, true);
            }
            
            // Save to both locations
            $attachment->move($uploadPath1, $attachmentName);
            copy($uploadPath1 . '/' . $attachmentName, $uploadPath2 . '/' . $attachmentName);
            chmod($uploadPath2 . '/' . $attachmentName, 0644);
            
            $data['attachment'] = $attachmentName;
        }

        LatestUpdate::create($data);

        return redirect()->route('backend.latestupdate.index')->with('success', 'Latest Update created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(LatestUpdate $latestupdate)
    {
        return view('backend.latestupdate.show', compact('latestupdate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LatestUpdate $latestupdate)
    {
        return view('backend.latestUpdate.edit-clean', compact('latestupdate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LatestUpdate $latestupdate)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'detail' => 'nullable|string',
            'attachment' => 'nullable|file|mimes:pdf|max:10240'
        ]);

        $data = $request->all();
        $data['updated_by'] = auth()->user()->name ?? 'Admin';

        // Handle attachment upload
        if ($request->hasFile('attachment')) {
            // Delete old attachment from both locations
            if ($latestupdate->attachment) {
                $oldPath1 = public_path('backend/attachments/' . $latestupdate->attachment);
                if (file_exists($oldPath1)) {
                    unlink($oldPath1);
                }
                $oldPath2 = base_path('backend/attachments/' . $latestupdate->attachment);
                if (file_exists($oldPath2)) {
                    unlink($oldPath2);
                }
            }

            $attachment = $request->file('attachment');
            $attachmentName = time() . '_' . Str::slug($request->title) . '.' . $attachment->getClientOriginalExtension();
            
            // Save to public/backend for Laravel (backward compatibility)
            $uploadPath1 = public_path('backend/attachments');
            if (!file_exists($uploadPath1)) {
                mkdir($uploadPath1, 0755, true);
            }
            
            // Save to base_path backend for direct web access (live server)
            $uploadPath2 = base_path('backend/attachments');
            if (!file_exists($uploadPath2)) {
                mkdir($uploadPath2, 0755, true);
            }
            
            // Save to both locations
            $attachment->move($uploadPath1, $attachmentName);
            copy($uploadPath1 . '/' . $attachmentName, $uploadPath2 . '/' . $attachmentName);
            chmod($uploadPath2 . '/' . $attachmentName, 0644);
            
            $data['attachment'] = $attachmentName;
        } else {
            unset($data['attachment']);
        }

        $latestupdate->update($data);

        return redirect()->route('backend.latestupdate.index')->with('success', 'Latest Update updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LatestUpdate $latestupdate)
    {
        // Delete attachment file from both locations
        if ($latestupdate->attachment) {
            $path1 = public_path('backend/attachments/' . $latestupdate->attachment);
            if (file_exists($path1)) {
                unlink($path1);
            }
            $path2 = base_path('backend/attachments/' . $latestupdate->attachment);
            if (file_exists($path2)) {
                unlink($path2);
            }
        }

        $latestupdate->delete();

        return redirect()->route('backend.latestupdate.index')->with('success', 'Latest Update deleted successfully!');
    }
}
