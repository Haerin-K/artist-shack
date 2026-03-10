{{-- ===== HEADER COMPONENT ===== --}}
{{-- Laravel Blade Template for Header Navigation --}}
{{-- Include CSS in your layout: @include('components.header-css') --}}
{{-- Include JS in your layout: @include('components.header-js') --}}

<header class="header-area header-sticky" id="main-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ===== LOGO SECTION ===== -->
                    <a href="{{ route('home') }}" class="logo">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="Logo">
                    </a>
                    
                    <!-- ===== NAVIGATION MENU ===== -->
                    <ul class="nav">
                        <li class="scroll-to-section">
                            <a href="#top" class="active">Home</a>
                        </li>
                        <li class="scroll-to-section">
                            <a href="#men">Men's</a>
                        </li>
                        <li class="scroll-to-section">
                            <a href="#women">Women's</a>
                        </li>
                        <li class="scroll-to-section">
                            <a href="#kids">Kid's</a>
                        </li>
                        <li class="scroll-to-section">
                            <a href="#best-sellers">Best Sellers</a>
                        </li>
                        
                        <!-- PAGES DROPDOWN -->
                        <li class="submenu">
                            <a href="javascript:;">Pages</a>
                            <ul>
                                <li><a href="{{ route('about') }}">About Us</a></li>
                                <li><a href="{{ route('products') }}">Products</a></li>
                                <li><a href="{{ route('product.show', ['id' => 1]) }}">Single Product</a></li>
                                <li><a href="{{ route('contact') }}">Contact Us</a></li>
                            </ul>
                        </li>
                        
                        <!-- USER SECTION (Search, Login, Cart) -->
                        <li class="user-section">
                            <div class="search-area">
                                <input type="text" id="search-input" placeholder="Search...">
                                <button id="search-btn"><i class="fa fa-search"></i></button>
                            </div>
                            <a href="{{ route('login') }}" class="login-link" id="login-link">
                                <i class="fa fa-user"></i>
                            </a>
                            <span class="username-area" id="username-display"></span>
                            <a href="{{ route('cart.index') }}" class="cart-icon" id="cart-link">
                                <i class="fa fa-shopping-cart"></i> 
                                <span class="cart-count" id="cart-count">0</span>
                            </a>
                        </li>
                    </ul>        
                    
                    <!-- MOBILE MENU TRIGGER -->
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                </nav>
            </div>
        </div>
    </div>
</header>
{{-- ===== END HEADER COMPONENT ===== --}}
