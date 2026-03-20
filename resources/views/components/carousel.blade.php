{{-- ===== PRODUCT CAROUSEL COMPONENT ===== --}}
{{-- Laravel Blade Template for Infinite Carousel with Expand Grid View --}}

@props(['products' => [], 'category' => 'Products', 'section_id' => 'default', 'title' => null, 'subtitle' => null])

<section class="product-carousel-section" id="carousel-section-{{ $section_id }}">
    <div class="carousel-content-wrapper">
        <div class="carousel-header">
            <div class="section-title">
                <h2>{{ $title ?? $category ?? 'Featured Products' }}</h2>
                <span>{{ $subtitle ?? 'Explore our amazing collection' }}</span>
            </div>
            
            <!-- EXPAND/COLLAPSE BUTTONS -->
            <div class="carousel-controls">
                <button type="button" class="expand-btn" data-carousel="#carousel-{{ $section_id }}" title="View all items">
                    <i class="fa fa-th"></i> View All
                </button>
            </div>
        </div>

        <!-- ===== CAROUSEL VIEW (DEFAULT) ===== -->
        <div class="carousel-wrapper">
            <div class="carousel-container">
                <!-- LEFT NAVIGATION BUTTON -->
                <button type="button" class="carousel-nav-btn carousel-prev" data-carousel="#carousel-{{ $section_id }}">
                    <i class="fa fa-chevron-left"></i>
                </button>

                <!-- CAROUSEL TRACK -->
                <div class="carousel-track-wrapper">
                    <div class="carousel-track" id="carousel-{{ $section_id }}">
                                @forelse($products as $product)
                                    <div class="product-carousel-item">
                                        <div class="product-card">
                                            <!-- PRODUCT IMAGE -->
                                            <div class="product-image-wrapper">
                                                @php
                                                    $displayImage = $product->display_image ?? null;
                                                    $productImages = is_array($product->images) ? $product->images : (array) $product->images;
                                                    $firstImage = collect($productImages)->filter()->first();
                                                    $imagePath = $displayImage ?: $firstImage;
                                                    $imageSrc = $imagePath
                                                        ? asset('storage/' . ltrim($imagePath, '/'))
                                                        : 'https://via.placeholder.com/600x600?text=No+Image';
                                                @endphp
                                                <img src="{{ $imageSrc }}" 
                                                     alt="{{ $product->name ?? 'Product' }}" 
                                                     class="product-image"
                                                     loading="lazy"
                                                     onerror="this.onerror=null;this.src='https://via.placeholder.com/600x600?text=No+Image';">
                                                
                                                <!-- HOVER ACTIONS -->
                                                <div class="product-hover-overlay">
                                                    <div class="action-buttons">
                                                        <a href="{{ route('product.show', $product->slug ?? '#') }}" 
                                                           class="action-btn view-btn" title="View Details">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <button class="action-btn wishlist-btn" title="Add to Wishlist">
                                                            <i class="fa fa-heart-o"></i>
                                                        </button>
                                                        <form action="{{ route('cart.add') }}" 
                                                              method="POST" class="add-to-cart-form">
                                                            @csrf
                                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                            <input type="hidden" name="quantity" value="1">
                                                            <button type="submit" class="action-btn cart-btn" title="Add to Cart">
                                                                <i class="fa fa-shopping-cart"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- PRODUCT INFO -->
                                            <div class="product-info">
                                                <h3 class="product-name">{{ $product->name ?? 'Product Name' }}</h3>
                                                <span class="product-category">{{ $product->category->name ?? 'Uncategorized' }}</span>
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
                                    <div class="product-carousel-item">
                                        <div class="empty-state">
                                            <p>No products available</p>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- RIGHT NAVIGATION BUTTON -->
                        <button type="button" class="carousel-nav-btn carousel-next" data-carousel="#carousel-{{ $section_id }}">
                            <i class="fa fa-chevron-right"></i>
                        </button>
                    </div>

                    <!-- CAROUSEL INDICATORS (DOTS) -->
                    <div class="product-carousel-indicators" id="indicators-{{ $section_id }}"></div>
                </div>
            </div>
        </div>

        <!-- ===== GRID VIEW (EXPANDED) ===== -->
        <div class="grid-wrapper hidden">
            <div class="grid-header">
                <h3 style="flex: 1;">All Products</h3>
            </div>

            <div class="products-grid">
                @forelse($products as $product)
                    <div class="grid-product-card">
                        <div class="grid-product-image-wrapper">
                            @php
                                $gridDisplayImage = $product->display_image ?? null;
                                $gridProductImages = is_array($product->images) ? $product->images : (array) $product->images;
                                $gridFirstImage = collect($gridProductImages)->filter()->first();
                                $gridImagePath = $gridDisplayImage ?: $gridFirstImage;
                                $gridImageSrc = $gridImagePath
                                    ? asset('storage/' . ltrim($gridImagePath, '/'))
                                    : 'https://via.placeholder.com/600x600?text=No+Image';
                            @endphp
                            <img src="{{ $gridImageSrc }}" 
                                 alt="{{ $product->name ?? 'Product' }}"
                                 class="grid-product-image"
                                 loading="lazy"
                                 onerror="this.onerror=null;this.src='https://via.placeholder.com/600x600?text=No+Image';">
                            
                            <div class="grid-product-overlay">
                                <a href="{{ route('product.show', $product->slug ?? '#') }}" class="grid-view-btn">
                                    <i class="fa fa-eye"></i> View
                                </a>
                            </div>
                        </div>

                        <div class="grid-product-info">
                            <h3 class="grid-product-name">{{ $product->name ?? 'Product Name' }}</h3>
                            <span class="grid-product-category">{{ $product->category->name ?? 'Uncategorized' }}</span>
                            <p class="grid-product-description">{{ Str::limit($product->description ?? '', 60) }}</p>

                            <div class="grid-product-footer">
                                <span class="grid-product-price">${{ $product->price ?? '0.00' }}</span>
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="grid-add-to-cart-btn">
                                        Add to Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <p>No products available</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>

{{-- ===== END PRODUCT CAROUSEL COMPONENT ===== --}}
