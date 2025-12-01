@extends('master.frontend')

@section('content')
<!-- All Videos Header -->
<section class="page-header py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('frontend.home.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('frontend.videogallery.index') }}">Video Gallery</a></li>
                        <li class="breadcrumb-item active" aria-current="page">All Videos</li>
                    </ol>
                </nav>
                <h1 class="page-title">All Videos</h1>
                <p class="page-subtitle">{{ $videos->total() }} videos available</p>
            </div>
        </div>
    </div>
</section>

<!-- Videos Grid Section -->
<section class="videos-section py-5">
    <div class="container">
        @if($videos->count() > 0)
            <div class="row">
                @foreach($videos as $video)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="video-card">
                            <div class="video-thumbnail">
                                @if($video->thumbnail)
                                    <img src="{{ $video->thumbnail_url }}" alt="{{ $video->title }}" class="video-img">
                                @else
                                    <div class="video-placeholder">
                                        <i class="fab fa-{{ $video->type === 'youtube' ? 'youtube' : 'facebook' }}"></i>
                                    </div>
                                @endif
                                <div class="video-overlay">
                                    <div class="play-button">
                                        <i class="fas fa-play"></i>
                                    </div>
                                </div>
                                <div class="video-type-badge">
                                    <i class="fab fa-{{ $video->type === 'youtube' ? 'youtube' : 'facebook' }}"></i>
                                </div>
                            </div>
                            <div class="video-content">
                                <h5 class="video-title">{{ $video->title }}</h5>
                                <div class="video-meta">
                                    <span class="video-date">
                                        <i class="fas fa-calendar me-1"></i>
                                        {{ $video->created_at->format('M d, Y') }}
                                    </span>
                                </div>
                                <div class="video-actions">
                                    <button class="btn btn-primary btn-sm video-play-btn" 
                                            data-video-url="{{ $video->url }}" 
                                            data-video-title="{{ $video->title }}">
                                        <i class="fas fa-play me-1"></i>Play
                                    </button>
                                    <a href="{{ $video->url }}" target="_blank" class="btn btn-outline-secondary btn-sm">
                                        <i class="fas fa-external-link-alt me-1"></i>Original
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($videos->hasPages())
                <div class="row">
                    <div class="col-12">
                        <nav aria-label="Video pagination">
                            {{ $videos->links() }}
                        </nav>
                    </div>
                </div>
            @endif
        @else
            <!-- No videos available -->
            <div class="row">
                <div class="col-12 text-center py-5">
                    <i class="fas fa-video fa-4x text-muted mb-4"></i>
                    <h3 class="text-muted">No Videos Available</h3>
                    <p class="text-muted">Check back later for new video content.</p>
                    <a href="{{ route('frontend.videogallery.index') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-left me-2"></i>Back to Categories
                    </a>
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Video Modal -->
<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="videoModalLabel" style="max-width: 80%; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">Video Player</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="ratio ratio-16x9">
                    <iframe id="videoFrame" src="" title="Video Player" allowfullscreen style="border-radius: 10px; box-shadow: 0 4px 20px rgba(0,0,0,0.1);"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.page-header {
    background: linear-gradient(135deg, #314465 0%, #4a5f7a 100%);
    color: white;
}

.breadcrumb {
    background: rgba(255,255,255,0.1);
    border-radius: 25px;
    padding: 0.5rem 1rem;
    margin-bottom: 1rem;
}

.breadcrumb-item a {
    color: rgba(255,255,255,0.8);
    text-decoration: none;
}

.breadcrumb-item a:hover {
    color: white;
}

.breadcrumb-item.active {
    color: white;
}

.page-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.page-subtitle {
    font-size: 1.1rem;
    opacity: 0.9;
    margin: 0;
}

.video-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    height: 100%;
}

.video-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.15);
}

.video-thumbnail {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.video-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.video-card:hover .video-img {
    transform: scale(1.05);
}

.video-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #a7c724 0%, #8fb91a 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2.5rem;
}

.video-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.video-card:hover .video-overlay {
    opacity: 1;
}

.play-button {
    width: 60px;
    height: 60px;
    background: rgba(255,255,255,0.9);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #333;
    font-size: 1.5rem;
    transition: all 0.3s ease;
    cursor: pointer;
}

.play-button:hover {
    background: white;
    transform: scale(1.1);
}

.video-type-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    width: 30px;
    height: 30px;
    background: rgba(0,0,0,0.7);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1rem;
}

.video-content {
    padding: 1.5rem;
}

.video-title {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: #333;
    line-height: 1.4;
    height: 2.8rem;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
}

.video-meta {
    margin-bottom: 1rem;
}

.video-date {
    font-size: 0.9rem;
    color: #666;
}

.video-actions {
    display: flex;
    gap: 0.5rem;
}

.video-actions .btn {
    flex: 1;
    border-radius: 20px;
    padding: 0.5rem 1rem;
    font-size: 0.9rem;
    transition: all 0.3s ease;
}

.video-actions .btn:hover {
    transform: translateY(-2px);
}

/* Pagination Styling */
.pagination {
    justify-content: center;
    margin-top: 2rem;
}

.page-link {
    border-radius: 50%;
    margin: 0 0.25rem;
    border: none;
    color: #314465;
    background: white;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.page-link:hover {
    background: #a7c724;
    color: white;
    transform: translateY(-2px);
}

.page-item.active .page-link {
    background: #a7c724;
    border-color: #a7c724;
}

@media (max-width: 768px) {
    .page-title {
        font-size: 1.8rem;
    }
    
    .page-subtitle {
        font-size: 1rem;
    }
    
    .video-actions {
        flex-direction: column;
    }
    
    .video-actions .btn {
        width: 100%;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Video gallery script loaded');
    
    // Video play button functionality
    const videoPlayBtns = document.querySelectorAll('.video-play-btn');
    const videoModalElement = document.getElementById('videoModal');
    const videoFrame = document.getElementById('videoFrame');
    const videoModalLabel = document.getElementById('videoModalLabel');
    
    console.log('Found video play buttons:', videoPlayBtns.length);
    console.log('Video modal element:', videoModalElement);
    
    if (videoModalElement && videoFrame && videoModalLabel) {
        const videoModal = new bootstrap.Modal(videoModalElement);

        videoPlayBtns.forEach((btn, index) => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const videoUrl = this.getAttribute('data-video-url');
                const videoTitle = this.getAttribute('data-video-title');
                
                console.log('Video button clicked:', index, videoUrl, videoTitle);
                
                if (videoUrl && videoTitle) {
                    videoFrame.src = videoUrl;
                    videoModalLabel.textContent = videoTitle;
                    videoModal.show();
                } else {
                    console.error('Missing video data:', { videoUrl, videoTitle });
                }
            });
        });

        // Clear video when modal is hidden
        videoModalElement.addEventListener('hidden.bs.modal', function() {
            videoFrame.src = '';
            console.log('Video modal closed');
        });
    } else {
        console.error('Required modal elements not found');
    }
});
</script>
@endsection
