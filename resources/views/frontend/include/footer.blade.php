
@php
use App\Models\SiteSetting;
use App\Models\FooterBranch;
use App\Models\FooterLink;

$settings = SiteSetting::first();
$importantLinks = FooterLink::where('type', 'important')->get();
$usefulLinks = FooterLink::where('type', 'useful')->get();
$branches = FooterBranch::all();
$satkhiraBranch = $branches->where('name', 'Satkhira Campus')->first();
$debhataBranch = $branches->where('name', 'Debhata Campus')->first();
@endphp
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <!-- important Links Column -->
                <div class="footer-column">
                    <h3 class="footer-title">{{ $settings && $settings->footer_important_links_title ? $settings->footer_important_links_title : 'Important Links' }}</h3>
                    <ul class="footer-links">
                        @if($importantLinks->count() > 0)
                            @foreach($importantLinks as $link)
                                <li><a href="{{ $link->url }}" target="_blank">{{ $link->title }}</a></li>
                            @endforeach
                        @else
                            <p>Anis</p>
                        @endif
                    </ul>
                </div>

                <!-- Useful Links Column -->
                <div class="footer-column">
                    <h3 class="footer-title">{{ $settings && $settings->footer_useful_links_title ? $settings->footer_useful_links_title : 'Useful Links' }}</h3>
                    <ul class="footer-links">
                        @if($usefulLinks->count() > 0)
                            @foreach($usefulLinks as $link)
                                <li><a href="{{ $link->url }}">{{ $link->title }}</a></li>
                            @endforeach
                        @else
                            <p>Anis</p>
                        @endif
                    </ul>
                </div>

                <!-- Campus-1 Column -->
                <div class="footer-column">
                    <h3 class="footer-title">{{ $settings && $settings->footer_satkhira_campus_title ? $settings->footer_satkhira_campus_title : 'Satkhira Campus' }}</h3>
                    <div class="footer-contact text-start">
                        @if($satkhiraBranch)
                            <div class="contact-item text-start">
                                <span class="contact-label">EMIS NO.</span>
                                <span class="contact-value">{{ $satkhiraBranch->emis_no }}</span>
                            </div>
                            <div class="contact-item text-start">
                                <span class="contact-label">ADDRESS</span>
                                <span class="contact-value">{{ $satkhiraBranch->address }}</span>
                            </div>
                            <div class="contact-item text-start">
                                <span class="contact-label">PHONE NUMBER</span>
                                <span class="contact-value">{{ $satkhiraBranch->phone }}</span>
                            </div>
                            <div class="contact-item text-start">
                                <span class="contact-label">EMAIL</span>
                                <span class="contact-value">{{ $satkhiraBranch->email }}</span>
                            </div>
                            <div class="contact-item text-start">
                                <span class="contact-label">School Code</span>
                                <span class="contact-value">{{ $satkhiraBranch->school_code }}</span>
                            </div>
                        @else
                            <div class="contact-item text-start">
                                <span class="contact-label">EMIS NO.</span>
                                <span class="contact-value">20807041</span>
                            </div>
                            <div class="contact-item text-start">
                                <span class="contact-label">ADDRESS</span>
                                <span class="contact-value">Kharibila, Bypass Road, Satkhira Sadar, Satkhira-9400</span>
                            </div>
                            <div class="contact-item text-start">
                                <span class="contact-label">PHONE NUMBER</span>
                                <span class="contact-value">01919888316</span>
                            </div>
                            <div class="contact-item text-start">
                                <span class="contact-label">EMAIL</span>
                                <span class="contact-value">info@bliss.edu.bd</span>
                            </div>
                            <div class="contact-item text-start">
                                <span class="contact-label">School Code</span>
                                <span class="contact-value">480675</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Campus-2 Column -->
                {{-- <div class="footer-column">
                    <h3 class="footer-title">Debhata Campus</h3>
                    <div class="footer-contact text-start">
                        @if($debhataBranch)
                            <div class="contact-item text-start">
                                <span class="contact-label">EMIS NO.</span>
                                <span class="contact-value">{{ $debhataBranch->emis_no }}</span>
                            </div>
                            <div class="contact-item text-start">
                                <span class="contact-label">ADDRESS</span>
                                <span class="contact-value">{{ $debhataBranch->address }}</span>
                            </div>
                            <div class="contact-item text-start">
                                <span class="contact-label">PHONE NUMBER</span>
                                <span class="contact-value">{{ $debhataBranch->phone }}</span>
                            </div>
                            <div class="contact-item text-start">
                                <span class="contact-label">EMAIL</span>
                                <span class="contact-value">{{ $debhataBranch->email }}</span>
                            </div>
                            <div class="contact-item text-start">
                                <span class="contact-label">School Code</span>
                                <span class="contact-value">{{ $debhataBranch->school_code }}</span>
                            </div>
                        @else
                            <div class="contact-item text-start">
                                <span class="contact-label">EMIS NO.</span>
                                <span class="contact-value">208050212</span>
                            </div>
                            <div class="contact-item text-start">
                                <span class="contact-label">ADDRESS</span>
                                <span class="contact-value">Sekendra, Debhata, Satkhira</span>
                            </div>
                            <div class="contact-item text-start">
                                <span class="contact-label">PHONE NUMBER</span>
                                <span class="contact-value">01926261818</span>
                            </div>
                            <div class="contact-item text-start">
                                <span class="contact-label">EMAIL</span>
                                <span class="contact-value">blimia bd@gmail.com</span>
                            </div>
                            <div class="contact-item text-start">
                                <span class="contact-label">School Code</span>
                                <span class="contact-value">463289</span>
                            </div>
                        @endif
                    </div>
                </div> --}}
            </div>

            <!-- Footer Bottom Bar -->
            <div class="footer-bottom">
                <div class="footer-bottom-content">
                    <div class="footer-bottom-left">
                        <span>{{ $settings && $settings->footer_registration_number ? $settings->footer_registration_number : 'Cambridge Registration Number BD000' }}</span>
                    </div>
                    <div class="footer-bottom-center">
                        <span>{{ $settings && $settings->footer_copyright ? $settings->footer_copyright : 'Copyright © 2025 BLISSIA. All rights reserved' }}</span>
                    </div>
                    <div class="footer-bottom-right">
                        <div class="footer-social-icons">
                            @if($settings && $settings->youtube_url)
                                <a href="{{ $settings->youtube_url }}" class="footer-social-icon" target="_blank"><i class="fab fa-youtube"></i></a>
                            @endif
                            @if($settings && $settings->facebook_url)
                                <a href="{{ $settings->facebook_url }}" class="footer-social-icon" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            @endif
                            @if($settings && $settings->twitter_url)
                                <a href="{{ $settings->twitter_url }}" class="footer-social-icon" target="_blank"><i class="fab fa-twitter"></i></a>
                            @endif
                            @if($settings && $settings->instagram_url)
                                <a href="{{ $settings->instagram_url }}" class="footer-social-icon" target="_blank"><i class="fab fa-instagram"></i></a>
                            @endif
                            @if($settings && $settings->linkedin_url)
                                <a href="{{ $settings->linkedin_url }}" class="footer-social-icon" target="_blank"><i class="fab fa-linkedin"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>