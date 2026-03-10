# 🚀 Integration Quick Guide

## Step 1: Folder Setup
```
your-laravel-project/
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php          (Use: app.blade.php template)
│       ├── pages/
│       │   └── home.blade.php         (Use: home.blade.php template)
│       └── components/
│           ├── header.blade.php       (Copy here)
│           ├── footer.blade.php       (Copy here)
│           └── carousel.blade.php     (Copy here)
├── public/
│   └── css/
│       └── components/
│           ├── header.css             (Copy here)
│           ├── footer.css             (Copy here)
│           ├── carousel.css           (Copy here)
│           └── scroll-to-top.css      (Copy here)
└── js/
    └── components/
        ├── header.js                  (Copy here)
        ├── footer.js                  (Copy here)
        └── carousel.js                (Copy here)
```

## Step 2: Terminal Commands
```bash
# Navigate to Laravel project
cd your-laravel-project

# Copy all blade files
cp laravel_components/*.blade.php resources/views/components/

# Copy CSS files
mkdir -p public/css/components
cp laravel_components/*.css public/css/components/

# Copy JavaScript files
mkdir -p public/js/components
cp laravel_components/*.js public/js/components/
```

## Step 3: Create Layout File
Create `resources/views/layouts/app.blade.php`:

```blade
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Fumo Store')</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.css') }}">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <!-- Component Styles -->
    <link rel="stylesheet" href="{{ asset('css/components/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/scroll-to-top.css') }}">

    @stack('styles')
</head>
<body>
    <!-- Header -->
    @include('components.header')

    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('components.footer')

    <!-- jQuery -->
    <script src="{{ asset('assets/js/jquery-2.1.0.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('assets/js/popper.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    <!-- Component Scripts -->
    <script src="{{ asset('js/components/header.js') }}"></script>
    <script src="{{ asset('js/components/footer.js') }}"></script>
    <script src="{{ asset('js/components/carousel.js') }}"></script>

    @stack('scripts')
</body>
</html>
```

## Step 4: Use in Your Pages
Create controllers and pages:

```bash
# Create controller
php artisan make:controller HomeController

# Create views
php artisan make:view pages.home
```

Example Controller (`app/Http/Controllers/HomeController.php`):
```php
<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $menProducts = Product::where('category', 'mens')->limit(10)->get();
        $womenProducts = Product::where('category', 'womens')->limit(10)->get();
        $kidsProducts = Product::where('category', 'kids')->limit(10)->get();
        $bestSellers = Product::where('best_seller', true)->limit(10)->get();

        return view('pages.home', [
            'menProducts' => $menProducts,
            'womenProducts' => $womenProducts,
            'kidsProducts' => $kidsProducts,
            'bestSellers' => $bestSellers,
        ]);
    }
}
```

Example Page View (`resources/views/pages/home.blade.php`):
```blade
@extends('layouts.app')

@section('content')

    @include('components.carousel', [
        'products' => $menProducts,
        'title' => "Men's Latest",
        'subtitle' => 'Discover our exclusive men collection',
        'section_id' => 'men'
    ])

    @include('components.carousel', [
        'products' => $womenProducts,
        'title' => "Women's Collection",
        'subtitle' => 'Explore our stunning women range',
        'section_id' => 'women'
    ])

    @include('components.carousel', [
        'products' => $kidsProducts,
        'title' => "Kid's Favorites",
        'subtitle' => 'Fun and colorful items for kids',
        'section_id' => 'kids'
    ])

    @include('components.carousel', [
        'products' => $bestSellers,
        'title' => 'Best Sellers',
        'subtitle' => 'Top rated products our customers love',
        'section_id' => 'best-sellers'
    ])

@endsection
```

## Step 5: Create Routes
In `routes/web.php`:

```php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/{id}', [CartController::class, 'add'])->name('cart.add');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
```

## Step 6: Create Product Attributes
If not already done, add to Product model migration:

```php
Schema::create('products', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->text('description')->nullable();
    $table->decimal('price', 10, 2);
    $table->string('category');
    $table->string('image')->nullable();
    $table->integer('rating')->default(5);
    $table->boolean('best_seller')->default(false);
    $table->timestamps();
});
```

## Testing

Run the development server:
```bash
php artisan serve
```

Visit: http://127.0.0.1:8000

## Customization Options

### 1. Change Colors
Edit component CSS files or override in your main CSS:
```css
.product-card {
    /* Your custom styles */
}
```

### 2. Modify Carousel Items Per View
Edit inside `carousel.js`:
```javascript
getItemsPerView() {
    // Adjust these breakpoints
    return 4; // Default: 4 items
}
```

### 3. Add Custom Routes/Functionality
Extend components by modifying the JavaScript:
```javascript
handleAddToCart($form) {
    // Add your custom logic here
    console.log('Product added to cart');
}
```

## Troubleshooting

### Carousel Not Showing
- ✅ Check products array is passed
- ✅ Verify jQuery is loaded first
- ✅ Check browser console for errors

### Header Search Not Working
- ✅ Ensure route 'products.search' exists
- ✅ Check route parameter is correct

### Cart Count Not Updating
- ✅ Verify localStorage is enabled
- ✅ Check cartUpdated event is triggered

---

For detailed documentation, see **README.md** in the laravel_components folder.
