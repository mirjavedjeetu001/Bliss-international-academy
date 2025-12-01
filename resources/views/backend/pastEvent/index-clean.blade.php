@extends('master.backend-clean')

@section('title', 'Manage Past Events - Bliss International Academy')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Manage Past Events</h1>
            <p class="text-muted">Manage past events and activities</p>
        </div>
        <div>
            <a href="{{ route('backend.pastevent.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Add New Past Event
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
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Events</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pastevents->total() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
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
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pastevents->where('created_at', '>=', now()->subMonth())->count() }}</div>
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
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">This Week</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pastevents->where('created_at', '>=', now()->subWeek())->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-day fa-2x text-gray-300"></i>
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
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">With Images</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pastevents->whereNotNull('image')->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-image fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Past Events Table -->
    <div class="card shadow">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">All Past Events</h6>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-primary btn-sm" onclick="exportEvents()">
                    <i class="fas fa-download me-1"></i>Export
                </button>
                <a href="{{ route('backend.pastevent.index') }}" class="btn btn-outline-secondary btn-sm">
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

            @if($pastevents->count() > 0)
                <div class="table-responsive">
                    <table class="table table-borderless" id="eventsTable">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Detail</th>
                                <th>Created By</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pastevents as $pastevent)
                                <tr>
                                    <td>
                                        @if($pastevent->image)
                                            <div class="event-image-container">
                                                <img src="{{ asset('backend/assets/images/events/' . $pastevent->image) }}" 
                                                     alt="{{ $pastevent->title }}" 
                                                     class="event-thumbnail"
                                                     data-bs-toggle="modal" 
                                                     data-bs-target="#imageModal{{ $pastevent->id }}">
                                            </div>
                                        @else
                                            <div class="no-image-placeholder">
                                                <i class="fas fa-calendar text-muted"></i>
                                                <small class="text-muted d-block">No Image</small>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="fw-semibold">{{ $pastevent->title }}</div>
                                        <small class="text-muted">ID: {{ $pastevent->id }}</small>
                                    </td>
                                    <td>
                                        <div class="event-detail">{{ Str::limit($pastevent->detail, 60) }}</div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm bg-info text-white rounded-circle d-flex align-items-center justify-content-center me-2">
                                                {{ strtoupper(substr($pastevent->created_by ?? 'A', 0, 1)) }}
                                            </div>
                                            <div>
                                                <div class="fw-semibold">{{ $pastevent->created_by ?? 'System' }}</div>
                                                @if($pastevent->updated_by)
                                                    <small class="text-muted">Updated by: {{ $pastevent->updated_by }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-semibold">{{ $pastevent->created_at->format('M d, Y') }}</div>
                                        <small class="text-muted">{{ $pastevent->created_at->format('h:i A') }}</small>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('backend.pastevent.edit', $pastevent) }}" 
                                               class="btn btn-sm btn-outline-primary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('backend.pastevent.destroy', $pastevent) }}" 
                                                  method="POST" 
                                                  class="d-inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this past event?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Image Modal -->
                                @if($pastevent->image)
                                <div class="modal fade" id="imageModal{{ $pastevent->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">{{ $pastevent->title }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <img src="{{ asset('backend/assets/images/events/' . $pastevent->image) }}" 
                                                     alt="{{ $pastevent->title }}" 
                                                     class="img-fluid rounded">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($pastevents->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $pastevents->links() }}
                    </div>
                @endif
            @else
                <div class="text-center py-5">
                    <div class="text-muted">
                        <i class="fas fa-calendar-alt fa-4x mb-3"></i>
                        <h5>No past events found</h5>
                        <p>Start by adding your first past event to showcase your activities.</p>
                        <a href="{{ route('backend.pastevent.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Add New Past Event
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

.event-thumbnail {
    width: 80px;
    height: 50px;
    object-fit: cover;
    border-radius: 0.5rem;
    cursor: pointer;
    transition: transform 0.2s ease;
}

.event-thumbnail:hover {
    transform: scale(1.05);
}

.no-image-placeholder {
    width: 80px;
    height: 50px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background: #f8f9fa;
    border-radius: 0.5rem;
    border: 2px dashed #dee2e6;
}

.event-detail {
    max-width: 200px;
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
function exportEvents() {
    const table = document.getElementById('eventsTable');
    const rows = table.querySelectorAll('tr');
    let csv = [];
    
    for (let i = 0; i < rows.length; i++) {
        const row = [], cols = rows[i].querySelectorAll('td, th');
        for (let j = 0; j < cols.length; j++) {
            let cellText = cols[j].innerText.replace(/"/g, '""');
            row.push('"' + cellText + '"');
        }
        csv.push(row.join(','));
    }
    
    const csvContent = csv.join('\n');
    const blob = new Blob([csvContent], { type: 'text/csv' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'past_events_' + new Date().toISOString().split('T')[0] + '.csv';
    a.click();
    window.URL.revokeObjectURL(url);
}
</script>
@endsection
