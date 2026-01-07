<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Storage;

class SiteSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return redirect()->route('admin.site-settings.edit', 1);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $setting = SiteSetting::firstOrCreate([]);
        return view('backend.site-settings.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $setting = SiteSetting::findOrFail($id);

        $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'facebook_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string',
            'contact_address' => 'nullable|string',
            'footer_text' => 'nullable|string',
            'footer_copyright' => 'nullable|string',
            'footer_registration_number' => 'nullable|string',
            'footer_important_links_title' => 'nullable|string',
            'footer_useful_links_title' => 'nullable|string',
            'footer_satkhira_campus_title' => 'nullable|string',
            'footer_debhata_campus_title' => 'nullable|string',
            'footer_important_links' => 'nullable|string',
            'footer_useful_links' => 'nullable|string',
            'footer_satkhira_info' => 'nullable|string',
            'footer_debhata_info' => 'nullable|string',
        ]);

        $data = $request->except('logo');

        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($setting->logo_path && Storage::disk('public')->exists($setting->logo_path)) {
                Storage::disk('public')->delete($setting->logo_path);
            }
            // Ensure logos directory exists
            $logosPath = storage_path('app/public/logos');
            if (!file_exists($logosPath)) {
                mkdir($logosPath, 0755, true);
            }
            // Store new logo
            $data['logo_path'] = $request->file('logo')->store('logos', 'public');
        }

        $setting->update($data);

        return redirect()->route('admin.site-settings.edit', $id)->with('success', 'Site settings updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
