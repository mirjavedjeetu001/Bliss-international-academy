@extends('master.backend-clean')

@section('title', 'Manage Latest Updates - Bliss International Academy')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Manage Latest Updates</h1>
            <p class="text-muted">Manage news and announcements</p>
        </div>
        <div>
            <a href="{{ route('backend.latestupdate.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Add New Update
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Updates</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $latestupdates->total() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">This Month</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $latestupdates->where('created_at', '>=', now()->subMonth())->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-week fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">With Attachments</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $latestupdates->whereNotNull('attachment')->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-pdf fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">This Week</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $latestupdates->where('created_at', '>=', now()->subWeek())->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-day fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Latest Updates Table -->
    <div class="card shadow">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">All Latest Updates</h6>
            <div class="d-flex gap-2">
                <a href="{{ route('backend.latestupdate.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="fas fa-sync me-1"></i>Refresh
                </a>
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($latestupdates->count() > 0)
                <div class="table-responsive">
                    <table class="table table-borderless" id="updatesTable">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Type</th>
                                <th>Detail</th>
                                <th>Attachment</th>
                                <th>Created By</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($latestupdates as $latestupdate)
                                <tr>
                                    <td>
                                        <div class="fw-semibold">{{ $latestupdate->title }}</div>
                                        <small class="text-muted">ID: {{ $latestupdate->id }}</small>
                                    </td>
                                    <td>
                                        @if($latestupdate->type == 'career')
                                            <span class="badge bg-success">
                                                <i class="fas fa-briefcase me-1"></i>Career
                                            </span>
                                        @else
                                            <span class="badge bg-primary">
                                                <i class="fas fa-bell me-1"></i>Update
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="update-detail">{{ Str::limit($latestupdate->detail, 80) }}</div>
                                    </td>
                                    <td>
                                        @if($latestupdate->attachment)
                                            <a href="{{ asset('main/backend/attachments/' . $latestupdate->attachment) }}" 
                                               target="_blank" 
                                               class="btn btn-sm btn-outline-info">
                                                <i class="fas fa-file-pdf me-1"></i>View PDF
                                            </a>
                                        @else
                                            <span class="text-muted">
                                                <i class="fas fa-file-slash me-1"></i>No Attachment
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-2">
                                                {{ strtoupper(substr($latestupdate->created_by ?? 'A', 0, 1)) }}
                                            </div>
                                            <div>
                                                <div class="fw-semibold">{{ $latestupdate->created_by ?? 'System' }}</div>
                                                @if($latestupdate->updated_by)
                                                    <small class="text-muted">Updated by: {{ $latestupdate->updated_by }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-semibold">{{ $latestupdate->created_at->format('M d, Y') }}</div>
                                        <small class="text-muted">{{ $latestupdate->created_at->format('h:i A') }}</small>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('backend.latestupdate.edit', $latestupdate) }}" 
                                               class="btn btn-sm btn-outline-primary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('backend.latestupdate.destroy', $latestupdate) }}" 
                                                  method="POST" 
                                                  class="d-inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this latest update?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($latestupdates->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $latestupdates->links() }}
                    </div>
                @endif
            @else
                <div class="text-center py-5">
                    <div class="text-muted">
                        <i class="fas fa-newspaper fa-4x mb-3"></i>
                        <h5>No latest updates found</h5>
                        <p>Start by adding your first update to keep your community informed.</p>
                        <a href="{{ route('backend.latestupdate.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Add New Update
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.border-left-primary { border-left: 0.25rem solid #4e73df !important; }
.border-left-success { border-left: 0.25rem solid #1cc88a !important; }
.border-left-info { border-left: 0.25rem solid #36b9cc !important; }
.border-left-warning { border-left: 0.25rem solid #f6c23e !important; }

.text-xs { font-size: 0.7rem; }
.text-gray-300 { color: #dddfeb !important; }
.text-gray-800 { color: #5a5c69 !important; }
.shadow { box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15) !important; }

.update-detail {
    max-width: 250px;
    line-height: 1.4;
}

.avatar-sm {
    width: 32px;
    height: 32px;
    font-size: 0.875rem;
}

.btn-group .btn {
    margin-right: 2px;
}

.btn-group .btn:last-child {
    margin-right: 0;
}
</style>

<script>
</script>
@endsection
