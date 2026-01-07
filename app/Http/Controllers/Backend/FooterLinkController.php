<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\FooterLink;
use Illuminate\Http\Request;

class FooterLinkController extends Controller
{
    public function index()
    {
        $links = FooterLink::ordered()->get();
        return view('backend.footer-links.index', compact('links'));
    }

    public function create()
    {
        return view('backend.footer-links.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
            'open_in_new_tab' => 'boolean',
        ]);

        FooterLink::create($request->all());

        return redirect()->route('admin.footer-links.index')
            ->with('success', 'Link created successfully.');
    }

    public function show(FooterLink $footerLink)
    {
        return view('backend.footer-links.show', compact('footerLink'));
    }

    public function edit(FooterLink $footerLink)
    {
        return view('backend.footer-links.edit', compact('footerLink'));
    }

    public function update(Request $request, FooterLink $footerLink)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
            'open_in_new_tab' => 'boolean',
        ]);

        $footerLink->update($request->all());

        return redirect()->route('admin.footer-links.index')
            ->with('success', 'Link updated successfully.');
    }

    public function destroy(FooterLink $footerLink)
    {
        $footerLink->delete();

        return redirect()->route('admin.footer-links.index')
            ->with('success', 'Link deleted successfully.');
    }
}