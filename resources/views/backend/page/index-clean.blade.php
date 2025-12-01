@extends('master.backend-clean')

@section('title', 'Pages Management')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="section-header">Pages Management</h2>
            <p class="text-muted mb-0">Manage your website pages</p>
        </div>
        <a href="{{ route('backend.page.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Add New Page
        </a>
    </div>

    <!-- Search and Filter Bar -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" id="searchInput" placeholder="Search pages...">
                    </div>
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="statusFilter">
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-outline-primary" id="refreshBtn">
                        <i class="fas fa-sync-alt me-2"></i>Refresh
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Pages Table -->
    <div class="card">
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($pages->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Images</th>
                                <th>PDFs</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pages as $page)
                                <tr>
                                    <td>{{ $page->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <h6 class="mb-0">{{ $page->title }}</h6>
                                                <small class="text-muted">{{ $page->slug }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $page->status === 'active' ? 'success' : 'secondary' }}">
                                            {{ ucfirst($page->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">
                                            {{ count($page->images ?? []) }} images
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-warning">
                                            {{ count($page->pdfs ?? []) }} PDFs
                                        </span>
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            {{ $page->created_at->format('M d, Y') }}
                                        </small>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('backend.page.show', $page) }}" 
                                               class="btn btn-sm btn-outline-info" 
                                               title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('backend.page.edit', $page) }}" 
                                               class="btn btn-sm btn-outline-primary" 
                                               title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" 
                                                    class="btn btn-sm btn-outline-danger" 
                                                    onclick="deletePage({{ $page->id }})"
                                                    title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div class="text-muted">
                        Showing {{ $pages->firstItem() }} to {{ $pages->lastItem() }} of {{ $pages->total() }} results
                    </div>
                    <div>
                        {{ $pages->links() }}
                    </div>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No pages found</h5>
                    <p class="text-muted">Get started by creating your first page.</p>
                    <a href="{{ route('backend.page.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Create First Page
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

<script>
function deletePage(pageId) {
    const form = document.getElementById('deleteForm');
    form.action = `/backend/page/${pageId}`;
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}

// Search functionality
document.getElementById('searchInput').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const rows = document.querySelectorAll('tbody tr');
    
    rows.forEach(row => {
        const title = row.querySelector('h6').textContent.toLowerCase();
        const slug = row.querySelector('small').textContent.toLowerCase();
        
        if (title.includes(searchTerm) || slug.includes(searchTerm)) {
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
        const statusBadge = row.querySelector('.badge');
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
