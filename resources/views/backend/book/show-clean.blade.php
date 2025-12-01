@extends('master.backend-clean')

@section('title', 'View Book')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="section-header">Book Details</h2>
            <p class="text-muted mb-0">View book information</p>
        </div>
        <div class="btn-group">
            <a href="{{ route('backend.book.edit', $book) }}" class="btn btn-primary">
                <i class="fas fa-edit me-2"></i>Edit Book
            </a>
            <a href="{{ route('backend.book.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to Books
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Book Information Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>Book Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <strong><i class="fas fa-hashtag me-2"></i>ID:</strong>
                        </div>
                        <div class="col-md-9">
                            {{ $book->id }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <strong><i class="fas fa-layer-group me-2"></i>Book Type:</strong>
                        </div>
                        <div class="col-md-9">
                            <span class="badge bg-{{ $book->type_badge_color }}">
                                <i class="fas fa-{{ $book->book_type === 'form' ? 'file-alt' : 'book' }} me-1"></i>
                                {{ ucfirst($book->book_type) }}
                            </span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <strong><i class="fas fa-building me-2"></i>Campus:</strong>
                        </div>
                        <div class="col-md-9">
                            <span class="badge bg-{{ $book->campus === 'All Campus' ? 'primary' : ($book->campus === 'Satkhira' ? 'info' : 'success') }}">
                                <i class="fas fa-building me-1"></i>
                                {{ $book->campus }}
                            </span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <strong><i class="fas fa-heading me-2"></i>Title:</strong>
                        </div>
                        <div class="col-md-9">
                            {{ $book->title }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <strong><i class="fas fa-toggle-on me-2"></i>Status:</strong>
                        </div>
                        <div class="col-md-9">
                            <span class="badge bg-{{ $book->status_badge_color }}">
                                {{ ucfirst($book->status) }}
                            </span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <strong><i class="fas fa-calendar me-2"></i>Created:</strong>
                        </div>
                        <div class="col-md-9">
                            {{ $book->created_at->format('F d, Y h:i A') }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <strong><i class="fas fa-calendar-check me-2"></i>Last Updated:</strong>
                        </div>
                        <div class="col-md-9">
                            {{ $book->updated_at->format('F d, Y h:i A') }}
                        </div>
                    </div>

                    @if($book->created_by)
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <strong><i class="fas fa-user me-2"></i>Created By:</strong>
                        </div>
                        <div class="col-md-9">
                            {{ $book->created_by }}
                        </div>
                    </div>
                    @endif

                    @if($book->updated_by)
                    <div class="row">
                        <div class="col-md-3">
                            <strong><i class="fas fa-user-edit me-2"></i>Updated By:</strong>
                        </div>
                        <div class="col-md-9">
                            {{ $book->updated_by }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- PDF Preview Card -->
            @if($book->pdf_path)
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-file-pdf me-2"></i>PDF Document
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <i class="fas fa-file-pdf text-danger fa-2x me-3"></i>
                            <span class="h6">{{ basename($book->pdf_path) }}</span>
                        </div>
                        <a href="{{ $book->pdf_url }}" target="_blank" class="btn btn-primary">
                            <i class="fas fa-download me-2"></i>Download PDF
                        </a>
                    </div>
                    
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>File Location:</strong> {{ $book->pdf_path }}
                    </div>

                    <!-- PDF Embed Preview -->
                    <div class="border rounded p-2" style="height: 600px;">
                        <embed src="{{ $book->pdf_url }}" type="application/pdf" width="100%" height="100%">
                    </div>
                </div>
            </div>
            @endif
        </div>

        <div class="col-lg-4">
            <!-- Quick Actions -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-bolt me-2"></i>Quick Actions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('backend.book.edit', $book) }}" class="btn btn-outline-primary">
                            <i class="fas fa-edit me-2"></i>Edit Book
                        </a>
                        @if($book->pdf_path)
                        <a href="{{ $book->pdf_url }}" target="_blank" class="btn btn-outline-success">
                            <i class="fas fa-download me-2"></i>Download PDF
                        </a>
                        @endif
                        <button type="button" class="btn btn-outline-danger" onclick="deleteBook({{ $book->id }})">
                            <i class="fas fa-trash me-2"></i>Delete Book
                        </button>
                    </div>
                </div>
            </div>

            <!-- Statistics -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-bar me-2"></i>Statistics
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <span><i class="fas fa-calendar-plus me-2"></i>Days Since Created:</span>
                        <strong>{{ $book->created_at->diffInDays(now()) }} days</strong>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span><i class="fas fa-clock me-2"></i>Last Updated:</span>
                        <strong>{{ $book->updated_at->diffForHumans() }}</strong>
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
                <p>Are you sure you want to delete this book? This action cannot be undone.</p>
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    This will also delete the PDF file from the server.
                </div>
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
</script>
@endsection

