<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\PastEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PastEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pastevents = PastEvent::latest()->paginate(10);
        return view('backend.pastEvent.index-clean', compact('pastevents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pastEvent.add-clean');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'detail' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();
        $data['created_by'] = auth()->user()->name ?? 'Admin';

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('backend/assets/images/events'), $imageName);
            $data['image'] = $imageName;
        }

        PastEvent::create($data);

        return redirect()->route('backend.pastevent.index')->with('success', 'Past Event created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(PastEvent $pastevent)
    {
        return view('backend.pastEvent.show', compact('pastevent'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PastEvent $pastevent)
    {
        return view('backend.pastEvent.edit-clean', compact('pastevent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PastEvent $pastevent)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'detail' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();
        $data['updated_by'] = auth()->user()->name ?? 'Admin';

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($pastevent->image && file_exists(public_path('backend/assets/images/events/' . $pastevent->image))) {
                unlink(public_path('backend/assets/images/events/' . $pastevent->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('backend/assets/images/events'), $imageName);
            $data['image'] = $imageName;
        } else {
            unset($data['image']);
        }

        $pastevent->update($data);

        return redirect()->route('backend.pastevent.index')->with('success', 'Past Event updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PastEvent $pastevent)
    {
        // Delete image file
        if ($pastevent->image && file_exists(public_path('backend/assets/images/events/' . $pastevent->image))) {
            unlink(public_path('backend/assets/images/events/' . $pastevent->image));
        }

        $pastevent->delete();

        return redirect()->route('backend.pastevent.index')->with('success', 'Past Event deleted successfully!');
    }
}
