@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-4xl font-bold text-gray-800 mb-12">📊 Admin Dashboard</h1>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-12">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="text-gray-600 text-sm font-semibold mb-2">Total Products</div>
            <div class="text-4xl font-bold text-purple-600">{{ $totalProducts }}</div>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="text-gray-600 text-sm font-semibold mb-2">Total Orders</div>
            <div class="text-4xl font-bold text-blue-600">{{ $totalOrders }}</div>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="text-gray-600 text-sm font-semibold mb-2">Total Revenue</div>
            <div class="text-4xl font-bold text-green-600">${{ number_format($totalRevenue, 2) }}</div>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="text-gray-600 text-sm font-semibold mb-2">Total Customers</div>
            <div class="text-4xl font-bold text-pink-600">{{ $totalCustomers }}</div>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="text-gray-600 text-sm font-semibold mb-2">Low Stock Items</div>
            <div class="text-4xl font-bold text-red-600">{{ $lowStockProducts }}</div>
        </div>
    </div>

    <!-- Actions -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-12">
        <a href="{{ route('admin.products.create') }}" class="btn-primary text-center block py-3">
            ➕ Add Product
        </a>
        <a href="{{ route('admin.categories.create') }}" class="btn-secondary text-center block py-3">
            📂 Add Category
        </a>
        <a href="{{ route('admin.reports.sales') }}" class="btn-primary text-center block py-3">
            📊 Sales Report
        </a>
        <a href="{{ route('admin.reports.inventory') }}" class="btn-secondary text-center block py-3">
            📦 Inventory Report
        </a>
    </div>

    <!-- Recent Orders -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Recent Orders</h2>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-purple-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Order Number</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Customer</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Amount</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Date</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentOrders as $order)
                        <tr class="border-b hover:bg-purple-50">
                            <td class="px-4 py-3 font-semibold text-gray-800">{{ $order->order_number }}</td>
                            <td class="px-4 py-3 text-gray-700">{{ $order->user->name }}</td>
                            <td class="px-4 py-3 font-bold text-purple-600">${{ number_format($order->total_amount, 2) }}</td>
                            <td class="px-4 py-3">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold text-white
                                    @if($order->status === 'Completed') bg-green-600
                                    @elseif($order->status === 'Shipped') bg-blue-600
                                    @elseif($order->status === 'Processing') bg-yellow-600
                                    @else bg-gray-600 @endif
                                ">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-gray-700">{{ $order->created_at->format('M d, Y') }}</td>
                            <td class="px-4 py-3">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="text-purple-600 hover:text-purple-700 font-semibold">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection