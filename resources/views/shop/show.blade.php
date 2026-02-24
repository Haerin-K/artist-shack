@extends('layouts.app')

@section('content')
<div class="flex flex-col md:flex-row bg-white rounded-xl shadow-lg p-8">
    <div class="md:w-1/2">
        <img src="https://via.placeholder.com/500" class="rounded-lg w-full">
    </div>
    
    <div class="md:w-1/2 md:pl-12 mt-6 md:mt-0">
        <h1 class="text-4xl font-bold">{{ $product->name }}</h1>
        <p class="text-2xl text-green-600 font-bold mt-2">${{ $product->price }}</p>
        
        <div class="mt-6">
            <h3 class="font-semibold text-gray-700">Description:</h3>
            <p class="text-gray-600 leading-relaxed">{{ $product->description }}</p>
        </div>

        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-8">
            @csrf
            <label class="block font-semibold mb-2">Quantity:</label>
            <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock_quantity }}" 
                   class="border p-2 w-20 rounded mb-4">
            
            <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg font-bold hover:bg-blue-700">
                Add to Shopping Cart
            </button>
        </form>
        
        <p class="mt-4 text-sm text-gray-500">In Stock: {{ $product->stock_quantity }} items [cite: 21]</p>
    </div>
</div>
@endsection