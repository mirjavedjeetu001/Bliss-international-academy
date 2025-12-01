@extends('master.backend-clean')

@section('title', 'Books Management')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="section-header">Books Management</h2>
            <p class="text-muted mb-0">Manage books and forms for download</p>
        </div>
        <a href="{{ route('backend.book.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Add New Book
        </a>
    </div>

    <!-- Search and Filter Bar -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" id="searchInput" placeholder="Search books...">
                    </div>
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="typeFilter">
                        <option value="">All Types</option>
                        <option value="form">Form</option>
                        <option value="book">Book</option>
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

    <!-- Books Table -->
    <div class="card">
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($books->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Type</th>
                                <th>Campus</th>
                                <th>Status</th>
                                <th>PDF</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($books as $book)
                                <tr>
                                    <td>{{ $book->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-file-pdf text-danger me-2"></i>
                                            <div>
                                                <h6 class="mb-0">{{ $book->title }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $book->type_badge_color }}">
                                            <i class="fas fa-{{ $book->book_type === 'form' ? 'file-alt' : 'book' }} me-1"></i>
                                            {{ ucfirst($book->book_type) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $book->campus === 'All Campus' ? 'primary' : ($book->campus === 'Satkhira' ? 'info' : 'success') }}">
                                            <i class="fas fa-building me-1"></i>
                                            {{ $book->campus }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $book->status_badge_color }}">
                                            {{ ucfirst($book->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ $book->pdf_url }}" target="_blank" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-download me-1"></i>Download
                                        </a>
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            {{ $book->created_at->format('M d, Y') }}
                                        </small>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('backend.book.show', $book) }}" 
                                               class="btn btn-sm btn-outline-info" 
                                               title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('backend.book.edit', $book) }}" 
                                               class="btn btn-sm btn-outline-primary" 
                                               title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" 
                                                    class="btn btn-sm btn-outline-danger" 
                                                    onclick="deleteBook({{ $book->id }})"
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
                <div class="d-flex justify-content-center mt-4">
                    {{ $books->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-book fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No books found</h5>
                    <p class="text-muted">Get started by creating your first book.</p>
                    <a href="{{ route('backend.book.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Create First Book
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
                <p>Are you sure you want to delete this book? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Book</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function deleteBook(bookId) {
    const form = document.getElementById('deleteForm');
    form.action = `/backend/book/${bookId}`;
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
        const typeBadge = row.querySelectorAll('.badge')[0];
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
        const statusBadge = badges[1]; // Second badge is status
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

