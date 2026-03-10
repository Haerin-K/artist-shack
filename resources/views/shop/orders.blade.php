@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-4xl font-bold text-gray-800 mb-12">📦 My Orders</h1>

    @if($orders->isEmpty())
        <div class="bg-white rounded-lg shadow-md p-12 text-center">
            <svg class="w-24 h-24 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
            </svg>
            <p class="text-gray-600 text-xl mb-6">No orders yet</p>
            <a href="{{ route('shop.index') }}" class="btn-primary inline-block">
                Start Shopping
            </a>
        </div>
    @else
        <div class="space-y-4">
            @foreach($orders as $order)
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-sm text-gray-600">Order Number</p>
                            <h3 class="text-2xl font-bold text-gray-800">{{ $order->order_number }}</h3>
                        </div>
                        <div class="text-right">
                            <span class="px-4 py-2 rounded-lg font-semibold text-white
                                @if($order->status === 'Completed') bg-green-600
                                @elseif($order->status === 'Shipped') bg-blue-600
                                @elseif($order->status === 'Processing') bg-yellow-600
                                @elseif($order->status === 'Cancelled') bg-red-600
                                @else bg-gray-600 @endif
                            ">
                                {{ $order->status }}
                            </span>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4 py-4 border-y border-gray-200">
                        <div>
                            <p class="text-sm text-gray-600">Order Date</p>
                            <p class="font-semibold text-gray-800">{{ $order->created_at->format('M d, Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Items</p>
                            <p class="font-semibold text-gray-800">{{ $order->items()->count() }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Total Amount</p>
                            <p class="font-semibold text-purple-600 text-lg">${{ number_format($order->total_amount, 2) }}</p>
                        </div>
                        <div class="text-right">
                            <a href="{{ route('order.show', $order->order_number) }}" class="btn-secondary inline-block py-1 text-sm">
                                View Details
                            </a>
                        </div>
                    </div>

                    @if($order->status === 'Shipped' && $order->shipped_at)
                        <p class="text-sm text-blue-600 font-semibold">📦 Shipped on {{ $order->shipped_at->format('M d, Y') }}</p>
                    @elseif($order->status === 'Completed' && $order->completed_at)
                        <p class="text-sm text-green-600 font-semibold">✅ Completed on {{ $order->completed_at->format('M d, Y') }}</p>
                    @endif
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $orders->links() }}
        </div>
    @endif
</div>
@endsection