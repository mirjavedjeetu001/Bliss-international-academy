@extends('master.backend-clean')

@section('title', 'Add New Page')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="section-header">Add New Page</h2>
            <p class="text-muted mb-0">Create a new page for your website</p>
        </div>
        <a href="{{ route('backend.page.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Pages
        </a>
    </div>

 <form action="{{ route('backend.page.store') }}" method="POST" enctype="multipart/form-data" id="pageForm">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                   
                        @csrf
                        
                        <!-- Title -->
                        <div class="mb-4">
                            <label for="title" class="form-label">
                                <i class="fas fa-heading me-2"></i>Page Title <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title') }}" 
                                   placeholder="Enter page title"
                                   required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Detail (Rich Text Content) -->
                        <div class="mb-4">
                            <label for="detail" class="form-label">
                                <i class="fas fa-align-left me-2"></i>Page Content <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control @error('detail') is-invalid @enderror" 
                                      id="detail" 
                                      name="detail" 
                                      rows="15" 
                                      placeholder="Enter page content using the rich text editor"
                                      required>{{ old('detail') }}</textarea>
                            @error('detail')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Use the rich text editor to format your content. Images, links, and formatting will be preserved.
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
                                <i class="fas fa-save me-2"></i>Create Page
                            </button>
                            <a href="{{ route('backend.page.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i>Cancel
                            </a>
                        </div>
                   
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Images Upload -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-images me-2"></i>Images
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="images" class="form-label">Upload Images</label>
                        <input type="file" 
                               class="form-control @error('images.*') is-invalid @enderror" 
                               id="images" 
                               name="images[]" 
                               multiple 
                               accept="image/*">
                        @error('images.*')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            <i class="fas fa-info-circle me-1"></i>
                            You can select multiple images. Max size: 2MB per image.
                        </div>
                    </div>
                    
                    <!-- Image Preview -->
                    <div id="imagePreview" class="row g-2"></div>
                </div>
            </div>

            <!-- PDFs Upload -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-file-pdf me-2"></i>PDF Documents
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="pdfs" class="form-label">Upload PDFs</label>
                        <input type="file" 
                               class="form-control @error('pdfs.*') is-invalid @enderror" 
                               id="pdfs" 
                               name="pdfs[]" 
                               multiple 
                               accept=".pdf">
                        @error('pdfs.*')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            <i class="fas fa-info-circle me-1"></i>
                            You can select multiple PDF files. Max size: 10MB per file.
                        </div>
                    </div>
                    
                    <!-- PDF Preview -->
                    <div id="pdfPreview"></div>
                </div>
            </div>
        </div>
    </div>
	 </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Image preview functionality
    const imageInput = document.getElementById('images');
    const imagePreview = document.getElementById('imagePreview');
    
    imageInput.addEventListener('change', function(e) {
        imagePreview.innerHTML = '';
        
        Array.from(e.target.files).forEach((file, index) => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const col = document.createElement('div');
                    col.className = 'col-6';
                    col.innerHTML = `
                        <div class="position-relative">
                            <img src="${e.target.result}" class="img-fluid rounded" style="height: 100px; object-fit: cover; width: 100%;">
                            <div class="position-absolute top-0 end-0 p-1">
                                <span class="badge bg-primary">${index + 1}</span>
                            </div>
                        </div>
                    `;
                    imagePreview.appendChild(col);
                };
                reader.readAsDataURL(file);
            }
        });
    });

    // PDF preview functionality
    const pdfInput = document.getElementById('pdfs');
    const pdfPreview = document.getElementById('pdfPreview');
    
    pdfInput.addEventListener('change', function(e) {
        pdfPreview.innerHTML = '';
        
        Array.from(e.target.files).forEach((file, index) => {
            if (file.type === 'application/pdf') {
                const div = document.createElement('div');
                div.className = 'alert alert-info d-flex align-items-center mb-2';
                div.innerHTML = `
                    <i class="fas fa-file-pdf me-2 text-danger"></i>
                    <div class="flex-grow-1">
                        <small class="fw-semibold">${file.name}</small>
                        <br>
                        <small class="text-muted">${(file.size / 1024 / 1024).toFixed(2)} MB</small>
                    </div>
                    <span class="badge bg-primary">${index + 1}</span>
                `;
                pdfPreview.appendChild(div);
            }
        });
    });

    // Form submission with loading state
    const form = document.getElementById('pageForm');
    const submitBtn = document.getElementById('submitBtn');
    
    form.addEventListener('submit', function(e) {
        // Debug: Log form data
        const formData = new FormData(form);
        console.log('Form submission debug:');
        console.log('Title:', formData.get('title'));
        console.log('Status:', formData.get('status'));
        console.log('Images count:', formData.getAll('images[]').length);
        console.log('PDFs count:', formData.getAll('pdfs[]').length);
        
        // Check if files are selected
        const imageInput = document.getElementById('images');
        const pdfInput = document.getElementById('pdfs');
        console.log('Image files selected:', imageInput.files.length);
        console.log('PDF files selected:', pdfInput.files.length);
        
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Creating...';
    });

    // Initialize TinyMCE Rich Text Editor
    tinymce.init({
        selector: '#detail',
        height: 500,
        menubar: false,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'help', 'wordcount',
            'paste', 'textcolor', 'colorpicker', 'textpattern', 'nonbreaking',
            'template', 'codesample', 'hr', 'pagebreak', 'noneditable'
        ],
        toolbar: 'undo redo | blocks | ' +
            'bold italic underline strikethrough | alignleft aligncenter ' +
            'alignright alignjustify | outdent indent |  numlist bullist | ' +
            'forecolor backcolor removeformat | pagebreak | charmap | ' +
            'fullscreen preview | insertfile image media template link anchor codesample',
        toolbar_mode: 'sliding',
        content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 14px; }',
        branding: false,
        promotion: false,
        resize: true,
        elementpath: false,
        statusbar: true,
        paste_data_images: true,
        automatic_uploads: true,
        images_upload_handler: function (blobInfo, success, failure) {
            // Use base64 encoding for images
            try {
                const reader = new FileReader();
                reader.onload = function() {
                    success(reader.result);
                };
                reader.onerror = function() {
                    failure('Image upload failed');
                };
                reader.readAsDataURL(blobInfo.blob());
            } catch (error) {
                failure('Image upload error: ' + error.message);
            }
        },
        setup: function (editor) {
            editor.on('change', function () {
                editor.save();
            });
            
            // Handle image insertion errors
            editor.on('BeforeSetContent', function (e) {
                if (e.content && e.content.includes('<img')) {
                    // Ensure images are properly formatted
                    e.content = e.content.replace(/<img([^>]*)>/gi, function(match, attrs) {
                        if (!attrs.includes('style=')) {
                            return '<img' + attrs + ' style="max-width: 100%; height: auto;">';
                        }
                        return match;
                    });
                }
            });
        },
        // Remove API key requirements
        license_key: 'gpl',
        // Disable cloud features that require API key
        cloud_channel: '6-stable'
    });
});
</script>
@endsection
