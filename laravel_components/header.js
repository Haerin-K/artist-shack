/* ===== HEADER COMPONENT JAVASCRIPT ===== */

(function ($) {
    "use strict";

    // ===== STICKY HEADER ON SCROLL =====
    $(window).on('scroll', function() {
        var scroll = $(window).scrollTop();
        var headerHeight = $('#main-header').height();
        
        if (scroll >= 100) {
            $('#main-header').addClass('background-header');
        } else {
            $('#main-header').removeClass('background-header');
        }
    });

    // ===== MOBILE MENU TOGGLE =====
    $('.menu-trigger').on('click', function() {
        $(this).toggleClass('active');
        $('.header-area .nav').slideToggle(200);
        $('.submenu ul').removeClass('active');
    });

    // ===== SUBMENU TOGGLE (Mobile) =====
    $('.submenu > a').on('click', function(e) {
        if ($(window).width() < 991) {
            e.preventDefault();
            $(this).toggleClass('active');
            $(this).next('ul').toggleClass('active');
        }
    });

    // ===== SMOOTH SCROLL TO SECTIONS =====
    $('.scroll-to-section a[href*="#"]:not([href="#"])').on('click', function() {
        if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && 
            location.hostname === this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            
            if (target.length) {
                $('html, body').animate({
                    scrollTop: (target.offset().top) - 80
                }, 700);
                
                // Close mobile menu if open
                if ($(window).width() < 991) {
                    $('.menu-trigger').removeClass('active');
                    $('.header-area .nav').slideUp(200);
                }
                return false;
            }
        }
    });

    // ===== UPDATE CART COUNT =====
    function updateCartCount() {
        var cartCount = localStorage.getItem('cartCount') || 0;
        $('#cart-count').text(cartCount);
    }

    // ===== UPDATE USER DISPLAY =====
    function updateUserDisplay() {
        var userName = localStorage.getItem('userName');
        var loginLink = $('#login-link');
        var usernameArea = $('#username-display');
        
        if (userName) {
            usernameArea.text(userName);
            loginLink.html('<i class="fa fa-user"></i> Logout').attr('href', '{{ route("logout") }}');
        } else {
            usernameArea.text('');
            loginLink.html('<i class="fa fa-user"></i>').attr('href', '{{ route("login") }}');
        }
    }

    // ===== SEARCH FUNCTIONALITY =====
    $('#search-btn').on('click', function() {
        var searchQuery = $('#search-input').val();
        if (searchQuery.trim() !== '') {
            window.location.href = "{{ route('products.search') }}?q=" + encodeURIComponent(searchQuery);
        }
    });

    $('#search-input').on('keypress', function(e) {
        if (e.which === 13) {
            $('#search-btn').click();
        }
    });

    // ===== ACTIVE LINK HIGHLIGHTING ON SCROLL =====
    $(window).on('scroll', function() {
        var scrollPos = $(document).scrollTop();
        
        $('.scroll-to-section a').each(function() {
            var currLink = $(this);
            var refElement = $(currLink.attr('href'));
            
            if (refElement.length) {
                var refTop = refElement.position().top;
                var refBottom = refTop + refElement.height();
                
                if (refTop <= scrollPos && refBottom > scrollPos) {
                    $('.scroll-to-section a').removeClass('active');
                    currLink.addClass('active');
                } else {
                    currLink.removeClass('active');
                }
            }
        });
    });

    // ===== INITIALIZE ON PAGE LOAD =====
    $(document).ready(function() {
        updateCartCount();
        updateUserDisplay();
        
        // Listen for cart updates
        $(document).on('cartUpdated', function() {
            updateCartCount();
        });
        
        // Listen for user login/logout
        $(document).on('userUpdated', function() {
            updateUserDisplay();
        });
    });

    // ===== WINDOW RESIZE HANDLER =====
    $(window).on('resize', function() {
        if ($(window).width() >= 991) {
            $('.header-area .nav').show();
            $('.menu-trigger').removeClass('active');
        }
    });

})(window.jQuery);

/* ===== END HEADER COMPONENT JAVASCRIPT ===== */
