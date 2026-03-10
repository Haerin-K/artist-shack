/* ===== PRODUCT CAROUSEL COMPONENT JAVASCRIPT ===== */

class ProductCarousel {
    constructor(carouselId) {
        this.carouselId = carouselId;
        this.carouselElement = document.querySelector(carouselId);
        if (!this.carouselElement) return;

        this.section = this.carouselElement.closest('.product-carousel-section');
        this.trackElement = this.section.querySelector('.carousel-track') || this.carouselElement;
        this.itemsPerView = this.getItemsPerView();
        this.currentIndex = 0;
        this.totalItems = this.carouselElement.querySelectorAll('.carousel-item').length;
        this.isAnimating = false;
        
        this.init();
    }

    init() {
        if (this.totalItems === 0) return;

        this.setupEventListeners();
        this.createIndicators();
        this.updateCarousel();
        this.handleResize();
    }

    getItemsPerView() {
        const width = window.innerWidth;
        if (width < 576) return 1;
        if (width < 768) return 2;
        if (width < 1200) return 3;
        return 4;
    }

    setupEventListeners() {
        // Previous button - shift carousel left by 1 item
        const prevBtn = this.section.querySelector('.carousel-prev');
        if (prevBtn) {
            prevBtn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                this.previous();
            });
        }

        // Next button - shift carousel right by 1 item
        const nextBtn = this.section.querySelector('.carousel-next');
        if (nextBtn) {
            nextBtn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                this.next();
            });
        }

        // Indicator dots
        this.section.addEventListener('click', (e) => {
            if (e.target.classList.contains('indicator-dot')) {
                const index = parseInt(e.target.dataset.index);
                this.goToSlide(index);
            }
        });

        // Expand button - show all items in grid view
        const expandBtn = this.section.querySelector('.expand-btn');
        if (expandBtn) {
            expandBtn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                this.expandGrid();
            });
        }

        // Minimize button - collapse grid and return to carousel view
        const minimizeBtn = this.section.querySelector('.minimize-btn');
        if (minimizeBtn) {
            minimizeBtn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                this.collapseGrid();
            });
        }

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft') {
                this.previous();
            } else if (e.key === 'ArrowRight') {
                this.next();
            }
        });

        // Touch swipe support
        let touchStartX = 0;
        let touchEndX = 0;

        this.trackElement.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        });

        this.trackElement.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            
            if (touchStartX - touchEndX > 50) {
                this.next();
            } else if (touchEndX - touchStartX > 50) {
                this.previous();
            }
        });
    }

    previous() {
        if (this.isAnimating) return;
        this.isAnimating = true;

        this.currentIndex--;

        if (this.currentIndex < 0) {
            this.currentIndex = this.totalItems - this.itemsPerView;
        }

        this.updateCarousel();

        setTimeout(() => {
            this.isAnimating = false;
        }, 400);
    }

    next() {
        if (this.isAnimating) return;
        this.isAnimating = true;

        this.currentIndex++;

        if (this.currentIndex > this.totalItems - this.itemsPerView) {
            this.currentIndex = 0;
        }

        this.updateCarousel();

        setTimeout(() => {
            this.isAnimating = false;
        }, 400);
    }

    goToSlide(index) {
        if (this.isAnimating) return;
        this.isAnimating = true;

        this.currentIndex = Math.max(0, Math.min(index, this.totalItems - this.itemsPerView));
        this.updateCarousel();

        setTimeout(() => {
            this.isAnimating = false;
        }, 400);
    }

    updateCarousel() {
        // Calculate offset - each item takes up (100 / itemsPerView)% of the container
        const itemWidth = 100 / this.itemsPerView;
        const offset = this.currentIndex * itemWidth;
        
        // Apply transform to the carousel track element (keep container static)
        if (this.trackElement) {
            this.trackElement.style.transform = `translateX(-${offset}%)`;
        }

        // Update indicators
        const dots = this.section.querySelectorAll('.indicator-dot');
        dots.forEach(dot => {
            dot.classList.remove('active');
        });
        
        const activeIndex = Math.floor(this.currentIndex / this.itemsPerView);
        const activeDot = this.section.querySelector(`.indicator-dot[data-index="${activeIndex}"]`);
        if (activeDot) {
            activeDot.classList.add('active');
        }
    }

    createIndicators() {
        const indicatorContainer = this.section.querySelector('.carousel-indicators');
        const numIndicators = Math.ceil(this.totalItems / this.itemsPerView);

        for (let i = 0; i < numIndicators; i++) {
            const button = document.createElement('button');
            button.className = `indicator-dot ${i === 0 ? 'active' : ''}`;
            button.dataset.index = i;
            button.type = 'button';
            indicatorContainer.appendChild(button);
        }
    }

    handleResize() {
        let resizeTimer;

        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                const newItemsPerView = this.getItemsPerView();
                
                if (newItemsPerView !== this.itemsPerView) {
                    this.itemsPerView = newItemsPerView;
                    const indicatorContainer = this.section.querySelector('.carousel-indicators');
                    indicatorContainer.innerHTML = '';
                    this.createIndicators();
                    this.currentIndex = 0;
                    this.updateCarousel();
                }
            }, 250);
        });
    }

    expandGrid() {
        this.section.querySelector('.carousel-wrapper').classList.add('hidden');
        this.section.querySelector('.grid-wrapper').classList.remove('hidden');
    }

    collapseGrid() {
        this.section.querySelector('.carousel-wrapper').classList.remove('hidden');
        this.section.querySelector('.grid-wrapper').classList.add('hidden');
    }
}

// Initialize all carousels on page load
document.addEventListener('DOMContentLoaded', function() {
    const carousels = document.querySelectorAll('[id^="carousel-"]');
    carousels.forEach(carousel => {
        new ProductCarousel('#' + carousel.id);
    });
});

/* ===== NOTIFICATION STYLES (Injected via JS) ===== */
const notificationStyles = `
    .carousel-notification {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #28a745;
        color: #fff;
        padding: 15px 20px;
        border-radius: 4px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        font-size: 14px;
        font-weight: 600;
        z-index: 9999;
        display: flex;
        align-items: center;
        gap: 10px;
        opacity: 0;
        transform: translateY(100px);
        transition: all 0.3s ease;
        max-width: 300px;
    }

    .carousel-notification.show {
        opacity: 1;
        transform: translateY(0);
    }

    .carousel-notification.notification-info {
        background-color: #17a2b8;
    }

    .carousel-notification.notification-error {
        background-color: #dc3545;
    }

    @media (max-width: 576px) {
        .carousel-notification {
            bottom: 10px;
            right: 10px;
            left: 10px;
            max-width: none;
        }
    }
`;

// Inject notification styles
if (!document.getElementById('carousel-notification-styles')) {
    const style = document.createElement('style');
    style.id = 'carousel-notification-styles';
    style.textContent = notificationStyles;
    document.head.appendChild(style);
}

/* ===== END PRODUCT CAROUSEL COMPONENT JAVASCRIPT ===== */
