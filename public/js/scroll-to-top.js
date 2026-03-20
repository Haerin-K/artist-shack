/* ===== SCROLL TO TOP JAVASCRIPT ===== */

(function() {
    'use strict';

    const scrollToTopBtn = document.getElementById('scroll-to-top');

    if (!scrollToTopBtn) {
        console.warn('Scroll to top button not found');
        return;
    }

    // Show/hide scroll to top button
    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            scrollToTopBtn.classList.add('show');
        } else {
            scrollToTopBtn.classList.remove('show');
        }
    });

    // Scroll to top smooth animation
    scrollToTopBtn.addEventListener('click', function(e) {
        e.preventDefault();
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    // Keyboard support (Ctrl+Home)
    document.addEventListener('keydown', function(e) {
        if ((e.ctrlKey || e.metaKey) && e.key === 'Home') {
            e.preventDefault();
            scrollToTopBtn.click();
        }
    });

    console.log('Scroll to top initialized');
})();

/* ===== END SCROLL TO TOP JAVASCRIPT ===== */
