@extends('master.backend-clean')

@section('title', 'Add New Video')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="section-header">Add New Video</h2>
            <p class="text-muted mb-0">Add a new video to the gallery</p>
        </div>
        <a href="{{ route('backend.videogallery.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Gallery
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('backend.videogallery.store') }}" method="POST" enctype="multipart/form-data" id="videoForm">
                        @csrf
                        
                        <!-- Title -->
                        <div class="mb-4">
                            <label for="title" class="form-label">
                                <i class="fas fa-heading me-2"></i>Video Title <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title') }}" 
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
                                <option value="youtube" {{ old('type') === 'youtube' ? 'selected' : '' }}>
                                    <i class="fab fa-youtube"></i> YouTube
                                </option>
                                <option value="facebook" {{ old('type') === 'facebook' ? 'selected' : '' }}>
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
                                   value="{{ old('url') }}" 
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

                        <!-- Thumbnail -->
                        <div class="mb-4">
                            <label for="thumbnail" class="form-label">
                                <i class="fas fa-image me-2"></i>Thumbnail Image
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
                                <i class="fas fa-save me-2"></i>Add Video
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
                            <i class="fas fa-lightbulb me-2"></i>Tips for Adding Videos
                        </h6>
                        <ul class="mb-0">
                            <li>Use descriptive titles for easy identification</li>
                            <li>Ensure the video URL is publicly accessible</li>
                            <li>Upload a custom thumbnail for better presentation</li>
                            <li>Set status to Active to make it visible</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- URL Examples -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-link me-2"></i>URL Examples
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h6 class="text-danger">
                            <i class="fab fa-youtube me-1"></i>YouTube
                        </h6>
                        <small class="text-muted">
                            https://www.youtube.com/watch?v=VIDEO_ID<br>
                            https://youtu.be/VIDEO_ID
                        </small>
                    </div>
                    <div>
                        <h6 class="text-primary">
                            <i class="fab fa-facebook me-1"></i>Facebook
                        </h6>
                        <small class="text-muted">
                            https://www.facebook.com/watch/?v=VIDEO_ID<br>
                            https://fb.watch/VIDEO_ID
                        </small>
                    </div>
                </div>
            </div>

            <!-- Video Preview -->
            <div class="card" id="videoPreviewCard" style="display: none;">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-play me-2"></i>Video Preview
                    </h5>
                </div>
                <div class="card-body">
                    <div id="videoPreview"></div>
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
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Adding...';
    });

    // Auto-focus title field
    const titleField = document.getElementById('title');
    if (titleField && !titleField.value) {
        titleField.focus();
    }

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
    const videoPreviewCard = document.getElementById('videoPreviewCard');
    const videoPreview = document.getElementById('videoPreview');

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
        
        // Clear video preview
        videoPreviewCard.style.display = 'none';
        videoPreview.innerHTML = '';
    });

    // URL change handler for preview
    urlInput.addEventListener('input', function() {
        const url = this.value;
        const type = typeSelect.value;
        
        if (url && type === 'youtube') {
            // Extract YouTube video ID
            const videoId = extractYouTubeVideoId(url);
            if (videoId) {
                showVideoPreview('youtube', videoId);
            } else {
                hideVideoPreview();
            }
        } else if (url && type === 'facebook') {
            // For Facebook, just show the URL
            showVideoPreview('facebook', url);
        } else {
            hideVideoPreview();
        }
    });

    function extractYouTubeVideoId(url) {
        const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
        const match = url.match(regExp);
        return (match && match[2].length === 11) ? match[2] : null;
    }

    function showVideoPreview(type, identifier) {
        if (type === 'youtube') {
            videoPreview.innerHTML = `
                <div class="ratio ratio-16x9">
                    <iframe src="https://www.youtube.com/embed/${identifier}" 
                            title="Video Preview"
                            allowfullscreen></iframe>
                </div>
            `;
        } else if (type === 'facebook') {
            videoPreview.innerHTML = `
                <div class="text-center">
                    <i class="fab fa-facebook fa-3x text-primary mb-3"></i>
                    <p class="text-muted">Facebook video preview not available</p>
                    <a href="${identifier}" target="_blank" class="btn btn-primary btn-sm">
                        <i class="fab fa-facebook me-2"></i>View on Facebook
                    </a>
                </div>
            `;
        }
        videoPreviewCard.style.display = 'block';
    }

    function hideVideoPreview() {
        videoPreviewCard.style.display = 'none';
        videoPreview.innerHTML = '';
    }
});
</script>
@endsection
