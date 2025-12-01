@extends('master.backend-clean')

@section('title', 'Edit Book')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="section-header">Edit Book</h2>
            <p class="text-muted mb-0">Update book information</p>
        </div>
        <a href="{{ route('backend.book.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Books
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('backend.book.update', $book) }}" method="POST" enctype="multipart/form-data" id="bookForm">
                        @csrf
                        @method('PUT')
                        
                        <!-- Book Type -->
                        <div class="mb-4">
                            <label for="book_type" class="form-label">
                                <i class="fas fa-layer-group me-2"></i>Book Type <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('book_type') is-invalid @enderror" 
                                    id="book_type" 
                                    name="book_type" 
                                    required>
                                <option value="">Select Book Type</option>
                                <option value="form" {{ old('book_type', $book->book_type) === 'form' ? 'selected' : '' }}>Form</option>
                                <option value="book" {{ old('book_type', $book->book_type) === 'book' ? 'selected' : '' }}>Book</option>
                            </select>
                            @error('book_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Choose whether this is a form or a book.
                            </div>
                        </div>

                        <!-- Campus -->
                        <div class="mb-4">
                            <label for="campus" class="form-label">
                                <i class="fas fa-building me-2"></i>Campus <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('campus') is-invalid @enderror" 
                                    id="campus" 
                                    name="campus" 
                                    required>
                                <option value="">Select Campus</option>
                                <option value="All Campus" {{ old('campus', $book->campus) === 'All Campus' ? 'selected' : '' }}>All Campus</option>
                                <option value="Satkhira" {{ old('campus', $book->campus) === 'Satkhira' ? 'selected' : '' }}>Satkhira</option>
                                <option value="Debhata" {{ old('campus', $book->campus) === 'Debhata' ? 'selected' : '' }}>Debhata</option>
                            </select>
                            @error('campus')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Select which campus this book is for.
                            </div>
                        </div>

                        <!-- Title -->
                        <div class="mb-4">
                            <label for="title" class="form-label">
                                <i class="fas fa-heading me-2"></i>Title <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title', $book->title) }}" 
                                   placeholder="Enter book title"
                                   required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Current PDF -->
                        @if($book->pdf_path)
                        <div class="mb-4">
                            <label class="form-label">
                                <i class="fas fa-file-pdf me-2"></i>Current PDF
                            </label>
                            <div class="alert alert-secondary">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-file-pdf text-danger me-2"></i>
                                        <span>{{ basename($book->pdf_path) }}</span>
                                    </div>
                                    <a href="{{ $book->pdf_url }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye me-1"></i>View
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- PDF Upload -->
                        <div class="mb-4">
                            <label for="pdf" class="form-label">
                                <i class="fas fa-file-pdf me-2"></i>Upload New PDF (Optional)
                            </label>
                            <input type="file" 
                                   class="form-control @error('pdf') is-invalid @enderror" 
                                   id="pdf" 
                                   name="pdf" 
                                   accept=".pdf">
                            @error('pdf')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Upload a new PDF to replace the current one. Max size: 10MB. Format: PDF only.
                            </div>
                            
                            <!-- PDF Preview -->
                            <div id="pdfPreview" class="mt-3" style="display: none;">
                                <div class="alert alert-info">
                                    <i class="fas fa-file-pdf me-2"></i>
                                    <span id="pdfFileName"></span>
                                    <span class="ms-2">(<span id="pdfFileSize"></span>)</span>
                                </div>
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
                                <option value="active" {{ old('status', $book->status) === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status', $book->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <i class="fas fa-save me-2"></i>Update Book
                            </button>
                            <a href="{{ route('backend.book.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i>Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Book Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>Book Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <small class="text-muted">Created:</small>
                        <div>{{ $book->created_at->format('M d, Y h:i A') }}</div>
                    </div>
                    <div class="mb-3">
                        <small class="text-muted">Last Updated:</small>
                        <div>{{ $book->updated_at->format('M d, Y h:i A') }}</div>
                    </div>
                    @if($book->created_by)
                    <div class="mb-3">
                        <small class="text-muted">Created By:</small>
                        <div>{{ $book->created_by }}</div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Tips -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-lightbulb me-2"></i>Tips
                    </h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-info mb-0">
                        <ul class="mb-0">
                            <li>Leave PDF field empty to keep current PDF</li>
                            <li>Uploading a new PDF will replace the old one</li>
                            <li>Ensure new PDF is under 10MB</li>
                            <li>PDFs are saved to frontend/assets/attachments</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form submission with loading state
    const form = document.getElementById('bookForm');
    const submitBtn = document.getElementById('submitBtn');
    
    form.addEventListener('submit', function() {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Updating...';
    });

    // PDF preview functionality
    const pdfInput = document.getElementById('pdf');
    const pdfPreview = document.getElementById('pdfPreview');
    const pdfFileName = document.getElementById('pdfFileName');
    const pdfFileSize = document.getElementById('pdfFileSize');
    
    pdfInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            pdfFileName.textContent = file.name;
            pdfFileSize.textContent = formatFileSize(file.size);
            pdfPreview.style.display = 'block';
        } else {
            pdfPreview.style.display = 'none';
        }
    });

    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
    }
});
</script>
@endsection

