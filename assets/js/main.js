/**
 * INVIRO WP Theme - Main JavaScript
 */

(function($) {
    'use strict';

    // Document Ready
    $(document).ready(function() {
        initMobileMenu();
        initSearchOverlay();
        initHeroSlider();
        initTestimonialsCarousel();
        initContactForm();
        initSmoothScroll();
        initLazyLoad();
    });

    /**
     * Mobile Menu Toggle
     */
    function initMobileMenu() {
        const menuToggle = $('.menu-toggle');
        const navigation = $('.main-navigation');
        const menuLinks = $('.nav-menu a');

        menuToggle.on('click', function() {
            navigation.toggleClass('active');
            $(this).attr('aria-expanded', navigation.hasClass('active'));
        });

        // Close menu when clicking on a link
        menuLinks.on('click', function() {
            if ($(window).width() <= 768) {
                navigation.removeClass('active');
                menuToggle.attr('aria-expanded', 'false');
            }
        });

        // Close menu when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.main-navigation, .menu-toggle').length) {
                navigation.removeClass('active');
                menuToggle.attr('aria-expanded', 'false');
            }
        });
    }

    /**
     * Search Overlay
     */
    function initSearchOverlay() {
        const searchToggle = $('.search-toggle');
        const searchOverlay = $('.search-overlay');
        const searchClose = $('.search-close');
        const searchField = $('.search-field');

        searchToggle.on('click', function() {
            searchOverlay.addClass('active');
            searchField.focus();
            $('body').css('overflow', 'hidden');
        });

        searchClose.on('click', function() {
            closeSearchOverlay();
        });

        searchOverlay.on('click', function(e) {
            if ($(e.target).is(searchOverlay)) {
                closeSearchOverlay();
            }
        });

        $(document).on('keydown', function(e) {
            if (e.key === 'Escape' && searchOverlay.hasClass('active')) {
                closeSearchOverlay();
            }
        });

        function closeSearchOverlay() {
            searchOverlay.removeClass('active');
            $('body').css('overflow', '');
        }
    }

    /**
     * Hero Slider
     */
    function initHeroSlider() {
        const slides = $('.hero-slide');
        const prevBtn = $('.hero-prev');
        const nextBtn = $('.hero-next');
        let currentSlide = 0;
        let slideInterval;

        if (slides.length === 0) return;

        // Create indicators
        const indicatorsContainer = $('.hero-indicators');
        slides.each(function(index) {
            const indicator = $('<div class="hero-indicator"></div>');
            if (index === 0) indicator.addClass('active');
            indicator.on('click', function() {
                goToSlide(index);
            });
            indicatorsContainer.append(indicator);
        });

        function showSlide(index) {
            slides.removeClass('active');
            slides.eq(index).addClass('active');
            $('.hero-indicator').removeClass('active');
            $('.hero-indicator').eq(index).addClass('active');
            currentSlide = index;
        }

        function nextSlide() {
            const next = (currentSlide + 1) % slides.length;
            showSlide(next);
        }

        function prevSlide() {
            const prev = (currentSlide - 1 + slides.length) % slides.length;
            showSlide(prev);
        }

        function goToSlide(index) {
            showSlide(index);
            resetInterval();
        }

        function startInterval() {
            slideInterval = setInterval(nextSlide, 5000);
        }

        function resetInterval() {
            clearInterval(slideInterval);
            startInterval();
        }

        nextBtn.on('click', function() {
            nextSlide();
            resetInterval();
        });

        prevBtn.on('click', function() {
            prevSlide();
            resetInterval();
        });

        // Auto-play slider
        if (slides.length > 1) {
            startInterval();
        }

        // Pause on hover
        $('.hero-section').on('mouseenter', function() {
            clearInterval(slideInterval);
        }).on('mouseleave', function() {
            startInterval();
        });
    }

    /**
     * Testimonials Carousel
     */
    function initTestimonialsCarousel() {
        const track = $('.testimonials-track');
        const cards = $('.testimonial-card');
        const prevBtn = $('.testimonial-prev');
        const nextBtn = $('.testimonial-next');
        let currentIndex = 0;
        let cardWidth = 0;
        let visibleCards = 3;

        if (cards.length === 0) return;

        function updateCardWidth() {
            const containerWidth = track.width();
            if ($(window).width() <= 768) {
                visibleCards = 1;
            } else if ($(window).width() <= 1024) {
                visibleCards = 2;
            } else {
                visibleCards = 3;
            }
            cardWidth = containerWidth / visibleCards;
        }

        function createIndicators() {
            const indicatorsContainer = $('.testimonials-indicators');
            indicatorsContainer.empty();
            const totalIndicators = Math.ceil(cards.length / visibleCards);
            
            for (let i = 0; i < totalIndicators; i++) {
                const indicator = $('<div class="testimonial-indicator"></div>');
                if (i === 0) indicator.addClass('active');
                indicator.on('click', function() {
                    goToSlide(i);
                });
                indicatorsContainer.append(indicator);
            }
        }

        function updateCarousel() {
            updateCardWidth();
            const translateX = -currentIndex * cardWidth;
            track.css('transform', `translateX(${translateX}px)`);
            updateIndicators();
        }

        function updateIndicators() {
            const activeIndicator = Math.floor(currentIndex / visibleCards);
            $('.testimonial-indicator').removeClass('active');
            $('.testimonial-indicator').eq(activeIndicator).addClass('active');
        }

        function nextSlide() {
            const maxIndex = Math.ceil(cards.length / visibleCards) - 1;
            if (currentIndex < maxIndex * visibleCards) {
                currentIndex += visibleCards;
                if (currentIndex >= cards.length) {
                    currentIndex = 0;
                }
                updateCarousel();
            }
        }

        function prevSlide() {
            if (currentIndex > 0) {
                currentIndex -= visibleCards;
                if (currentIndex < 0) {
                    currentIndex = 0;
                }
                updateCarousel();
            } else {
                const maxIndex = Math.ceil(cards.length / visibleCards) - 1;
                currentIndex = maxIndex * visibleCards;
                updateCarousel();
            }
        }

        function goToSlide(index) {
            currentIndex = index * visibleCards;
            updateCarousel();
        }

        nextBtn.on('click', nextSlide);
        prevBtn.on('click', prevSlide);

        // Touch/swipe support
        let startX = 0;
        let isDragging = false;

        track.on('mousedown touchstart', function(e) {
            isDragging = true;
            startX = e.type === 'mousedown' ? e.pageX : e.originalEvent.touches[0].pageX;
            track.css('cursor', 'grabbing');
        });

        $(document).on('mousemove touchmove', function(e) {
            if (!isDragging) return;
            e.preventDefault();
        });

        $(document).on('mouseup touchend', function(e) {
            if (!isDragging) return;
            isDragging = false;
            track.css('cursor', 'grab');
            
            const endX = e.type === 'mouseup' ? e.pageX : e.originalEvent.changedTouches[0].pageX;
            const diffX = startX - endX;
            
            if (Math.abs(diffX) > 50) {
                if (diffX > 0) {
                    nextSlide();
                } else {
                    prevSlide();
                }
            }
        });

        // Initialize
        updateCardWidth();
        createIndicators();
        updateCarousel();

        // Update on resize
        $(window).on('resize', function() {
            updateCardWidth();
            createIndicators();
            currentIndex = 0;
            updateCarousel();
        });
    }

    /**
     * Contact Form Handler
     */
    function initContactForm() {
        const form = $('#inviro-contact-form');
        const messageDiv = $('.form-message');

        form.on('submit', function(e) {
            e.preventDefault();

            const formData = {
                action: 'inviro_contact_form',
                nonce: inviroAjax.nonce,
                name: $('#contact-name').val(),
                email: $('#contact-email').val(),
                phone: $('#contact-phone').val(),
                subject: $('#contact-subject').val(),
                message: $('#contact-message').val()
            };

            // Validate
            if (!formData.name || !formData.email || !formData.message) {
                showMessage('error', 'Mohon lengkapi semua field yang wajib diisi.');
                return;
            }

            // Show loading state
            const submitBtn = form.find('button[type="submit"]');
            const originalText = submitBtn.text();
            submitBtn.prop('disabled', true).text('Mengirim...');

            // Send AJAX request
            $.ajax({
                url: inviroAjax.ajaxurl,
                type: 'POST',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        showMessage('success', response.data.message || 'Pesan berhasil dikirim!');
                        form[0].reset();
                    } else {
                        showMessage('error', response.data.message || 'Gagal mengirim pesan. Silakan coba lagi.');
                    }
                },
                error: function() {
                    showMessage('error', 'Terjadi kesalahan. Silakan coba lagi.');
                },
                complete: function() {
                    submitBtn.prop('disabled', false).text(originalText);
                }
            });
        });

        function showMessage(type, message) {
            messageDiv.removeClass('success error')
                      .addClass(type)
                      .text(message)
                      .fadeIn();

            setTimeout(function() {
                messageDiv.fadeOut();
            }, 5000);
        }
    }

    /**
     * Smooth Scroll
     */
    function initSmoothScroll() {
        $('a[href^="#"]').on('click', function(e) {
            const target = $(this.getAttribute('href'));
            if (target.length) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: target.offset().top - 80
                }, 800);
            }
        });
    }

    /**
     * Lazy Load Images
     */
    function initLazyLoad() {
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        if (img.dataset.src) {
                            img.src = img.dataset.src;
                            img.removeAttribute('data-src');
                            imageObserver.unobserve(img);
                        }
                    }
                });
            });

            $('img[data-src]').each(function() {
                imageObserver.observe(this);
            });
        }
    }

    /**
     * Sticky Header on Scroll
     */
    $(window).on('scroll', function() {
        const header = $('.site-header');
        if ($(window).scrollTop() > 100) {
            header.addClass('scrolled');
        } else {
            header.removeClass('scrolled');
        }
    });

    /**
     * Product Like Button
     */
    $('.product-like').on('click', function(e) {
        e.preventDefault();
        $(this).toggleClass('liked');
        if ($(this).hasClass('liked')) {
            $(this).css('color', '#e74c3c');
        } else {
            $(this).css('color', '');
        }
    });

    /**
     * Animate on Scroll
     */
    function initScrollAnimation() {
        if ('IntersectionObserver' in window) {
            const animationObserver = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animated');
                        animationObserver.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1
            });

            $('.product-card, .testimonial-card, .branch-card, .feature-item').each(function() {
                animationObserver.observe(this);
            });
        }
    }

    // Initialize scroll animations
    initScrollAnimation();

})(jQuery);

