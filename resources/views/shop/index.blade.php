@extends('layouts.app')

@section('title', 'Shop - All Products')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-purple-600 to-purple-800 rounded-lg text-white p-12 mb-12">
        <h1 class="text-5xl font-bold mb-4">Welcome to The Artist Shack</h1>
        <p class="text-xl text-purple-100">Discover amazing merchandise, collectibles, and art</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Filters Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-6 sticky top-24">
                <h3 class="text-lg font-bold text-purple-700 mb-4">Categories</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('shop.index') }}" class="text-gray-700 hover:text-purple-600 transition block py-2 {{ !isset($category) ? 'font-bold text-purple-600' : '' }}">
                            All Products
                        </a>
                    </li>
                    @foreach($categories as $cat)
                        <li>
                            <a href="{{ route('shop.category', $cat->slug) }}" class="text-gray-700 hover:text-purple-600 transition block py-2 {{ isset($category) && $category->id === $cat->id ? 'font-bold text-purple-600' : '' }}">
                                {{ $cat->name }}
                                <span class="text-gray-500 text-sm">({{ $cat->products()->count() }})</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="lg:col-span-3">
            <div class="mb-6">
                <h2 class="text-3xl font-bold text-gray-800">
                    {{ isset($category) ? $category->name : 'All Products' }}
                </h2>
                <p class="text-gray-600">{{ $products->total() }} products available</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($products as $product)
                    <div class="card overflow-hidden">
                        <!-- Product Image -->
                        <div class="aspect-square bg-gray-200 overflow-hidden">
                            @if($product->images && count($product->images) > 0)
                                <img src="{{ asset('storage/' . $product->images[0]) }}" alt="{{ $product->name }}" class="w-full h-full object-cover hover:scale-105 transition duration-300">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-purple-100">
                                    <svg class="w-16 h-16 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- Product Info -->
                        <div class="p-4">
                            <a href="{{ route('product.show', $product->slug) }}" class="text-lg font-bold text-gray-800 hover:text-purple-600 transition">
                                {{ $product->name }}
                            </a>
                            <p class="text-sm text-gray-600 mt-1">{{ $product->category->name }}</p>
                            <p class="text-gray-700 text-sm mt-2 line-clamp-2">{{ $product->description }}</p>

                            <div class="flex items-center justify-between mt-4">
                                <span class="text-2xl font-bold text-purple-600">${{ number_format($product->price, 2) }}</span>
                                @if($product->stock > 0)
                                    <span class="text-xs text-green-600 font-semibold bg-green-100 px-2 py-1 rounded">In Stock</span>
                                @else
                                    <span class="text-xs text-red-600 font-semibold bg-red-100 px-2 py-1 rounded">Out of Stock</span>
                                @endif
                            </div>

                            <div class="mt-4 grid grid-cols-2 gap-2">
                                <a href="{{ route('product.show', $product->slug) }}" class="btn-secondary text-center text-sm py-2">
                                    View
                                </a>
                                @if($product->stock > 0)
                                    @auth
                                        <form action="{{ route('cart.add') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="w-full btn-primary text-sm py-2">
                                                Add to Cart
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('login') }}" class="btn-primary text-center text-sm py-2">
                                            Add to Cart
                                        </a>
                                    @endauth
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12">
                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                        <p class="text-gray-600 text-lg">No products found</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection