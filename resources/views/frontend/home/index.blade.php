@extends('master.frontend')
@section('content')
@if($sliders->count() > 0)
    <div class="swiper-container">
        <div class="swiper-wrapper">
            @foreach($sliders as $slider)
                <div class="swiper-slide">
                    <img src="{{ asset('frontend/assets/images/sliders/' . $slider->image) }}" alt="{{ $slider->title }}">
                </div>
            @endforeach
        </div>

        <!-- Navigation Arrows -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>

        <!-- Pagination Dots -->
        <div class="swiper-pagination"></div>

        <!-- Scrollbar -->
        <div class="swiper-scrollbar"></div>
    </div>
@endif

    <!-- New Section with Cards -->
    <section class="cards-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-top">
                            <h5 class="card-title">
                                <span class="title-first">National Curriculum</span>
                                <span class="title-second">English Version</span>
                            </h5>
                        </div>
                        <div class="card-bottom">
                            <button class="btn read-more-btn" data-bs-toggle="modal" data-bs-target="#detailModal" data-title="National Curriculum English Version" data-content="Bliss International Academy offers the National Curriculum (English Version), aligned with the standards of the National Curriculum and Textbook Board (NCTB) of Bangladesh. This program delivers high-quality education entirely in English, helping students master academic content while developing strong English proficiency.

Our curriculum covers a wide range of core and elective subjects—such as Bangla, English, Math, Science, ICT, Social Science, and Religion—taught through modern, interactive methods. We emphasize critical thinking, creativity, communication, and problem-solving to nurture well-rounded, responsible, and lifelong learners.

Supported by experienced, well-trained educators, our program focuses on both academic and character development. Students are encouraged to engage in co-curricular activities like clubs, sports, and competitions to build leadership, confidence, and teamwork.

We prepare students for national public exams (PSC, JSC, SSC, HSC) under the General Education Board, with instruction and assessments conducted in English. This equips students for higher education and global opportunities.

