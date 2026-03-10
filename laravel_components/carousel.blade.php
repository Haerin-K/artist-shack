{{-- ===== PRODUCT CAROUSEL COMPONENT ===== --}}
{{-- Laravel Blade Template for Infinite Carousel with Expand Grid View --}}
{{-- Include CSS in your layout: @include('components.carousel-css') --}}
{{-- Include JS in your layout: @include('components.carousel-js') --}}

<section class="product-carousel-section" id="carousel-section-{{ $section_id ?? 'default' }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="carousel-header">
                    <div class="section-title">
                        <h2>{{ $title ?? 'Featured Products' }}</h2>
                        <span>{{ $subtitle ?? 'Explore our amazing collection' }}</span>
                    </div>
                    
                    <!-- EXPAND/COLLAPSE BUTTON -->
                    <div class="carousel-controls">
                        <button class="expand-btn" data-carousel="#carousel-{{ $section_id ?? 'default' }}" title="View all items">
                            <i class="fa fa-th"></i> View All
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== CAROUSEL VIEW (DEFAULT) ===== -->
        <div class="carousel-wrapper expanded-hidden">
            <div class="row">
                <div class="col-lg-12">
                    <div class="carousel-container">
                        <!-- LEFT NAVIGATION BUTTON -->
                        <button class="carousel-nav-btn carousel-prev" data-carousel="#carousel-{{ $section_id ?? 'default' }}">
                            <i class="fa fa-chevron-left"></i>
                        </button>

                        <!-- CAROUSEL TRACK -->
                        <div class="carousel-track-wrapper">
                            <div class="carousel-track" id="carousel-{{ $section_id ?? 'default' }}">
                                @forelse($products as $product)
                                    <div class="carousel-item">
                                        <div class="product-card">
                                            <!-- PRODUCT IMAGE -->
                                            <div class="product-image-wrapper">
                                                <img src="{{ $product->image ?? 'https://via.placeholder.com/300' }}" 
                                                     alt="{{ $product->name ?? 'Product' }}" 
                                                     class="product-image">
                                                
                                                <!-- HOVER ACTIONS -->
                                                <div class="product-hover-overlay">
                                                    <div class="action-buttons">
                                                        <a href="{{ route('product.show', $product->id ?? 1) }}" 
                                                           class="action-btn view-btn" title="View Details">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <button class="action-btn wishlist-btn" title="Add to Wishlist">
                                                            <i class="fa fa-heart-o"></i>
                                                        </button>
                                                        <form action="{{ route('cart.add', $product->id ?? 1) }}" 
                                                              method="POST" class="add-to-cart-form">
                                                            @csrf
                                                            <button type="submit" class="action-btn cart-btn" title="Add to Cart">
                                                                <i class="fa fa-shopping-cart"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- PRODUCT INFO -->
                                            <div class="product-info">
                                                <span class="product-category">{{ $product->category ?? 'Category' }}</span>
                                                <h3 class="product-name">{{ $product->name ?? 'Product Name' }}</h3>
                                                <p class="product-description">{{ Str::limit($product->description ?? '', 50) }}</p>
                                                
                                                <div class="product-footer">
                                                    <span class="product-price">${{ $product->price ?? '0.00' }}</span>
                                                    <div class="product-rating">
                                                        @for($i = 0; $i < 5; $i++)
                                                            <i class="fa fa-star{{ $i < ($product->rating ?? 5) ? '' : '-o' }}"></i>
                                                        @endfor
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="carousel-item">
                                        <div class="empty-state">
                                            <p>No products available</p>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- RIGHT NAVIGATION BUTTON -->
                        <button class="carousel-nav-btn carousel-next" data-carousel="#carousel-{{ $section_id ?? 'default' }}">
                            <i class="fa fa-chevron-right"></i>
                        </button>
                    </div>

                    <!-- CAROUSEL INDICATORS (DOTS) -->
                    <div class="carousel-indicators" id="indicators-{{ $section_id ?? 'default' }}"></div>
                </div>
            </div>
        </div>

        <!-- ===== GRID VIEW (EXPANDED) ===== -->
        <div class="grid-wrapper expanded-hidden hidden">
            <div class="row">
                <div class="col-lg-12">
                    <button class="collapse-btn" data-carousel="#carousel-{{ $section_id ?? 'default' }}">
                        <i class="fa fa-times"></i> Back to Carousel
                    </button>
                </div>
            </div>

            <div class="products-grid">
                @forelse($products as $product)
                    <div class="grid-product-card">
                        <div class="grid-product-image-wrapper">
                            <img src="{{ $product->image ?? 'https://via.placeholder.com/300' }}" 
                                 alt="{{ $product->name ?? 'Product' }}"
                                 class="grid-product-image">
                            
                            <div class="grid-product-overlay">
                                <a href="{{ route('product.show', $product->id ?? 1) }}" class="grid-view-btn">
                                    <i class="fa fa-eye"></i> View
                                </a>
                            </div>
                        </div>

                        <div class="grid-product-info">
                            <span class="grid-product-category">{{ $product->category ?? 'Category' }}</span>
                            <h3 class="grid-product-name">{{ $product->name ?? 'Product Name' }}</h3>
                            <p class="grid-product-description">{{ Str::limit($product->description ?? '', 60) }}</p>

                            <div class="grid-product-footer">
                                <span class="grid-product-price">${{ $product->price ?? '0.00' }}</span>
                                <form action="{{ route('cart.add', $product->id ?? 1) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="grid-add-to-cart-btn">
                                        Add to Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="empty-state">
                            <p>No products available</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>

{{-- ===== END PRODUCT CAROUSEL COMPONENT ===== --}}
