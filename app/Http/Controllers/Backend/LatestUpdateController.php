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
            $attachment->move(public_path('backend/attachments'), $attachmentName);
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
            // Delete old attachment
            if ($latestupdate->attachment && file_exists(public_path('backend/attachments/' . $latestupdate->attachment))) {
                unlink(public_path('backend/attachments/' . $latestupdate->attachment));
            }

            $attachment = $request->file('attachment');
            $attachmentName = time() . '_' . Str::slug($request->title) . '.' . $attachment->getClientOriginalExtension();
            $attachment->move(public_path('backend/attachments'), $attachmentName);
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
        // Delete attachment file
        if ($latestupdate->attachment && file_exists(public_path('backend/attachments/' . $latestupdate->attachment))) {
            unlink(public_path('backend/attachments/' . $latestupdate->attachment));
        }

        $latestupdate->delete();

        return redirect()->route('backend.latestupdate.index')->with('success', 'Latest Update deleted successfully!');
    }
}
