@extends('master.backend-clean')

@section('title', 'Contact Message Details - Katunia Rajbari College')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Contact Message Details</h1>
            <p class="text-muted">View and manage contact message</p>
        </div>
        <div>
            <a href="{{ route('backend.contact.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to List
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Contact Message Details -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Message Information</h6>
                    @if($contact->is_read)
                        <span class="badge bg-success">Read</span>
                    @else
                        <span class="badge bg-warning">Unread</span>
                    @endif
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar-lg bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3">
                                    {{ strtoupper(substr($contact->name, 0, 1)) }}
                                </div>
                                <div>
                                    <h5 class="mb-0">{{ $contact->name }}</h5>
                                    <small class="text-muted">{{ $contact->created_at->format('M d, Y \a\t h:i A') }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-end">
                                <div class="mb-2">
                                    <strong>Subject:</strong> {{ $contact->subject }}
                                </div>
                                <div>
                                    <strong>Campus:</strong> 
                                    <span class="badge bg-info">{{ ucfirst($contact->campus ?? 'General') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Phone Number</label>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-phone text-primary me-2"></i>
                                    <a href="tel:{{ $contact->phone }}" class="text-decoration-none">
                                        {{ $contact->phone }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Email Address</label>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-envelope text-primary me-2"></i>
                                    @if($contact->email)
                                        <a href="mailto:{{ $contact->email }}" class="text-decoration-none">
                                            {{ $contact->email }}
                                        </a>
                                    @else
                                        <span class="text-muted">Not provided</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Message</label>
                        <div class="border rounded p-3 bg-light">
                            <p class="mb-0">{{ $contact->message }}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Submitted</label>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-clock text-primary me-2"></i>
                                    <div>
                                        <div>{{ $contact->created_at->format('M d, Y \a\t h:i A') }}</div>
                                        <small class="text-muted">{{ $contact->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Status</label>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-info-circle text-primary me-2"></i>
                                    @if($contact->is_read)
                                        <span class="badge bg-success">Read</span>
                                    @else
                                        <span class="badge bg-warning">Unread</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <!-- Actions Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Actions</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        @if($contact->is_read)
                            <form action="{{ route('backend.contact.mark-unread', $contact->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-warning w-100">
                                    <i class="fas fa-envelope me-2"></i>Mark as Unread
                                </button>
                            </form>
                        @else
                            <form action="{{ route('backend.contact.mark-read', $contact->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success w-100">
                                    <i class="fas fa-check me-2"></i>Mark as Read
                                </button>
                            </form>
                        @endif
                        
                        @if($contact->phone)
                            <a href="tel:{{ $contact->phone }}" class="btn btn-info w-100">
                                <i class="fas fa-phone me-2"></i>Call {{ $contact->name }}
                            </a>
                        @endif
                        
                        @if($contact->email)
                            <a href="mailto:{{ $contact->email }}" class="btn btn-primary w-100">
                                <i class="fas fa-envelope me-2"></i>Send Email
                            </a>
                        @endif
                        
                        <hr>
                        
                        <form action="{{ route('backend.contact.destroy', $contact->id) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this contact message?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="fas fa-trash me-2"></i>Delete Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Contact Information Card -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Contact Information</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar-sm bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3">
                            {{ strtoupper(substr($contact->name, 0, 1)) }}
                        </div>
                        <div>
                            <div class="fw-semibold">{{ $contact->name }}</div>
                            <small class="text-muted">Contact Person</small>
                        </div>
                    </div>
                    
                    @if($contact->phone)
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-phone text-success me-3"></i>
                        <div>
                            <div class="fw-semibold">{{ $contact->phone }}</div>
                            <small class="text-muted">Phone Number</small>
                        </div>
                    </div>
                    @endif
                    
                    @if($contact->email)
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-envelope text-info me-3"></i>
                        <div>
                            <div class="fw-semibold">{{ $contact->email }}</div>
                            <small class="text-muted">Email Address</small>
                        </div>
                    </div>
                    @endif
                    
                    <div class="d-flex align-items-center">
                        <i class="fas fa-building text-warning me-3"></i>
                        <div>
                            <div class="fw-semibold">{{ ucfirst($contact->campus ?? 'General') }}</div>
                            <small class="text-muted">Campus</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.avatar-lg {
    width: 60px;
    height: 60px;
    font-size: 1.5rem;
}

.avatar-sm {
    width: 40px;
    height: 40px;
    font-size: 1rem;
}

.shadow {
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15) !important;
}

.form-label {
    color: #5a5c69;
    font-weight: 600;
}
</style>
@endsection
