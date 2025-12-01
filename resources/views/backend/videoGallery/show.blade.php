@extends('master.backend-clean')

@section('title', 'Video Details')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="section-header">Video Details</h2>
            <p class="text-muted mb-0">View video information and preview</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('backend.videogallery.edit', $videoGallery) }}" class="btn btn-primary">
                <i class="fas fa-edit me-2"></i>Edit Video
            </a>
            <a href="{{ route('backend.videogallery.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to Gallery
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Video Preview -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-play me-2"></i>Video Preview
                    </h5>
                </div>
                <div class="card-body">
                    @if($videoGallery->type === 'youtube')
                        <div class="ratio ratio-16x9">
                            <iframe src="{{ $videoGallery->embed_url }}" 
                                    title="{{ $videoGallery->title }}"
                                    allowfullscreen></iframe>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fab fa-facebook fa-5x text-primary mb-4"></i>
                            <h5 class="text-muted">Facebook Video</h5>
                            <p class="text-muted">Facebook videos cannot be embedded in preview</p>
                            <a href="{{ $videoGallery->url }}" target="_blank" class="btn btn-primary">
                                <i class="fab fa-facebook me-2"></i>View on Facebook
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Video Information -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>Video Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-heading text-primary fa-lg"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">Title</h6>
                                    <p class="mb-0 text-muted">{{ $videoGallery->title }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-video text-primary fa-lg"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">Type</h6>
                                    <span class="badge bg-{{ $videoGallery->type === 'youtube' ? 'danger' : 'primary' }}">
                                        <i class="fab fa-{{ $videoGallery->type }} me-1"></i>
                                        {{ ucfirst($videoGallery->type) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-link text-primary fa-lg"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">Video URL</h6>
                                    <a href="{{ $videoGallery->url }}" target="_blank" class="text-decoration-none">
                                        <i class="fas fa-external-link-alt me-1"></i>
                                        {{ $videoGallery->url }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-toggle-on text-primary fa-lg"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">Status</h6>
                                    <span class="badge bg-{{ $videoGallery->status_badge_color }}">
                                        {{ ucfirst($videoGallery->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-calendar text-primary fa-lg"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">Created Date</h6>
                                    <p class="mb-0 text-muted">{{ $videoGallery->created_at->format('F d, Y \a\t g:i A') }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-user text-primary fa-lg"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">Created By</h6>
                                    <p class="mb-0 text-muted">{{ $videoGallery->created_by ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-user-edit text-primary fa-lg"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">Modified By</h6>
                                    <p class="mb-0 text-muted">{{ $videoGallery->modified_by ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-clock text-primary fa-lg"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">Last Updated</h6>
                                    <p class="mb-0 text-muted">{{ $videoGallery->updated_at->format('F d, Y \a\t g:i A') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Thumbnail -->
            @if($videoGallery->thumbnail)
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-image me-2"></i>Thumbnail
                    </h5>
                </div>
                <div class="card-body text-center">
                    <img src="{{ $videoGallery->thumbnail_url }}" 
                         alt="{{ $videoGallery->title }}" 
                         class="img-fluid rounded"
                         style="max-height: 300px; object-fit: cover;">
                    <div class="mt-3">
                        <a href="{{ $videoGallery->thumbnail_url }}" 
                           class="btn btn-outline-primary btn-sm" 
                           download="{{ $videoGallery->title }}-thumbnail">
                            <i class="fas fa-download me-2"></i>Download
                        </a>
                    </div>
                </div>
            </div>
            @endif

            <!-- Quick Actions -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-bolt me-2"></i>Quick Actions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('backend.videogallery.edit', $videoGallery) }}" class="btn btn-primary">
                            <i class="fas fa-edit me-2"></i>Edit Video
                        </a>
                        <a href="{{ $videoGallery->url }}" target="_blank" class="btn btn-outline-primary">
                            <i class="fas fa-external-link-alt me-2"></i>View Original
                        </a>
                        <button type="button" 
                                class="btn btn-outline-danger" 
                                onclick="deleteVideo({{ $videoGallery->id }})">
                            <i class="fas fa-trash me-2"></i>Delete Video
                        </button>
                    </div>
                </div>
            </div>

            <!-- Video Statistics -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-bar me-2"></i>Video Statistics
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3 text-center">
                        <div class="col-6">
                            <div class="border rounded p-3">
                                <i class="fas fa-eye fa-2x text-primary mb-2"></i>
                                <h6 class="mb-0">Views</h6>
                                <small class="text-muted">N/A</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="border rounded p-3">
                                <i class="fas fa-thumbs-up fa-2x text-success mb-2"></i>
                                <h6 class="mb-0">Likes</h6>
                                <small class="text-muted">N/A</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="border rounded p-3">
                                <i class="fas fa-comment fa-2x text-info mb-2"></i>
                                <h6 class="mb-0">Comments</h6>
                                <small class="text-muted">N/A</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="border rounded p-3">
                                <i class="fas fa-share fa-2x text-warning mb-2"></i>
                                <h6 class="mb-0">Shares</h6>
                                <small class="text-muted">N/A</small>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <small class="text-muted">
                            <i class="fas fa-info-circle me-1"></i>
                            Statistics are not available for embedded videos. Visit the original platform for detailed analytics.
                        </small>
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
</script>
@endsection
