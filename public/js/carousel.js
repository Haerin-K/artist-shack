/* ===== PRODUCT CAROUSEL COMPONENT JAVASCRIPT ===== */

(function() {
    'use strict';

    class ProductCarousel {
        constructor(sectionElement) {
            this.section = sectionElement;
            this.track = this.section.querySelector('.carousel-track');
            this.prevBtn = this.section.querySelector('.carousel-prev');
            this.nextBtn = this.section.querySelector('.carousel-next');
            this.expandBtn = this.section.querySelector('.expand-btn');
            this.carouselWrapper = this.section.querySelector('.carousel-wrapper');
            this.gridWrapper = this.section.querySelector('.grid-wrapper');
            this.indicatorContainer = this.section.querySelector('.product-carousel-indicators');
            this.items = Array.from(this.track ? this.track.children : []);

            this.totalItems = this.items.length;
            this.itemsPerView = this.getItemsPerView();
            this.currentStart = 0;
            this.isAnimating = false;

            if (!this.track || this.totalItems === 0) {
                return;
            }

            this.bindEvents();
            this.createIndicators();
            this.updateIndicators();
            this.handleResize();
        }

        getItemsPerView() {
            const width = window.innerWidth;
            if (width < 576) return 1;
            if (width < 768) return 2;
            if (width < 1200) return 3;
            return 4;
        }

        getStepWidth() {
            const firstItem = this.track.querySelector('.product-carousel-item');
            if (!firstItem) return 0;

            const itemWidth = firstItem.getBoundingClientRect().width;
            const gap = parseFloat(window.getComputedStyle(this.track).gap || '0');
            return itemWidth + gap;
        }

        bindEvents() {
            if (this.nextBtn) {
                this.nextBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    this.next();
                });
            }

            if (this.prevBtn) {
                this.prevBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    this.previous();
                });
            }

            if (this.expandBtn) {
                this.expandBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    if (this.gridWrapper && this.gridWrapper.classList.contains('hidden')) {
                        this.expandGrid();
                    } else {
                        this.collapseGrid();
                    }
                });
            }

            this.section.addEventListener('click', (e) => {
                const indicator = e.target.closest('.product-indicator-dot');
                if (!indicator) return;
                const pageIndex = parseInt(indicator.dataset.index, 10);
                if (Number.isNaN(pageIndex)) return;
                const targetStart = pageIndex * this.itemsPerView;
                this.goToIndex(targetStart);
            });

            let touchStartX = 0;
            this.track.addEventListener('touchstart', (e) => {
                touchStartX = e.changedTouches[0].screenX;
            });

            this.track.addEventListener('touchend', (e) => {
                const touchEndX = e.changedTouches[0].screenX;
                const deltaX = touchStartX - touchEndX;

                if (Math.abs(deltaX) < 50) return;
                if (deltaX > 0) {
                    this.next();
                } else {
                    this.previous();
                }
            });
        }

        next() {
            if (this.isAnimating || this.totalItems <= this.itemsPerView) return;
            this.isAnimating = true;

            const step = this.getStepWidth();
            this.track.style.transition = 'transform 0.45s ease';
            this.track.style.transform = `translateX(-${step}px)`;

            const onTransitionEnd = () => {
                const first = this.track.firstElementChild;
                if (first) {
                    this.track.appendChild(first);
                }

                this.track.style.transition = 'none';
                this.track.style.transform = 'translateX(0)';

                this.currentStart = (this.currentStart + 1) % this.totalItems;
                this.updateIndicators();

                this.track.offsetHeight;
                this.isAnimating = false;
            };

            this.track.addEventListener('transitionend', onTransitionEnd, { once: true });
        }

        previous() {
            if (this.isAnimating || this.totalItems <= this.itemsPerView) return;
            this.isAnimating = true;

            const last = this.track.lastElementChild;
            if (last) {
                this.track.insertBefore(last, this.track.firstElementChild);
            }

            const step = this.getStepWidth();
            this.track.style.transition = 'none';
            this.track.style.transform = `translateX(-${step}px)`;
            this.track.offsetHeight;

            this.track.style.transition = 'transform 0.45s ease';
            this.track.style.transform = 'translateX(0)';

            const onTransitionEnd = () => {
                this.currentStart = (this.currentStart - 1 + this.totalItems) % this.totalItems;
                this.updateIndicators();
                this.isAnimating = false;
            };

            this.track.addEventListener('transitionend', onTransitionEnd, { once: true });
        }

        goToIndex(targetStart) {
            if (this.isAnimating || this.totalItems <= this.itemsPerView) return;

            let steps = ((targetStart - this.currentStart) % this.totalItems + this.totalItems) % this.totalItems;
            if (steps > this.totalItems / 2) {
                steps -= this.totalItems;
            }

            if (steps === 0) return;

            const moveNext = steps > 0;
            const totalMoves = Math.abs(steps);
            let moved = 0;

            const moveOne = () => {
                if (moved >= totalMoves) return;
                moved += 1;

                if (moveNext) {
                    this.next();
                } else {
                    this.previous();
                }

                const waitForUnlock = () => {
                    if (!this.isAnimating) {
                        moveOne();
                    } else {
                        requestAnimationFrame(waitForUnlock);
                    }
                };

                waitForUnlock();
            };

            moveOne();
        }

        createIndicators() {
            if (!this.indicatorContainer) return;
            this.indicatorContainer.innerHTML = '';

            const pages = Math.max(1, Math.ceil(this.totalItems / this.itemsPerView));
            for (let i = 0; i < pages; i += 1) {
                const button = document.createElement('button');
                button.type = 'button';
                button.className = 'product-indicator-dot';
                button.dataset.index = String(i);
                this.indicatorContainer.appendChild(button);
            }
        }

        updateIndicators() {
            if (!this.indicatorContainer) return;
            const dots = this.indicatorContainer.querySelectorAll('.product-indicator-dot');
            const activePage = Math.floor(this.currentStart / this.itemsPerView);

            dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === activePage);
            });
        }

        expandGrid() {
            if (this.carouselWrapper) {
                this.carouselWrapper.classList.add('hidden');
            }

            if (this.gridWrapper) {
                this.gridWrapper.classList.remove('hidden');
            }

            if (this.expandBtn) {
                this.expandBtn.innerHTML = '<i class="fa fa-compress"></i> Minimize';
                this.expandBtn.setAttribute('title', 'Back to carousel view');
            }
        }

        collapseGrid() {
            if (this.carouselWrapper) {
                this.carouselWrapper.classList.remove('hidden');
            }

            if (this.gridWrapper) {
                this.gridWrapper.classList.add('hidden');
            }

            if (this.expandBtn) {
                this.expandBtn.innerHTML = '<i class="fa fa-th"></i> View All';
                this.expandBtn.setAttribute('title', 'View all items');
            }
        }

        handleResize() {
            let resizeTimer;
            window.addEventListener('resize', () => {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(() => {
                    const updatedItemsPerView = this.getItemsPerView();
                    if (updatedItemsPerView === this.itemsPerView) return;

                    this.itemsPerView = updatedItemsPerView;
                    this.createIndicators();
                    this.updateIndicators();
                }, 200);
            });
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        const sections = document.querySelectorAll('.product-carousel-section');
        sections.forEach((section) => {
            new ProductCarousel(section);
        });
    });
})();

/* ===== END PRODUCT CAROUSEL COMPONENT JAVASCRIPT ===== */
