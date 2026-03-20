/* ===== FOOTER JAVASCRIPT ===== */

(function() {
    'use strict';

    // Smooth scroll for footer links
    const footerLinks = document.querySelectorAll('footer a');

    footerLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            
            // Only prevent default for hash links
            if (href && href.startsWith('#')) {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            }
        });
    });

    console.log('Footer initialized');
})();

/* ===== END FOOTER JAVASCRIPT ===== */
