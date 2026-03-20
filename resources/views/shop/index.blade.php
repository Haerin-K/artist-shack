@extends('layouts.app')

@section('title', 'Shop - The Artist Shack')

@section('content')

<!-- ===== HERO BANNER ===== -->
<section class="hero-banner mb-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 60px 0; text-align: center;">
    <div class="container">
        <h1 class="display-4 font-weight-bold mb-3">Welcome to The Artist Shack</h1>
        <p class="lead">Discover our amazing collection of products</p>
    </div>
</section>

<!-- ===== CAROUSEL SECTIONS BY CATEGORY ===== -->
<div class="container-fluid">
    @forelse($groupedProducts as $category => $products)
        <x-carousel 
            :products="$products" 
            :category="$category"
            :title="$category"
            :subtitle="'Explore our ' . strtolower($category) . ' collection'"
            :section_id="Str::slug($category)"
        />
    @empty
        <div class="alert alert-info text-center" role="alert">
            <i class="fa fa-inbox"></i> No products available at the moment. Please check back soon!
        </div>
    @endforelse
</div>

@endsection