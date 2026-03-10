<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Shop\ProductController;
use App\Http\Controllers\Shop\CartController;
use App\Http\Controllers\Shop\CheckoutController;
use App\Http\Controllers\Shop\OrderController as ShopOrderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ReportController;

// Home
Route::get('/', [ProductController::class, 'index'])->name('home');

// Shop Routes
Route::prefix('shop')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('shop.index');
    Route::get('/category/{slug}', [ProductController::class, 'filterByCategory'])->name('shop.category');
    Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
});

// Cart Routes (requires authentication)
Route::prefix('cart')->middleware('auth')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add', [CartController::class, 'add'])->name('cart.add');
    Route::put('/update/{cartItem}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/remove/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');
});

// Checkout Routes (requires authentication)
Route::prefix('checkout')->middleware('auth')->group(function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/', [CheckoutController::class, 'store'])->name('checkout.store');
});

// Customer Orders (requires authentication)
Route::prefix('orders')->middleware('auth')->group(function () {
    Route::get('/', [ShopOrderController::class, 'index'])->name('orders.index');
    Route::get('/{orderNumber}', [ShopOrderController::class, 'show'])->name('order.show');
});

// Admin Routes (requires authentication and admin role)
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Products
    Route::resource('products', AdminProductController::class)->names('admin.products');
    Route::post('/products/{product}/restore', [AdminProductController::class, 'restore'])->name('admin.products.restore');

    // Categories
    Route::resource('categories', CategoryController::class)->names('admin.categories');

    // Orders
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
    Route::put('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.update-status');

    // Reports
    Route::get('/reports/sales', [ReportController::class, 'sales'])->name('admin.reports.sales');
    Route::get('/reports/inventory', [ReportController::class, 'inventory'])->name('admin.reports.inventory');
});

require __DIR__.'/auth.php';