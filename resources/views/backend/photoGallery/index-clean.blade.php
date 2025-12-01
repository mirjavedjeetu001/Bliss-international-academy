@extends('master.backend-clean')

@section('title', 'Photo Gallery Management')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="section-header">Photo Gallery Management</h2>
            <p class="text-muted mb-0">Manage photo gallery images</p>
        </div>
        <a href="{{ route('backend.photogallery.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Add New Photo
        </a>
    </div>

    <!-- Search and Filter Bar -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" id="searchInput" placeholder="Search photos...">
                    </div>
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="categoryFilter">
                        <option value="">All Categories</option>
                        @foreach(\App\Models\MediaCategory::where('type', 'photo')->active()->get() as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="statusFilter">
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-outline-primary" id="refreshBtn">
                        <i class="fas fa-sync-alt me-2"></i>Refresh
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Photo Gallery Table -->
    <div class="card">
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($photoGalleries->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Created By</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($photoGalleries as $photo)
                                <tr>
                                    <td>{{ $photo->id }}</td>
                                    <td>
                                        <img src="{{ $photo->image_url }}" 
                                             alt="{{ $photo->title }}" 
                                             class="img-thumbnail" 
                                             style="width: 60px; height: 60px; object-fit: cover;"
                                             data-bs-toggle="modal" 
                                             data-bs-target="#imageModal{{ $photo->id }}">
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <h6 class="mb-0">{{ $photo->title }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary">
                                            {{ $photo->mediaCategory->name }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $photo->status_badge_color }}">
                                            {{ ucfirst($photo->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <small class="text-muted">{{ $photo->created_by ?? 'N/A' }}</small>
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            {{ $photo->created_at->format('M d, Y') }}
                                        </small>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('backend.photogallery.show', $photo) }}" 
                                               class="btn btn-sm btn-outline-info" 
                                               title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('backend.photogallery.edit', $photo) }}" 
                                               class="btn btn-sm btn-outline-primary" 
                                               title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" 
                                                    class="btn btn-sm btn-outline-danger" 
                                                    onclick="deletePhoto({{ $photo->id }})"
                                                    title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Image Modal -->
                                <div class="modal fade" id="imageModal{{ $photo->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">{{ $photo->title }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <img src="{{ $photo->image_url }}" class="img-fluid" alt="{{ $photo->title }}">
                                            </div>
                                            <div class="modal-footer">
                                                <a href="{{ $photo->image_url }}" 
                                                   class="btn btn-primary" 
                                                   download="{{ $photo->title }}">
                                                    <i class="fas fa-download me-2"></i>Download
                                                </a>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $photoGalleries->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-camera fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No photos found</h5>
                    <p class="text-muted">Get started by adding your first photo to the gallery.</p>
                    <a href="{{ route('backend.photogallery.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Add First Photo
                    </a>
                </div>
            @endif
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
                <p>Are you sure you want to delete this photo? This action cannot be undone.</p>
                <p class="text-danger"><strong>The image file will also be deleted.</strong></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Photo</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function deletePhoto(photoId) {
    const form = document.getElementById('deleteForm');
    form.action = `/backend/photogallery/${photoId}`;
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}

// Search functionality
document.getElementById('searchInput').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const rows = document.querySelectorAll('tbody tr');
    
    rows.forEach(row => {
        const title = row.querySelector('h6').textContent.toLowerCase();
        
        if (title.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

// Category filter
document.getElementById('categoryFilter').addEventListener('change', function() {
    const filterValue = this.value;
    const rows = document.querySelectorAll('tbody tr');
    
    rows.forEach(row => {
        const categoryBadge = row.querySelector('.badge.bg-primary');
        const categoryId = categoryBadge ? categoryBadge.getAttribute('data-category-id') : '';
        
        if (!filterValue || categoryId === filterValue) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

// Status filter
document.getElementById('statusFilter').addEventListener('change', function() {
    const filterValue = this.value;
    const rows = document.querySelectorAll('tbody tr');
    
    rows.forEach(row => {
        const badges = row.querySelectorAll('.badge');
        const statusBadge = badges[badges.length - 1]; // Last badge is status
        const status = statusBadge.textContent.toLowerCase();
        
        if (!filterValue || status.includes(filterValue)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

// Refresh functionality
document.getElementById('refreshBtn').addEventListener('click', function() {
    window.location.reload();
});
</script>
@endsection
