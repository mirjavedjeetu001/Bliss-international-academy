@extends('master.backend-clean')

@section('title', 'Edit Past Event - Bliss International Academy')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Edit Past Event</h1>
            <p class="text-muted">Update past event information and image</p>
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
                    <h6 class="m-0 font-weight-bold text-primary">Edit Past Event Information</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('backend.pastevent.update', $pastevent) }}" method="POST" enctype="multipart/form-data" id="eventForm">
                        @csrf
                        @method('PUT')
                        
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
                                           value="{{ old('title', $pastevent->title) }}" 
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
                                              placeholder="Enter detailed description of the event">{{ old('detail', $pastevent->detail) }}</textarea>
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
                                        <i class="fas fa-image text-primary me-2"></i>New Event Image
                                    </label>
                                    <input type="file" 
                                           class="form-control form-control-lg @error('image') is-invalid @enderror" 
                                           id="image" 
                                           name="image" 
                                           accept="image/*">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Leave empty to keep current image. Supported formats: JPEG, PNG, JPG, GIF. Max size: 2MB
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
                                        <i class="fas fa-save me-2"></i>Update Past Event
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <!-- Current Image -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Current Image</h6>
                </div>
                <div class="card-body">
                    @if($pastevent->image)
                        <div class="text-center">
                            <img src="{{ asset('backend/assets/images/events/' . $pastevent->image) }}" 
                                 alt="{{ $pastevent->title }}" 
                                 class="img-fluid rounded shadow mb-3">
                            <div>
                                <small class="text-muted">Current Image</small>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-calendar-alt fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No image uploaded</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- New Image Preview -->
            <div class="card shadow mt-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">New Image Preview</h6>
                </div>
                <div class="card-body">
                    <div id="image-preview" class="text-center" style="display: none;">
                        <img id="preview-img" src="" alt="Preview" class="img-fluid rounded shadow">
                        <div class="mt-3">
                            <small class="text-muted">New Image Preview</small>
                        </div>
                    </div>
                    <div id="no-image" class="text-center py-5">
                        <i class="fas fa-upload fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No new image selected</p>
                        <small class="text-muted">Select a new image to see preview</small>
                    </div>
                </div>
            </div>

            <!-- Event Info -->
            <div class="card shadow mt-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Event Information</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="text-center">
                                <div class="h5 mb-0">{{ $pastevent->id }}</div>
                                <small class="text-muted">ID</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center">
                                <div class="h5 mb-0">{{ $pastevent->created_at->format('M d') }}</div>
                                <small class="text-muted">Created</small>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="text-center">
                        <div class="mb-2">
                            <strong>Created by:</strong><br>
                            <span class="text-muted">{{ $pastevent->created_by ?? 'System' }}</span>
                        </div>
                        @if($pastevent->updated_by)
                            <div>
                                <strong>Updated by:</strong><br>
                                <span class="text-muted">{{ $pastevent->updated_by }}</span>
                            </div>
                        @endif
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

        if (!title) {
            e.preventDefault();
            alert('Please enter a title for the past event.');
            return;
        }
    });
});
</script>
@endsection
