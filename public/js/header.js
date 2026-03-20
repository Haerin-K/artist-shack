/* ===== HEADER NAVIGATION JAVASCRIPT ===== */

(function() {
    'use strict';

    // Close navbar on link click
    const navbarLinks = document.querySelectorAll('.navbar-nav .nav-link');
    const navbarToggler = document.querySelector('.navbar-toggler');
    const navbarCollapse = document.querySelector('.navbar-collapse');

    navbarLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (navbarCollapse.classList.contains('show')) {
                navbarToggler.click();
            }
        });
    });

    // Add active class to current page link
    const currentLocation = location.pathname;
    const menuItems = document.querySelectorAll('.navbar-nav .nav-link');

    menuItems.forEach(item => {
        const href = item.getAttribute('href');
        if (href && currentLocation.includes(href)) {
            item.classList.add('active');
        }
    });

    console.log('Header navigation initialized');
})();

/* ===== END HEADER NAVIGATION JAVASCRIPT ===== */
