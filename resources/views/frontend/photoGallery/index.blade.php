@extends('master.frontend')

@section('content')
<!-- Photo Gallery Header -->
<section class="page-header py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="page-title">Photo Gallery</h1>
                <p class="page-subtitle">Explore our collection of photos showcasing school activities and events</p>
            </div>
        </div>
    </div>
</section>

<!-- Photo Categories Section -->
<section class="photo-categories-section py-5">
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
                                        <i class="fas fa-camera"></i>
                                    </div>
                                @endif
                                <div class="category-overlay">
                                    <div class="category-info">
                                        <h3 class="category-title">{{ $category->name }}</h3>
                                        <p class="category-count">{{ $category->photo_galleries_count }} Photos</p>
                                    </div>
                                </div>
                            </div>
                            <div class="category-content">
                                <h4 class="category-name">{{ $category->name }}</h4>
                                <p class="category-description">Explore {{ $category->photo_galleries_count }} photos in this category</p>
                                <a href="{{ route('frontend.photogallery.category', $category->id) }}" class="btn btn-primary category-btn">
                                    <i class="fas fa-images me-2"></i>View Photos
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @elseif(isset($allPhotos) && $allPhotos->count() > 0)
            <!-- Fallback: Show all photos if no categories -->
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <i class="fas fa-info-circle me-2"></i>
                        No categories available. Showing all photos.
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($allPhotos as $photo)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="photo-card">
                            <div class="photo-thumbnail">
                                <img src="{{ $photo->image_url }}" alt="{{ $photo->title }}" class="photo-img">
                                <div class="photo-overlay">
                                    <div class="photo-actions">
                                        <button class="btn btn-light photo-view-btn" 
                                                data-photo-url="{{ $photo->image_url }}" 
                                                data-photo-title="{{ $photo->title }}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="photo-content">
                                <h5 class="photo-title">{{ $photo->title }}</h5>
                                <div class="photo-meta">
                                    @if($photo->mediaCategory)
                                        <span class="photo-category">
                                            <i class="fas fa-folder me-1"></i>
                                            {{ $photo->mediaCategory->name }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- No photos available -->
            <div class="row">
                <div class="col-12 text-center py-5">
                    <i class="fas fa-camera fa-4x text-muted mb-4"></i>
                    <h3 class="text-muted">No Photos Available</h3>
                    <p class="text-muted">Check back later for new photo content.</p>
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

.photo-category {
    font-size: 0.9rem;
    color: #666;
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
    
    .category-title {
        font-size: 1.1rem;
    }
    
    .category-name {
        font-size: 1.1rem;
    }
    
    .photo-title {
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
