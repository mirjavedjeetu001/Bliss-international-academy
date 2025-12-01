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

    .campus-badge {
        display: inline-block;
        background: white;
        color: #667eea;
        padding: 8px 20px;
        border-radius: 25px;
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .download-section {
        margin-bottom: 50px;
    }

    .section-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 30px;
        padding-bottom: 15px;
        border-bottom: 3px solid #667eea;
        display: inline-block;
    }

    .download-list {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        overflow: hidden;
    }

    .download-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px 30px;
        border-bottom: 1px solid #f0f0f0;
        transition: all 0.3s ease;
    }

    .download-item:last-child {
        border-bottom: none;
    }

    .download-item:hover {
        background: linear-gradient(135deg, #f8f9ff 0%, #f5f7fa 100%);
        transform: translateX(5px);
    }

    .download-info {
        flex-grow: 1;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .download-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .download-icon i {
        font-size: 1.5rem;
        color: white;
    }

    .download-details {
        flex-grow: 1;
    }

    .download-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 5px;
    }

    .download-meta {
        display: flex;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 0.85rem;
        color: #7f8c8d;
    }

    .meta-item i {
        font-size: 0.8rem;
    }

    .type-badge {
        padding: 4px 12px;
        border-radius: 15px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .badge-form {
        background: #e8f4fd;
        color: #2196F3;
    }

    .badge-book {
        background: #fff3e0;
        color: #ff9800;
    }

    .download-btn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 12px 30px;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s ease;
        border: none;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }

    .download-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .download-btn i {
        font-size: 1rem;
    }

    .no-downloads {
        text-align: center;
        padding: 80px 20px;
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    }

    .no-downloads i {
        font-size: 80px;
        color: #e0e0e0;
        margin-bottom: 20px;
    }

    .no-downloads h3 {
        color: #7f8c8d;
        font-size: 1.5rem;
        margin-bottom: 10px;
    }

    .no-downloads p {
        color: #95a5a6;
        font-size: 1rem;
    }

    @media (max-width: 768px) {
        .page-header h1 {
            font-size: 2rem;
        }

        .download-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

        .download-info {
            width: 100%;
        }

        .download-btn {
            width: 100%;
            justify-content: center;
        }

        .download-meta {
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }
    }
</style>

<div class="page-header">
    <div class="container">
        <h1>BIA e-library</h1>
        <p><span class="campus-badge"><i class="fas fa-book me-2"></i>All Campus</span></p>
    </div>
</div>
<div class="container mb-5">
    @if($books->count() > 0)
    <div class="download-section">
        
        <div class="download-list">
            @foreach($books as $book)
            <div class="download-item">
                <div class="download-info">
                    <div class="download-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="download-details">
                        <h3 class="download-title">{{ $book->title }}</h3>
                        <div class="download-meta">
                            <span class="meta-item">
                                <i class="fas fa-calendar"></i>
                                {{ $book->created_at->format('M d, Y') }}
                            </span>
                            <span class="type-badge badge-book">
                                <i class="fas fa-book"></i>
                                Book
                            </span>
                        </div>
                    </div>
                </div>
                <a href="{{asset('/'.$book->pdf_path)}}" target="_blank" class="download-btn">
                    <i class="fas fa-download"></i>
                    Download
                </a>
            </div>
            @endforeach
        </div>
    </div>
    @else
    <div class="no-downloads">
        <i class="fas fa-book"></i>
        <h3>No Books Available</h3>
        <p>There are currently no books available in the library.</p>
    </div>
    @endif
</div>
@endsection

