<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class ShopController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::where('is_active', true)
            ->with('category')
            ->paginate(12);

        $groupedProducts = $products->groupBy(function ($product) {
            return $product->category->name;
        });

        return view('shop.index', compact('products', 'categories', 'groupedProducts'));
    }

    public function show($slug)
    {
        $categories = Category::all();
        $product = Product::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('shop.product-detail', compact('product', 'categories'));
    }

    public function addToCart($id)
    {
        Product::findOrFail($id);

        return redirect()->back()->with('success', 'Product added to cart!');
    }
}
