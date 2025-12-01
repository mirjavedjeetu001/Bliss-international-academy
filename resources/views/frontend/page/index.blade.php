@extends('master.frontend')



@section('title', $page->title . ' - Bliss International Academy')



@section('content')

<!-- Hero Section -->

<section class="page-hero bg-secondary py-5">

    <div class="container">

        <div class="row align-items-center">

            <div class="col-12">

                <!-- Breadcrumb Navigation -->

                <nav aria-label="breadcrumb" class="mb-3">

                    <ol class="breadcrumb">

                        <li class="breadcrumb-item">

                            <a href="{{ route('frontend.home.index') }}" class="text-decoration-none">

                                <i class="fas fa-home me-1"></i>Home

                            </a>

                        </li>

                        <li class="breadcrumb-item active" aria-current="page">{{ $page->title }}</li>

                    </ol>

                </nav>

                

                <!-- Page Title -->

                <h1 class="page-title text-white mb-0">{{ $page->title }}</h1>

            </div>

        </div>

    </div>

</section>



<!-- Main Content Section -->

<section class="page-content py-5">

    <div class="container">

        <div class="row">

            @if($page->image_view == 0 && count($page->formatted_images) > 0)

                <!-- Images in Sidebar Layout -->

                <div class="col-lg-8">

                    <div class="page-detail">

                        <div class="content-body">

                            {!! $page->detail !!}

                        </div>

                        

                        <!-- PDF Section - Download Icons -->

                        @if($page->pdf_view == 0 && count($page->formatted_pdfs) > 0)

                            <div class="pdf-section mt-5">

                                <h4 class="section-title mb-4">

                                    <i class="fas fa-file-pdf me-2 text-danger"></i>Related Documents

                                </h4>

                                <div class="row">

                                    @foreach($page->formatted_pdfs as $pdf)

                                        <div class="col-md-6 col-lg-4 mb-3">

                                            <div class="pdf-card">

                                                <div class="pdf-icon">

                                                    <i class="fas fa-file-pdf fa-3x text-danger"></i>

                                                </div>

                                                <div class="pdf-info">

                                                    <h6 class="pdf-title">{{ $pdf['name'] }}</h6>

                                                    <a href="{{asset('/'.$pdf['path'])}}" download class="btn btn-outline-danger btn-sm">

                                                        <i class="fas fa-download me-1"></i>Download

                                                    </a>

                                                </div>

                                            </div>

                                        </div>

                                    @endforeach

                                </div>

                            </div>

                        @endif

                        

                        <!-- PDF Section - Embedded -->

                        @if($page->pdf_view == 1 && count($page->formatted_pdfs) > 0)

                            <div class="pdf-section mt-5">

                                <h4 class="section-title mb-4">

                                    <i class="fas fa-file-pdf me-2 text-danger"></i>Related Documents

                                </h4>

                                @foreach($page->formatted_pdfs as $pdf)

                                    <div class="pdf-embed mb-4">

                                        <div class="pdf-header d-flex justify-content-between align-items-center mb-2">

                                            <h5 class="pdf-title mb-0">{{ $pdf['name'] }}</h5>

                                            <a href="{{asset('/'.$pdf['path'])}}" download class="btn btn-outline-danger btn-sm">

                                                <i class="fas fa-download me-1"></i>Download

                                            </a>

                                        </div>

                                        <div class="pdf-viewer">

                                            <iframe src="{{asset('/'.$pdf['path'])}}#toolbar=0" width="100%" height="600" frameborder="0"></iframe>

                                        </div>

                                    </div>

                                @endforeach

                            </div>

                        @endif

                    </div>

                </div>

                

                <!-- Images Sidebar -->

                <div class="col-lg-4">

                    <div class="images-sidebar">

                        <div class="image-gallery">

                            @foreach($page->formatted_images as $index => $image)

                                <div class="gallery-item mb-3">

                                    <img src="/{{ $image['path'] }}" 

                                         alt="{{ $image['name'] }}" 

                                         class="img-fluid rounded shadow-sm gallery-image"

                                         data-bs-toggle="modal" 

                                         data-bs-target="#imageModal{{ $index }}"

                                         style="cursor: pointer;">

                                </div>

                                

                                <!-- Image Modal -->

                                

                                <div class="modal fade" id="imageModal{{ $index }}" tabindex="-1" aria-labelledby="imageModalLabel{{ $index }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="imageModalLabel{{ $index }}">{{ $image['name'] }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-0">
                                                <img src="/{{ $image['path'] }}" alt="{{ $image['name'] }}" class="img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach

                        </div>

                    </div>

                </div>

            @else

                <!-- Full Width Layout -->

                <div class="col-12">

                    <!-- Images Full Width -->

                    @if($page->image_view == 1 && count($page->formatted_images) > 0)

                        <div class="full-width-gallery mb-5">

                        

                            <div class="row">

                                @foreach($page->formatted_images as $index => $image)

                                    <div class="col-md-12 col-lg-12 mb-12">

                                        <div class="gallery-item">

                                            <img src="/{{ $image['path'] }}" 

                                                 alt="{{ $image['name'] }}" 

                                                 class="img-fluid rounded shadow-sm gallery-image"

                                                 data-bs-toggle="modal" 

                                                 data-bs-target="#imageModal{{ $index }}"

                                                 style="cursor: pointer;">

                                        </div>

                                        

                                        <!-- Image Modal -->

                                        <div class="modal fade" id="imageModal{{ $index }}" tabindex="-1">

                                            <div class="modal-dialog modal-lg modal-dialog-centered">

                                                <div class="modal-content">

                                                    <div class="modal-header">

                                                        <h5 class="modal-title">{{ $image['name'] }}</h5>

                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

                                                    </div>

                                                    <div class="modal-body p-0">

                                                        <img src="/{{ $image['path'] }}" alt="{{ $image['name'] }}" class="img-fluid">

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                @endforeach

                            </div>

                        </div>

                    @endif

                    

                    <!-- Page Content -->

                    <div class="page-detail">

                        <div class="content-body">

                            {!! $page->detail !!}

                        </div>

                        

                        <!-- PDF Section - Download Icons -->

                        @if($page->pdf_view == 0 && count($page->formatted_pdfs) > 0)

                            <div class="pdf-section mt-5">

                                <h4 class="section-title mb-4">

                                    <i class="fas fa-file-pdf me-2 text-danger"></i>Related Documents

                                </h4>

                                <div class="row">

                                    @foreach($page->formatted_pdfs as $pdf)

                                        <div class="col-md-6 col-lg-4 mb-3">

                                            <div class="pdf-card">

                                                <div class="pdf-icon">

                                                    <i class="fas fa-file-pdf fa-3x text-danger"></i>

                                                </div>

                                                <div class="pdf-info">

                                                    <h6 class="pdf-title">{{ $pdf['name'] }}</h6>

                                                    <a href="/{{ $pdf['path'] }}" download class="btn btn-outline-danger btn-sm">

                                                        <i class="fas fa-download me-1"></i>Download

                                                    </a>

                                                </div>

                                            </div>

                                        </div>

                                    @endforeach

                                </div>

                            </div>

                        @endif

                        

                        <!-- PDF Section - Embedded -->

                        @if($page->pdf_view == 1 && count($page->formatted_pdfs) > 0)

                            <div class="pdf-section mt-5">

                                <h4 class="section-title mb-4">

                                    <i class="fas fa-file-pdf me-2 text-danger"></i>Related Documents

                                </h4>

                                @foreach($page->formatted_pdfs as $pdf)

                                    <div class="pdf-embed mb-4">

                                        <div class="pdf-header d-flex justify-content-between align-items-center mb-2">

                                            <h5 class="pdf-title mb-0">{{ $pdf['name'] }}</h5>

                                            <a href="{{asset('/'.$pdf['path'])}}" download class="btn btn-outline-danger btn-sm">

                                                <i class="fas fa-download me-1"></i>Download

                                            </a>

                                        </div>

                                        <div class="pdf-viewer">

                                            <iframe src="{{asset('/'.$pdf['path'])}}#toolbar=0" width="100%" height="600" frameborder="0"></iframe>

                                        </div>

                                    </div>

                                @endforeach

                            </div>

                        @endif

                    </div>

                </div>

            @endif

        </div>

    </div>

