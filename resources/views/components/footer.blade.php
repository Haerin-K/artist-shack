<footer>
    <div class="footer-container">
        <div class="footer-grid">
            <div class="footer-section">
                <h4>🎁 ArtistShack</h4>
                <p>Your one-stop shop for collectibles, plushies, art, and more!</p>
            </div>

            <div class="footer-section">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="{{ route('shop.index') }}">Shop</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h4>Categories</h4>
                <ul>
                    @foreach($categories ?? [] as $category)
                        <li><a href="{{ route('shop.category', $category->slug) }}">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="footer-section">
                <h4>Contact</h4>
                <ul>
                    <li>📧 info@artistshack.com</li>
                    <li>📞 1-800-ARTIST-SHACH</li>
                </ul>
            </div>
        </div>

        <div class="footer-divider">
            <p>&copy; 2026 MerchHub. All rights reserved.</p>
        </div>
    </div>
</footer>