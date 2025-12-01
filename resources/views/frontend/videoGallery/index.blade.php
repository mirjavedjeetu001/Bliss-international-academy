@extends('master.frontend')

@section('content')
<!-- Video Gallery Header -->
<section class="page-header py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="page-title">Video Gallery</h1>
                <p class="page-subtitle">Explore our collection of videos showcasing school activities and events</p>
            </div>
        </div>
    </div>
</section>

<!-- Video Categories Section -->
<section class="video-categories-section py-5">
    <div class="container">
        @if(isset($categories) && $categories->count() > 0)
            <div class="row">
                @foreach($categories as $category)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="category-card">
                            <div class="category-image">
                                @if($category->image)
                                    <img src="{{ $category->image_url }}" alt="{{ $category->name }}" class="category-img">
                                @else
                                    <div class="category-placeholder">
                                        <i class="fas fa-video"></i>
                                    </div>
                                @endif
                                <div class="category-overlay">
                                    <div class="category-info">
                                        <h3 class="category-title">{{ $category->name }}</h3>
                                        <p class="category-count">{{ $category->video_galleries_count }} Videos</p>
                                    </div>
                                </div>
                            </div>
                            <div class="category-content">
                                <h4 class="category-name">{{ $category->name }}</h4>
                                <p class="category-description">Explore {{ $category->video_galleries_count }} videos in this category</p>
                                <a href="{{ route('frontend.videogallery.category', $category->id) }}" class="btn btn-primary category-btn">
                                    <i class="fas fa-play me-2"></i>View Videos
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @elseif(isset($allVideos) && $allVideos->count() > 0)
            <!-- Fallback: Show all videos if no categories -->
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <i class="fas fa-info-circle me-2"></i>
                        No categories available. Showing all videos.
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($allVideos as $video)
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
                            </div>
                            <div class="video-content">
                                <h5 class="video-title">{{ $video->title }}</h5>
                                <div class="video-meta">
                                    <span class="video-type">
                                        <i class="fab fa-{{ $video->type === 'youtube' ? 'youtube' : 'facebook' }} me-1"></i>
                                        {{ ucfirst($video->type) }}
                                    </span>
                                </div>
                                <button class="btn btn-primary btn-sm video-play-btn" 
                                        data-video-url="{{ $video->embed_url }}" 
                                        data-video-title="{{ $video->title }}">
                                    <i class="fas fa-play me-1"></i>Play Video
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- No videos available -->
            <div class="row">
                <div class="col-12 text-center py-5">
                    <i class="fas fa-video fa-4x text-muted mb-4"></i>
                    <h3 class="text-muted">No Videos Available</h3>
                    <p class="text-muted">Check back later for new video content.</p>
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

.page-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.page-subtitle {
    font-size: 1.1rem;
    opacity: 0.9;
}

.category-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    height: 100%;
}

.category-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.category-image {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.category-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.category-card:hover .category-img {
    transform: scale(1.1);
}

.category-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #314465 0%, #4a5f7a 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2.5rem;
}

.category-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.category-card:hover .category-overlay {
    opacity: 1;
}

.category-info {
    text-align: center;
    color: white;
}

.category-title {
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.category-count {
    font-size: 0.9rem;
    margin: 0;
}

.category-content {
    padding: 1.5rem;
}

.category-name {
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: #314465;
}

.category-description {
    color: #666;
    margin-bottom: 1rem;
    font-size: 0.95rem;
}

.category-btn {
    width: 100%;
    border-radius: 25px;
    padding: 0.75rem 1.5rem;
    font-weight: 500;
    font-size: 0.95rem;
    background-color: #a7c724;
    border-color: #a7c724;
    transition: all 0.3s ease;
}

.category-btn:hover {
    background-color: #8fb91a;
    border-color: #8fb91a;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(167, 199, 36, 0.3);
}

.video-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    overflow: hidden;
    transition: transform 0.3s ease;
    height: 100%;
}

.video-card:hover {
    transform: translateY(-5px);
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
}

.play-button:hover {
    background: white;
    transform: scale(1.1);
}

.video-content {
    padding: 1.5rem;
}

.video-title {
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: #314465;
    line-height: 1.4;
}

.video-meta {
    margin-bottom: 1rem;
}

.video-type {
    font-size: 0.9rem;
    color: #666;
}

.video-play-btn {
    width: 100%;
    border-radius: 20px;
    padding: 0.5rem 1rem;
    font-size: 0.9rem;
    background-color: #a7c724;
    border-color: #a7c724;
}

.video-play-btn:hover {
    background-color: #8fb91a;
    border-color: #8fb91a;
}

@media (max-width: 768px) {
    .page-title {
        font-size: 1.8rem;
    }
    
    .page-subtitle {
        font-size: 0.95rem;
    }
    
    .category-title {
        font-size: 1.1rem;
    }
    
    .category-name {
        font-size: 1.1rem;
    }
    
    .video-title {
        font-size: 0.95rem;
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
