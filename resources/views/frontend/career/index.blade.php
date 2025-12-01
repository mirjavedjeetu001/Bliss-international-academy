@extends('master.frontend')

@section('content')
<style>
    .page-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 80px 0 60px;
        color: white;
        text-align: center;
        margin-bottom: 60px;
    }

    .page-header h2 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 10px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
    }

    .page-header p {
        font-size: 1.1rem;
        opacity: 0.9;
    }

    .career-section {
        margin-bottom: 50px;
    }

    .career-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        padding: 30px;
        margin-bottom: 30px;
        transition: all 0.3s ease;
        border-left: 5px solid #667eea;
    }

    .career-card:hover {
        box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        transform: translateY(-5px);
    }

    .career-header {
        display: flex;
        align-items: start;
        justify-content: space-between;
        margin-bottom: 20px;
        gap: 20px;
    }

    .career-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 10px;
        flex-grow: 1;
    }

    .career-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, #1cc88a 0%, #13855c 100%);
        color: white;
        padding: 8px 16px;
        border-radius: 25px;
        font-size: 0.85rem;
        font-weight: 600;
        white-space: nowrap;
    }

    .career-meta {
        display: flex;
        gap: 20px;
        margin-bottom: 15px;
        flex-wrap: wrap;
    }

    .career-meta-item {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #6c757d;
        font-size: 0.9rem;
    }

    .career-meta-item i {
        color: #667eea;
    }

    .career-detail {
        color: #555;
        line-height: 1.8;
        margin-bottom: 20px;
        white-space: pre-wrap;
    }

    .career-actions {
        display: flex;
        gap: 15px;
        align-items: center;
        padding-top: 20px;
        border-top: 1px solid #f0f0f0;
    }

    .btn-view-details {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 12px 30px;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
    }

    .btn-view-details:hover {
        transform: translateX(5px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .btn-download {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: white;
        color: #667eea;
        padding: 12px 30px;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        border: 2px solid #667eea;
    }

    .btn-download:hover {
        background: #667eea;
        color: white;
        transform: translateX(5px);
    }

    .no-careers {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    }

    .no-careers i {
        font-size: 4rem;
        color: #ddd;
        margin-bottom: 20px;
    }

    .no-careers h3 {
        color: #2c3e50;
        margin-bottom: 10px;
    }

    .no-careers p {
        color: #6c757d;
    }

    .pagination {
        margin-top: 40px;
        justify-content: center;
    }

    .pagination .page-link {
        color: #667eea;
        border: 1px solid #667eea;
        margin: 0 5px;
        border-radius: 5px;
    }

    .pagination .page-link:hover {
        background: #667eea;
        color: white;
    }

    .pagination .active .page-link {
        background: #667eea;
        border-color: #667eea;
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h2 class="section-header">Career Opportunities</h2>
        <p>Join our team and make a difference in education</p>
        <div class="mt-3">
            <p><i class="fas fa-envelope me-2"></i>Career Email: <strong>Career@blim.edu.bd</strong></p>
        </div>
    </div>
</div>

<!-- Career Listings -->
<section class="career-section">
    <div class="container">
        @if($careers->count() > 0)
            <div class="row">
                <div class="col-12">
                    @foreach($careers as $career)
                        <div class="career-card">
                            <div class="career-header">
                                <h3 class="career-title">{{ $career->title }}</h3>
                                <span class="career-badge">
                                    <i class="fas fa-briefcase"></i> Career
                                </span>
                            </div>

                            <div class="career-meta">
                                <div class="career-meta-item">
                                    <i class="fas fa-calendar-alt"></i>
                                    <span>Posted: {{ $career->created_at->format('F d, Y') }}</span>
                                </div>
                                @if($career->created_by)
                                    <div class="career-meta-item">
                                        <i class="fas fa-user"></i>
                                        <span>{{ $career->created_by }}</span>
                                    </div>
                                @endif
                                @if($career->attachment)
                                    <div class="career-meta-item">
                                        <i class="fas fa-paperclip"></i>
                                        <span>Attachment Available</span>
                                    </div>
                                @endif
                            </div>

                            @if($career->detail)
                                <div class="career-detail">
                                    {{ $career->detail }}
                                </div>
                            @endif

                            @if($career->attachment)
                                <div class="career-actions">
                                    <a href="{{ asset('backend/attachments/' . $career->attachment) }}" 
                                       target="_blank" 
                                       class="btn-view-details">
                                        <i class="fas fa-file-pdf"></i>
                                        View Details (PDF)
                                    </a>
                                    <a href="{{ asset('backend/attachments/' . $career->attachment) }}" 
                                       download 
                                       class="btn-download">
                                        <i class="fas fa-download"></i>
                                        Download
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endforeach

                    <!-- Pagination -->
                    @if($careers->hasPages())
                        <div class="d-flex justify-content-center">
                            {{ $careers->links() }}
                        </div>
                    @endif
                </div>
            </div>
        @else
            <div class="no-careers">
                <i class="fas fa-briefcase"></i>
                <h3>No Career Opportunities Available</h3>
                <p>We don't have any job openings at the moment. Please check back later or contact us for more information.</p>
            </div>
        @endif
    </div>
</section>
@endsection

