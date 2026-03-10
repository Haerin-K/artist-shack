<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cartItems = auth()->user()->cartItems()->with('product')->get();
        $categories = Category::all();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $total = $cartItems->sum(fn($item) => $item->quantity * $item->price);

        return view('shop.checkout', compact('cartItems', 'total', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'shipping_address' => 'required|string|max:255',
            'shipping_city' => 'required|string|max:100',
            'shipping_state' => 'required|string|max:100',
            'shipping_zip' => 'required|string|max:10',
            'shipping_country' => 'required|string|max:100',
            'customer_phone' => 'nullable|string|max:20',
        ]);

        $cartItems = auth()->user()->cartItems()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $totalAmount = $cartItems->sum(fn($item) => $item->quantity * $item->price);

        // Create Order
        $order = Order::create([
            'user_id' => auth()->id(),
            'order_number' => Order::generateOrderNumber(),
            'status' => 'Pending',
            'total_amount' => $totalAmount,
            'customer_email' => auth()->user()->email,
            ...$validated,
        ]);

        // Create Order Items and reduce stock
        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'unit_price' => $cartItem->price,
                'total_price' => $cartItem->quantity * $cartItem->price,
            ]);

            $cartItem->product->decrement('stock', $cartItem->quantity);
        }

        // Clear cart
        auth()->user()->cartItems()->delete();

        // Create pending transaction
        Transaction::create([
            'order_id' => $order->id,
            'payment_method' => 'pending',
            'status' => 'Pending',
            'amount' => $totalAmount,
        ]);

        return redirect()->route('order.show', $order->order_number)
            ->with('success', 'Order created successfully!');
    }
}