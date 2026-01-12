@extends('master.backend-clean')

@section('title', 'Manage Sliders - Katunia Rajbari College')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Manage Sliders</h1>
            <p class="text-muted">Manage homepage slider images and content</p>
        </div>
        <div>
            <a href="{{ route('backend.slider.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Add New Slider
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
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Sliders</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $sliders->total() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-images fa-2x text-gray-300"></i>
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
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Active</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $sliders->where('status', 'active')->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
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
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Inactive</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $sliders->where('status', 'inactive')->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-pause-circle fa-2x text-gray-300"></i>
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
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">This Month</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $sliders->where('created_at', '>=', now()->subMonth())->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sliders Table -->
    <div class="card shadow">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">All Sliders</h6>
            <div class="d-flex gap-2">
                <a href="{{ route('backend.slider.index') }}" class="btn btn-outline-secondary btn-sm">
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

            @if($sliders->count() > 0)
                <div class="table-responsive">
                    <table class="table table-borderless" id="slidersTable">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Detail</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sliders as $slider)
                                <tr>
                                    <td>
                                        @if($slider->image)
                                            <div class="slider-image-container">
                                                <img src="{{ asset('frontend/assets/images/sliders/' . $slider->image) }}" 
                                                     alt="{{ $slider->title }}" 
                                                     class="slider-thumbnail"
                                                     data-bs-toggle="modal" 
                                                     data-bs-target="#imageModal{{ $slider->id }}">
                                            </div>
                                        @else
                                            <div class="no-image-placeholder">
                                                <i class="fas fa-image text-muted"></i>
                                                <small class="text-muted d-block">No Image</small>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="fw-semibold">{{ $slider->title }}</div>
                                        <small class="text-muted">ID: {{ $slider->id }}</small>
                                    </td>
                                    <td>
                                        <div class="slider-detail">{{ Str::limit($slider->detail, 60) }}</div>
                                    </td>
                                    <td>
                                        @if($slider->status == 'active')
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-warning">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="fw-semibold">{{ $slider->created_at->format('M d, Y') }}</div>
                                        <small class="text-muted">{{ $slider->created_at->format('h:i A') }}</small>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('backend.slider.edit', $slider) }}" 
                                               class="btn btn-sm btn-outline-primary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('backend.slider.destroy', $slider) }}" 
                                                  method="POST" 
                                                  class="d-inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this slider?')">
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
                                @if($slider->image)
                                <div class="modal fade" id="imageModal{{ $slider->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">{{ $slider->title }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <img src="{{ asset('frontend/assets/images/sliders/' . $slider->image) }}" 
                                                     alt="{{ $slider->title }}" 
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
                @if($sliders->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $sliders->links() }}
                    </div>
                @endif
            @else
                <div class="text-center py-5">
                    <div class="text-muted">
                        <i class="fas fa-images fa-4x mb-3"></i>
                        <h5>No sliders found</h5>
                        <p>Start by adding your first slider to showcase your content.</p>
                        <a href="{{ route('backend.slider.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Add New Slider
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
.border-left-warning { border-left: 0.25rem solid #f6c23e !important; }
.border-left-info { border-left: 0.25rem solid #36b9cc !important; }

.text-xs { font-size: 0.7rem; }
.text-gray-300 { color: #dddfeb !important; }
.text-gray-800 { color: #5a5c69 !important; }
.shadow { box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15) !important; }

.slider-thumbnail {
    width: 80px;
    height: 50px;
    object-fit: cover;
    border-radius: 0.5rem;
    cursor: pointer;
    transition: transform 0.2s ease;
}

.slider-thumbnail:hover {
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

.slider-detail {
    max-width: 200px;
    line-height: 1.4;
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
