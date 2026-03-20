/* ===== CAROUSEL WRAPPER JAVASCRIPT ===== */

(function() {
    'use strict';

    // The carousel is initialized by carousel-standalone.js
    // This file can be used for additional carousel functionality if needed

    document.addEventListener('DOMContentLoaded', function() {
        console.log('Carousel wrapper initialized');

        // You can add additional carousel handling here
        // For example: tracking carousel events, analytics, etc.

        // Listen for carousel navigation
        const prevButtons = document.querySelectorAll('.carousel-prev');
        const nextButtons = document.querySelectorAll('.carousel-next');

        prevButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                // Add any tracking or logging here
                console.log('Previous carousel button clicked');
            });
        });

        nextButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                // Add any tracking or logging here
                console.log('Next carousel button clicked');
            });
        });
    });
})();

/* ===== END CAROUSEL WRAPPER JAVASCRIPT ===== */
