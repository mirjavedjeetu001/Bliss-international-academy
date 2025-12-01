@extends('master.backend-clean')

@section('title', 'Manage Teachers')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="section-header">Manage Teachers</h2>
            <p class="text-muted mb-0">Manage your school teachers</p>
        </div>
        <a href="{{ route('backend.teacher.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Add New Teacher
        </a>
    </div>

    <!-- Search and Filter Bar -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" id="searchInput" placeholder="Search teachers...">
                    </div>
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="campusFilter">
                        <option value="">All Campus</option>
                        <option value="Satkhira">Satkhira</option>
                        <option value="Debhata">Debhata</option>
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

    <!-- Teachers Table -->
    <div class="card">
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($teachers->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Picture</th>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Campus</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Sort By</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($teachers as $teacher)
                                <tr>
                                    <td>{{ $teacher->id }}</td>
                                    <td>
                                        @if($teacher->picture)
                                            <img src="{{ asset($teacher->picture) }}" 
                                                 alt="{{ $teacher->name }}" 
                                                 class="rounded-circle" 
                                                 style="width: 40px; height: 40px; object-fit: cover;">
                                        @else
                                            <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center" 
                                                 style="width: 40px; height: 40px;">
                                                <i class="fas fa-user text-white"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div>
                                            <h6 class="mb-0">{{ $teacher->name }}</h6>
                                        </div>
                                    </td>
                                    <td>{{ $teacher->designation }}</td>
                                    <td>
                                        <span class="badge bg-{{ $teacher->campus === 'Satkhira' ? 'primary' : 'info' }}">
                                            {{ $teacher->campus }}
                                        </span>
                                    </td>
                                    <td>{{ $teacher->mobile }}</td>
                                    <td>{{ $teacher->email }}</td>
                                    <td>
                                        <span class="badge bg-{{ $teacher->status === 'active' ? 'success' : 'secondary' }}">
                                            {{ ucfirst($teacher->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $teacher->sort_by }}</span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('backend.teacher.show', $teacher) }}" 
                                               class="btn btn-sm btn-outline-info" 
                                               title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('backend.teacher.edit', $teacher) }}" 
                                               class="btn btn-sm btn-outline-primary" 
                                               title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" 
                                                    class="btn btn-sm btn-outline-danger" 
                                                    onclick="deleteTeacher({{ $teacher->id }})"
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
                    {{ $teachers->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-chalkboard-teacher fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No teachers found</h5>
                    <p class="text-muted">Get started by adding your first teacher.</p>
                    <a href="{{ route('backend.teacher.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Add First Teacher
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

<script>
function deleteTeacher(teacherId) {
    const form = document.getElementById('deleteForm');
    form.action = `/backend/teacher/${teacherId}`;
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}

// Search functionality
document.getElementById('searchInput').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const rows = document.querySelectorAll('tbody tr');
    
    rows.forEach(row => {
        const name = row.querySelector('h6')?.textContent.toLowerCase() || '';
        const designation = row.cells[3]?.textContent.toLowerCase() || '';
        const mobile = row.cells[5]?.textContent.toLowerCase() || '';
        const email = row.cells[6]?.textContent.toLowerCase() || '';
        
        if (name.includes(searchTerm) || designation.includes(searchTerm) || 
            mobile.includes(searchTerm) || email.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

// Campus filter
document.getElementById('campusFilter').addEventListener('change', function() {
    const filterValue = this.value;
    const rows = document.querySelectorAll('tbody tr');
    
    rows.forEach(row => {
        const campus = row.cells[4]?.textContent.trim();
        
        if (!filterValue || campus.includes(filterValue)) {
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
        const statusBadge = row.cells[7]?.querySelector('.badge');
        const status = statusBadge?.textContent.toLowerCase().trim();
        
        if (!filterValue || status === filterValue) {
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

