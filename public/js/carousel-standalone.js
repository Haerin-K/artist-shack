/* ===== PRODUCT CAROUSEL COMPONENT JAVASCRIPT (STANDALONE) ===== */

(function() {
    class ProductCarousel {
        constructor(carouselId) {
            this.carouselId = carouselId;
            this.carouselElement = document.querySelector(carouselId);
            if (!this.carouselElement) {
                console.warn('Carousel element not found:', carouselId);
                return;
            }

            this.section = this.carouselElement.closest('.product-carousel-section');
            if (!this.section) {
                console.warn('Section not found for carousel:', carouselId);
                return;
            }

            this.trackElement = this.section.querySelector('.carousel-track') || this.carouselElement;
            this.itemsPerView = this.getItemsPerView();
            this.currentIndex = 0;
            this.totalItems = this.carouselElement.querySelectorAll('.carousel-item').length;
            this.isAnimating = false;

            console.log('Carousel initialized:', carouselId, 'Items:', this.totalItems);
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
                    console.log('Previous clicked');
                    this.previous();
                });
            } else {
                console.warn('Previous button not found');
            }

            // Next button - shift carousel right by 1 item
            const nextBtn = this.section.querySelector('.carousel-next');
            if (nextBtn) {
                nextBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    console.log('Next clicked');
                    this.next();
                });
            } else {
                console.warn('Next button not found');
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
            console.log('Looking for expand btn in section:', this.section.id);
            console.log('Expand btn found:', expandBtn);
            
            if (expandBtn) {
                console.log('Attaching click listener to expand btn');
                expandBtn.addEventListener('click', (e) => {
                    console.log('Expand button CLICKED!');
                    e.preventDefault();
                    e.stopPropagation();
                    const gridWrapper = this.section.querySelector('.grid-wrapper');
                    const isGridVisible = !gridWrapper.classList.contains('hidden');
                    console.log('Expand clicked, grid visible:', isGridVisible, 'Grid wrapper:', gridWrapper);
                    if (isGridVisible) {
                        this.collapseGrid();
                    } else {
                        this.expandGrid();
                    }
                });
            } else {
                console.warn('Expand button not found for carousel:', this.carouselId);
                console.log('Section element:', this.section);
                console.log('Looking for .expand-btn in', this.section.innerHTML.substring(0, 500));
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

            if (this.trackElement) {
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
        }

        previous() {
            if (this.isAnimating) return;
            this.isAnimating = true;

            this.currentIndex--;

            if (this.currentIndex < 0) {
                this.currentIndex = this.totalItems - this.itemsPerView;
            }

            console.log('Previous: currentIndex =', this.currentIndex);
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

            console.log('Next: currentIndex =', this.currentIndex);
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

            // Apply transform to the carousel track element
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
            if (!indicatorContainer) {
                console.warn('Indicator container not found');
                return;
            }

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
                        if (indicatorContainer) {
                            indicatorContainer.innerHTML = '';
                        }
                        this.createIndicators();
                        this.currentIndex = 0;
                        this.updateCarousel();
                    }
                }, 250);
            });
        }

        expandGrid() {
            console.log('expandGrid called for', this.carouselId);
            const carouselWrapper = this.section.querySelector('.carousel-wrapper');
            const gridWrapper = this.section.querySelector('.grid-wrapper');
            const expandBtn = this.section.querySelector('.expand-btn');

            if (carouselWrapper) {
                carouselWrapper.classList.add('hidden');
                console.log('Added hidden to carousel-wrapper');
            }
            if (gridWrapper) {
                gridWrapper.classList.remove('hidden');
                console.log('Removed hidden from grid-wrapper');
            }
            if (expandBtn) {
                expandBtn.innerHTML = '<i class="fa fa-compress"></i> Minimize';
                expandBtn.title = 'Back to carousel view';
            }
        }

        collapseGrid() {
            console.log('collapseGrid called for', this.carouselId);
            const carouselWrapper = this.section.querySelector('.carousel-wrapper');
            const gridWrapper = this.section.querySelector('.grid-wrapper');
            const expandBtn = this.section.querySelector('.expand-btn');

            if (carouselWrapper) {
                carouselWrapper.classList.remove('hidden');
                console.log('Removed hidden from carousel-wrapper');
            }
            if (gridWrapper) {
                gridWrapper.classList.add('hidden');
                console.log('Added hidden to grid-wrapper');
            }
            if (expandBtn) {
                expandBtn.innerHTML = '<i class="fa fa-th"></i> View All';
                expandBtn.title = 'View all items';
            }
        }
    }

    // Initialize all carousels on page load
    function initializeCarousels() {
        console.log('Initializing carousels...');
        const carousels = document.querySelectorAll('[id^="carousel-"]');
        console.log('Found', carousels.length, 'carousel elements');
        
        carousels.forEach(carousel => {
            console.log('Creating carousel for:', '#' + carousel.id);
            new ProductCarousel('#' + carousel.id);
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initializeCarousels);
    } else {
        initializeCarousels();
    }
})();

/* ===== END PRODUCT CAROUSEL COMPONENT JAVASCRIPT ===== */
