@extends('layouts.app')

@section('title', 'Order ' . $order->order_number)

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex justify-between items-center mb-12">
        <h1 class="text-4xl font-bold text-gray-800">{{ $order->order_number }}</h1>
        <span class="px-6 py-2 rounded-lg font-semibold text-white text-lg
            @if($order->status === 'Completed') bg-green-600
            @elseif($order->status === 'Shipped') bg-blue-600
            @elseif($order->status === 'Processing') bg-yellow-600
            @elseif($order->status === 'Cancelled') bg-red-600
            @else bg-gray-600 @endif
        ">
            {{ $order->status }}
        </span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
        <!-- Order Info -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Order Information</h3>
            <div class="space-y-3 text-gray-700">
                <div>
                    <p class="text-sm text-gray-600">Order Date</p>
                    <p class="font-semibold">{{ $order->created_at->format('F d, Y \a\t g:i A') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Total Amount</p>
                    <p class="font-bold text-purple-600 text-xl">${{ number_format($order->total_amount, 2) }}</p>
                </div>
                @if($order->shipped_at)
                    <div>
                        <p class="text-sm text-gray-600">Shipped On</p>
                        <p class="font-semibold">{{ $order->shipped_at->format('F d, Y') }}</p>
                    </div>
                @endif
                @if($order->completed_at)
                    <div>
                        <p class="text-sm text-gray-600">Completed On</p>
                        <p class="font-semibold">{{ $order->completed_at->format('F d, Y') }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Shipping Address -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">📍 Shipping Address</h3>
            <div class="text-gray-700">
                <p class="font-semibold">{{ auth()->user()->name }}</p>
                <p>{{ $order->shipping_address }}</p>
                <p>{{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_zip }}</p>
                <p>{{ $order->shipping_country }}</p>
            </div>
        </div>

        <!-- Contact Info -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">📧 Contact Information</h3>
            <div class="space-y-3 text-gray-700">
                <div>
                    <p class="text-sm text-gray-600">Email</p>
                    <p class="font-semibold">{{ $order->customer_email }}</p>
                </div>
                @if($order->customer_phone)
                    <div>
                        <p class="text-sm text-gray-600">Phone</p>
                        <p class="font-semibold">{{ $order->customer_phone }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Order Items -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h3 class="text-2xl font-bold text-gray-800 mb-6">Order Items</h3>
        <div class="space-y-4">
            @foreach($order->items as $item)
                <div class="border-b border-gray-200 pb-4 last:border-b-0">
                    <div class="flex justify-between items-start">
                        <div>
                            <h4 class="font-bold text-gray-800">{{ $item->product->name }}</h4>
                            <p class="text-gray-600 text-sm">SKU: {{ $item->product->sku }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-lg font-bold text-purple-600">${{ number_format($item->total_price, 2) }}</p>
                            <p class="text-gray-600 text-sm">Quantity: {{ $item->quantity }}</p>
                            <p class="text-gray-600 text-sm">Unit Price: ${{ number_format($item->unit_price, 2) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Payment Info -->
    @if($order->transaction)
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h3 class="text-lg font-bold text-gray-800 mb-4">💳 Payment Information</h3>
            <div class="grid grid-cols-2 gap-4 text-gray-700">
                <div>
                    <p class="text-sm text-gray-600">Payment Status</p>
                    <p class="font-semibold {{ $order->transaction->status === 'Success' ? 'text-green-600' : 'text-yellow-600' }}">
                        {{ $order->transaction->status }}
                    </p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Amount</p>
                    <p class="font-semibold">${{ number_format($order->transaction->amount, 2) }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="flex gap-4">
        <a href="{{ route('orders.index') }}" class="btn-secondary py-2">
            ← Back to Orders
        </a>
        <a href="{{ route('shop.index') }}" class="btn-primary py-2">
            Continue Shopping
        </a>
    </div>
</div>
@endsection