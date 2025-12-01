@extends('master.backend-clean')

@section('title', 'Photo Details')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="section-header">Photo Details</h2>
            <p class="text-muted mb-0">View photo information and details</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('backend.photogallery.edit', $photoGallery) }}" class="btn btn-primary">
                <i class="fas fa-edit me-2"></i>Edit Photo
            </a>
            <a href="{{ route('backend.photogallery.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to Gallery
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Photo Display -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-image me-2"></i>{{ $photoGallery->title }}
                    </h5>
                </div>
                <div class="card-body text-center">
                    <img src="{{ $photoGallery->image_url }}" 
                         alt="{{ $photoGallery->title }}" 
                         class="img-fluid rounded shadow" 
                         style="max-height: 500px; object-fit: contain;">
                    <div class="mt-3">
                        <a href="{{ $photoGallery->image_url }}" 
                           class="btn btn-primary" 
                           download="{{ $photoGallery->title }}">
                            <i class="fas fa-download me-2"></i>Download Image
                        </a>
                    </div>
                </div>
            </div>

            <!-- Photo Details -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>Photo Details
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center p-3 border rounded">
                                <div class="flex-shrink-0 me-3">
                                    <i class="fas fa-heading fa-2x text-primary"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Title</h6>
                                    <p class="mb-0 fw-semibold">{{ $photoGallery->title }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center p-3 border rounded">
                                <div class="flex-shrink-0 me-3">
                                    <i class="fas fa-folder fa-2x text-info"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Category</h6>
                                    <p class="mb-0 fw-semibold">{{ $photoGallery->mediaCategory->name }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center p-3 border rounded">
                                <div class="flex-shrink-0 me-3">
                                    <i class="fas fa-toggle-on fa-2x text-{{ $photoGallery->status_badge_color }}"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Status</h6>
                                    <p class="mb-0 fw-semibold">
                                        <span class="badge bg-{{ $photoGallery->status_badge_color }}">
                                            {{ ucfirst($photoGallery->status) }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center p-3 border rounded">
                                <div class="flex-shrink-0 me-3">
                                    <i class="fas fa-id-card fa-2x text-secondary"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Photo ID</h6>
                                    <p class="mb-0 fw-semibold">#{{ $photoGallery->id }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- File Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-file-image me-2"></i>File Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="d-flex align-items-center p-3 border rounded">
                                <div class="flex-shrink-0 me-3">
                                    <i class="fas fa-file fa-2x text-primary"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Filename</h6>
                                    <p class="mb-0 fw-semibold text-break">{{ $photoGallery->image }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items-center p-3 border rounded">
                                <div class="flex-shrink-0 me-3">
                                    <i class="fas fa-link fa-2x text-info"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Image URL</h6>
                                    <p class="mb-0">
                                        <a href="{{ $photoGallery->image_url }}" target="_blank" class="text-break">
                                            {{ $photoGallery->image_url }}
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Creation Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-user-clock me-2"></i>Creation Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="d-flex align-items-center p-3 border rounded">
                                <div class="flex-shrink-0 me-3">
                                    <i class="fas fa-user fa-2x text-success"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Created By</h6>
                                    <p class="mb-0 fw-semibold">{{ $photoGallery->created_by ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items-center p-3 border rounded">
                                <div class="flex-shrink-0 me-3">
                                    <i class="fas fa-calendar-plus fa-2x text-primary"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Created Date</h6>
                                    <p class="mb-0 fw-semibold">{{ $photoGallery->created_at->format('M d, Y') }}</p>
                                    <small class="text-muted">{{ $photoGallery->created_at->format('h:i A') }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items-center p-3 border rounded">
                                <div class="flex-shrink-0 me-3">
                                    <i class="fas fa-user-edit fa-2x text-warning"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Updated By</h6>
                                    <p class="mb-0 fw-semibold">{{ $photoGallery->updated_by ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items-center p-3 border rounded">
                                <div class="flex-shrink-0 me-3">
                                    <i class="fas fa-calendar-check fa-2x text-info"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Last Updated</h6>
                                    <p class="mb-0 fw-semibold">{{ $photoGallery->updated_at->format('M d, Y') }}</p>
                                    <small class="text-muted">{{ $photoGallery->updated_at->format('h:i A') }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Category Information -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-folder me-2"></i>Category Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center p-3 border rounded">
                        <div class="flex-shrink-0 me-3">
                            @if($photoGallery->mediaCategory->image)
                                <img src="{{ $photoGallery->mediaCategory->image_url }}" 
                                     alt="{{ $photoGallery->mediaCategory->name }}" 
                                     class="img-thumbnail" 
                                     style="width: 50px; height: 50px; object-fit: cover;">
                            @else
                                <i class="fas fa-folder fa-2x text-primary"></i>
                            @endif
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-1">Category Name</h6>
                            <p class="mb-0 fw-semibold">{{ $photoGallery->mediaCategory->name }}</p>
                            <small class="text-muted">Type: {{ ucfirst($photoGallery->mediaCategory->type) }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
