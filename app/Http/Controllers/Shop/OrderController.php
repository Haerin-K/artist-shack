<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::all();
        $orders = auth()->user()->orders()
            ->with('items')
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('shop.orders', compact('orders', 'categories'));
    }

    public function show($orderNumber)
    {
        $categories = Category::all();
        $order = Order::where('order_number', $orderNumber)
            ->with('items', 'transaction')
            ->firstOrFail();

        $this->authorize('view', $order);

        return view('shop.order-detail', compact('order', 'categories'));
    }
}