@extends('layouts.app')

@section('title', 'Orders Management')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-4xl font-bold text-gray-800 mb-12">📦 Orders Management</h1>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-purple-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Order Number</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Customer</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Items</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Amount</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Date</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr class="border-b hover:bg-purple-50">
                            <td class="px-6 py-3 font-semibold text-gray-800">{{ $order->order_number }}</td>
                            <td class="px-6 py-3 text-gray-700">{{ $order->user->name }}</td>
                            <td class="px-6 py-3 text-gray-700">{{ $order->items()->count() }}</td>
                            <td class="px-6 py-3 font-bold text-purple-600">${{ number_format($order->total_amount, 2) }}</td>
                            <td class="px-6 py-3">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold text-white
                                    @if($order->status === 'Completed') bg-green-600
                                    @elseif($order->status === 'Shipped') bg-blue-600
                                    @elseif($order->status === 'Processing') bg-yellow-600
                                    @elseif($order->status === 'Cancelled') bg-red-600
                                    @else bg-gray-600 @endif
                                ">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="px-6 py-3 text-gray-700">{{ $order->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-3">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="text-purple-600 hover:text-purple-700 font-semibold">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-8">
        {{ $orders->links() }}
    </div>
</div>
@endsection