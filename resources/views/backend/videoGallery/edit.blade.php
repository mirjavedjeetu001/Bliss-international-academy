@extends('master.backend-clean')

@section('title', 'Edit Video')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="section-header">Edit Video</h2>
            <p class="text-muted mb-0">Update video information</p>
        </div>
        <a href="{{ route('backend.videogallery.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Gallery
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('backend.videogallery.update', $videoGallery) }}" method="POST" enctype="multipart/form-data" id="videoForm">
                        @csrf
                        @method('PUT')
                        
                        <!-- Title -->
                        <div class="mb-4">
                            <label for="title" class="form-label">
                                <i class="fas fa-heading me-2"></i>Video Title <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title', $videoGallery->title) }}" 
                                   placeholder="Enter video title"
                                   required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Video Type -->
                        <div class="mb-4">
                            <label for="type" class="form-label">
                                <i class="fas fa-video me-2"></i>Video Type <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('type') is-invalid @enderror" 
                                    id="type" 
                                    name="type" 
                                    required>
                                <option value="">Select Video Type</option>
                                <option value="youtube" {{ old('type', $videoGallery->type) === 'youtube' ? 'selected' : '' }}>
                                    <i class="fab fa-youtube"></i> YouTube
                                </option>
                                <option value="facebook" {{ old('type', $videoGallery->type) === 'facebook' ? 'selected' : '' }}>
                                    <i class="fab fa-facebook"></i> Facebook
                                </option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Select the platform where your video is hosted.
                            </div>
                        </div>

                        <!-- Media Category -->
                        <div class="mb-4">
                            <label for="media_category_id" class="form-label">
                                <i class="fas fa-folder me-2"></i>Category
                            </label>
                            <select class="form-select @error('media_category_id') is-invalid @enderror" 
                                    id="media_category_id" 
                                    name="media_category_id">
                                <option value="">Select Category (Optional)</option>
                                @foreach(\App\Models\MediaCategory::where('type', 'video')->active()->get() as $category)
                                    <option value="{{ $category->id }}" {{ old('media_category_id', $videoGallery->media_category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('media_category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Select a category to organize this video. (Optional)
                            </div>
                        </div>

                        <!-- Video URL -->
                        <div class="mb-4">
                            <label for="url" class="form-label">
                                <i class="fas fa-link me-2"></i>Video URL <span class="text-danger">*</span>
                            </label>
                            <input type="url" 
                                   class="form-control @error('url') is-invalid @enderror" 
                                   id="url" 
                                   name="url" 
                                   value="{{ old('url', $videoGallery->url) }}" 
                                   placeholder="Enter video URL (e.g., https://www.youtube.com/watch?v=...)"
                                   required>
                            @error('url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                <span id="urlHelp">Enter the full URL of your video.</span>
                            </div>
                        </div>

                        <!-- Current Thumbnail -->
                        @if($videoGallery->thumbnail)
                        <div class="mb-4">
                            <label class="form-label">
                                <i class="fas fa-image me-2"></i>Current Thumbnail
                            </label>
                            <div class="d-flex align-items-center">
                                <img src="{{ $videoGallery->thumbnail_url }}" 
                                     alt="{{ $videoGallery->title }}" 
                                     class="img-thumbnail me-3" 
                                     style="width: 100px; height: 100px; object-fit: cover;">
                                <div>
                                    <p class="mb-1"><strong>Current thumbnail</strong></p>
                                    <small class="text-muted">Upload a new image to replace this thumbnail</small>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- New Thumbnail -->
                        <div class="mb-4">
                            <label for="thumbnail" class="form-label">
                                <i class="fas fa-image me-2"></i>{{ $videoGallery->thumbnail ? 'New Thumbnail Image' : 'Thumbnail Image' }}
                            </label>
                            <input type="file" 
                                   class="form-control @error('thumbnail') is-invalid @enderror" 
                                   id="thumbnail" 
                                   name="thumbnail" 
                                   accept="image/*">
                            @error('thumbnail')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Upload a custom thumbnail. Max size: 2MB. Supported formats: JPEG, PNG, JPG, GIF, WebP. (Optional)
                            </div>
                            
                            <!-- Thumbnail Preview -->
                            <div id="thumbnailPreview" class="mt-3" style="display: none;">
                                <img id="previewImg" src="" alt="Preview" class="img-thumbnail" style="max-width: 300px; max-height: 300px;">
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
                                <option value="active" {{ old('status', $videoGallery->status) === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status', $videoGallery->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <i class="fas fa-save me-2"></i>Update Video
                            </button>
                            <a href="{{ route('backend.videogallery.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i>Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Video Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>Video Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <h6 class="alert-heading">
                            <i class="fas fa-lightbulb me-2"></i>Tips for Editing Videos
                        </h6>
                        <ul class="mb-0">
                            <li>Update the title to reflect any changes</li>
                            <li>Ensure the video URL is still accessible</li>
                            <li>Upload a new thumbnail to replace the current one</li>
                            <li>Set status to Active to make it visible</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Current Video Preview -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-play me-2"></i>Current Video Preview
                    </h5>
                </div>
                <div class="card-body">
                    @if($videoGallery->type === 'youtube')
                        <div class="ratio ratio-16x9">
                            <iframe src="{{ $videoGallery->embed_url }}" 
                                    title="{{ $videoGallery->title }}"
                                    allowfullscreen></iframe>
                        </div>
                    @else
                        <div class="text-center">
                            <i class="fab fa-facebook fa-3x text-primary mb-3"></i>
                            <p class="text-muted">Facebook video preview not available</p>
                            <a href="{{ $videoGallery->url }}" target="_blank" class="btn btn-primary btn-sm">
                                <i class="fab fa-facebook me-2"></i>View on Facebook
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Video Details -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info me-2"></i>Video Details
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">ID:</span>
                                <span class="fw-semibold">#{{ $videoGallery->id }}</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Type:</span>
                                <span class="badge bg-{{ $videoGallery->type === 'youtube' ? 'danger' : 'primary' }}">
                                    <i class="fab fa-{{ $videoGallery->type }} me-1"></i>
                                    {{ ucfirst($videoGallery->type) }}
                                </span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Status:</span>
                                <span class="badge bg-{{ $videoGallery->status_badge_color }}">
                                    {{ ucfirst($videoGallery->status) }}
                                </span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Created By:</span>
                                <span class="fw-semibold">{{ $videoGallery->created_by ?? 'N/A' }}</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Modified By:</span>
                                <span class="fw-semibold">{{ $videoGallery->modified_by ?? 'N/A' }}</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Created:</span>
                                <span class="fw-semibold">{{ $videoGallery->created_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Last Updated:</span>
                                <span class="fw-semibold">{{ $videoGallery->updated_at->format('M d, Y') }}</span>
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
    const form = document.getElementById('videoForm');
    const submitBtn = document.getElementById('submitBtn');
    
    form.addEventListener('submit', function() {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Updating...';
    });

    // Thumbnail preview functionality
    const thumbnailInput = document.getElementById('thumbnail');
    const thumbnailPreview = document.getElementById('thumbnailPreview');
    const previewImg = document.getElementById('previewImg');
    
    thumbnailInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                thumbnailPreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            thumbnailPreview.style.display = 'none';
        }
    });

    // Video type change handler
    const typeSelect = document.getElementById('type');
    const urlInput = document.getElementById('url');
    const urlHelp = document.getElementById('urlHelp');

    typeSelect.addEventListener('change', function() {
        const selectedType = this.value;
        
        if (selectedType === 'youtube') {
            urlHelp.textContent = 'Enter the full YouTube URL (e.g., https://www.youtube.com/watch?v=VIDEO_ID)';
            urlInput.placeholder = 'https://www.youtube.com/watch?v=...';
        } else if (selectedType === 'facebook') {
            urlHelp.textContent = 'Enter the full Facebook video URL (e.g., https://www.facebook.com/watch/?v=VIDEO_ID)';
            urlInput.placeholder = 'https://www.facebook.com/watch/?v=...';
        } else {
            urlHelp.textContent = 'Enter the full URL of your video.';
            urlInput.placeholder = 'Enter video URL';
        }
    });

    // Initialize URL help text based on current type
    const currentType = typeSelect.value;
    if (currentType === 'youtube') {
        urlHelp.textContent = 'Enter the full YouTube URL (e.g., https://www.youtube.com/watch?v=VIDEO_ID)';
    } else if (currentType === 'facebook') {
        urlHelp.textContent = 'Enter the full Facebook video URL (e.g., https://www.facebook.com/watch/?v=VIDEO_ID)';
    }
});
</script>
@endsection