</section>



<style>

/* Hero Section Styles */

.page-hero {

    background: linear-gradient(135deg, #6c757d 0%, #495057 100%);

    position: relative;

    overflow: hidden;

}



.page-hero::before {

    content: '';

    position: absolute;

    top: 0;

    left: 0;

    right: 0;

    bottom: 0;

    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');

    opacity: 0.1;

}



.page-hero .container {

    position: relative;

    z-index: 2;

}



.page-title {

    font-size: 2.5rem;

    font-weight: 700;

    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);

}



.breadcrumb {

    background: rgba(255,255,255,0.1);

    border-radius: 0.5rem;

    padding: 0.75rem 1rem;

    margin-bottom: 0;

}



.breadcrumb-item a {

    color: rgba(255,255,255,0.8);

    transition: color 0.3s ease;

}



.breadcrumb-item a:hover {

    color: white;

}



.breadcrumb-item.active {

    color: white;

    font-weight: 500;

}



/* Content Styles */

.page-content {

    background-color: #f8f9fa;

    min-height: 60vh;

}



.section-title {

    color: #495057;

    font-weight: 600;

    border-bottom: 3px solid #007bff;

    padding-bottom: 0.5rem;

    display: inline-block;

}



.content-body {

    background: white;

    padding: 2rem;

    border-radius: 0.5rem;

    box-shadow: 0 2px 10px rgba(0,0,0,0.1);

    line-height: 1.2;

}



