# 📦 Fumo Store - Laravel UI Components

Complete modular Laravel-ready UI components extracted from your Hexashop template. Each component is independent, reusable, and fully documented.

## 📁 Component Structure

```
laravel_components/
├── header.blade.php           # Header navigation component
├── header.css                 # Header styles
├── header.js                  # Header JavaScript (sticky, menu, search)
│
├── footer.blade.php           # Footer component
├── footer.css                 # Footer styles
├── footer.js                  # Footer JavaScript (scroll-to-top)
│
├── carousel.blade.php         # Product carousel component
├── carousel.css               # Carousel styles
├── carousel.js                # Carousel JavaScript (infinite loop, expand grid)
│
├── app.blade.php              # Main layout template example
├── home.blade.php             # Example page using all components
└── README.md                  # This file
```

---

## 🚀 Quick Start

### 1. **Copy Files to Laravel Project**

```bash
# Copy components to your Laravel views
cp laravel_components/*.blade.php resources/views/components/

# Copy CSS to public folder
cp laravel_components/*.css public/css/components/

# Copy JavaScript to public folder
cp laravel_components/*.js public/js/components/
```

### 2. **Use in Your Layout**

In your main layout file (`resources/views/layouts/app.blade.php`):

```blade
<!DOCTYPE html>
<html>
<head>
    <!-- Include component styles -->
    <link rel="stylesheet" href="{{ asset('css/components/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/carousel.css') }}">
</head>
<body>
    <!-- Include header component -->
    @include('components.header')

    <!-- Your page content -->
    @yield('content')

    <!-- Include footer component -->
    @include('components.footer')

    <!-- Include component scripts at the end -->
    <script src="{{ asset('js/components/header.js') }}"></script>
    <script src="{{ asset('js/components/footer.js') }}"></script>
    <script src="{{ asset('js/components/carousel.js') }}"></script>
</body>
</html>
```

---

## 🎯 Component Details

### **Header Component** (`header.blade.php`)

**Features:**
- Sticky navigation
- Responsive mobile menu
- Search functionality
- User login/logout
- Shopping cart with item count
- Dropdown menus

**Usage:**
```blade
@include('components.header')
```

**CSS Classes:** `.header-area`, `.main-nav`, `.user-section`, etc.

**Events:**
- `cartUpdated` - Triggered when cart count changes
- `userUpdated` - Triggered when user logs in/out

---

### **Footer Component** (`footer.blade.php`)

**Features:**
- Company information
- Multiple link categories
- Social media links
- Copyright notice
- Scroll-to-top button

**Usage:**
```blade
@include('components.footer')
```

**Responsive Design:** Adapts to mobile, tablet, and desktop screens

---

### **Carousel Component** (`carousel.blade.php`)

**Features:**
- ✅ **Infinite Loop Navigation** - Navigate indefinitely with left/right buttons
- ✅ **Responsive** - Auto-adjusts items per view (1 mobile, 2 tablet, 3 desktop, 4 large)
- ✅ **Expand Grid View** - Click "View All" to see products in grid format
- ✅ **Touch Swipe Support** - Swipe on mobile devices
- ✅ **Keyboard Navigation** - Arrow keys to navigate
- ✅ **Smooth Animations** - SVG transforms for performance
- ✅ **Wishlist Toggle** - Add/remove from wishlist
- ✅ **Notifications** - Toast notifications for actions

**Usage:**
```blade
@include('components.carousel', [
    'products' => $products,           // Collection of products
    'title' => 'Featured Products',    // Section title
    'subtitle' => 'Browse our items',  // Section subtitle
    'section_id' => 'featured'         // Unique ID for the carousel
])
```

**Product Object Structure:**
```php
$product = [
    'id' => 1,
    'name' => 'Product Name',
    'category' => 'Category',
    'description' => 'Product description',
    'price' => 99.99,
    'image' => 'path/to/image.jpg',
    'rating' => 5  // Rating out of 5
];
```

**Navigation:**
- **Left Button** - View previous items (loops to end when at start)
- **Right Button** - View next items (loops to start when at end)
- **View All** - Expands to grid view showing all products
- **Back to Carousel** - Collapse grid view

**Grid View Layout:**
```css
/* Tailwind-like responsive grid */
grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
gap: 24px;

/* Responsive adjustments */
@media (max-width: 1200px) { minmax(250px, 1fr) }
@media (max-width: 768px) { minmax(200px, 1fr) }
@media (max-width: 576px) { 1fr }
```

---

## 📱 Responsive Breakpoints

All components are fully responsive:

| Device | Breakpoint | Carousel Items |
|--------|-----------|-----------------|
| Mobile | < 576px   | 1 item          |
| Tablet | 576-768px | 2 items         |
| Desktop | 768-1200px | 3 items        |
| Large | > 1200px  | 4 items         |

