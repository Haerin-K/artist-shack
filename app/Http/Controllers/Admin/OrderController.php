<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $categories = Category::all();
        $orders = Order::with('user', 'items')
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('admin.orders.index', compact('orders', 'categories'));
    }

    public function show(Order $order)
    {
        $categories = Category::all();
        $order->load('items', 'user', 'transaction');

        return view('admin.orders.show', compact('order', 'categories'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:Processing,Shipped,Completed,Cancelled',
        ]);

        $order->update($validated);

        if ($validated['status'] === 'Shipped') {
            $order->update(['shipped_at' => now()]);
        } elseif ($validated['status'] === 'Completed') {
            $order->update(['completed_at' => now()]);
        }

        return redirect()->back()->with('success', 'Order status updated!');
    }
}