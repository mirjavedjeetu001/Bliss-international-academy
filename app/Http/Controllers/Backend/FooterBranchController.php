<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\FooterBranch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FooterBranchController extends Controller
{
    public function index()
    {
        $branches = FooterBranch::ordered()->get();
        return view('backend.footer-branches.index', compact('branches'));
    }

    public function create()
    {
        return view('backend.footer-branches.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'map_url' => 'nullable|url',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        FooterBranch::create($request->all());

        return redirect()->route('admin.footer-branches.index')
            ->with('success', 'Branch created successfully.');
    }

    public function show(FooterBranch $footerBranch)
    {
        return view('backend.footer-branches.show', compact('footerBranch'));
    }

    public function edit(FooterBranch $footerBranch)
    {
        return view('backend.footer-branches.edit', compact('footerBranch'));
    }

    public function update(Request $request, FooterBranch $footerBranch)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'map_url' => 'nullable|url',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $footerBranch->update($request->all());

        return redirect()->route('admin.footer-branches.index')
            ->with('success', 'Branch updated successfully.');
    }

    public function destroy(FooterBranch $footerBranch)
    {
        $footerBranch->delete();

        return redirect()->route('admin.footer-branches.index')
            ->with('success', 'Branch deleted successfully.');
    }
}