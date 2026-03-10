@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mb-16">
        <!-- Product Images -->
        <div>
            <div class="bg-white rounded-lg shadow-md p-4 mb-4">
                @if($product->images && count($product->images) > 0)
                    <img id="mainImage" src="{{ asset('storage/' . $product->images[0]) }}" alt="{{ $product->name }}" class="w-full h-auto rounded-lg">
                @else
                    <div class="w-full aspect-square bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-24 h-24 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                @endif
            </div>

            <!-- Thumbnail Gallery -->
            @if($product->images && count($product->images) > 1)
                <div class="grid grid-cols-4 gap-2">
                    @foreach($product->images as $image)
                        <img src="{{ asset('storage/' . $image) }}" alt="Thumbnail" class="cursor-pointer rounded-lg border-2 border-gray-300 hover:border-purple-600 transition" onclick="changeImage('{{ asset('storage/' . $image) }}')">
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Product Details -->
        <div>
            <div class="mb-4">
                <a href="{{ route('shop.category', $product->category->slug) }}" class="text-purple-600 hover:text-purple-700 font-semibold">
                    {{ $product->category->name }}
                </a>
            </div>

            <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $product->name }}</h1>

            <div class="flex items-center gap-4 mb-6">
                <span class="text-4xl font-bold text-purple-600">${{ number_format($product->price, 2) }}</span>
                <span class="px-4 py-2 {{ $product->stock > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }} rounded-lg font-semibold">
                    {{ $product->stock > 0 ? 'In Stock (' . $product->stock . ')' : 'Out of Stock' }}
                </span>
            </div>

            <div class="bg-purple-50 rounded-lg p-6 mb-6">
                <h3 class="text-lg font-bold text-gray-800 mb-3">About This Product</h3>
                <p class="text-gray-700 leading-relaxed">{{ $product->description }}</p>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">SKU</label>
                    <p class="text-gray-600 font-mono">{{ $product->sku }}</p>
                </div>

                @if($product->stock > 0)
                    @auth
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <div class="mb-6">
                                <label for="quantity" class="block text-gray-700 font-semibold mb-2">Quantity</label>
                                <div class="flex items-center">
                                    <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="input-field w-20">
                                </div>
                            </div>

                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="w-full btn-primary text-lg py-3">
                                Add to Cart 🛒
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="w-full btn-primary text-center block text-lg py-3">
                            Login to Add to Cart
                        </a>
                    @endauth
                @else
                    <div class="bg-red-100 text-red-700 p-4 rounded-lg text-center font-semibold">
                        This product is currently out of stock
                    </div>
                @endif
            </div>

            <div class="bg-purple-100 rounded-lg p-6">
                <h3 class="font-bold text-gray-800 mb-3">✨ Why Shop With Us?</h3>
                <ul class="space-y-2 text-gray-700">
                    <li>✓ High Quality Materials</li>
                    <li>✓ Fast & Free Shipping</li>
                    <li>✓ Easy Returns (30 days)</li>
                    <li>✓ Secure Checkout</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    <div class="mt-16">
        <h2 class="text-3xl font-bold text-gray-800 mb-8">Related Products</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($product->category->products()->where('id', '!=', $product->id)->where('is_active', true)->take(4)->get() as $related)
                <div class="card overflow-hidden">
                    <div class="aspect-square bg-gray-200 overflow-hidden">
                        @if($related->images && count($related->images) > 0)
                            <img src="{{ asset('storage/' . $related->images[0]) }}" alt="{{ $related->name }}" class="w-full h-full object-cover hover:scale-105 transition">
                        @else
                            <div class="w-full h-full bg-purple-100 flex items-center justify-center">
                                <svg class="w-12 h-12 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-gray-800">{{ $related->name }}</h3>
                        <p class="text-purple-600 font-bold mt-2">${{ number_format($related->price, 2) }}</p>
                        <a href="{{ route('product.show', $related->slug) }}" class="btn-secondary text-center block mt-3 text-sm py-2">
                            View Product
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    function changeImage(src) {
        document.getElementById('mainImage').src = src;
    }
</script>
@endsection