.content-body h1, .content-body h2, .content-body h3, .content-body h4, .content-body h5, .content-body h6 {

    color:rgb(0, 0, 0);

    margin-top: 1.5rem;

    margin-bottom: 1rem;

}



.content-body p {

    margin-bottom: 1rem;

    color:rgb(0, 0, 0);

}



.content-body ul, .content-body ol {

    margin-bottom: 1rem;

    padding-left: 2rem;

}



.content-body li {

    margin-bottom: 0.5rem;

    color:rgb(0, 0, 0);

}



/* Sidebar Styles */

.images-sidebar {

    background: white;

    padding: 1.5rem;

    border-radius: 0.5rem;

    box-shadow: 0 2px 10px rgba(0,0,0,0.1);

    height: fit-content;

    position: sticky;

    top: 2rem;

}



.sidebar-title {

    color: #495057;

    font-weight: 600;

    border-bottom: 2px solid #007bff;

    padding-bottom: 0.5rem;

    display: inline-block;

}



.gallery-image {

    transition: transform 0.3s ease, box-shadow 0.3s ease;

    border: 2px solid transparent;

}



.gallery-image:hover {

    transform: scale(1.05);

    box-shadow: 0 8px 25px rgba(0,0,0,0.15);

    border-color: #007bff;

}



/* PDF Card Styles */

.pdf-card {

    background: white;

    border: 1px solid #dee2e6;

    border-radius: 0.5rem;

    padding: 1.5rem;

    text-align: center;

    transition: all 0.3s ease;

    height: 100%;

    display: flex;

    flex-direction: column;

    justify-content: space-between;

}



.pdf-card:hover {

    transform: translateY(-5px);

    box-shadow: 0 8px 25px rgba(0,0,0,0.1);

    border-color: #dc3545;

}



.pdf-icon {

    margin-bottom: 1rem;

}



.pdf-title {

    color: #495057;

    font-weight: 600;

    margin-bottom: 1rem;

    word-break: break-word;

}



/* PDF Embed Styles */

.pdf-embed {

    background: white;

    border: 1px solid #dee2e6;

    border-radius: 0.5rem;

    padding: 1.5rem;

    box-shadow: 0 2px 10px rgba(0,0,0,0.1);

}



.pdf-header {

    background: #f8f9fa;

    padding: 1rem;

    border-radius: 0.5rem;

    margin-bottom: 1rem;

}



.pdf-viewer {

    border: 1px solid #dee2e6;

    border-radius: 0.5rem;

    overflow: hidden;

}



/* Full Width Gallery */

.full-width-gallery .gallery-image {

    width: 100%;

    height: 250px;

    object-fit: cover;

}



/* Responsive Design */

@media (max-width: 768px) {

    .page-title {

        font-size: 2rem;

    }

    

    .content-body {

        padding: 1.5rem;

    }

    

    .images-sidebar {

        margin-top: 2rem;

        position: static;

    }

    

    .pdf-viewer iframe {

        height: 400px;

    }

}



@media (max-width: 576px) {

    .page-title {

        font-size: 1.75rem;

    }

    

    .content-body {

        padding: 1rem;

    }

    

    .pdf-viewer iframe {

        height: 300px;

    }

}



/* Animation */

.gallery-image, .pdf-card {

    animation: fadeInUp 0.6s ease-out;

}



@keyframes fadeInUp {

    from {

        opacity: 0;

        transform: translateY(30px);

    }

    to {

        opacity: 1;

        transform: translateY(0);

    }

}

</style>

@endsection