Bliss International Academy provides a balanced, inclusive learning environment that blends national values with global relevance, empowering every student to reach their full potential.">Read More</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-top">
                            <h5 class="card-title">
                                <span class="title-first">Islamic</span>
                                <span class="title-second">Education</span>
                            </h5>
                        </div>
                        <div class="card-bottom">
                            <button class="btn read-more-btn" data-bs-toggle="modal" data-bs-target="#detailModal" data-title="Islamic Education" data-content="Our Islamic Education program provides students with a comprehensive understanding of Islamic values, principles, and teachings. We integrate Islamic studies with modern education to develop well-rounded individuals who are grounded in their faith while being prepared for contemporary challenges. The curriculum includes Quranic studies, Islamic history, Arabic language, and Islamic ethics. Students learn about the rich heritage of Islamic civilization and its contributions to science, mathematics, philosophy, and the arts. Our approach emphasizes tolerance, respect for diversity, and the importance of community service. Through this program, students develop strong moral character, spiritual awareness, and a deep appreciation for Islamic culture and traditions while maintaining academic excellence in all subjects.">Read More</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-top">
                            <h5 class="card-title">
                                <span class="title-first">Hifzul</span>
                                <span class="title-second">Quran</span>
                            </h5>
                        </div>
                        <div class="card-bottom">
                            <button class="btn read-more-btn" data-bs-toggle="modal" data-bs-target="#detailModal" data-title="Hifzul Quran" data-content="The Hifzul Quran program is a specialized course designed for students who wish to memorize the Holy Quran. This sacred journey requires dedication, discipline, and spiritual commitment. Our qualified Hafiz teachers provide personalized guidance to help students memorize the Quran with proper Tajweed (correct pronunciation and recitation rules). The program includes regular assessments, progress tracking, and spiritual development activities. Students learn the meanings and interpretations of the verses they memorize, deepening their understanding of Islamic teachings. The Hifzul Quran program not only focuses on memorization but also emphasizes the application of Quranic teachings in daily life. This program instills a lifelong connection with the Holy Book and prepares students to become future leaders who carry the light of the Quran in their hearts and actions.">Read More</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Event Section -->
    <section class="event-section py-5">
        <div class="container">
            <div class="section-header text-center mb-5">
                <h2 class="section-title">Past Events</h2>
            </div>

            @if($pastevents->count() > 0)
                <div class="row">
                    @foreach($pastevents as $pastevent)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="event-card">
                                <div class="event-image">
                                    <img src="{{ asset('backend/assets/images/events/' . $pastevent->image) }}" alt="{{ $pastevent->title }}" class="event-img">
                                    <div class="event-overlay">
                                        <div class="event-date">
                                            <span class="day">{{ $pastevent->created_at->format('d') }}</span>
                                            <span class="month">{{ $pastevent->created_at->format('M') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="event-content">
                                    <h3 class="event-title">{{ $pastevent->title }}</h3>
                                    <p class="event-detail">{{ Str::limit($pastevent->detail, 120) }}</p>
                                    <button class="event-read-more" data-bs-toggle="modal" data-bs-target="#detailModal" data-title="{{ $pastevent->title }}" data-content="{{ $pastevent->detail }}">
                                        <span>Read More</span>
                                        <i class="fas fa-arrow-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fa fa-calendar fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">No past events available</h4>
                    <p class="text-muted">Check back later for upcoming events and updates.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Latest Updates Section -->
    <section class="latest-updates-section py-5">
        <div class="container">
            <h2 class="section-title">Latest Updates</h2>
            
            @if($latestupdates->count() > 0)
                <div class="accordion" id="updatesAccordion">
                    @foreach($latestupdates as $index => $latestupdate)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{ $index + 1 }}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index + 1 }}" aria-expanded="false" aria-controls="collapse{{ $index + 1 }}">
                                    <span class="update-title">{{ $latestupdate->title }}</span>
                                    <i class="fas fa-plus update-icon"></i>
                                </button>
                            </h2>
                            <div id="collapse{{ $index + 1 }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $index + 1 }}" data-bs-parent="#updatesAccordion">
                                <div class="accordion-body">
                                    @if($latestupdate->detail)
                                        <div class="update-detail mb-3">
                                            <p style="text-align: justify; line-height: 1.8; word-wrap: break-word;">{{ $latestupdate->detail }}</p>
                                        </div>
                                    @endif
                                    
                                    @if($latestupdate->attachment)
                                        <div class="pdf-viewer-container">
                                            <div class="pdf-content">
                                                <div class="pdf-main">
                                                    <iframe src="{{ asset('backend/attachments/' . $latestupdate->attachment) }}" width="100%" height="600px" frameborder="0"></iframe>
                                                </div>
                                            </div>
                                            <div class="pdf-actions">
                                                <button class="btn btn-primary download-btn" onclick="downloadPDF('{{ asset('backend/attachments/' . $latestupdate->attachment) }}', '{{ $latestupdate->attachment }}')">
                                                    <i class="fas fa-download"></i>
                                                    Download PDF
                                                </button>
                                            </div>
                                        </div>
                                    @else
                                        <div class="alert alert-info">
                                            <i class="fas fa-info-circle"></i>
                                            No attachment available for this update.
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fa fa-newspaper fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">No latest updates available</h4>
                    <p class="text-muted">Check back later for new updates and announcements.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Video Section -->
    <section class="video-section py-5">
        <div class="container">
            <div class="section-header text-center mb-5">
                <h2 class="section-title">Our Videos</h2>
            </div>

            @if($videos->count() > 0)
                <div class="video-container">
                    @foreach($videos as $index => $video)
                        <div class="video-item {{ $index === 0 ? 'active' : '' }}" data-video-id="{{ $video->embed_url }}">
                            <div class="video-thumbnail">
                                @if($video->thumbnail)
                                    <img src="{{ asset('backend/assets/images/video-gallery/' . $video->thumbnail) }}" alt="{{ $video->title }}" class="thumbnail-img">
                                @else
                                    <img src="{{ asset('frontend/assets/images/sliders/slider2.jpg') }}" alt="{{ $video->title }}" class="thumbnail-img">
                                @endif
                                <div class="play-button video-play-btn" 
                                     data-video-url="{{ $video->embed_url }}" 
                                     data-video-title="{{ $video->title }}">
                                    <i class="fas fa-play"></i>
                                </div>
                                <div class="video-overlay"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- No videos available message -->
                <div class="text-center py-5">
                    <i class="fas fa-video fa-4x text-muted mb-4"></i>
                    <h4 class="text-muted">No Videos Available</h4>
                    <p class="text-muted">Check back later for new video content.</p>
                </div>
            @endif

            @if($videos->count() > 0)
                <!-- Video Navigation Controls -->
                <div class="video-controls">
                    <button class="video-nav-btn prev-btn" id="prevVideo">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="video-nav-btn next-btn" id="nextVideo">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            @endif
        </div>
    </section>

    <!-- Video Viewer Section -->
    <div id="videoViewer" class="video-viewer-section" style="display: none;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="video-viewer-header">
                        <button class="btn btn-secondary" id="closeVideoViewer">
                            <i class="fas fa-arrow-left me-2"></i>Back to Home
                        </button>
                        <h3 id="videoViewerTitle" class="video-viewer-title"></h3>
                    </div>
                    <div class="video-viewer-content">
                        <div class="ratio ratio-16x9">
                            <iframe id="videoViewerFrame" src="" title="Video Player" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Basic Info Section -->
    {{-- <section class="basic-info-section py-5">
        <div class="container">
            <div class="info-panel">
            <h4>Satkhira Campus</h4>
                <div class="info-item">
                    <div class="info-logo">
                        <div class="logo-circle">
                            <div class="logo-outer-ring">
                                <span class="logo-text-top">মাধ্যমিক</span>
                                <span class="logo-text-bottom">শিক্ষা শক্তি প্রগতি।</span>
                            </div>
                            <div class="logo-inner-circle">
                                <div class="logo-building">
                                    <i class="fas fa-university"></i>
                                </div>
                                <div class="logo-text">
                                    <span>বাংলাদেশ</span>
                                    <span>ঢাকা</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-text">
                        <div class="info-label">EMIS NO.</div>
                        <div class="info-value">20807041</div>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-logo">
                        <div class="logo-geometric">
                            <div class="geometric-shape">
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <div class="info-text">
                        <div class="info-label">INTERNATIONAL</div>
                        <div class="info-value">SCHOOL AWARDS</div>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-logo">
                        <div class="logo-shield">
                            
                        </div>
                    </div>
                    <div class="info-text">
                        <div class="info-label">School Code</div>
                        <div class="info-code">480675</div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    {{-- <section class="basic-info-section py-5">
        <div class="container">
        
            <div class="info-panel">
            <h4>Debhata Campus</h4>
                <div class="info-item">
                    <div class="info-logo">
                        <div class="logo-circle">
                            <div class="logo-outer-ring">
                                <span class="logo-text-top">মাধ্যমিক</span>
                                <span class="logo-text-bottom">শিক্ষা শক্তি প্রগতি।</span>
                            </div>
                            <div class="logo-inner-circle">
                                <div class="logo-building">
                                    <i class="fas fa-university"></i>
                                </div>
                                <div class="logo-text">
                                    <span>বাংলাদেশ</span>
                                    <span>ঢাকা</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-text">
                        <div class="info-label">EMIS NO.</div>
                        <div class="info-value">208050212</div>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-logo">
                        <div class="logo-geometric">
                            <div class="geometric-shape">
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <div class="info-text">
                        <div class="info-label">INTERNATIONAL</div>
                        <div class="info-value">SCHOOL AWARDS</div>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-logo">
                        <div class="logo-shield">
                            
                        </div>
                    </div>
                    <div class="info-text">
                        <div class="info-label">School Code</div>
                        <div class="info-code">463289</div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <style>
    /* Video Viewer Styles */
    .video-viewer-section {
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

    .video-viewer-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 2rem;
        padding: 1rem 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    }

    .video-viewer-title {
        color: white;
        font-size: 1.5rem;
        font-weight: 600;
        margin: 0;
        max-width: 70%;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .video-viewer-content {
        padding: 2rem 0;
    }

    .video-viewer-content iframe {
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
    }

    /* Event Modal Styles */
    .event-modal-content {
        padding: 1rem 0;
    }

    .event-modal-content h4 {
        color: #007bff;
        font-weight: 600;
        border-bottom: 2px solid #007bff;
        padding-bottom: 0.5rem;
        margin-bottom: 1.5rem;
    }

    .event-detail-content {
        line-height: 1.6;
        color: #495057;
        font-size: 1rem;
    }

    .event-detail-content p {
        margin-bottom: 1rem;
    }

    .modal-content-scroll {
        max-height: 400px;
        overflow-y: auto;
        padding-right: 0.5rem;
    }

    .modal-content-scroll::-webkit-scrollbar {
        width: 6px;
    }

    .modal-content-scroll::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
    }

    .modal-content-scroll::-webkit-scrollbar-thumb {
        background: #007bff;
        border-radius: 3px;
    }

    .modal-content-scroll::-webkit-scrollbar-thumb:hover {
        background: #0056b3;
    }

    @media (max-width: 768px) {
        .video-viewer-title {
            font-size: 1.2rem;
            max-width: 60%;
        }
        
        .video-viewer-header {
            flex-direction: column;
            gap: 1rem;
            text-align: center;
        }
    }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Home page video script loaded');
        
        // Video play button functionality
        const videoPlayBtns = document.querySelectorAll('.video-play-btn');
        const videoViewer = document.getElementById('videoViewer');
        const videoViewerFrame = document.getElementById('videoViewerFrame');
        const videoViewerTitle = document.getElementById('videoViewerTitle');
        const closeVideoViewer = document.getElementById('closeVideoViewer');
        
        console.log('Found video play buttons:', videoPlayBtns.length);
        console.log('Video viewer element:', videoViewer);
        
        if (videoViewer && videoViewerFrame && videoViewerTitle && closeVideoViewer) {
            videoPlayBtns.forEach((btn, index) => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    const videoUrl = this.getAttribute('data-video-url');
                    const videoTitle = this.getAttribute('data-video-title');
                    
                    console.log('Video button clicked:', index, videoUrl, videoTitle);
                    
                    if (videoUrl && videoTitle) {
                        videoViewerFrame.src = videoUrl;
                        videoViewerTitle.textContent = videoTitle;
                        videoViewer.style.display = 'block';
                        document.body.style.overflow = 'hidden'; // Prevent background scrolling
                    } else {
                        console.error('Missing video data:', { videoUrl, videoTitle });
                    }
                });
            });

            // Close video viewer
            closeVideoViewer.addEventListener('click', function() {
                videoViewer.style.display = 'none';
                videoViewerFrame.src = ''; // Stop video
                document.body.style.overflow = 'auto'; // Restore scrolling
                console.log('Video viewer closed');
            });

            // Close on escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && videoViewer.style.display === 'block') {
                    videoViewer.style.display = 'none';
                    videoViewerFrame.src = ''; // Stop video
                    document.body.style.overflow = 'auto';
                    console.log('Video viewer closed with escape key');
                }
            });

            // Close on background click
            videoViewer.addEventListener('click', function(e) {
                if (e.target === videoViewer) {
                    videoViewer.style.display = 'none';
                    videoViewerFrame.src = ''; // Stop video
                    document.body.style.overflow = 'auto';
                    console.log('Video viewer closed with background click');
                }
            });
        } else {
            console.error('Required video viewer elements not found');
        }

        // Past Events Read More functionality
        const eventReadMoreBtns = document.querySelectorAll('.event-read-more');
        const detailModal = document.getElementById('detailModal');
        const detailModalLabel = document.getElementById('detailModalLabel');
        const modalContent = document.getElementById('modalContent');
        
        console.log('Found event read more buttons:', eventReadMoreBtns.length);
        console.log('Detail modal element:', detailModal);
        
        if (detailModal && detailModalLabel && modalContent) {
            eventReadMoreBtns.forEach((btn, index) => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const eventTitle = this.getAttribute('data-title');
                    const eventDetail = this.getAttribute('data-content');
                    
                    console.log('Event read more clicked:', index, eventTitle);
                    
                    if (eventTitle && eventDetail) {
                        // Update modal content
                        detailModalLabel.textContent = eventTitle;
                        modalContent.innerHTML = `
                            <div class="event-modal-content">
                                <h4 class="mb-3">${eventTitle}</h4>
                                <div class="event-detail-content">
                                    ${eventDetail.replace(/\n/g, '<br>')}
                                </div>
                            </div>
                        `;
                        
                        // Show modal
                        const modal = new bootstrap.Modal(detailModal);
                        modal.show();
                    } else {
                        console.error('Missing event data:', { eventTitle, eventDetail });
                    }
                });
            });
        } else {
            console.error('Required modal elements not found');
        }
    });
    </script>

@endsection