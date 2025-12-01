
    <header>
        <div class="topbar">
            <div class="container">
                <div class="topbar-content">
                    <div class="brand-logo">
                        <a href="{{ route('frontend.home.index') }}">
                            <img src="{{ asset('frontend/assets/images/logo.png') }}" alt="Bliss International Academy Logo" class="brand-logo-image">
                        </a>
                    </div>
                    <div class="social-icons">
                        <a href="https://www.youtube.com/@BIASATKHIRA" class="social-icon"><i class="fab fa-youtube"></i></a>
                        <a href="https://wa.me/8801919888316" class="social-icon"><i class="fab fa-whatsapp"></i></a>
                        <a href="https://www.facebook.com/blissia" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    </div>
                    <div class="contact-info">
                        <div class="contact-item">
                            <span class="contact-label">Hotline |</span>
                            <span class="contact-value">
                                <span class="contact-value">01919888316 (Satkhira)</span><br>
                                <span class="contact-value">01926261818 (Debhata)</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navbar Section -->

        <nav class="navbar navbar-expand-lg navbar-light ">
            <div class="container">
                <a class="navbar-brand fw-bold d-lg-none d-block" href="#">Bliss International Academy</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavMenu" aria-controls="mainNavMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="mainNavMenu">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                About BIA
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('frontend.page', ['id' => 5]) }}">About BIA</a></li>
                                <li><a class="dropdown-item" href="{{ route('frontend.page', ['id' => 6]) }}">Message from Chairman</a></li>
                                <li><a class="dropdown-item" href="{{ route('frontend.page', ['id' => 7]) }}">Message from Academic Chief</a></li>
                                <li class="nav-item dropend">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Message from Principal
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('frontend.page', ['id' => 8]) }}">Satkhira Campus</a></li>
                                        <li><a class="dropdown-item" href="{{ route('frontend.page', ['id' => 41]) }}">Debhata Campus</a></li>                                    
                                    </ul>
                                </li>
                                <li class="nav-item dropend">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Faculties
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('frontend.teachers.satkhira') }}">Satkhira Campus</a></li>
                                        <li><a class="dropdown-item" href="{{ route('frontend.teachers.debhata') }}">Debhata Campus</a></li>                                    
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Admission
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('frontend.page', ['id' => 11]) }}">Admission Procedure</a></li>
                                <li><a class="dropdown-item" href="{{ route('frontend.page', ['id' => 12]) }}">Age Criteria</a></li>
                                <li class="nav-item dropend">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Fees Structure
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('frontend.page', ['id' => 13]) }}">Satkhira Campus</a></li>
                                        <li><a class="dropdown-item" href="{{ route('frontend.page', ['id' => 14]) }}">Debhata Campus</a></li>                                    
                                    </ul>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('frontend.page', ['id' => 40]) }}">Online Admission</a></li>
                                <li class="nav-item dropend">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Payment Procedure
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('frontend.page', ['id' => 38]) }}">Satkhira Campus</a></li>
                                        <li><a class="dropdown-item" href="{{ route('frontend.page', ['id' => 39]) }}">Debhata Campus</a></li>                                    
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Academics
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item dropend">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Academic Calendar
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('frontend.page', ['id' => 15]) }}">Satkhira Campus</a></li>
                                        <li><a class="dropdown-item" href="{{ route('frontend.page', ['id' => 16]) }}">Debhata Campus</a></li>                                    
                                    </ul>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('frontend.page', ['id' => 17]) }}">Cariculum</a></li>
                                <li><a class="dropdown-item" href="{{ route('frontend.page', ['id' => 18]) }}">Teaching Medium</a></li>
                                <li><a class="dropdown-item" href="{{ route('frontend.page', ['id' => 19]) }}">Syllabus</a></li>
                                <li class="nav-item dropend">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Forms & Downloads
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('frontend.downloads.satkhira') }}">Satkhira Campus</a></li>
                                        <li><a class="dropdown-item" href="{{ route('frontend.downloads.debhata') }}">Debhata Campus</a></li>                                    
                                    </ul>
                                </li>                            
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Bliss Clubs
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('frontend.page', ['id' => 20]) }}">Language Club</a></li>
                                <li><a class="dropdown-item" href="{{ route('frontend.page', ['id' => 21]) }}">Debating Club</a></li>
                                <li><a class="dropdown-item" href="{{ route('frontend.page', ['id' => 22]) }}">Science Club</a></li>
                                <li><a class="dropdown-item" href="{{ route('frontend.page', ['id' => 23]) }}">Art Club</a></li>
                                <li><a class="dropdown-item" href="{{ route('frontend.page', ['id' => 24]) }}">Cultural Club</a></li>
                                <li><a class="dropdown-item" href="{{ route('frontend.page', ['id' => 25]) }}">Sports Club</a></li>
                                <li><a class="dropdown-item" href="{{ route('frontend.page', ['id' => 26]) }}">ICT Club</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Results
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('frontend.page', ['id' => 27]) }}">Satkhira Campus</a></li>
                                <li><a class="dropdown-item" href="{{ route('frontend.page', ['id' => 28]) }}">Debhata Campus</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Students' Affairs
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item dropend">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Students' Activities
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('frontend.page', ['id' => 29]) }}">Satkhira Campus</a></li>
                                        <li><a class="dropdown-item" href="{{ route('frontend.page', ['id' => 30]) }}">Debhata Campus</a></li>                                    
                                    </ul>
                                </li>
                                <li class="nav-item dropend">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    BIA Publication
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('frontend.page', ['id' => 31]) }}">Satkhira Campus</a></li>
                                        <li><a class="dropdown-item" href="{{ route('frontend.page', ['id' => 32]) }}">Debhata Campus</a></li>                                    
                                    </ul>
                                </li>
                                <li class="nav-item dropend">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Student Verification
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('frontend.page', ['id' => 33]) }}">Satkhira Campus</a></li>
                                        <li><a class="dropdown-item" href="{{ route('frontend.page', ['id' => 37]) }}">Debhata Campus</a></li>                                    
                                    </ul>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('frontend.library.index') }}">BIA e-library</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Media Gallery
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('frontend.photogallery.index') }}">Photo Gallery</a></li>
                                <li><a class="dropdown-item" href="{{ route('frontend.videogallery.index') }}">Video Gallery</a></li>                            
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                login
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Teacher's Login</a></li>
                                <li><a class="dropdown-item" href="#">Student Login</a></li>                            
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Contact
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('frontend.contact.satkhira') }}">Satkhira Campus</a></li>
                                <li><a class="dropdown-item" href="{{ route('frontend.contact.debhata') }}">Debhata Campus</a></li>
                                <li><a class="dropdown-item" href="{{ route('frontend.career.index') }}">Career</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>