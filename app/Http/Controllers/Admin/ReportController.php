<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function sales()
    {
        $categories = Category::all();
        $salesData = Order::selectRaw('DATE(created_at) as date, COUNT(*) as orders, SUM(total_amount) as revenue')
            ->where('status', 'Completed')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->limit(30)
            ->get();

        return view('admin.reports.sales', compact('salesData', 'categories'));
    }

    public function inventory()
    {
        $categories = Category::all();
        $products = Product::with('category')
            ->orderBy('stock')
            ->get();

        return view('admin.reports.inventory', compact('products', 'categories'));
    }
}