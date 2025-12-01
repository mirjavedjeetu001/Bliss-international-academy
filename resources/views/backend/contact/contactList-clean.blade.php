@extends('master.backend-clean')

@section('title', 'Contact Messages - Bliss International Academy')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Contact Messages</h1>
            <p class="text-muted">Manage all contact form submissions</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-primary" onclick="exportContacts()">
                <i class="fas fa-download me-2"></i>Export
            </button>
            <a href="{{ route('backend.contact.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-sync me-2"></i>Refresh
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
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Messages</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-envelope fa-2x text-gray-300"></i>
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
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Unread</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $unreadCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-bell fa-2x text-gray-300"></i>
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
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Read</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalCount - $unreadCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check fa-2x text-gray-300"></i>
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
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Models\Contact::where('created_at', '>=', now()->subWeek())->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-week fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters and Search -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" id="searchInput" placeholder="Search contacts...">
                    </div>
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="statusFilter">
                        <option value="">All Status</option>
                        <option value="read">Read</option>
                        <option value="unread">Unread</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="campusFilter">
                        <option value="">All Campuses</option>
                        <option value="satkhira">Satkhira</option>
                        <option value="debhata">Debhata</option>
                        <option value="general">General</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary w-100" onclick="clearFilters()">
                        <i class="fas fa-times me-1"></i>Clear
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Messages Table -->
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Contact Messages</h6>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-borderless" id="contactsTable">
                    <thead>
                        <tr>
                            <th>Contact</th>
                            <th>Subject</th>
                            <th>Campus</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($contacts as $contact)
                        <tr class="{{ !$contact->is_read ? 'table-warning' : '' }}">
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3">
                                        {{ strtoupper(substr($contact->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-semibold">{{ $contact->name }}</div>
                                        <small class="text-muted">{{ $contact->phone }}</small>
                                        @if($contact->email)
                                            <br><small class="text-muted">{{ $contact->email }}</small>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="fw-semibold">{{ $contact->subject }}</div>
                                <small class="text-muted">{{ Str::limit($contact->message, 50) }}</small>
                            </td>
                            <td>
                                <span class="badge bg-info">{{ ucfirst($contact->campus ?? 'General') }}</span>
                            </td>
                            <td>
                                <div class="fw-semibold">{{ $contact->created_at->format('M d, Y') }}</div>
                                <small class="text-muted">{{ $contact->created_at->format('h:i A') }}</small>
                            </td>
                            <td>
                                @if($contact->is_read)
                                    <span class="badge bg-success">Read</span>
                                @else
                                    <span class="badge bg-warning">Unread</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('backend.contact.show', $contact->id) }}" 
                                       class="btn btn-sm btn-outline-primary" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    
                                    @if($contact->is_read)
                                        <form action="{{ route('backend.contact.mark-unread', $contact->id) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-warning" title="Mark as Unread">
                                                <i class="fas fa-envelope"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('backend.contact.mark-read', $contact->id) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-success" title="Mark as Read">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                    @endif
                                    
                                    <form action="{{ route('backend.contact.destroy', $contact->id) }}" 
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this contact message?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="fas fa-inbox fa-4x mb-3"></i>
                                    <h5>No contact messages found</h5>
                                    <p>Contact messages will appear here when users submit the contact form.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($contacts->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $contacts->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.border-left-primary { border-left: 0.25rem solid #4e73df !important; }
.border-left-success { border-left: 0.25rem solid #1cc88a !important; }
.border-left-warning { border-left: 0.25rem solid #f6c23e !important; }
.border-left-info { border-left: 0.25rem solid #36b9cc !important; }

.avatar-sm {
    width: 40px;
    height: 40px;
    font-size: 1rem;
}

.text-xs { font-size: 0.7rem; }
.text-gray-300 { color: #dddfeb !important; }
.text-gray-800 { color: #5a5c69 !important; }
.shadow { box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15) !important; }

.table-warning {
    background-color: rgba(255, 193, 7, 0.1) !important;
}

.btn-group .btn {
    margin-right: 2px;
}

.btn-group .btn:last-child {
    margin-right: 0;
}
</style>

<script>
// Search functionality
document.getElementById('searchInput').addEventListener('input', function() {
    searchContacts();
});

// Filter functionality
document.getElementById('statusFilter').addEventListener('change', function() {
    filterContacts();
});

document.getElementById('campusFilter').addEventListener('change', function() {
    filterContacts();
});

function searchContacts() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const rows = document.querySelectorAll('#contactsTable tbody tr');
    
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        if (text.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

function filterContacts() {
    const statusFilter = document.getElementById('statusFilter').value;
    const campusFilter = document.getElementById('campusFilter').value;
    const rows = document.querySelectorAll('#contactsTable tbody tr');
    
    rows.forEach(row => {
        let showRow = true;
        
        // Status filter
        if (statusFilter) {
            const statusCell = row.querySelector('td:nth-child(5)');
            const statusText = statusCell.textContent.toLowerCase();
            if (statusFilter === 'read' && !statusText.includes('read')) {
                showRow = false;
            } else if (statusFilter === 'unread' && !statusText.includes('unread')) {
                showRow = false;
            }
        }
        
        // Campus filter
        if (campusFilter && showRow) {
            const campusCell = row.querySelector('td:nth-child(3)');
            const campusText = campusCell.textContent.toLowerCase();
            if (!campusText.includes(campusFilter)) {
                showRow = false;
            }
        }
        
        row.style.display = showRow ? '' : 'none';
    });
}

function clearFilters() {
    document.getElementById('searchInput').value = '';
    document.getElementById('statusFilter').value = '';
    document.getElementById('campusFilter').value = '';
    
    const rows = document.querySelectorAll('#contactsTable tbody tr');
    rows.forEach(row => {
        row.style.display = '';
    });
}

function exportContacts() {
    const table = document.getElementById('contactsTable');
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
    a.download = 'contact_messages_' + new Date().toISOString().split('T')[0] + '.csv';
    a.click();
    window.URL.revokeObjectURL(url);
}
</script>
@endsection
