@extends('master.backend-clean')

@section('title', 'View Page')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="section-header">{{ $page->title }}</h2>
            <p class="text-muted mb-0">Page Details and Content</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('backend.page.edit', $page) }}" class="btn btn-primary">
                <i class="fas fa-edit me-2"></i>Edit Page
            </a>
            <a href="{{ route('backend.page.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to Pages
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Page Content -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-align-left me-2"></i>Page Content
                    </h5>
                </div>
                <div class="card-body">
                    <div class="content-preview">
                        {!! $page->detail !!}
                    </div>
                </div>
            </div>

            <!-- Page Images -->
            @if($page->images && count($page->images) > 0)
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-images me-2"></i>Page Images ({{ count($page->images) }})
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            @foreach($page->formatted_images as $index => $image)
                                <div class="col-lg-4 col-md-6">
                                    <div class="card h-100">
                                        <div class="position-relative">
                                            <img src="/{{ $image['path'] }}" 
                                                 class="card-img-top" 
                                                 style="height: 200px; object-fit: cover;"
                                                 alt="{{ $image['name'] }}"
                                                 data-bs-toggle="modal" 
                                                 data-bs-target="#imageModal{{ $index }}">
                                            <div class="position-absolute top-0 end-0 p-2">
                                                <span class="badge bg-primary">{{ $index + 1 }}</span>
                                            </div>
                                        </div>
                                        <div class="card-body p-2">
                                            <h6 class="card-title mb-1">{{ $image['name'] }}</h6>
                                            <small class="text-muted">Click to view full size</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Image Modal -->
                                <div class="modal fade" id="imageModal{{ $index }}" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">{{ $image['name'] }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <img src="/{{ $image['path'] }}" class="img-fluid" alt="{{ $image['name'] }}">
                                            </div>
                                            <div class="modal-footer">
                                                <a href="/{{ $image['path'] }}" 
                                                   class="btn btn-primary" 
                                                   download="{{ $image['name'] }}">
                                                    <i class="fas fa-download me-2"></i>Download
                                                </a>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Page PDFs -->
            @if($page->pdfs && count($page->pdfs) > 0)
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-file-pdf me-2"></i>Page PDFs ({{ count($page->pdfs) }})
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            @foreach($page->formatted_pdfs as $index => $pdf)
                                <div class="col-lg-6">
                                    <div class="card h-100">
                                        <div class="card-body d-flex align-items-center">
                                            <div class="flex-shrink-0 me-3">
                                                <i class="fas fa-file-pdf fa-3x text-danger"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="card-title mb-1">{{ $pdf['name'] }}</h6>
                                                <p class="card-text text-muted mb-2">PDF Document</p>
                                                <div class="d-flex gap-2">
                                                    <a href="/{{ $pdf['path'] }}" 
                                                       target="_blank" 
                                                       class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-eye me-1"></i>View
                                                    </a>
                                                    <a href="/{{ $pdf['path'] }}" 
                                                       download="{{ $pdf['name'] }}" 
                                                       class="btn btn-sm btn-primary">
                                                        <i class="fas fa-download me-1"></i>Download
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <span class="badge bg-primary">{{ $index + 1 }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="col-lg-4">
            <!-- Page Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>Page Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold">Page ID</label>
                            <p class="mb-0">{{ $page->id }}</p>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Title</label>
                            <p class="mb-0">{{ $page->title }}</p>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Slug</label>
                            <p class="mb-0">
                                <code>{{ $page->slug }}</code>
                            </p>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Status</label>
                            <p class="mb-0">
                                <span class="badge bg-{{ $page->status === 'active' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($page->status) }}
                                </span>
                            </p>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Created</label>
                            <p class="mb-0">{{ $page->created_at->format('M d, Y \a\t h:i A') }}</p>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Last Updated</label>
                            <p class="mb-0">{{ $page->updated_at->format('M d, Y \a\t h:i A') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-bar me-2"></i>Statistics
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3 text-center">
                        <div class="col-6">
                            <div class="border rounded p-3">
                                <i class="fas fa-images fa-2x text-primary mb-2"></i>
                                <h4 class="mb-0">{{ count($page->images ?? []) }}</h4>
                                <small class="text-muted">Images</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="border rounded p-3">
                                <i class="fas fa-file-pdf fa-2x text-danger mb-2"></i>
                                <h4 class="mb-0">{{ count($page->pdfs ?? []) }}</h4>
                                <small class="text-muted">PDFs</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-bolt me-2"></i>Quick Actions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('backend.page.edit', $page) }}" class="btn btn-primary">
                            <i class="fas fa-edit me-2"></i>Edit Page
                        </a>
                        <button type="button" 
                                class="btn btn-outline-danger" 
                                onclick="deletePage({{ $page->id }})">
                            <i class="fas fa-trash me-2"></i>Delete Page
                        </button>
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
                <p>Are you sure you want to delete this page? This action cannot be undone.</p>
                <p class="text-danger"><strong>All associated images and PDFs will also be deleted.</strong></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Page</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.content-preview {
    line-height: 1.6;
    font-size: 1rem;
}

.content-preview h1,
.content-preview h2,
.content-preview h3,
.content-preview h4,
.content-preview h5,
.content-preview h6 {
    margin-top: 1.5rem;
    margin-bottom: 1rem;
    font-weight: 600;
}

.content-preview p {
    margin-bottom: 1rem;
}

.content-preview img {
    max-width: 100%;
    height: auto;
    border-radius: 0.375rem;
    margin: 1rem 0;
}

.content-preview ul,
.content-preview ol {
    margin-bottom: 1rem;
    padding-left: 2rem;
}

.content-preview blockquote {
    border-left: 4px solid #dee2e6;
    padding-left: 1rem;
    margin: 1rem 0;
    font-style: italic;
    color: #6c757d;
}
</style>

<script>
function deletePage(pageId) {
    const form = document.getElementById('deleteForm');
    form.action = `/backend/page/${pageId}`;
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}
</script>
@endsection
