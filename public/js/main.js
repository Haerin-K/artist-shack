/* ===== MAIN JAVASCRIPT ===== */

(function() {
    'use strict';

    // Initialize everything when DOM is ready
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Page initialized');

        // Initialize tooltips if Bootstrap tooltips are used
        initTooltips();

        // Add smooth scroll to all links
        initSmoothScroll();

        // Initialize form validation if needed
        initFormValidation();
    });

    /**
     * Initialize Bootstrap tooltips
     */
    function initTooltips() {
        if (typeof $ !== 'undefined' && $.fn.tooltip) {
            $('[data-toggle="tooltip"]').tooltip();
        }
    }

    /**
     * Add smooth scroll to internal links
     */
    function initSmoothScroll() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href !== '#' && href !== '#!') {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }
            });
        });
    }

    /**
     * Initialize form validation
     */
    function initFormValidation() {
        const forms = document.querySelectorAll('form');
        forms.forEach(form => {
            form.addEventListener('submit', function(e) {
                // You can add custom form validation here
                console.log('Form submitted:', this);
            });
        });
    }

    /**
     * Handle API calls (logout, delete, etc)
     */
    window.handleAction = function(action, confirmMessage = null) {
        if (confirmMessage && !confirm(confirmMessage)) {
            return false;
        }
        // Add your action handling here
        return true;
    };

    /**
     * Log page performance metrics
     */
    window.addEventListener('load', function() {
        if (window.performance && window.performance.timing) {
            const perfData = window.performance.timing;
            const pageLoadTime = perfData.loadEventEnd - perfData.navigationStart;
            console.log('Page load time: ' + pageLoadTime + 'ms');
        }
    });

    console.log('Main script loaded');
})();

/* ===== END MAIN JAVASCRIPT ===== */
