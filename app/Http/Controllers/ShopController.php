<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    // Display all merchandise grouped by category
    public function index() {
        $products = Product::all();
        $groupedProducts = $products->groupBy('category');
        return view('shop.index', compact('groupedProducts'));
    }

    // Show details for items
    public function show($id) {
        $product = Product::findOrFail($id);
        return view('shop.show', compact('product'));
    }

    // Add product to cart
    public function addToCart($id) {
        $product = Product::findOrFail($id);
        // Cart logic will be implemented here
        return redirect()->back()->with('success', 'Product added to cart!');
    }
}
