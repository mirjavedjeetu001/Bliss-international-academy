@extends('master.backend-clean')

@section('title', 'Add Menu Item')

@section('content')
<div class="container mt-4">
    <h2>Add Menu Item</h2>
    <form action="{{ route('admin.menus.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="url" class="form-label">URL (optional)</label>
            <input type="text" class="form-control" id="url" name="url">
        </div>
        <div class="mb-3">
            <label for="page_id" class="form-label">Page (optional)</label>
            <select class="form-control" id="page_id" name="page_id">
                <option value="">-- None --</option>
                @foreach($pages as $page)
                    <option value="{{ $page->id }}">{{ $page->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="parent_id" class="form-label">Parent Menu (optional)</label>
            <select class="form-control" id="parent_id" name="parent_id">
                <option value="">-- None --</option>
                @foreach($parents as $parent)
                    <option value="{{ $parent->id }}">{{ $parent->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="order" class="form-label">Order</label>
            <input type="number" class="form-control" id="order" name="order" value="0">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="show_in_nav" name="show_in_nav" value="1" checked>
            <label class="form-check-label" for="show_in_nav">Show in Navbar</label>
        </div>
        <button type="submit" class="btn btn-primary">Add Menu</button>
        <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
