@extends('master.backend-clean')

@section('title', 'Edit Footer Link')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Edit Footer Link</h2>
        <a href="{{ route('admin.footer-links.index') }}" class="btn btn-secondary">Back to List</a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.footer-links.update', $footerLink->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $footerLink->title) }}" required>
                </div>

                <div class="mb-3">
                    <label for="url" class="form-label">URL <span class="text-danger">*</span></label>
                    <input type="url" class="form-control" id="url" name="url" value="{{ old('url', $footerLink->url) }}" required>
                </div>

                <div class="mb-3">
                    <label for="order" class="form-label">Order</label>
                    <input type="number" class="form-control" id="order" name="order" value="{{ old('order', $footerLink->order) }}" min="0">
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $footerLink->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">
                            Active
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update Link</button>
            </form>
        </div>
    </div>
</div>
@endsection