---

## 🎨 Customization

### **Colors**
Edit the CSS color variables:
```css
/* Primary Colors */
--color-primary: #2a2a2a;
--color-primary-dark: #000;
--color-accent: #0066ff;
--color-success: #28a745;
--color-border: #eee;
```

### **Carousel Items Per View**
In `carousel.js`, modify the `getItemsPerView()` method:
```javascript
getItemsPerView() {
    const width = $(window).width();
    if (width < 576) return 1;    // Change these values
    if (width < 768) return 2;
    if (width < 1200) return 3;
    return 4;
}
```

### **Animation Speed**
```javascript
// In carousel.js
setTimeout(() => {
    this.isAnimating = false;
}, 400);  // Change this value (in milliseconds)
```

---

## 🔑 Key Features

### **Carousel Features:**

1. **Infinite Loop**
   - Seamlessly cycles through products
   - Wraps to end when going left from start
   - Wraps to start when going right from end

2. **Expand Grid View**
   ```blade
   <!-- Grid format shown in your custom format -->
   <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
       {{-- Products display here --}}
   </div>
   ```

3. **Touch Gestures**
   - Swipe left to go next
   - Swipe right to go previous
   - Requires > 50px swipe distance

4. **Accessibility**
   - Keyboard arrow key support
   - ARIA labels for screen readers
   - Button focus management

---

## 💾 Data Passed to Components

### **Header Component**
- Routes: `home`, `login`, `cart.index`, `products.search`
- LocalStorage: `userName`, `cartCount`

### **Footer Component**
- Routes: `home`, `about`, `contact`, `products`
- Dynamic year using `{{ now()->year }}`

### **Carousel Component**
- Collection: `$products`
- Strings: `$title`, `$subtitle`
- String: `$section_id` (unique identifier)

---

## 🔌 Event Handling

### **Custom Events**

```javascript
// Listen for cart updates
$(document).on('cartUpdated', function() {
    updateCartCount();
});

// Listen for user login/logout
$(document).on('userUpdated', function() {
    updateUserDisplay();
});

// Trigger cart update
$(document).trigger('cartUpdated');
```

---

## 📋 Routes Referenced

Add these routes to your `routes/web.php`:

```php
Route::get('/', 'HomeController@index')->name('home');
Route::get('/about', 'AboutController@index')->name('about');
Route::get('/products', 'ProductController@index')->name('products');
Route::get('/products/search', 'ProductController@search')->name('products.search');
Route::get('/products/{id}', 'ProductController@show')->name('product.show');
Route::get('/contact', 'ContactController@index')->name('contact');
Route::get('/login', 'AuthController@login')->name('login');
Route::post('/logout', 'AuthController@logout')->name('logout');
Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/cart/{id}', 'CartController@add')->name('cart.add');
```

---

## 🎓 Example: Creating a Products Page

```blade
@extends('layouts.app')

@section('content')

    @include('components.carousel', [
        'products' => $products,
        'title' => 'All Products',
        'subtitle' => 'Browse our complete collection',
        'section_id' => 'all-products'
    ])

@endsection
```

---

## 🛠️ Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers (iOS Safari, Chrome Android)

---

## 📦 Dependencies

- **jQuery 2.1.0+** - For event handling and DOM manipulation
- **Bootstrap 4+** - For grid system (optional, can customize)
- **Font Awesome 4+** - For icons

---

## 🎯 Performance Tips

1. **Lazy Load Images** - Add `loading="lazy"` attribute to images
2. **Minify CSS/JS** - Use Laravel Mix to compile and minify
3. **Caching** - Cache product collections for faster rendering
4. **CDN** - Serve static assets from CDN

---

## 🚨 Troubleshooting

### **Carousel Not Moving**
- Ensure jQuery is loaded before carousel.js
- Check browser console for JavaScript errors
- Verify CSS is loading (check Network tab)

### **Mobile Menu Not Working**
- Ensure screen width < 991px
- Check z-index conflicts
- Verify hamburger icon is visible

### **Grid View Not Showing**
- Check that products array is not empty
- Verify expand button is being clicked
- Check CSS classes: `.grid-wrapper.hidden`

---

## 📄 License

These components are part of the Fumo Store project. Modify and use as needed for your Laravel application.

---

## 🤝 Support

For issues or questions:
1. Check the component's inline comments
2. Review the example files (app.blade.php, home.blade.php)
3. Verify all routes exist in your Laravel project
4. Ensure jQuery and Bootstrap are properly loaded

---

**Last Updated:** February 27, 2026
**Version:** 1.0.0
**Compatibility:** Laravel 8.0+
