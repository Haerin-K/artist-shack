@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-4xl font-bold text-gray-800 mb-12">💳 Checkout</h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Checkout Form -->
        <div class="lg:col-span-2">
            <form action="{{ route('checkout.store') }}" method="POST" class="space-y-8">
                @csrf

                <!-- Shipping Information -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Shipping Address</h2>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Street Address</label>
                            <input type="text" name="shipping_address" value="{{ old('shipping_address') }}" required class="input-field @error('shipping_address') border-red-500 @enderror">
                            @error('shipping_address')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">City</label>
                                <input type="text" name="shipping_city" value="{{ old('shipping_city') }}" required class="input-field @error('shipping_city') border-red-500 @enderror">
                                @error('shipping_city')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">State/Province</label>
                                <input type="text" name="shipping_state" value="{{ old('shipping_state') }}" required class="input-field @error('shipping_state') border-red-500 @enderror">
                                @error('shipping_state')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Zip Code</label>
                                <input type="text" name="shipping_zip" value="{{ old('shipping_zip') }}" required class="input-field @error('shipping_zip') border-red-500 @enderror">
                                @error('shipping_zip')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Country</label>
                                <input type="text" name="shipping_country" value="{{ old('shipping_country') }}" required class="input-field @error('shipping_country') border-red-500 @enderror">
                                @error('shipping_country')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Phone Number (Optional)</label>
                            <input type="tel" name="customer_phone" value="{{ old('customer_phone') }}" class="input-field">
                        </div>
                    </div>
                </div>

                <!-- Order Items Preview -->
                <div class="bg-purple-50 rounded-lg p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Order Summary</h3>
                    <div class="space-y-3">
                        @foreach($cartItems as $item)
                            <div class="flex justify-between items-center">
                                <span class="text-gray-700">{{ $item->product->name }} x {{ $item->quantity }}</span>
                                <span class="font-semibold text-gray-800">${{ number_format($item->quantity * $item->price, 2) }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <button type="submit" class="w-full btn-primary text-lg py-3">
                    Complete Order 🎉
                </button>
            </form>
        </div>

        <!-- Order Summary Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-6 sticky top-24">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Total</h2>

                <div class="space-y-3 mb-6 border-b border-gray-200 pb-6">
                    @foreach($cartItems as $item)
                        <div class="text-sm text-gray-700">
                            <span>{{ $item->product->name }}</span>
                            <span class="float-right font-semibold">${{ number_format($item->quantity * $item->price, 2) }}</span>
                        </div>
                    @endforeach
                </div>

                <div class="space-y-2 mb-6 border-b border-gray-200 pb-6">
                    <div class="flex justify-between text-gray-700">
                        <span>Subtotal</span>
                        <span>${{ number_format($total, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-gray-700">
                        <span>Tax (8%)</span>
                        <span>${{ number_format($total * 0.08, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-gray-700">
                        <span>Shipping</span>
                        <span class="text-green-600 font-semibold">Free</span>
                    </div>
                </div>

                <div class="flex justify-between text-2xl font-bold text-purple-600">
                    <span>Total</span>
                    <span>${{ number_format($total * 1.08, 2) }}</span>
                </div>

                <p class="text-xs text-gray-500 mt-4 text-center">Payment will be completed on the next page</p>
            </div>
        </div>
    </div>
</div>
@endsection