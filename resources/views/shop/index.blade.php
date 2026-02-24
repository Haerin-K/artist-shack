@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-6">Merchandise Gallery</h1>

<div class="mb-8">
    <span class="font-semibold">Filter:</span>
    <button class="ml-2 px-4 py-2 bg-gray-200 rounded">Plushies</button>
    <button class="ml-2 px-4 py-2 bg-gray-200 rounded">Stickers</button>
    <button class="ml-2 px-4 py-2 bg-gray-200 rounded">Keychains</button>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @foreach($products as $product)
    <div class="bg-white rounded-lg shadow-sm overflow-hidden border">
        <img src="https://via.placeholder.com/300" alt="{{ $product->name }}" class="w-full h-48 object-cover">
        
        <div class="p-4">
            <span class="text-xs text-blue-500 uppercase font-bold">{{ $product->category }}</span>
            <h2 class="text-lg font-semibold">{{ $product->name }}</h2>
            <p class="text-gray-600 text-sm mt-1 line-clamp-2">{{ $product->description }}</p>
            
            <div class="mt-4 flex justify-between items-center">
                <span class="text-xl font-bold">${{ $product->price }}</span>
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-black text-white px-4 py-2 rounded text-sm hover:bg-gray-800">
                        Add to Cart
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection