<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>The Artist Shack - Handcrafted Merchandise</title>
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-white text-gray-900 flex flex-col min-h-screen">
        <!-- Header -->
        <header class="bg-gradient-to-r from-purple-600 to-pink-600 text-white shadow-lg">
            <nav class="container mx-auto px-4 py-4 flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm0-13c-2.76 0-5 2.24-5 5s2.24 5 5 5 5-2.24 5-5-2.24-5-5-5z"/>
                    </svg>
                    <a href="/" class="text-2xl font-bold">The Artist Shack</a>
                </div>
                
                <div class="flex items-center gap-6">
                    <a href="/" class="hover:text-gray-200 transition">Shop</a>
                    <a href="/admin/products" class="hover:text-gray-200 transition">Admin</a>
                    <div class="relative">
                        <button class="bg-white text-purple-600 px-4 py-2 rounded-full font-semibold hover:bg-gray-100 transition flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            Cart (0)
                        </button>
                    </div>
                </div>
            </nav>
        </header>

        <!-- Main Content -->
        <main class="container mx-auto px-4 py-12 flex-grow">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-gray-900 text-gray-300 mt-20">
            <div class="container mx-auto px-4 py-12">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                    <!-- About -->
                    <div>
                        <h3 class="text-white font-bold text-lg mb-4">The Artist Shack</h3>
                        <p class="text-sm leading-relaxed">
                            Your one-stop shop for handcrafted merchandise, unique collectibles, and artist-designed products.
                        </p>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h4 class="text-white font-bold text-lg mb-4">Quick Links</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="/" class="hover:text-white transition">Home</a></li>
                            <li><a href="#" class="hover:text-white transition">Shop</a></li>
                            <li><a href="#" class="hover:text-white transition">About Us</a></li>
                            <li><a href="#" class="hover:text-white transition">Contact</a></li>
                        </ul>
                    </div>

                    <!-- Categories -->
                    <div>
                        <h4 class="text-white font-bold text-lg mb-4">Categories</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#" class="hover:text-white transition">Plushies</a></li>
                            <li><a href="#" class="hover:text-white transition">Stickers</a></li>
                            <li><a href="#" class="hover:text-white transition">Keychains</a></li>
                        </ul>
                    </div>

                    <!-- Contact -->
                    <div>
                        <h4 class="text-white font-bold text-lg mb-4">Contact Us</h4>
                        <ul class="space-y-2 text-sm">
                            <li>Email: <a href="mailto:info@artistshack.com" class="hover:text-white transition">info@artistshack.com</a></li>
                            <li>Phone: <a href="tel:+1234567890" class="hover:text-white transition">+1 (234) 567-890</a></li>
                            <li class="flex gap-3 mt-4">
                                <a href="#" class="hover:text-white transition">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                </a>
                                <a href="#" class="hover:text-white transition">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2s9 5 20 5a9.5 9.5 0 00-9-5.5c4.75 2.25 7-7 7-7" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Bottom Footer -->
                <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center">
                    <p class="text-sm text-gray-400">
                        &copy; 2026 The Artist Shack. All rights reserved.
                    </p>
                    <div class="flex gap-6 mt-4 md:mt-0 text-sm">
                        <a href="#" class="text-gray-400 hover:text-white transition">Privacy Policy</a>
                        <a href="#" class="text-gray-400 hover:text-white transition">Terms of Service</a>
                        <a href="#" class="text-gray-400 hover:text-white transition">Shipping Info</a>
                    </div>
                </div>
            </div>
        </footer>
        
        <!-- Carousel Script -->
        <script src="{{ asset('js/carousel-standalone.js') }}"></script>
    </body>
</html>