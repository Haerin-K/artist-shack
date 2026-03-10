<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $categories = Category::all();
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::where('status', 'Completed')->sum('total_amount');
        $totalCustomers = User::where('role', 'customer')->count();
        $lowStockProducts = Product::where('stock', '<', 10)->count();

        $recentOrders = Order::with('user')
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        $salesData = Order::selectRaw('DATE(created_at) as date, SUM(total_amount) as total')
            ->where('status', 'Completed')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->limit(30)
            ->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalOrders',
            'totalRevenue',
            'totalCustomers',
            'lowStockProducts',
            'recentOrders',
            'salesData',
            'categories'
        ));
    }
}