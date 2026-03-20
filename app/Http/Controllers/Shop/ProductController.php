<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
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

    public function filterByCategory($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $categories = Category::all();
        $products = $category->products()
            ->where('is_active', true)
            ->paginate(12);

        $groupedProducts = $products->groupBy(function ($product) {
            return $product->category->name;
        });

        return view('shop.index', compact('products', 'categories', 'category', 'groupedProducts'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
        $categories = Category::all();

        return view('shop.product-detail', compact('product', 'categories'));
    }
}