@extends('layouts.app')

@section('title', 'Order ' . $order->order_number)

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-4xl font-bold text-gray-800">{{ $order->order_number }}</h1>
        <a href="{{ route('admin.orders.index') }}" class="btn-secondary">
            ← Back to Orders
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Order Status -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Order Status</h3>
            <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <select name="status" class="input-field">
                    <option value="Pending" {{ $order->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Processing" {{ $order->status === 'Processing' ? 'selected' : '' }}>Processing</option>
                    <option value="Shipped" {{ $order->status === 'Shipped' ? 'selected' : '' }}>Shipped</option>
                    <option value="Completed" {{ $order->status === 'Completed' ? 'selected' : '' }}>Completed</option>
                    <option value="Cancelled" {{ $order->status === 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                <button type="submit" class="w-full btn-primary">Update Status</button>
            </form>
        </div>

        <!-- Customer Info -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">👤 Customer</h3>
            <p class="text-gray-700 font-semibold">{{ $order->user->name }}</p>
            <p class="text-gray-600">{{ $order->customer_email }}</p>
            @if($order->customer_phone)
                <p class="text-gray-600">{{ $order->customer_phone }}</p>
            @endif
        </div>

        <!-- Order Info -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">📋 Order Info</h3>
            <p class="text-gray-700"><span class="font-semibold">Total:</span> ${{ number_format($order->total_amount, 2) }}</p>
            <p class="text-gray-700"><span class="font-semibold">Date:</span> {{ $order->created_at->format('F d, Y') }}</p>
            <p class="text-gray-700"><span class="font-semibold">Items:</span> {{ $order->items()->count() }}</p>
        </div>
    </div>

    <!-- Shipping Address -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h3 class="text-lg font-bold text-gray-800 mb-4">📍 Shipping Address</h3>
        <p class="text-gray-700">{{ $order->shipping_address }}</p>
        <p class="text-gray-700">{{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_zip }}</p>
        <p class="text-gray-700">{{ $order->shipping_country }}</p>
    </div>

    <!-- Order Items -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h3 class="text-lg font-bold text-gray-800 mb-6">Items</h3>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-purple-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Product</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">SKU</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Quantity</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Unit Price</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                        <tr class="border-b">
                            <td class="px-4 py-3 text-gray-800 font-semibold">{{ $item->product->name }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $item->product->sku }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $item->quantity }}</td>
                            <td class="px-4 py-3 text-gray-600">${{ number_format($item->unit_price, 2) }}</td>
                            <td class="px-4 py-3 text-purple-600 font-bold">${{ number_format($item->total_price, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Payment Info -->
    @if($order->transaction)
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">💳 Payment</h3>
            <p class="text-gray-700"><span class="font-semibold">Status:</span> {{ $order->transaction->status }}</p>
            <p class="text-gray-700"><span class="font-semibold">Amount:</span> ${{ number_format($order->transaction->amount, 2) }}</p>
        </div>
    @endif
</div>
@endsection