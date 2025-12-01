@extends('master.backend-clean')

@section('title', 'Add New Past Event - Bliss International Academy')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Add New Past Event</h1>
            <p class="text-muted">Create a new past event to showcase activities</p>
        </div>
        <div>
            <a href="{{ route('backend.pastevent.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to Past Events
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Past Event Form -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Past Event Information</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('backend.pastevent.store') }}" method="POST" enctype="multipart/form-data" id="eventForm">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-4">
                                    <label for="title" class="form-label fw-semibold">
                                        <i class="fas fa-heading text-primary me-2"></i>Event Title
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control form-control-lg @error('title') is-invalid @enderror" 
                                           id="title" 
                                           name="title" 
                                           value="{{ old('title') }}" 
                                           placeholder="Enter event title"
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
                                        <i class="fas fa-align-left text-primary me-2"></i>Event Description
                                    </label>
                                    <textarea class="form-control @error('detail') is-invalid @enderror" 
                                              id="detail" 
                                              name="detail" 
                                              rows="6"
                                              placeholder="Enter detailed description of the event">{{ old('detail') }}</textarea>
                                    @error('detail')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-4">
                                    <label for="image" class="form-label fw-semibold">
                                        <i class="fas fa-image text-primary me-2"></i>Event Image
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
                                    <a href="{{ route('backend.pastevent.index') }}" class="btn btn-outline-secondary btn-lg">
                                        <i class="fas fa-times me-2"></i>Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-save me-2"></i>Create Past Event
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
                        <i class="fas fa-calendar-alt fa-3x text-muted mb-3"></i>
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
                            Use high-quality images from the event
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            Write detailed descriptions for better engagement
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            Include event highlights and achievements
                        </li>
                        <li class="mb-0">
                            <i class="fas fa-check text-success me-2"></i>
                            Keep titles descriptive and engaging
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Event Statistics -->
            <div class="card shadow mt-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Event Statistics</h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="h5 mb-0 text-primary">{{ \App\Models\Backend\PastEvent::count() }}</div>
                            <small class="text-muted">Total Events</small>
                        </div>
                        <div class="col-6">
                            <div class="h5 mb-0 text-success">{{ \App\Models\Backend\PastEvent::where('created_at', '>=', now()->subMonth())->count() }}</div>
                            <small class="text-muted">This Month</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.form-control-lg {
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
    const form = document.getElementById('eventForm');
    form.addEventListener('submit', function(e) {
        const title = document.getElementById('title').value.trim();
        const image = document.getElementById('image').files[0];

        if (!title) {
            e.preventDefault();
            alert('Please enter a title for the past event.');
            return;
        }

        if (!image) {
            e.preventDefault();
            alert('Please select an image for the past event.');
            return;
        }
    });
});
</script>
@endsection
