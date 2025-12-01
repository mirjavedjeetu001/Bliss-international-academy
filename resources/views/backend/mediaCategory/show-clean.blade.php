@extends('master.backend-clean')

@section('title', 'View Media Category')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="section-header">{{ $mediaCategory->name }}</h2>
            <p class="text-muted mb-0">Media Category Details</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('backend.mediacategory.edit', $mediaCategory) }}" class="btn btn-primary">
                <i class="fas fa-edit me-2"></i>Edit Category
            </a>
            <a href="{{ route('backend.mediacategory.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to Categories
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Category Details -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>Category Details
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center p-3 border rounded">
                                <div class="flex-shrink-0 me-3">
                                    @if($mediaCategory->image)
                                        <img src="{{ $mediaCategory->image_url }}" 
                                             alt="{{ $mediaCategory->name }}" 
                                             class="img-thumbnail" 
                                             style="width: 60px; height: 60px; object-fit: cover;">
                                    @else
                                        <i class="fas fa-tag fa-2x text-primary"></i>
                                    @endif
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Category Name</h6>
                                    <p class="mb-0 fw-semibold">{{ $mediaCategory->name }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center p-3 border rounded">
                                <div class="flex-shrink-0 me-3">
                                    <i class="fas fa-{{ $mediaCategory->type === 'photo' ? 'camera' : 'video' }} fa-2x text-{{ $mediaCategory->type_badge_color }}"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Media Type</h6>
                                    <p class="mb-0 fw-semibold">
                                        <span class="badge bg-{{ $mediaCategory->type_badge_color }}">
                                            {{ ucfirst($mediaCategory->type) }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center p-3 border rounded">
                                <div class="flex-shrink-0 me-3">
                                    <i class="fas fa-toggle-{{ $mediaCategory->status === 'active' ? 'on' : 'off' }} fa-2x text-{{ $mediaCategory->status_badge_color }}"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Status</h6>
                                    <p class="mb-0 fw-semibold">
                                        <span class="badge bg-{{ $mediaCategory->status_badge_color }}">
                                            {{ ucfirst($mediaCategory->status) }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center p-3 border rounded">
                                <div class="flex-shrink-0 me-3">
                                    <i class="fas fa-hashtag fa-2x text-info"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Category ID</h6>
                                    <p class="mb-0 fw-semibold">{{ $mediaCategory->id }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Category Image -->
            @if($mediaCategory->image)
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-image me-2"></i>Category Image
                        </h5>
                    </div>
                    <div class="card-body text-center">
                        <img src="{{ $mediaCategory->image_url }}" 
                             alt="{{ $mediaCategory->name }}" 
                             class="img-fluid rounded" 
                             style="max-height: 300px; object-fit: cover;">
                        <p class="mt-2 mb-0 text-muted">{{ $mediaCategory->image }}</p>
                    </div>
                </div>
            @endif

            <!-- Usage Information -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-bar me-2"></i>Usage Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <h6 class="alert-heading">
                            <i class="fas fa-info-circle me-2"></i>Category Usage
                        </h6>
                        <p class="mb-0">This category can be used to organize and categorize your {{ $mediaCategory->type }} media files. When creating {{ $mediaCategory->type }} galleries, you can assign them to this category for better organization.</p>
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="text-center p-3 border rounded">
                                <i class="fas fa-{{ $mediaCategory->type === 'photo' ? 'images' : 'video' }} fa-2x text-primary mb-2"></i>
                                <h5 class="mb-1">0</h5>
                                <small class="text-muted">{{ ucfirst($mediaCategory->type) }} Files</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-center p-3 border rounded">
                                <i class="fas fa-folder fa-2x text-success mb-2"></i>
                                <h5 class="mb-1">0</h5>
                                <small class="text-muted">Galleries</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Category Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-user me-2"></i>Created Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold">Created By</label>
                            <p class="mb-0">{{ $mediaCategory->created_by ?? 'N/A' }}</p>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Last Updated By</label>
                            <p class="mb-0">{{ $mediaCategory->updated_by ?? 'N/A' }}</p>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Created Date</label>
                            <p class="mb-0">{{ $mediaCategory->created_at->format('M d, Y \a\t h:i A') }}</p>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Last Updated</label>
                            <p class="mb-0">{{ $mediaCategory->updated_at->format('M d, Y \a\t h:i A') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-bolt me-2"></i>Quick Actions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('backend.mediacategory.edit', $mediaCategory) }}" class="btn btn-primary">
                            <i class="fas fa-edit me-2"></i>Edit Category
                        </a>
                        <button type="button" 
                                class="btn btn-outline-danger" 
                                onclick="deleteCategory({{ $mediaCategory->id }})">
                            <i class="fas fa-trash me-2"></i>Delete Category
                        </button>
                    </div>
                </div>
            </div>

            <!-- Category Statistics -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-pie me-2"></i>Statistics
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="h5 mb-0 text-primary">0</div>
                            <small class="text-muted">Total Files</small>
                        </div>
                        <div class="col-6">
                            <div class="h5 mb-0 text-success">0</div>
                            <small class="text-muted">Active Galleries</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this media category? This action cannot be undone.</p>
                <p class="text-danger"><strong>Note: This will not delete any associated media files.</strong></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Category</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function deleteCategory(categoryId) {
    const form = document.getElementById('deleteForm');
    form.action = `/backend/mediacategory/${categoryId}`;
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}
</script>
@endsection
