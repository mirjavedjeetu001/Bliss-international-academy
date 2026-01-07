<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Page;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with('children')->whereNull('parent_id')->orderBy('order')->get();
        return view('backend.menus.index', compact('menus'));
    }

    public function create()
    {
        $pages = Page::all();
        $parents = Menu::whereNull('parent_id')->get();
        return view('backend.menus.create', compact('pages', 'parents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'url' => 'nullable',
            'page_id' => 'nullable|exists:pages,id',
            'parent_id' => 'nullable|exists:menus,id',
            'order' => 'nullable|integer',
            'show_in_nav' => 'boolean',
        ]);
        Menu::create($request->all());
        return redirect()->route('admin.menus.index')->with('success', 'Menu item created.');
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $pages = Page::all();
        $parents = Menu::whereNull('parent_id')->where('id', '!=', $id)->get();
        return view('backend.menus.edit', compact('menu', 'pages', 'parents'));
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);
        $request->validate([
            'title' => 'required',
            'url' => 'nullable',
            'page_id' => 'nullable|exists:pages,id',
            'parent_id' => 'nullable|exists:menus,id',
            'order' => 'nullable|integer',
            'show_in_nav' => 'boolean',
        ]);
        $menu->update($request->all());
        return redirect()->route('admin.menus.index')->with('success', 'Menu item updated.');
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();
        return redirect()->route('admin.menus.index')->with('success', 'Menu item deleted.');
    }
}
