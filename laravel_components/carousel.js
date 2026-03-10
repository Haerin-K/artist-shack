/* ===== PRODUCT CAROUSEL COMPONENT JAVASCRIPT ===== */

(function ($) {
    "use strict";

    // ===== CAROUSEL CLASS =====
    class ProductCarousel {
        constructor(carouselId) {
            this.carouselId = carouselId;
            this.$carousel = $(carouselId);
            this.$track = this.$carousel;
            this.$section = this.$carousel.closest('.product-carousel-section');
            this.itemsPerView = this.getItemsPerView();
            this.currentIndex = 0;
            this.totalItems = this.$carousel.find('.carousel-item').length;
            this.isAnimating = false;
            
            this.init();
        }

        // ===== INITIALIZE CAROUSEL =====
        init() {
            if (this.totalItems === 0) return;

            this.setupEventListeners();
            this.createIndicators();
            this.updateCarousel();
            this.handleResize();
        }

        // ===== GET ITEMS PER VIEW BASED ON SCREEN SIZE =====
        getItemsPerView() {
            const width = $(window).width();
            if (width < 576) return 1;    // Mobile: 1 item
            if (width < 768) return 2;    // Tablet: 2 items
            if (width < 1200) return 3;   // Desktop: 3 items
            return 4;                     // Large desktop: 4 items
        }

        // ===== SETUP EVENT LISTENERS =====
        setupEventListeners() {
            const self = this;

            // Previous button
            this.$section.find('.carousel-prev').on('click', function() {
                self.previous();
            });

            // Next button
            this.$section.find('.carousel-next').on('click', function() {
                self.next();
            });

            // Indicator dots
            this.$section.on('click', '.indicator-dot', function() {
                const index = $(this).data('index');
                self.goToSlide(index);
            });

            // Expand button
            this.$section.find('.expand-btn').on('click', function() {
                self.expandGrid();
            });

            // Collapse button
            this.$section.find('.collapse-btn').on('click', function() {
                self.collapseGrid();
            });

            // Add to cart forms
            this.$section.on('submit', '.add-to-cart-form', function(e) {
                e.preventDefault();
                self.handleAddToCart($(this));
            });

            // Wishlist button
            this.$section.on('click', '.wishlist-btn', function() {
                self.toggleWishlist($(this));
            });

            // Keyboard navigation
            $(document).on('keydown', function(e) {
                if (e.key === 'ArrowLeft') {
                    self.previous();
                } else if (e.key === 'ArrowRight') {
                    self.next();
                }
            });

            // Touch swipe support
            let touchStartX = 0;
            let touchEndX = 0;

            this.$carousel.on('touchstart', function(e) {
                touchStartX = e.changedTouches[0].screenX;
            });

            this.$carousel.on('touchend', function(e) {
                touchEndX = e.changedTouches[0].screenX;
                
                if (touchStartX - touchEndX > 50) {
                    self.next(); // Swipe left
                } else if (touchEndX - touchStartX > 50) {
                    self.previous(); // Swipe right
                }
            });
        }

        // ===== NAVIGATE TO PREVIOUS ITEM (INFINITE LOOP) =====
        previous() {
            if (this.isAnimating) return;
            this.isAnimating = true;

            this.currentIndex--;

            // Infinite loop: wrap around to end
            if (this.currentIndex < 0) {
                this.currentIndex = this.totalItems - this.itemsPerView;
            }

            this.updateCarousel();

            setTimeout(() => {
                this.isAnimating = false;
            }, 400);
        }

        // ===== NAVIGATE TO NEXT ITEM (INFINITE LOOP) =====
        next() {
            if (this.isAnimating) return;
            this.isAnimating = true;

            this.currentIndex++;

            // Infinite loop: wrap around to start
            if (this.currentIndex > this.totalItems - this.itemsPerView) {
                this.currentIndex = 0;
            }

            this.updateCarousel();

            setTimeout(() => {
                this.isAnimating = false;
            }, 400);
        }

        // ===== GO TO SPECIFIC SLIDE =====
        goToSlide(index) {
            if (this.isAnimating) return;
            this.isAnimating = true;

            this.currentIndex = Math.max(0, Math.min(index, this.totalItems - this.itemsPerView));
            this.updateCarousel();

            setTimeout(() => {
                this.isAnimating = false;
            }, 400);
        }

        // ===== UPDATE CAROUSEL POSITION AND INDICATORS =====
        updateCarousel() {
            const itemWidth = 100 / this.itemsPerView;
            const offset = -(this.currentIndex * itemWidth);

            this.$track.css({
                'transform': `translateX(${offset}%)`
            });

            // Update indicators
            this.$section.find('.indicator-dot').removeClass('active');
            const activeIndex = Math.floor(this.currentIndex / this.itemsPerView);
            this.$section.find(`.indicator-dot[data-index="${activeIndex}"]`).addClass('active');
        }

        // ===== CREATE CAROUSEL INDICATORS =====
        createIndicators() {
            const $indicatorContainer = this.$section.find('.carousel-indicators');
            const numIndicators = Math.ceil(this.totalItems / this.itemsPerView);

            for (let i = 0; i < numIndicators; i++) {
                const $dot = $(`<button class="indicator-dot ${i === 0 ? 'active' : ''}" data-index="${i}" type="button"></button>`);
                $indicatorContainer.append($dot);
            }
        }

        // ===== HANDLE WINDOW RESIZE =====
        handleResize() {
            const self = this;
            let resizeTimer;

            $(window).on('resize', function() {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(function() {
                    const newItemsPerView = self.getItemsPerView();
                    
                    if (newItemsPerView !== self.itemsPerView) {
                        self.itemsPerView = newItemsPerView;
                        self.$section.find('.carousel-indicators').html('');
                        self.createIndicators();
                        self.currentIndex = 0;
                        self.updateCarousel();
                    }
                }, 250);
            });
        }

        // ===== EXPAND TO GRID VIEW =====
        expandGrid() {
            this.$section.find('.carousel-wrapper').addClass('hidden');
            this.$section.find('.grid-wrapper').removeClass('hidden');
            
            // Scroll to grid view
            $('html, body').animate({
                scrollTop: this.$section.find('.grid-wrapper').offset().top - 100
            }, 500);
        }

        // ===== COLLAPSE GRID VIEW =====
        collapseGrid() {
            this.$section.find('.carousel-wrapper').removeClass('hidden');
            this.$section.find('.grid-wrapper').addClass('hidden');
            
            // Scroll to carousel
            $('html, body').animate({
                scrollTop: this.$section.find('.carousel-wrapper').offset().top - 100
            }, 500);
        }

        // ===== HANDLE ADD TO CART =====
        handleAddToCart($form) {
            const productId = $form.data('product-id') || 'unknown';
            
            // Optional: Show notification
            this.showNotification('Added to cart!', 'success');

            // Optional: Update cart count in header
            this.updateCartCount();

            // Form can still submit if you want server-side processing
            // Remove preventDefault if you want default form submission
        }

        // ===== TOGGLE WISHLIST =====
        toggleWishlist($btn) {
            $btn.toggleClass('active');
            
            if ($btn.hasClass('active')) {
                $btn.html('<i class="fa fa-heart"></i>');
                this.showNotification('Added to wishlist!', 'success');
            } else {
                $btn.html('<i class="fa fa-heart-o"></i>');
                this.showNotification('Removed from wishlist', 'info');
            }
        }

        // ===== UPDATE CART COUNT IN HEADER =====
        updateCartCount() {
            let cartCount = localStorage.getItem('cartCount') || 0;
            cartCount = parseInt(cartCount) + 1;
            localStorage.setItem('cartCount', cartCount);
            
            // Trigger event for header component to listen
            $(document).trigger('cartUpdated');
        }

        // ===== SHOW NOTIFICATION =====
        showNotification(message, type = 'success') {
            const $notification = $(`
                <div class="carousel-notification notification-${type}">
                    <i class="fa fa-check-circle"></i>
                    ${message}
                </div>
            `);

            $('body').append($notification);

            setTimeout(() => {
                $notification.addClass('show');
            }, 10);

            setTimeout(() => {
                $notification.removeClass('show');
                setTimeout(() => {
                    $notification.remove();
                }, 300);
            }, 3000);
        }
    }

    // ===== INITIALIZE ALL CAROUSELS ON PAGE LOAD =====
    $(document).ready(function() {
        // Find all carousels on the page
        $('[id^="carousel-"]').each(function() {
            const carouselId = '#' + $(this).attr('id');
            new ProductCarousel(carouselId);
        });
    });

})(window.jQuery);

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

// ===== INJECT NOTIFICATION STYLES =====
if ($('#carousel-notification-styles').length === 0) {
    $('<style id="carousel-notification-styles">' + notificationStyles + '</style>').appendTo('head');
}

/* ===== END PRODUCT CAROUSEL COMPONENT JAVASCRIPT ===== */
