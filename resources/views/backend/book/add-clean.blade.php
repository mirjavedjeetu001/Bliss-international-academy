@extends('master.backend-clean')

@section('title', 'Add New Book')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="section-header">Add New Book</h2>
            <p class="text-muted mb-0">Upload a new book or form</p>
        </div>
        <a href="{{ route('backend.book.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Books
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('backend.book.store') }}" method="POST" enctype="multipart/form-data" id="bookForm">
                        @csrf
                        
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
                                <option value="form" {{ old('book_type') === 'form' ? 'selected' : '' }}>Form</option>
                                <option value="book" {{ old('book_type') === 'book' ? 'selected' : '' }}>Book</option>
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
                                <option value="All Campus" {{ old('campus') === 'All Campus' ? 'selected' : '' }}>All Campus</option>
                                <option value="Satkhira" {{ old('campus') === 'Satkhira' ? 'selected' : '' }}>Satkhira</option>
                                <option value="Debhata" {{ old('campus') === 'Debhata' ? 'selected' : '' }}>Debhata</option>
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
                                   value="{{ old('title') }}" 
                                   placeholder="Enter book title"
                                   required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- PDF Upload -->
                        <div class="mb-4">
                            <label for="pdf" class="form-label">
                                <i class="fas fa-file-pdf me-2"></i>Upload PDF <span class="text-danger">*</span>
                            </label>
                            <input type="file" 
                                   class="form-control @error('pdf') is-invalid @enderror" 
                                   id="pdf" 
                                   name="pdf" 
                                   accept=".pdf"
                                   required>
                            @error('pdf')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Upload a PDF file. Max size: 10MB. Format: PDF only.
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
                                <i class="fas fa-save me-2"></i>Create Book
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
                    <div class="alert alert-info">
                        <h6 class="alert-heading">
                            <i class="fas fa-lightbulb me-2"></i>Tips for Adding Books
                        </h6>
                        <ul class="mb-0">
                            <li>Use clear, descriptive titles</li>
                            <li>Select the correct type (Form/Book)</li>
                            <li>Ensure PDF is under 10MB</li>
                            <li>Set status to Active to make it available</li>
                            <li>PDFs will be saved to frontend/assets/attachments</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Type Examples -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-examples me-2"></i>Type Examples
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="d-flex align-items-center p-3 border rounded">
                                <i class="fas fa-file-alt fa-2x text-info me-3"></i>
                                <div>
                                    <h6 class="mb-1">Forms</h6>
                                    <small class="text-muted">Application forms, admission forms, etc.</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items-center p-3 border rounded">
                                <i class="fas fa-book fa-2x text-primary me-3"></i>
                                <div>
                                    <h6 class="mb-1">Books</h6>
                                    <small class="text-muted">Textbooks, guides, manuals, etc.</small>
                                </div>
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
    const form = document.getElementById('bookForm');
    const submitBtn = document.getElementById('submitBtn');
    
    form.addEventListener('submit', function() {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Creating...';
    });

    // Auto-focus title field
    const titleField = document.getElementById('title');
    if (titleField && !titleField.value) {
        titleField.focus();
    }

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

