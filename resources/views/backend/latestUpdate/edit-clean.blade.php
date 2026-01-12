@extends('master.backend-clean')

@section('title', 'Edit Latest Update - Katunia Rajbari College')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Edit Latest Update</h1>
            <p class="text-muted">Update latest update information and attachment</p>
        </div>
        <div>
            <a href="{{ route('backend.latestupdate.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to Latest Updates
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Latest Update Form -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Latest Update Information</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('backend.latestupdate.update', $latestupdate) }}" method="POST" enctype="multipart/form-data" id="updateForm">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-4">
                                    <label for="title" class="form-label fw-semibold">
                                        <i class="fas fa-heading text-primary me-2"></i>Update Title
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control form-control-lg @error('title') is-invalid @enderror" 
                                           id="title" 
                                           name="title" 
                                           value="{{ old('title', $latestupdate->title) }}" 
                                           placeholder="Enter update title"
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
                                    <label for="type" class="form-label fw-semibold">
                                        <i class="fas fa-tag text-primary me-2"></i>Update Type
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select form-control-lg @error('type') is-invalid @enderror" 
                                            id="type" 
                                            name="type" 
                                            required>
                                        <option value="">Select Type</option>
                                        <option value="update" {{ old('type', $latestupdate->type) == 'update' ? 'selected' : '' }}>Update</option>
                                        <option value="career" {{ old('type', $latestupdate->type) == 'career' ? 'selected' : '' }}>Career</option>
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Select "Update" for general announcements or "Career" for job postings
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-4">
                                    <label for="detail" class="form-label fw-semibold">
                                        <i class="fas fa-align-left text-primary me-2"></i>Update Description
                                    </label>
                                    <textarea class="form-control @error('detail') is-invalid @enderror" 
                                              id="detail" 
                                              name="detail" 
                                              rows="6"
                                              placeholder="Enter detailed description of the update">{{ old('detail', $latestupdate->detail) }}</textarea>
                                    @error('detail')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-4">
                                    <label for="attachment" class="form-label fw-semibold">
                                        <i class="fas fa-file-pdf text-primary me-2"></i>New PDF Attachment
                                    </label>
                                    <input type="file" 
                                           class="form-control form-control-lg @error('attachment') is-invalid @enderror" 
                                           id="attachment" 
                                           name="attachment" 
                                           accept=".pdf">
                                    @error('attachment')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Leave empty to keep current attachment. Supported format: PDF. Max size: 10MB
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-end gap-3">
                                    <a href="{{ route('backend.latestupdate.index') }}" class="btn btn-outline-secondary btn-lg">
                                        <i class="fas fa-times me-2"></i>Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-save me-2"></i>Update Latest Update
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <!-- Current Attachment -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Current Attachment</h6>
                </div>
                <div class="card-body">
                    @if($latestupdate->attachment)
                        <div class="text-center">
                            <div class="alert alert-info d-flex align-items-center justify-content-center">
                                <i class="fas fa-file-pdf fa-2x text-danger me-3"></i>
                                <div>
                                    <div class="fw-semibold">PDF Document</div>
                                    <small class="text-muted">Current attachment</small>
                                </div>
                            </div>
                            <a href="{{ asset('backend/attachments/' . $latestupdate->attachment) }}" 
                               target="_blank" 
                               class="btn btn-outline-primary">
                                <i class="fas fa-external-link-alt me-2"></i>View Current PDF
                            </a>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-file-slash fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No attachment uploaded</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- New File Preview -->
            <div class="card shadow mt-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">New File Preview</h6>
                </div>
                <div class="card-body">
                    <div id="file-preview" class="text-center" style="display: none;">
                        <div class="alert alert-info d-flex align-items-center">
                            <i class="fas fa-file-pdf fa-2x text-danger me-3"></i>
                            <div>
                                <div class="fw-semibold" id="file-name"></div>
                                <small class="text-muted" id="file-size"></small>
                            </div>
                        </div>
                    </div>
                    <div id="no-file" class="text-center py-5">
                        <i class="fas fa-upload fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No new file selected</p>
                        <small class="text-muted">Select a new PDF to see preview</small>
                    </div>
                </div>
            </div>

            <!-- Update Info -->
            <div class="card shadow mt-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Update Information</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="text-center">
                                <div class="h5 mb-0">{{ $latestupdate->id }}</div>
                                <small class="text-muted">ID</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center">
                                <div class="h5 mb-0">{{ $latestupdate->created_at->format('M d') }}</div>
                                <small class="text-muted">Created</small>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="text-center">
                        <div class="mb-2">
                            <strong>Created by:</strong><br>
                            <span class="text-muted">{{ $latestupdate->created_by ?? 'System' }}</span>
                        </div>
                        @if($latestupdate->updated_by)
                            <div>
                                <strong>Updated by:</strong><br>
                                <span class="text-muted">{{ $latestupdate->updated_by }}</span>
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

.btn-lg {
    padding: 0.75rem 1.5rem;
    font-size: 1rem;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const attachmentInput = document.getElementById('attachment');
    const preview = document.getElementById('file-preview');
    const fileName = document.getElementById('file-name');
    const fileSize = document.getElementById('file-size');
    const noFile = document.getElementById('no-file');

    attachmentInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            fileName.textContent = file.name;
            fileSize.textContent = (file.size / 1024 / 1024).toFixed(2) + ' MB';
            preview.style.display = 'block';
            noFile.style.display = 'none';
        } else {
            preview.style.display = 'none';
            noFile.style.display = 'block';
        }
    });

    // Form validation
    const form = document.getElementById('updateForm');
    form.addEventListener('submit', function(e) {
        const title = document.getElementById('title').value.trim();

        if (!title) {
            e.preventDefault();
            alert('Please enter a title for the latest update.');
            return;
        }
    });
});
</script>
@endsection
