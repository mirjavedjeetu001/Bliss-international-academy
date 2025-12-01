@extends('master.backend-clean')

@section('title', 'Edit Photo')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="section-header">Edit Photo</h2>
            <p class="text-muted mb-0">Update photo information</p>
        </div>
        <a href="{{ route('backend.photogallery.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Gallery
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('backend.photogallery.update', $photoGallery) }}" method="POST" enctype="multipart/form-data" id="photoForm">
                        @csrf
                        @method('PUT')
                        
                        <!-- Title -->
                        <div class="mb-4">
                            <label for="title" class="form-label">
                                <i class="fas fa-heading me-2"></i>Photo Title <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title', $photoGallery->title) }}" 
                                   placeholder="Enter photo title"
                                   required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Current Image -->
                        @if($photoGallery->image)
                            <div class="mb-4">
                                <label class="form-label">
                                    <i class="fas fa-image me-2"></i>Current Image
                                </label>
                                <div class="d-flex align-items-center gap-3">
                                    <img src="{{ $photoGallery->image_url }}" 
                                         alt="{{ $photoGallery->title }}" 
                                         class="img-thumbnail" 
                                         style="width: 150px; height: 150px; object-fit: cover;"
                                         data-bs-toggle="modal" 
                                         data-bs-target="#currentImageModal">
                                    <div>
                                        <p class="mb-1"><strong>Current Image:</strong></p>
                                        <small class="text-muted">{{ $photoGallery->image }}</small>
                                        <br>
                                        <small class="text-muted">Uploaded: {{ $photoGallery->created_at->format('M d, Y') }}</small>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- New Image -->
                        <div class="mb-4">
                            <label for="image" class="form-label">
                                <i class="fas fa-image me-2"></i>{{ $photoGallery->image ? 'Replace Image' : 'Photo Image' }}
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
                                {{ $photoGallery->image ? 'Upload a new image to replace the current one.' : 'Upload a photo.' }} Max size: 2MB.
                            </div>
                            
                            <!-- New Image Preview -->
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
                                    <option value="{{ $category->id }}" 
                                            {{ old('media_category_id', $photoGallery->media_category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('media_category_id')
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
                                <option value="active" {{ old('status', $photoGallery->status) === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status', $photoGallery->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <i class="fas fa-save me-2"></i>Update Photo
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
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="d-flex align-items-center p-3 border rounded">
                                <div class="flex-shrink-0 me-3">
                                    <i class="fas fa-id-card fa-2x text-primary"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Photo ID</h6>
                                    <p class="mb-0 fw-semibold">#{{ $photoGallery->id }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items-center p-3 border rounded">
                                <div class="flex-shrink-0 me-3">
                                    <i class="fas fa-user fa-2x text-info"></i>
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
                                    <i class="fas fa-calendar fa-2x text-success"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Created Date</h6>
                                    <p class="mb-0 fw-semibold">{{ $photoGallery->created_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items-center p-3 border rounded">
                                <div class="flex-shrink-0 me-3">
                                    <i class="fas fa-edit fa-2x text-warning"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Last Updated</h6>
                                    <p class="mb-0 fw-semibold">{{ $photoGallery->updated_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                        </div>
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
                                    <div class="d-flex align-items-center p-2 border rounded {{ $category->id == $photoGallery->media_category_id ? 'bg-light' : '' }}">
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
                                            @if($category->id == $photoGallery->media_category_id)
                                                <br><small class="text-success">Current Category</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-3">
                            <i class="fas fa-folder-open fa-2x text-muted mb-2"></i>
                            <p class="text-muted mb-0">No photo categories available</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Current Image Modal -->
<div class="modal fade" id="currentImageModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $photoGallery->title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img src="{{ $photoGallery->image_url }}" class="img-fluid" alt="{{ $photoGallery->title }}">
            </div>
            <div class="modal-footer">
                <a href="{{ $photoGallery->image_url }}" 
                   class="btn btn-primary" 
                   download="{{ $photoGallery->title }}">
                    <i class="fas fa-download me-2"></i>Download
                </a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
