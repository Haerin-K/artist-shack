{{-- ===== FOOTER COMPONENT ===== --}}
{{-- Laravel Blade Template for Footer --}}
{{-- Include CSS in your layout: @include('components.footer-css') --}}
{{-- Include JS in your layout: @include('components.footer-js') --}}

<footer class="footer-area" id="footer-section">
    <div class="container">
        <div class="row">
            
            <!-- FOOTER COLUMN 1: COMPANY INFO -->
            <div class="col-lg-3 col-md-6 footer-column">
                <div class="footer-item company-info">
                    <div class="logo">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="Fumo Store">
                    </div>
                    <ul class="company-details">
                        <li><i class="fa fa-map-marker"></i> <a href="#">123 Sample St, City, Country</a></li>
                        <li><i class="fa fa-envelope"></i> <a href="mailto:info@fumostore.com">info@fumostore.com</a></li>
                        <li><i class="fa fa-phone"></i> <a href="tel:+1234567890">+1 (123) 456-7890</a></li>
                    </ul>
                </div>
            </div>

            <!-- FOOTER COLUMN 2: SHOPPING & CATEGORIES -->
            <div class="col-lg-3 col-md-6 footer-column">
                <div class="footer-item">
                    <h4>Shopping &amp; Categories</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('products', ['category' => 'plushies']) }}">Plushies</a></li>
                        <li><a href="{{ route('products', ['category' => 'costumes']) }}">Costumes</a></li>
                        <li><a href="{{ route('products', ['category' => 'collectibles']) }}">Collectibles</a></li>
                        <li><a href="{{ route('products', ['category' => 'accessories']) }}">Accessories</a></li>
                    </ul>
                </div>
            </div>

            <!-- FOOTER COLUMN 3: USEFUL LINKS -->
            <div class="col-lg-3 col-md-6 footer-column">
                <div class="footer-item">
                    <h4>Useful Links</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}">Homepage</a></li>
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li><a href="{{ route('contact') }}">Contact Us</a></li>
                        <li><a href="{{ route('products') }}">All Products</a></li>
                    </ul>
                </div>
            </div>

            <!-- FOOTER COLUMN 4: HELP & INFORMATION -->
            <div class="col-lg-3 col-md-6 footer-column">
                <div class="footer-item">
                    <h4>Help &amp; Information</h4>
                    <ul class="footer-links">
                        <li><a href="#">FAQ's</a></li>
                        <li><a href="#">Shipping Info</a></li>
                        <li><a href="#">Returns &amp; Exchanges</a></li>
                        <li><a href="#">Track Order</a></li>
                    </ul>
                </div>
            </div>

            <!-- FOOTER BOTTOM: COPYRIGHT & SOCIAL -->
            <div class="col-lg-12">
                <div class="footer-bottom">
                    <div class="copyright-section">
                        <p>&copy; {{ now()->year }} Fumo Store Co., Ltd. All Rights Reserved.</p>
                    </div>
                    <div class="social-section">
                        <h5>Follow Us</h5>
                        <ul class="social-links">
                            <li><a href="#" target="_blank" class="social-icon facebook"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#" target="_blank" class="social-icon twitter"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#" target="_blank" class="social-icon instagram"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="#" target="_blank" class="social-icon youtube"><i class="fa fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</footer>
{{-- ===== END FOOTER COMPONENT ===== --}}
