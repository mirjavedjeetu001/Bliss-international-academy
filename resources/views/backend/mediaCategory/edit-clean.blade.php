@extends('master.backend-clean')

@section('title', 'Edit Media Category')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="section-header">Edit Media Category</h2>
            <p class="text-muted mb-0">Update media category information</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('backend.mediacategory.show', $mediaCategory) }}" class="btn btn-outline-info">
                <i class="fas fa-eye me-2"></i>View Category
            </a>
            <a href="{{ route('backend.mediacategory.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to Categories
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('backend.mediacategory.update', $mediaCategory) }}" method="POST" enctype="multipart/form-data" id="categoryForm">
                        @csrf
                        @method('PUT')
                        
                        <!-- Name -->
                        <div class="mb-4">
                            <label for="name" class="form-label">
                                <i class="fas fa-tag me-2"></i>Category Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $mediaCategory->name) }}" 
                                   placeholder="Enter category name"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Current Image -->
                        @if($mediaCategory->image)
                            <div class="mb-4">
                                <label class="form-label">
                                    <i class="fas fa-image me-2"></i>Current Image
                                </label>
                                <div class="d-flex align-items-center gap-3">
                                    <img src="{{ $mediaCategory->image_url }}" 
                                         alt="{{ $mediaCategory->name }}" 
                                         class="img-thumbnail" 
                                         style="width: 100px; height: 100px; object-fit: cover;">
                                    <div>
                                        <p class="mb-1"><strong>Current Image:</strong></p>
                                        <small class="text-muted">{{ $mediaCategory->image }}</small>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- New Image -->
                        <div class="mb-4">
                            <label for="image" class="form-label">
                                <i class="fas fa-image me-2"></i>{{ $mediaCategory->image ? 'Replace Image' : 'Category Image' }}
                            </label>
                            <input type="file" 
                                   class="form-control @error('image') is-invalid @enderror" 
                                   id="image" 
                                   name="image" 
                                   accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                {{ $mediaCategory->image ? 'Upload a new image to replace the current one.' : 'Upload an image for this category.' }} Max size: 2MB.
                            </div>
                            
                            <!-- New Image Preview -->
                            <div id="imagePreview" class="mt-3" style="display: none;">
                                <img id="previewImg" src="" alt="Preview" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                            </div>
                        </div>

                        <!-- Type -->
                        <div class="mb-4">
                            <label for="type" class="form-label">
                                <i class="fas fa-layer-group me-2"></i>Media Type <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('type') is-invalid @enderror" 
                                    id="type" 
                                    name="type" 
                                    required>
                                <option value="">Select Media Type</option>
                                <option value="photo" {{ old('type', $mediaCategory->type) === 'photo' ? 'selected' : '' }}>
                                    Photo
                                </option>
                                <option value="video" {{ old('type', $mediaCategory->type) === 'video' ? 'selected' : '' }}>
                                    Video
                                </option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <label for="status" class="form-label">
                                <i class="fas fa-toggle-on me-2"></i>Status <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('status') is-invalid @enderror" 
                                    id="status" 
                                    name="status" 
                                    required>
                                <option value="">Select Status</option>
                                <option value="active" {{ old('status', $mediaCategory->status) === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status', $mediaCategory->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <i class="fas fa-save me-2"></i>Update Category
                            </button>
                            <a href="{{ route('backend.mediacategory.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i>Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Category Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>Category Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold">Category ID</label>
                            <p class="mb-0">{{ $mediaCategory->id }}</p>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Created By</label>
                            <p class="mb-0">{{ $mediaCategory->created_by ?? 'N/A' }}</p>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Last Updated By</label>
                            <p class="mb-0">{{ $mediaCategory->updated_by ?? 'N/A' }}</p>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Created</label>
                            <p class="mb-0">{{ $mediaCategory->created_at->format('M d, Y \a\t h:i A') }}</p>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Last Updated</label>
                            <p class="mb-0">{{ $mediaCategory->updated_at->format('M d, Y \a\t h:i A') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Current Status -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-bar me-2"></i>Current Status
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3 text-center">
                        <div class="col-6">
                            <div class="border rounded p-3">
                                <i class="fas fa-{{ $mediaCategory->type === 'photo' ? 'camera' : 'video' }} fa-2x text-{{ $mediaCategory->type_badge_color }} mb-2"></i>
                                <h6 class="mb-0">{{ ucfirst($mediaCategory->type) }}</h6>
                                <small class="text-muted">Type</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="border rounded p-3">
                                <i class="fas fa-toggle-{{ $mediaCategory->status === 'active' ? 'on' : 'off' }} fa-2x text-{{ $mediaCategory->status_badge_color }} mb-2"></i>
                                <h6 class="mb-0">{{ ucfirst($mediaCategory->status) }}</h6>
                                <small class="text-muted">Status</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form submission with loading state
    const form = document.getElementById('categoryForm');
    const submitBtn = document.getElementById('submitBtn');
    
    form.addEventListener('submit', function() {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Updating...';
    });

    // Image preview functionality
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');
    
    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                imagePreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.style.display = 'none';
        }
    });
});
</script>
@endsection
