@extends('master.frontend')

@section('content')
<!-- Photo Category Header -->
<section class="page-header py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('frontend.home.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('frontend.photogallery.index') }}">Photo Gallery</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
                    </ol>
                </nav>
                <h1 class="page-title">{{ $category->name }}</h1>
                <p class="page-subtitle">{{ $photos->total() }} photos in this category</p>
            </div>
        </div>
    </div>
</section>

<!-- Photos Grid Section -->
<section class="photos-section py-5">
    <div class="container">
        @if($photos->count() > 0)
            <div class="row">
                @foreach($photos as $photo)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="photo-card">
                            <div class="photo-thumbnail">
                                <img src="{{ asset('backend/assets/images/photo-gallery/' . $photo->image) }}" alt="{{ $photo->title }}" class="photo-img">

                                



                                <div class="photo-overlay">
                                    <div class="photo-actions">
                                        <button class="btn btn-light photo-view-btn" 
                                                data-photo-url="{{ asset('backend/assets/images/photo-gallery/' . $photo->image) }}" 
                                                data-photo-title="{{ $photo->title }}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="photo-content">
                                <h5 class="photo-title">{{ $photo->title }}</h5>
                                <div class="photo-meta">
                                    <span class="photo-date">
                                        <i class="fas fa-calendar me-1"></i>
                                        {{ $photo->created_at->format('M d, Y') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($photos->hasPages())
                <div class="row">
                    <div class="col-12">
                        <nav aria-label="Photo pagination">
                            <ul class="pagination justify-content-center">
                                {{ $photos->links() }}
                            </ul>
                        </nav>
                    </div>
                </div>
            @endif
        @else
            <!-- No photos in this category -->
            <div class="row">
                <div class="col-12 text-center py-5">
                    <i class="fas fa-camera fa-4x text-muted mb-4"></i>
                    <h3 class="text-muted">No Photos in This Category</h3>
                    <p class="text-muted">This category doesn't have any photos yet.</p>
                    <a href="{{ route('frontend.photogallery.index') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-left me-2"></i>Back to Photo Gallery
                    </a>
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Photo Viewer Section -->
<div id="photoViewer" class="photo-viewer-section" style="display: none;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="photo-viewer-header">
                    <button class="btn btn-secondary" id="closePhotoViewer">
                        <i class="fas fa-arrow-left me-2"></i>Back to Gallery
                    </button>
                    <h3 id="photoViewerTitle" class="photo-viewer-title"></h3>
                </div>
                <div class="photo-viewer-content text-center">
                    <img id="photoViewerImage" src="" alt="Photo" class="img-fluid photo-viewer-img">
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

.photo-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    overflow: hidden;
    transition: transform 0.3s ease;
    height: 100%;
}

.photo-card:hover {
    transform: translateY(-5px);
}

.photo-thumbnail {
    position: relative;
    height: 250px;
    overflow: hidden;
}

.photo-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.photo-card:hover .photo-img {
    transform: scale(1.05);
}

.photo-overlay {
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

.photo-card:hover .photo-overlay {
    opacity: 1;
}

.photo-actions {
    display: flex;
    gap: 10px;
}

.photo-view-btn {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255,255,255,0.9);
    border: none;
    color: #333;
    font-size: 1.2rem;
    transition: all 0.3s ease;
}

.photo-view-btn:hover {
    background: white;
    transform: scale(1.1);
    color: #a7c724;
}

.photo-content {
    padding: 1.5rem;
}

.photo-title {
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: #314465;
    line-height: 1.4;
}

.photo-meta {
    margin-bottom: 1rem;
}

.photo-date {
    font-size: 0.9rem;
    color: #666;
}

.pagination {
    margin-top: 3rem;
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
    background: #314465;
    color: white;
    transform: translateY(-2px);
}

.page-item.active .page-link {
    background: #314465;
    border-color: #314465;
}

/* Photo Viewer Styles */
.photo-viewer-section {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.95);
    z-index: 9999;
    overflow-y: auto;
    padding: 2rem 0;
}

.photo-viewer-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 2rem;
    padding: 1rem 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
}

.photo-viewer-title {
    color: white;
    font-size: 1.5rem;
    font-weight: 600;
    margin: 0;
    max-width: 70%;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.photo-viewer-content {
    padding: 2rem 0;
}

.photo-viewer-img {
    max-width: 100%;
    max-height: 80vh;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
    object-fit: contain;
}

@media (max-width: 768px) {
    .page-title {
        font-size: 1.8rem;
    }
    
    .page-subtitle {
        font-size: 0.95rem;
    }
    
    .photo-viewer-title {
        font-size: 1.2rem;
        max-width: 60%;
    }
    
    .photo-viewer-header {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Photo gallery script loaded');
    
    // Photo view button functionality
    const photoViewBtns = document.querySelectorAll('.photo-view-btn');
    const photoViewer = document.getElementById('photoViewer');
    const photoViewerImage = document.getElementById('photoViewerImage');
    const photoViewerTitle = document.getElementById('photoViewerTitle');
    const closePhotoViewer = document.getElementById('closePhotoViewer');
    
    console.log('Found photo view buttons:', photoViewBtns.length);
    console.log('Photo viewer element:', photoViewer);
    
    if (photoViewer && photoViewerImage && photoViewerTitle && closePhotoViewer) {
        photoViewBtns.forEach((btn, index) => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const photoUrl = this.getAttribute('data-photo-url');
                const photoTitle = this.getAttribute('data-photo-title');
                
                console.log('Photo button clicked:', index, photoUrl, photoTitle);
                
                if (photoUrl && photoTitle) {
                    photoViewerImage.src = photoUrl;
                    photoViewerImage.alt = photoTitle;
                    photoViewerTitle.textContent = photoTitle;
                    photoViewer.style.display = 'block';
                    document.body.style.overflow = 'hidden'; // Prevent background scrolling
                } else {
                    console.error('Missing photo data:', { photoUrl, photoTitle });
                }
            });
        });

        // Close photo viewer
        closePhotoViewer.addEventListener('click', function() {
            photoViewer.style.display = 'none';
            document.body.style.overflow = 'auto'; // Restore scrolling
            console.log('Photo viewer closed');
        });

        // Close on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && photoViewer.style.display === 'block') {
                photoViewer.style.display = 'none';
                document.body.style.overflow = 'auto';
                console.log('Photo viewer closed with escape key');
            }
        });

        // Close on background click
        photoViewer.addEventListener('click', function(e) {
            if (e.target === photoViewer) {
                photoViewer.style.display = 'none';
                document.body.style.overflow = 'auto';
                console.log('Photo viewer closed with background click');
            }
        });
    } else {
        console.error('Required photo viewer elements not found');
    }
});
</script>
@endsection
