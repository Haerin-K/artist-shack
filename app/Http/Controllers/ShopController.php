<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    // Display all merchandise
    public function index() {
        $products = Product::all();
        return view('shop.index', compact('products'));
    }

    // Show details for items
    public function show($id) {
        $product = Product::findOrFail($id);
        return view('shop.show', compact('product'));
    }

    //test push :3
}
