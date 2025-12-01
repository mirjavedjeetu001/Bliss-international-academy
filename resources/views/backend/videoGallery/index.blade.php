@extends('master.backend-clean')

@section('title', 'Video Gallery Management')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="section-header">Video Gallery Management</h2>
            <p class="text-muted mb-0">Manage video gallery content</p>
        </div>
        <a href="{{ route('backend.videogallery.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Add New Video
        </a>
    </div>

    <!-- Search and Filter Bar -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" id="searchInput" placeholder="Search videos...">
                    </div>
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="typeFilter">
                        <option value="">All Types</option>
                        <option value="youtube">YouTube</option>
                        <option value="facebook">Facebook</option>
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

    <!-- Video Gallery Table -->
    <div class="card">
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($videoGalleries->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Thumbnail</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Type</th>
                                <th>URL</th>
                                <th>Status</th>
                                <th>Created By</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($videoGalleries as $video)
                                <tr>
                                    <td>{{ $video->id }}</td>
                                    <td>
                                        @if($video->thumbnail)
                                            <img src="{{ $video->thumbnail_url }}" 
                                                 alt="{{ $video->title }}" 
                                                 class="img-thumbnail" 
                                                 style="width: 60px; height: 60px; object-fit: cover;"
                                                 data-bs-toggle="modal" 
                                                 data-bs-target="#thumbnailModal{{ $video->id }}">
                                        @else
                                            <div class="bg-light d-flex align-items-center justify-content-center" 
                                                 style="width: 60px; height: 60px;">
                                                <i class="fas fa-video text-muted"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <h6 class="mb-0">{{ $video->title }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if($video->mediaCategory)
                                            <span class="badge bg-info">
                                                {{ $video->mediaCategory->name }}
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">No Category</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $video->type === 'youtube' ? 'danger' : 'primary' }}">
                                            <i class="fab fa-{{ $video->type }} me-1"></i>
                                            {{ ucfirst($video->type) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ $video->url }}" target="_blank" class="text-decoration-none">
                                            <i class="fas fa-external-link-alt me-1"></i>
                                            View Video
                                        </a>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $video->status_badge_color }}">
                                            {{ ucfirst($video->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <small class="text-muted">{{ $video->created_by ?? 'N/A' }}</small>
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            {{ $video->created_at->format('M d, Y') }}
                                        </small>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button type="button" 
                                                    class="btn btn-sm btn-outline-info" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#videoModal{{ $video->id }}"
                                                    title="Preview">
                                                <i class="fas fa-play"></i>
                                            </button>
                                            <a href="{{ route('backend.videogallery.edit', $video) }}" 
                                               class="btn btn-sm btn-outline-primary" 
                                               title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" 
                                                    class="btn btn-sm btn-outline-danger" 
                                                    onclick="deleteVideo({{ $video->id }})"
                                                    title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Thumbnail Modal -->
                                @if($video->thumbnail)
                                <div class="modal fade" id="thumbnailModal{{ $video->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">{{ $video->title }} - Thumbnail</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <img src="{{ $video->thumbnail_url }}" class="img-fluid" alt="{{ $video->title }}">
                                            </div>
                                            <div class="modal-footer">
                                                <a href="{{ $video->thumbnail_url }}" 
                                                   class="btn btn-primary" 
                                                   download="{{ $video->title }}-thumbnail">
                                                    <i class="fas fa-download me-2"></i>Download
                                                </a>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <!-- Video Preview Modal -->
                                <div class="modal fade" id="videoModal{{ $video->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">{{ $video->title }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                @if($video->type === 'youtube')
                                                    <div class="ratio ratio-16x9">
                                                        <iframe src="{{ $video->embed_url }}" 
                                                                title="{{ $video->title }}"
                                                                allowfullscreen></iframe>
                                                    </div>
                                                @else
                                                    <div class="text-center">
                                                        <p class="text-muted">Facebook video preview not available in modal.</p>
                                                        <a href="{{ $video->url }}" target="_blank" class="btn btn-primary">
                                                            <i class="fab fa-facebook me-2"></i>View on Facebook
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                <a href="{{ $video->url }}" target="_blank" class="btn btn-primary">
                                                    <i class="fas fa-external-link-alt me-2"></i>Open Original
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
                    {{ $videoGalleries->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-video fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No videos found</h5>
                    <p class="text-muted">Get started by adding your first video to the gallery.</p>
                    <a href="{{ route('backend.videogallery.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Add First Video
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
                <p>Are you sure you want to delete this video? This action cannot be undone.</p>
                <p class="text-danger"><strong>The thumbnail file will also be deleted.</strong></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Video</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function deleteVideo(videoId) {
    const form = document.getElementById('deleteForm');
    form.action = `/backend/videogallery/${videoId}`;
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

// Type filter
document.getElementById('typeFilter').addEventListener('change', function() {
    const filterValue = this.value;
    const rows = document.querySelectorAll('tbody tr');
    
    rows.forEach(row => {
        const typeBadge = row.querySelector('.badge');
        const type = typeBadge.textContent.toLowerCase();
        
        if (!filterValue || type.includes(filterValue)) {
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
