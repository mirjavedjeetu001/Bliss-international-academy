@extends('master.backend-clean')

@section('title', 'View Teacher')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="section-header">Teacher Details</h2>
            <p class="text-muted mb-0">View teacher profile information</p>
        </div>
        <div class="btn-group">
            <a href="{{ route('backend.teacher.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to Teachers
            </a>
            <a href="{{ route('backend.teacher.edit', $teacher) }}" class="btn btn-primary">
                <i class="fas fa-edit me-2"></i>Edit Teacher
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <!-- Picture Card -->
            <div class="card mb-4">
                <div class="card-body text-center">
                    @if($teacher->picture)
                        <img src="{{ asset($teacher->picture) }}" 
                             alt="{{ $teacher->name }}" 
                             class="img-fluid rounded mb-3" 
                             style="max-height: 300px; object-fit: cover;">
                    @else
                        <div class="rounded bg-secondary d-flex align-items-center justify-content-center mb-3" 
                             style="height: 300px;">
                            <i class="fas fa-user fa-5x text-white"></i>
                        </div>
                    @endif
                    
                    <h4 class="mb-2">{{ $teacher->name }}</h4>
                    <p class="text-muted mb-3">{{ $teacher->designation }}</p>
                    
                    <div class="d-flex justify-content-center gap-2">
                        <span class="badge bg-{{ $teacher->campus === 'Satkhira' ? 'primary' : 'info' }} px-3 py-2">
                            <i class="fas fa-building me-1"></i>{{ $teacher->campus }}
                        </span>
                        <span class="badge bg-{{ $teacher->status === 'active' ? 'success' : 'secondary' }} px-3 py-2">
                            <i class="fas fa-circle me-1" style="font-size: 0.5rem;"></i>{{ ucfirst($teacher->status) }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-address-card me-2"></i>Contact Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="text-muted small mb-1">
                            <i class="fas fa-phone me-2"></i>Mobile
                        </div>
                        <div class="fw-semibold">{{ $teacher->mobile }}</div>
                    </div>
                    
                    <div class="mb-3">
                        <div class="text-muted small mb-1">
                            <i class="fas fa-envelope me-2"></i>Email
                        </div>
                        <div class="fw-semibold">{{ $teacher->email }}</div>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <a href="tel:{{ $teacher->mobile }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-phone me-2"></i>Call
                        </a>
                        <a href="mailto:{{ $teacher->email }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-envelope me-2"></i>Email
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <!-- Qualification Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-graduation-cap me-2"></i>Qualification
                    </h5>
                </div>
                <div class="card-body">
                    <div class="qualification-content">
                        {!! nl2br(e($teacher->qualification)) !!}
                    </div>
                </div>
            </div>

            <!-- Additional Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>Additional Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="text-muted small mb-1">Teacher ID</div>
                            <div class="fw-semibold">#{{ $teacher->id }}</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="text-muted small mb-1">Campus</div>
                            <div class="fw-semibold">{{ $teacher->campus }}</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="text-muted small mb-1">Status</div>
                            <div class="fw-semibold">{{ ucfirst($teacher->status) }}</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="text-muted small mb-1">Sort By</div>
                            <div class="fw-semibold">{{ $teacher->sort_by }}</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="text-muted small mb-1">Created At</div>
                            <div class="fw-semibold">{{ $teacher->created_at->format('M d, Y h:i A') }}</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="text-muted small mb-1">Last Updated</div>
                            <div class="fw-semibold">{{ $teacher->updated_at->format('M d, Y h:i A') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions Card -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-cog me-2"></i>Actions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-flex gap-2">
                        <a href="{{ route('backend.teacher.edit', $teacher) }}" class="btn btn-primary">
                            <i class="fas fa-edit me-2"></i>Edit Teacher
                        </a>
                        <button type="button" 
                                class="btn btn-danger" 
                                onclick="deleteTeacher({{ $teacher->id }})">
                            <i class="fas fa-trash me-2"></i>Delete Teacher
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
                <p>Are you sure you want to delete this teacher? This action cannot be undone.</p>
                <p class="text-danger"><strong>The teacher's picture will also be deleted.</strong></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Teacher</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.qualification-content {
    line-height: 1.8;
    font-size: 1rem;
}
</style>

<script>
function deleteTeacher(teacherId) {
    const form = document.getElementById('deleteForm');
    form.action = `/backend/teacher/${teacherId}`;
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}
</script>
@endsection

