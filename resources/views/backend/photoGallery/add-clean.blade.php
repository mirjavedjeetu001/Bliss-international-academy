@extends('master.backend-clean')

@section('title', 'Add New Photo')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="section-header">Add New Photo</h2>
            <p class="text-muted mb-0">Add a new photo to the gallery</p>
        </div>
        <a href="{{ route('backend.photogallery.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Gallery
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('backend.photogallery.store') }}" method="POST" enctype="multipart/form-data" id="photoForm">
                        @csrf
                        
                        <!-- Title -->
                        <div class="mb-4">
                            <label for="title" class="form-label">
                                <i class="fas fa-heading me-2"></i>Photo Title <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title') }}" 
                                   placeholder="Enter photo title"
                                   required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Image -->
                        <div class="mb-4">
                            <label for="image" class="form-label">
                                <i class="fas fa-image me-2"></i>Photo Image <span class="text-danger">*</span>
                            </label>
                            <input type="file" 
                                   class="form-control @error('image') is-invalid @enderror" 
                                   id="image" 
                                   name="image" 
                                   accept="image/*"
                                   required>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Upload a photo. Max size: 2MB. Supported formats: JPEG, PNG, JPG, GIF, WebP.
                            </div>
                            
                            <!-- Image Preview -->
                            <div id="imagePreview" class="mt-3" style="display: none;">
                                <img id="previewImg" src="" alt="Preview" class="img-thumbnail" style="max-width: 300px; max-height: 300px;">
                            </div>
                        </div>

                        <!-- Media Category -->
                        <div class="mb-4">
                            <label for="media_category_id" class="form-label">
                                <i class="fas fa-folder me-2"></i>Category <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('media_category_id') is-invalid @enderror" 
                                    id="media_category_id" 
                                    name="media_category_id" 
                                    required>
                                <option value="">Select Category</option>
                                @foreach($mediaCategories as $category)
                                    <option value="{{ $category->id }}" {{ old('media_category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('media_category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Select a photo category for organizing this image.
                            </div>
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
                                <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <i class="fas fa-save me-2"></i>Add Photo
                            </button>
                            <a href="{{ route('backend.photogallery.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i>Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Photo Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>Photo Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <h6 class="alert-heading">
                            <i class="fas fa-lightbulb me-2"></i>Tips for Adding Photos
                        </h6>
                        <ul class="mb-0">
                            <li>Use descriptive titles for easy identification</li>
                            <li>Choose high-quality images for better display</li>
                            <li>Select appropriate category for organization</li>
                            <li>Set status to Active to make it visible</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Available Categories -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-folder me-2"></i>Available Categories
                    </h5>
                </div>
                <div class="card-body">
                    @if($mediaCategories->count() > 0)
                        <div class="row g-2">
                            @foreach($mediaCategories as $category)
                                <div class="col-12">
                                    <div class="d-flex align-items-center p-2 border rounded">
                                        @if($category->image)
                                            <img src="{{ $category->image_url }}" 
                                                 alt="{{ $category->name }}" 
                                                 class="img-thumbnail me-2" 
                                                 style="width: 30px; height: 30px; object-fit: cover;">
                                        @else
                                            <i class="fas fa-folder text-primary me-2"></i>
                                        @endif
                                        <div>
                                            <small class="fw-semibold">{{ $category->name }}</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-3">
                            <i class="fas fa-folder-open fa-2x text-muted mb-2"></i>
                            <p class="text-muted mb-0">No photo categories available</p>
                            <small class="text-muted">Create categories first to organize photos</small>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form submission with loading state
    const form = document.getElementById('photoForm');
    const submitBtn = document.getElementById('submitBtn');
    
    form.addEventListener('submit', function() {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Adding...';
    });

    // Auto-focus title field
    const titleField = document.getElementById('title');
    if (titleField && !titleField.value) {
        titleField.focus();
    }

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
