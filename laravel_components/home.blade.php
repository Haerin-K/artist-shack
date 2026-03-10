{{-- ===== EXAMPLE PAGE USING CAROUSEL COMPONENT ===== --}}
{{-- Laravel Blade Template for Home/Products Page --}}
{{-- Path: resources/views/pages/home.blade.php --}}

@extends('layouts.app')

@section('title', 'Home - Fumo Store')

@section('content')

    <!-- ===== HERO BANNER ===== -->
    <section class="hero-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Welcome to Fumo Store</h1>
                    <p>Discover our amazing collection of products</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== MEN'S PRODUCTS CAROUSEL ===== -->
    @include('components.carousel', [
        'products' => $menProducts,
        'title' => "Men's Latest",
        'subtitle' => 'Discover our exclusive men collection',
        'section_id' => 'men'
    ])

    <!-- ===== WOMEN'S PRODUCTS CAROUSEL ===== -->
    @include('components.carousel', [
        'products' => $womenProducts,
        'title' => "Women's Collection",
        'subtitle' => 'Explore our stunning women range',
        'section_id' => 'women'
    ])

    <!-- ===== KIDS PRODUCTS CAROUSEL ===== -->
    @include('components.carousel', [
        'products' => $kidsProducts,
        'title' => "Kid's Favorites",
        'subtitle' => 'Fun and colorful items for kids',
        'section_id' => 'kids'
    ])

    <!-- ===== BEST SELLERS CAROUSEL ===== -->
    @include('components.carousel', [
        'products' => $bestSellers,
        'title' => 'Best Sellers',
        'subtitle' => 'Top rated products our customers love',
        'section_id' => 'best-sellers'
    ])

@endsection
