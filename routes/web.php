<?php

use App\Http\Controllers\ShopController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

// Buyer/Customer Routes
Route::get('/', [ShopController::class, 'index'])->name('shop.index');
Route::get('/product/{id}', [ShopController::class, 'show'])->name('shop.show');
Route::post('/cart/add/{id}', [ShopController::class, 'addToCart'])->name('cart.add');

// Admin routes (Protected)
Route::prefix('admin')->group(function () {
    Route::resource('products', ProductController::class);
    Route::get('/orders', [ProductController::class, 'orders'])->name('admin.orders');
});