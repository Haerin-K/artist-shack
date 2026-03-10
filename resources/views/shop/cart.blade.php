@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-4xl font-bold text-gray-800 mb-12">🛒 Shopping Cart</h1>

    @if($cartItems->isEmpty())
        <div class="bg-white rounded-lg shadow-md p-12 text-center">
            <svg class="w-24 h-24 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <p class="text-gray-600 text-xl mb-6">Your cart is empty</p>
            <a href="{{ route('shop.index') }}" class="btn-primary inline-block">
                Continue Shopping
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Cart Items -->
            <div class="lg:col-span-2">
                <div class="space-y-4">
                    @foreach($cartItems as $item)
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <div class="flex gap-6">
                                <!-- Product Image -->
                                <div class="w-24 h-24 bg-gray-200 rounded-lg overflow-hidden flex-shrink-0">
                                    @if($item->product->images && count($item->product->images) > 0)
                                        <img src="{{ asset('storage/' . $item->product->images[0]) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-purple-100 flex items-center justify-center">
                                            <svg class="w-8 h-8 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>

                                <!-- Item Details -->
                                <div class="flex-1">
                                    <a href="{{ route('product.show', $item->product->slug) }}" class="text-lg font-bold text-gray-800 hover:text-purple-600">
                                        {{ $item->product->name }}
                                    </a>
                                    <p class="text-gray-600 text-sm mt-1">{{ $item->product->category->name }}</p>
                                    <p class="text-purple-600 font-bold text-lg mt-2">${{ number_format($item->price, 2) }}</p>
                                </div>

                                <!-- Quantity & Actions -->
                                <div class="flex flex-col items-end gap-4">
                                    <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center gap-2">
                                        @csrf
                                        @method('PUT')
                                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}" class="input-field w-16">
                                        <button type="submit" class="text-xs btn-secondary py-1">Update</button>
                                    </form>

                                    <div>
                                        <p class="text-gray-700 font-bold">Subtotal: <span class="text-purple-600">${{ number_format($item->subtotal, 2) }}</span></p>
                                    </div>

                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-700 font-semibold text-sm">Remove</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-24">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Order Summary</h2>

                    <div class="space-y-4 mb-6 border-b border-gray-200 pb-6">
                        <div class="flex justify-between text-gray-700">
                            <span>Subtotal</span>
                            <span>${{ number_format($total, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-700">
                            <span>Shipping</span>
                            <span class="text-green-600 font-semibold">Free</span>
                        </div>
                        <div class="flex justify-between text-gray-700">
                            <span>Tax (8%)</span>
                            <span>${{ number_format($total * 0.08, 2) }}</span>
                        </div>
                    </div>

                    <div class="flex justify-between text-2xl font-bold text-purple-600 mb-6">
                        <span>Total</span>
                        <span>${{ number_format($total * 1.08, 2) }}</span>
                    </div>

                    <a href="{{ route('checkout.index') }}" class="w-full btn-primary block text-center py-3 text-lg">
                        Proceed to Checkout
                    </a>

                    <a href="{{ route('shop.index') }}" class="w-full btn-secondary block text-center py-3 text-lg mt-4">
                        Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection