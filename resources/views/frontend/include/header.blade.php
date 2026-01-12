@php
use App\Models\SiteSetting;
$settings = SiteSetting::first();
@endphp
<header>
        <div class="topbar">
            <div class="container">
                <div class="topbar-content">
                    <div class="brand-logo">
                        <a href="{{ route('frontend.home.index') }}">
                            <img src="{{ $settings && $settings->logo_path ? asset('storage/' . $settings->logo_path) : asset('frontend/assets/images/logo.png') }}" alt="Katunia Rajbari College Logo" class="brand-logo-image">
                        </a>
                    </div>
                    <div class="social-icons">
                        @if($settings && $settings->youtube_url)
                            <a href="{{ $settings->youtube_url }}" class="social-icon"><i class="fab fa-youtube"></i></a>
                        @endif
                        @if($settings && $settings->facebook_url)
                            <a href="{{ $settings->facebook_url }}" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        @endif
                        @if($settings && $settings->twitter_url)
                            <a href="{{ $settings->twitter_url }}" class="social-icon"><i class="fab fa-twitter"></i></a>
                        @endif
                        @if($settings && $settings->instagram_url)
                            <a href="{{ $settings->instagram_url }}" class="social-icon"><i class="fab fa-instagram"></i></a>
                        @endif
                        @if($settings && $settings->linkedin_url)
                            <a href="{{ $settings->linkedin_url }}" class="social-icon"><i class="fab fa-linkedin"></i></a>
                        @endif
                    </div>
                    <div class="contact-info">
                        <div class="contact-item">
                            <span class="contact-label">Hotline |</span>
                            <span class="contact-value">
                                @if($settings && $settings->contact_phone)
                                    {{ $settings->contact_phone }}
                                @else
                                    <span class="contact-value">01919888316 (Satkhira)</span><br>
                                    <span class="contact-value">01926261818 (Debhata)</span>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navbar Section -->

        @php
        use App\Models\Menu;
        $menus = Menu::where('show_in_nav', true)
            ->whereNull('parent_id')
            ->orderBy('order')
            ->with(['children' => function($q) { $q->where('show_in_nav', true)->orderBy('order'); }])
            ->get();
        @endphp
        <nav class="navbar navbar-expand-lg navbar-light ">
            <div class="container">
                <a class="navbar-brand fw-bold d-lg-none d-block" href="#">Katunia Rajbari College</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavMenu" aria-controls="mainNavMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="mainNavMenu">
                    <ul class="navbar-nav">
                        @foreach($menus as $menu)
                            @if($menu->children->count())
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ $menu->title }}
                                    </a>
                                    <ul class="dropdown-menu">
                                        @foreach($menu->children as $child)
                                            <li><a class="dropdown-item" href="{{ $child->url ?? ($child->page_id ? route('frontend.page', ['id' => $child->page_id]) : '#') }}">{{ $child->title }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ $menu->url ?? ($menu->page_id ? route('frontend.page', ['id' => $menu->page_id]) : '#') }}">{{ $menu->title }}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </nav>
        {{-- Restore your slider below this line --}}
        @include('frontend.include.slider')
    </header>