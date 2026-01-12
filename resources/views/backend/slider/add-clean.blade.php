@extends('master.backend-clean')

@section('title', 'Add New Slider - Katunia Rajbari College')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Add New Slider</h1>
            <p class="text-muted">Create a new slider for the homepage</p>
        </div>
        <div>
            <a href="{{ route('backend.slider.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to Sliders
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Slider Form -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Slider Information</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('backend.slider.store') }}" method="POST" enctype="multipart/form-data" id="sliderForm">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-4">
                                    <label for="title" class="form-label fw-semibold">
                                        <i class="fas fa-heading text-primary me-2"></i>Title
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control form-control-lg @error('title') is-invalid @enderror" 
                                           id="title" 
                                           name="title" 
                                           value="{{ old('title') }}" 
                                           placeholder="Enter slider title"
                                           required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-4">
                                    <label for="detail" class="form-label fw-semibold">
                                        <i class="fas fa-align-left text-primary me-2"></i>Description
                                    </label>
                                    <textarea class="form-control @error('detail') is-invalid @enderror" 
                                              id="detail" 
                                              name="detail" 
                                              rows="5"
                                              placeholder="Enter slider description">{{ old('detail') }}</textarea>
                                    @error('detail')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="status" class="form-label fw-semibold">
                                        <i class="fas fa-toggle-on text-primary me-2"></i>Status
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select form-select-lg @error('status') is-invalid @enderror" 
                                            id="status" 
                                            name="status" 
                                            required>
                                        <option value="">Select Status</option>
                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>
                                            <i class="fas fa-check-circle text-success me-2"></i>Active
                                        </option>
                                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                            <i class="fas fa-pause-circle text-warning me-2"></i>Inactive
                                        </option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="image" class="form-label fw-semibold">
                                        <i class="fas fa-image text-primary me-2"></i>Slider Image
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="file" 
                                           class="form-control form-control-lg @error('image') is-invalid @enderror" 
                                           id="image" 
                                           name="image" 
                                           accept="image/*" 
                                           required>
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Supported formats: JPEG, PNG, JPG, GIF. Max size: 2MB
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-end gap-3">
                                    <a href="{{ route('backend.slider.index') }}" class="btn btn-outline-secondary btn-lg">
                                        <i class="fas fa-times me-2"></i>Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-save me-2"></i>Create Slider
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <!-- Image Preview -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Image Preview</h6>
                </div>
                <div class="card-body">
                    <div id="image-preview" class="text-center" style="display: none;">
                        <img id="preview-img" src="" alt="Preview" class="img-fluid rounded shadow">
                        <div class="mt-3">
                            <small class="text-muted">Image Preview</small>
                        </div>
                    </div>
                    <div id="no-image" class="text-center py-5">
                        <i class="fas fa-image fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No image selected</p>
                        <small class="text-muted">Select an image to see preview</small>
                    </div>
                </div>
            </div>

            <!-- Form Tips -->
            <div class="card shadow mt-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tips</h6>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            Use high-quality images for better display
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            Recommended aspect ratio: 16:9
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            Keep titles concise and descriptive
                        </li>
                        <li class="mb-0">
                            <i class="fas fa-check text-success me-2"></i>
                            Set status to "Active" to display on homepage
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.form-control-lg, .form-select-lg {
    padding: 0.75rem 1rem;
    font-size: 1rem;
}

.shadow {
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15) !important;
}

.form-label {
    color: #5a5c69;
    font-weight: 600;
}

#preview-img {
    max-height: 300px;
    width: 100%;
    object-fit: cover;
}

.btn-lg {
    padding: 0.75rem 1.5rem;
    font-size: 1rem;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('image');
    const preview = document.getElementById('image-preview');
    const previewImg = document.getElementById('preview-img');
    const noImage = document.getElementById('no-image');

    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.style.display = 'block';
                noImage.style.display = 'none';
            };
            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none';
            noImage.style.display = 'block';
        }
    });

    // Form validation
    const form = document.getElementById('sliderForm');
    form.addEventListener('submit', function(e) {
        const title = document.getElementById('title').value.trim();
        const status = document.getElementById('status').value;
        const image = document.getElementById('image').files[0];

        if (!title) {
            e.preventDefault();
            alert('Please enter a title for the slider.');
            return;
        }

        if (!status) {
            e.preventDefault();
            alert('Please select a status for the slider.');
            return;
        }

        if (!image) {
            e.preventDefault();
            alert('Please select an image for the slider.');
            return;
        }
    });
});
</script>
@endsection
