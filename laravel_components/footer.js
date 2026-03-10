/* ===== FOOTER COMPONENT JAVASCRIPT ===== */

(function ($) {
    "use strict";

    // ===== SCROLL TO TOP BUTTON =====
    var scrollTopBtn = $('<div id="scroll-top-btn" class="scroll-top-btn">' +
                        '<i class="fa fa-arrow-up"></i>' +
                        '</div>');
    
    $('body').append(scrollTopBtn);

    // ===== SHOW/HIDE SCROLL TOP BUTTON =====
    $(window).on('scroll', function() {
        if ($(this).scrollTop() > 300) {
            $('#scroll-top-btn').fadeIn();
        } else {
            $('#scroll-top-btn').fadeOut();
        }
    });

    // ===== SCROLL TOP FUNCTIONALITY =====
    $('#scroll-top-btn').on('click', function() {
        $('html, body').animate({
            scrollTop: 0
        }, 600);
        return false;
    });

    // ===== UPDATE FOOTER YEAR (if using PHP/Blade) =====
    // The current year is already handled in the footer.blade.php with {{ now()->year }}
    // This JS is here for any dynamic footer updates needed

    // ===== SMOOTH NAVIGATION TO FOOTER =====
    $('.scroll-to-footer').on('click', function(e) {
        e.preventDefault();
        var footerOffset = $('#footer-section').offset().top - 100;
        
        $('html, body').animate({
            scrollTop: footerOffset
        }, 500);
    });

})(window.jQuery);

/* ===== END FOOTER COMPONENT JAVASCRIPT ===== */
