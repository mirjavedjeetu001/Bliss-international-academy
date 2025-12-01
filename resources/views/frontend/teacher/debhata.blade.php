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

    .page-header h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 10px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
    }

    .page-header p {
        font-size: 1.1rem;
        opacity: 0.9;
    }

    .teacher-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        overflow: hidden;
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .teacher-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.15);
    }

    .teacher-image-wrapper {
        position: relative;
        padding: 30px 30px 20px;
        text-align: center;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }

    .teacher-image {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid white;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        margin: 0 auto;
    }

    .teacher-image-placeholder {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        border: 5px solid white;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        margin: 0 auto;
    }

    .teacher-image-placeholder i {
        font-size: 60px;
        color: white;
    }

    .teacher-header {
        text-align: center;
        padding: 20px 25px 15px;
        border-bottom: 2px solid #f0f0f0;
    }

    .teacher-name {
        font-size: 1.3rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 8px;
    }

    .teacher-designation {
        font-size: 1rem;
        color: #667eea;
        font-weight: 600;
        margin-bottom: 0;
    }

    .teacher-body {
        padding: 20px 25px 25px;
        flex-grow: 1;
    }

    .teacher-info-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 15px;
        text-align: left;
    }

    .teacher-info-item:last-child {
        margin-bottom: 0;
    }

    .teacher-info-icon {
        width: 35px;
        height: 35px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
        flex-shrink: 0;
    }

    .teacher-info-icon i {
        color: white;
        font-size: 0.9rem;
    }

    .teacher-info-content {
        flex-grow: 1;
    }

    .teacher-info-label {
        font-size: 0.75rem;
        color: #95a5a6;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 3px;
        font-weight: 600;
    }

    .teacher-info-text {
        font-size: 0.95rem;
        color: #2c3e50;
        line-height: 1.6;
        word-break: break-word;
    }

    .teacher-info-text a {
        color: #667eea;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .teacher-info-text a:hover {
        color: #764ba2;
        text-decoration: underline;
    }

    .no-teachers {
        text-align: center;
        padding: 80px 20px;
    }

    .no-teachers i {
        font-size: 80px;
        color: #e0e0e0;
        margin-bottom: 20px;
    }

    .no-teachers h3 {
        color: #7f8c8d;
        font-size: 1.5rem;
        margin-bottom: 10px;
    }

    .no-teachers p {
        color: #95a5a6;
        font-size: 1rem;
    }

    .campus-badge {
        display: inline-block;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 8px 20px;
        border-radius: 25px;
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 15px;
    }

    @media (max-width: 768px) {
        .page-header h1 {
            font-size: 2rem;
        }

        .teacher-card {
            margin-bottom: 30px;
        }
    }
</style>

<div class="page-header">
    <div class="container">
        <h1>Our Faculties</h1>
        <p><span class="campus-badge"><i class="fas fa-building me-2"></i>Debhata Campus</span></p>
    </div>
</div>
<div class="container mb-5">
    @if($teachers->count() > 0)
        <div class="row g-4">
            @foreach($teachers as $teacher)
                <div class="col-lg-4 col-md-6">
                    <div class="teacher-card">
                        <div class="teacher-image-wrapper">
                            @if($teacher->picture)
                                <img src="/{{ $teacher->picture }}" alt="{{ $teacher->name }}" class="teacher-image">
                            @else
                                <div class="teacher-image-placeholder">
                                    <i class="fas fa-user"></i>
                                </div>
                            @endif
                        </div>

                        <div class="teacher-header">
                            <h3 class="teacher-name">{{ $teacher->name }}</h3>
                            <p class="teacher-designation">{{ $teacher->designation }}</p>
                        </div>

                        <div class="teacher-body">
                            <div class="teacher-info-item">
                                <div class="teacher-info-icon">
                                    <i class="fas fa-graduation-cap"></i>
                                </div>
                                <div class="teacher-info-content">
                                    <div class="teacher-info-label">Qualification</div>
                                    <div class="teacher-info-text">{!! nl2br(e($teacher->qualification)) !!}</div>
                                </div>
                            </div>

                            <div class="teacher-info-item">
                                <div class="teacher-info-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="teacher-info-content">
                                    <div class="teacher-info-label">Mobile</div>
                                    <div class="teacher-info-text">
                                        <a href="tel:{{ $teacher->mobile }}">{{ $teacher->mobile }}</a>
                                    </div>
                                </div>
                            </div>

                            <div class="teacher-info-item">
                                <div class="teacher-info-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="teacher-info-content">
                                    <div class="teacher-info-label">Email</div>
                                    <div class="teacher-info-text">
                                        <a href="mailto:{{ $teacher->email }}">{{ $teacher->email }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="no-teachers">
            <i class="fas fa-chalkboard-teacher"></i>
            <h3>No Teachers Found</h3>
            <p>There are currently no teachers listed for Debhata Campus.</p>
        </div>
    @endif
</div>
@endsection

