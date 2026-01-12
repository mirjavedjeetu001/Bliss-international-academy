// Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    
    // Navbar scroll effect
    // const navbar = document.querySelector('.navbar');
    // let lastScrollTop = 0;
    
    // window.addEventListener('scroll', function() {
    //     let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        
    //     // Add scrolled class for styling
    //     if (scrollTop > 100) {
    //         navbar.classList.add('scrolled');
    //     } else {
    //         navbar.classList.remove('scrolled');
    //     }
        
    //     // Hide/show navbar on scroll
    //     if (scrollTop > lastScrollTop && scrollTop > 200) {
    //         navbar.style.transform = 'translateY(-100%)';
    //     } else {
    //         navbar.style.transform = 'translateY(0)';
    //     }
        
    //     lastScrollTop = scrollTop;
    // });
    
    // Smooth scrolling for navigation links
    // const navLinks = document.querySelectorAll('.nav-link[href^="#"]');
    
    // navLinks.forEach(link => {
    //     link.addEventListener('click', function(e) {
    //         e.preventDefault();
            
    //         const targetId = this.getAttribute('href');
    //         const targetSection = document.querySelector(targetId);
            
    //         if (targetSection) {
    //             const offsetTop = targetSection.offsetTop - 100;
                
    //             window.scrollTo({
    //                 top: offsetTop,
    //                 behavior: 'smooth'
    //             });
    //         }
    //     });
    // });
    
    // Interactive elements hover effects
    const interactiveElements = document.querySelectorAll('.btn, .social-icon');
    
    interactiveElements.forEach(element => {
        element.addEventListener('mouseenter', function() {
            this.style.transform = this.style.transform + ' scale(1.05)';
        });
        
        element.addEventListener('mouseleave', function() {
            this.style.transform = this.style.transform.replace(' scale(1.05)', '');
        });
    });
    
    // Contact information click effects
    const contactItems = document.querySelectorAll('.contact-item');
    
    contactItems.forEach(item => {
        item.addEventListener('click', function() {
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
        });
    });
    
    // Login button effects
    const loginButtons = document.querySelectorAll('.btn-login');
    
    loginButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
            
            alert('Login functionality would be implemented here');
        });
    });
    
   
    
    // Logo click effect
    // const logo = document.querySelector('.navbar-brand');
    
    // if (logo) {
    //     logo.addEventListener('click', function(e) {
    //         e.preventDefault();
            
    //         window.scrollTo({
    //             top: 0,
    //             behavior: 'smooth'
    //         });
            
    //         this.style.transform = 'scale(0.95)';
    //         setTimeout(() => {
    //             this.style.transform = '';
    //         }, 150);
    //     });
    // }
    
    // Initialize Swiper Slider
    const swiperContainer = document.querySelector('.swiper-container');
    if (swiperContainer) {
        const swiper = new Swiper('.swiper-container', {
            // Basic settings
            direction: 'horizontal',
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            
            // Navigation
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            
            // Pagination
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                dynamicBullets: true,
            },
            
            // Scrollbar
            scrollbar: {
                el: '.swiper-scrollbar',
                draggable: true,
            },
            
            // Effects
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
            speed: 1500,
            
            // Responsive breakpoints
            breakpoints: {
                320: {
                    slidesPerView: 1,
                    spaceBetween: 0
                },
                768: {
                    slidesPerView: 1,
                    spaceBetween: 0
                },
                1024: {
                    slidesPerView: 1,
                    spaceBetween: 0
                }
            },
            
            // Touch and mousewheel
            touchRatio: 1,
            touchAngle: 45,
            grabCursor: true,
            mousewheel: false,
            
            // Keyboard navigation
            keyboard: {
                enabled: true,
                onlyInViewport: true,
            },
            
            // Accessibility
            a11y: {
                prevSlideMessage: 'Previous slide',
                nextSlideMessage: 'Next slide',
                firstSlideMessage: 'This is the first slide',
                lastSlideMessage: 'This is the last slide',
            },
            
            // Event listeners for zoom animation
            on: {
                init: function () {
                },
                slideChange: function () {
                    // Reset and restart zoom animation on slide change
                    const activeSlide = this.slides[this.activeIndex];
                    const activeImage = activeSlide.querySelector('img');
                    
                    if (activeImage) {
                        // Reset animation
                        activeImage.style.animation = 'none';
                        activeImage.offsetHeight; // Trigger reflow
                        
                        // Restart animation
                        activeImage.style.animation = 'zoomIn 5s ease-out forwards';
                    }
                }
            }
        });
        
    } else {
    }

    // Modal functionality for Read More buttons
    const readMoreButtons = document.querySelectorAll('.read-more-btn');
    
    readMoreButtons.forEach(button => {
        button.addEventListener('click', function() {
            const title = this.getAttribute('data-title');
            const content = this.getAttribute('data-content');
            
            // Update modal content
            document.getElementById('detailModalLabel').textContent = title;
            document.getElementById('modalContent').textContent = content;
        });
    });
    
    // Optional: Add smooth scrolling to modal content
    const modalContentScroll = document.querySelector('.modal-content-scroll');
    if (modalContentScroll) {
        modalContentScroll.style.scrollBehavior = 'smooth';
    }

    // Accordion functionality for Latest Updates
    const accordionButtons = document.querySelectorAll('.accordion-button');
    
    accordionButtons.forEach(button => {
        button.addEventListener('click', function() {
            const icon = this.querySelector('.update-icon');
            const isCollapsed = this.classList.contains('collapsed');
            
            // Reset all icons to plus
            accordionButtons.forEach(btn => {
                const btnIcon = btn.querySelector('.update-icon');
                btnIcon.className = 'fas fa-plus update-icon';
            });
            
            // Change icon based on state
            if (isCollapsed) {
                icon.className = 'fas fa-minus update-icon';
            } else {
                icon.className = 'fas fa-plus update-icon';
            }
        });
    });

    // Event Card Functionality
    const eventReadMoreButtons = document.querySelectorAll('.event-read-more');
    
    eventReadMoreButtons.forEach(button => {
        button.addEventListener('click', function() {
            const eventType = this.getAttribute('data-event');
            let eventDetails = '';
            
                                 // Define event details based on event type
                     switch(eventType) {
                         case 'sports-day':
                             eventDetails = `
                                 <h4>Annual Sports Day 2024 - Event Summary</h4>
                                 <p><strong>Date:</strong> December 15, 2024</p>
                                 <p><strong>Venue:</strong> School Ground</p>
                                 <p><strong>Events Held:</strong></p>
                                 <ul>
                                     <li>Track and Field Events (100m, 200m, 400m, 800m)</li>
                                     <li>Long Jump and High Jump</li>
                                     <li>Relay Races (4x100m, 4x400m)</li>
                                     <li>Team Sports (Football, Cricket, Basketball)</li>
                                     <li>Individual Sports (Badminton, Table Tennis)</li>
                                     <li>Fun Activities and Games</li>
                                 </ul>
                                 <p><strong>Highlights:</strong> The event was a tremendous success with enthusiastic participation from all students. The day was filled with competitive spirit, sportsmanship, and memorable moments.</p>
                                 <p><strong>Winners:</strong> Trophies and medals were awarded to winners in each category, recognizing outstanding athletic achievements.</p>
                                 <p><strong>Gallery:</strong> Check out the photo gallery to see the exciting moments from this memorable sports day!</p>
                             `;
                             break;
                         case 'science-fair':
                             eventDetails = `
                                 <h4>Annual Science Fair 2024 - Event Summary</h4>
                                 <p><strong>Date:</strong> December 22, 2024</p>
                                 <p><strong>Venue:</strong> Science Lab and Exhibition Hall</p>
                                 <p><strong>Project Categories:</strong></p>
                                 <ul>
                                     <li>Physics and Engineering</li>
                                     <li>Chemistry and Materials Science</li>
                                     <li>Biology and Environmental Science</li>
                                     <li>Computer Science and Technology</li>
                                     <li>Mathematics and Statistics</li>
                                 </ul>
                                 <p><strong>Highlights:</strong> Students showcased their innovative projects and scientific discoveries. The fair was attended by parents, teachers, and local scientists who were impressed by the creativity and scientific approach of our students.</p>
                                 <p><strong>Winners:</strong> Cash prizes and certificates were awarded to outstanding projects based on innovation, scientific method, presentation, and practical application.</p>
                                 <p><strong>Gallery:</strong> Explore the photo gallery to see the amazing projects and experiments presented by our talented students!</p>
                             `;
                             break;
                         case 'cultural-program':
                             eventDetails = `
                                 <h4>Cultural Program & Awards Ceremony 2024 - Event Summary</h4>
                                 <p><strong>Date:</strong> December 28, 2024</p>
                                 <p><strong>Venue:</strong> School Auditorium</p>
                                 <p><strong>Program Highlights:</strong></p>
                                 <ul>
                                     <li>Classical and Modern Dance Performances</li>
                                     <li>Musical Performances (Vocal and Instrumental)</li>
                                     <li>Drama and Skits</li>
                                     <li>Poetry Recitation</li>
                                     <li>Art Exhibition</li>
                                     <li>Annual Awards Ceremony</li>
                                 </ul>
                                 <p><strong>Award Categories:</strong></p>
                                 <ul>
                                     <li>Academic Excellence Awards</li>
                                     <li>Sports Achievement Awards</li>
                                     <li>Cultural Performance Awards</li>
                                     <li>Leadership and Service Awards</li>
                                     <li>Best Student of the Year</li>
                                 </ul>
                                 <p><strong>Highlights:</strong> The cultural program was a spectacular celebration of our diverse culture and student talents. The awards ceremony recognized outstanding achievements across all areas of student development.</p>
                                 <p><strong>Gallery:</strong> View the photo gallery to relive the beautiful performances and award ceremony moments!</p>
                             `;
                             break;
                         default:
                             eventDetails = '<p>Event details will be available soon.</p>';
                     }
            
            // Update modal content
            document.getElementById('detailModalLabel').textContent = this.closest('.event-card').querySelector('.event-title').textContent;
            document.getElementById('modalContent').innerHTML = eventDetails;
            
            // Show the modal
            const modal = new bootstrap.Modal(document.getElementById('detailModal'));
            modal.show();
        });
    });

    // Add hover effects for event cards
    const eventCards = document.querySelectorAll('.event-card');
    
    eventCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-15px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });

    // Video Section Functionality
    const videoItems = document.querySelectorAll('.video-item');
    const prevBtn = document.getElementById('prevVideo');
    const nextBtn = document.getElementById('nextVideo');
    
    let currentVideoIndex = 0;
    
    // Initialize video section
    function initVideoSection() {
        if (videoItems.length > 0) {
            videoItems[0].classList.add('active');
            updateVideoControls();
        }
    }
    
    // Show video by index
    function showVideo(index) {
        // Stop any currently playing video
        videoItems.forEach(item => {
            const iframe = item.querySelector('iframe');
            if (iframe) {
                // Remove the iframe to stop the video
                const thumbnail = item.querySelector('.video-thumbnail');
                const videoId = item.getAttribute('data-video-id');
                
                // Restore the original thumbnail and play button
                thumbnail.innerHTML = `
                    <img src="https://img.youtube.com/vi/${videoId}/maxresdefault.jpg" alt="Video thumbnail" class="thumbnail-img">
                    <div class="play-button">
                        <i class="fas fa-play"></i>
                    </div>
                    <div class="video-overlay"></div>
                `;
                
                // Re-add play button event listener
                const playButton = thumbnail.querySelector('.play-button');
                if (playButton) {
                    playButton.addEventListener('click', function() {
                        // Create YouTube embed URL
                        const embedUrl = `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0&modestbranding=1`;
                        
                        // Replace the thumbnail with the video iframe
                        thumbnail.innerHTML = `
                            <iframe 
                                src="${embedUrl}" 
                                width="100%" 
                                height="100%" 
                                frameborder="0" 
                                allowfullscreen
                                allow="autoplay; encrypted-media"
                            ></iframe>
                        `;
                        
                        // Hide the play button
                        playButton.style.display = 'none';
                    });
                }
            }
        });
        
        // Hide all videos
        videoItems.forEach(item => item.classList.remove('active'));
        
        // Show selected video
        if (videoItems[index]) {
            videoItems[index].classList.add('active');
        }
        
        currentVideoIndex = index;
        updateVideoControls();
    }
    
    // Update navigation controls
    function updateVideoControls() {
        if (prevBtn) {
            prevBtn.disabled = currentVideoIndex === 0;
        }
        if (nextBtn) {
            nextBtn.disabled = currentVideoIndex === videoItems.length - 1;
        }
    }
    
    // Event listeners for video controls
    if (prevBtn) {
        prevBtn.addEventListener('click', function() {
            if (currentVideoIndex > 0) {
                showVideo(currentVideoIndex - 1);
            }
        });
    }
    
    if (nextBtn) {
        nextBtn.addEventListener('click', function() {
            if (currentVideoIndex < videoItems.length - 1) {
                showVideo(currentVideoIndex + 1);
            }
        });
    }
    
    // Play button functionality
    videoItems.forEach(item => {
        const playButton = item.querySelector('.play-button');
        const videoId = item.getAttribute('data-video-id');
        
        if (playButton && videoId) {
            playButton.addEventListener('click', function() {
                // Create YouTube embed URL
                const embedUrl = `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0&modestbranding=1`;
                
                // Replace the thumbnail with the video iframe
                const thumbnail = item.querySelector('.video-thumbnail');
                thumbnail.innerHTML = `
                    <iframe 
                        src="${embedUrl}" 
                        width="100%" 
                        height="100%" 
                        frameborder="0" 
                        allowfullscreen
                        allow="autoplay; encrypted-media"
                    ></iframe>
                `;
                
                // Hide the play button
                playButton.style.display = 'none';
            });
        }
    });
    
    // Initialize video section
    initVideoSection();
}); 

// PDF functionality functions
function downloadPDF(pdfPath, filename) {
    const link = document.createElement('a');
    link.href = pdfPath;
    link.download = filename;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

function printPDF(pdfPath) {
    const printWindow = window.open(pdfPath, '_blank');
    printWindow.onload = function() {
        printWindow.print();
    };
} 