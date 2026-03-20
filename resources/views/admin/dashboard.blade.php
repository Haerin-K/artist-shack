@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid my-5">
    <h1 class="h2 mb-4">📊 Admin Dashboard</h1>

    <!-- Stats Grid -->
    <div class="row mb-4">
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <p class="card-text text-muted small mb-2">Total Products</p>
                    <h3 class="card-title text-primary">{{ $totalProducts }}</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <p class="card-text text-muted small mb-2">Total Orders</p>
                    <h3 class="card-title text-info">{{ $totalOrders }}</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <p class="card-text text-muted small mb-2">Total Revenue</p>
                    <h3 class="card-title text-success">${{ number_format($totalRevenue, 2) }}</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <p class="card-text text-muted small mb-2">Total Customers</p>
                    <h3 class="card-title text-danger">{{ $totalCustomers }}</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <p class="card-text text-muted small mb-2">Low Stock Items</p>
                    <h3 class="card-title text-warning">{{ $lowStockProducts }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-3">
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-block btn-lg">
                <i class="fa fa-plus"></i> Add Product
            </a>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <a href="{{ route('admin.categories.create') }}" class="btn btn-secondary btn-block btn-lg">
                <i class="fa fa-folder"></i> Add Category
            </a>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <a href="{{ route('admin.products.index') }}" class="btn btn-info btn-block btn-lg">
                <i class="fa fa-list"></i> View Products
            </a>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <a href="{{ route('admin.orders.index') }}" class="btn btn-warning btn-block btn-lg">
                <i class="fa fa-shopping-cart"></i> View Orders
            </a>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fa fa-history"></i> Recent Orders</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Order Number</th>
                            <th>Customer</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentOrders as $order)
                            <tr>
                                <td><strong>{{ $order->order_number }}</strong></td>
                                <td>{{ $order->user->name }}</td>
                                <td><strong class="text-primary">${{ number_format($order->total_amount, 2) }}</strong></td>
                                <td>
                                    <span class="badge
                                        @if($order->status === 'Completed') badge-success
                                        @elseif($order->status === 'Shipped') badge-info
                                        @elseif($order->status === 'Processing') badge-warning text-dark
                                        @else badge-secondary @endif
                                    ">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-primary">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection