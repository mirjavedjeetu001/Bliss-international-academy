@extends('master.backend-clean')

@section('title', 'Edit Menu Item')

@section('content')
<div class="container mt-4">
    <h2>Edit Menu Item</h2>
    <form action="{{ route('admin.menus.update', $menu->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $menu->title }}" required>
        </div>
        <div class="mb-3">
            <label for="url" class="form-label">URL (optional)</label>
            <input type="text" class="form-control" id="url" name="url" value="{{ $menu->url }}">
        </div>
        <div class="mb-3">
            <label for="page_id" class="form-label">Page (optional)</label>
            <select class="form-control" id="page_id" name="page_id">
                <option value="">-- None --</option>
                @foreach($pages as $page)
                    <option value="{{ $page->id }}" @if($menu->page_id == $page->id) selected @endif>{{ $page->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="parent_id" class="form-label">Parent Menu (optional)</label>
            <select class="form-control" id="parent_id" name="parent_id">
                <option value="">-- None --</option>
                @foreach($parents as $parent)
                    <option value="{{ $parent->id }}" @if($menu->parent_id == $parent->id) selected @endif>{{ $parent->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="order" class="form-label">Order</label>
            <input type="number" class="form-control" id="order" name="order" value="{{ $menu->order }}">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="show_in_nav" name="show_in_nav" value="1" @if($menu->show_in_nav) checked @endif>
            <label class="form-check-label" for="show_in_nav">Show in Navbar</label>
        </div>
        <button type="submit" class="btn btn-primary">Update Menu</button>
        <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
