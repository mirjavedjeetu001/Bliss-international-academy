@extends('master.backend-clean')

@section('title', 'Add New Teacher')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="section-header">Add New Teacher</h2>
            <p class="text-muted mb-0">Create a new teacher profile</p>
        </div>
        <a href="{{ route('backend.teacher.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Teachers
        </a>
    </div>

    <form action="{{ route('backend.teacher.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <!-- Name -->
                        <div class="mb-4">
                            <label for="name" class="form-label">
                                <i class="fas fa-user me-2"></i>Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}" 
                                   placeholder="Enter teacher name"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Designation -->
                        <div class="mb-4">
                            <label for="designation" class="form-label">
                                <i class="fas fa-id-badge me-2"></i>Designation <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('designation') is-invalid @enderror" 
                                   id="designation" 
                                   name="designation" 
                                   value="{{ old('designation') }}" 
                                   placeholder="Enter teacher designation"
                                   required>
                            @error('designation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Qualification -->
                        <div class="mb-4">
                            <label for="qualification" class="form-label">
                                <i class="fas fa-graduation-cap me-2"></i>Qualification <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control @error('qualification') is-invalid @enderror" 
                                      id="qualification" 
                                      name="qualification" 
                                      rows="4" 
                                      placeholder="Enter teacher qualifications"
                                      required>{{ old('qualification') }}</textarea>
                            @error('qualification')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Enter educational qualifications and certifications
                            </div>
                        </div>

                        <!-- Mobile -->
                        <div class="mb-4">
                            <label for="mobile" class="form-label">
                                <i class="fas fa-phone me-2"></i>Mobile <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('mobile') is-invalid @enderror" 
                                   id="mobile" 
                                   name="mobile" 
                                   value="{{ old('mobile') }}" 
                                   placeholder="Enter mobile number"
                                   required>
                            @error('mobile')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope me-2"></i>Email <span class="text-danger">*</span>
                            </label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   placeholder="Enter email address"
                                   required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
                                <option value="Satkhira" {{ old('campus') === 'Satkhira' ? 'selected' : '' }}>Satkhira</option>
                                <option value="Debhata" {{ old('campus') === 'Debhata' ? 'selected' : '' }}>Debhata</option>
                            </select>
                            @error('campus')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Settings</h5>
                    </div>
                    <div class="card-body">
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

                        <!-- Sort By -->
                        <div class="mb-4">
                            <label for="sort_by" class="form-label">
                                <i class="fas fa-sort-numeric-down me-2"></i>Sort By <span class="text-danger">*</span>
                            </label>
                            <input type="number" 
                                   class="form-control @error('sort_by') is-invalid @enderror" 
                                   id="sort_by" 
                                   name="sort_by" 
                                   value="{{ old('sort_by', 0) }}" 
                                   min="0"
                                   placeholder="Enter sort order (0, 1, 2, ...)"
                                   required>
                            @error('sort_by')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Lower numbers appear first
                            </div>
                        </div>

                        <!-- Picture -->
                        <div class="mb-4">
                            <label for="picture" class="form-label">
                                <i class="fas fa-image me-2"></i>Picture
                            </label>
                            <input type="file" 
                                   class="form-control @error('picture') is-invalid @enderror" 
                                   id="picture" 
                                   name="picture" 
                                   accept="image/*"
                                   onchange="previewImage(event)">
                            @error('picture')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Max file size: 2MB. Formats: jpg, png, gif, webp
                            </div>
                        </div>

                        <!-- Image Preview -->
                        <div id="imagePreview" class="mb-3" style="display: none;">
                            <label class="form-label">Preview:</label>
                            <img id="preview" src="" alt="Preview" class="img-fluid rounded" style="max-height: 200px;">
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Create Teacher
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview').src = e.target.result;
            document.getElementById('imagePreview').style.display = 'block';
        }
        reader.readAsDataURL(file);
    }
}
</script>
@endsection

