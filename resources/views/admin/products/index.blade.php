@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Inventory Tracking</h1>
    <a href="#" class="bg-green-500 text-white px-4 py-2 rounded">Add New Product</a> 
</div>

<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="p-4">Product Name</th> [cite: 21]
                <th class="p-4">Category</th> [cite: 8]
                <th class="p-4">Price</th> 
                <th class="p-4">Current Stock</th> [cite: 21]
                <th class="p-4">Actions</th> 
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-4 font-medium">{{ $product->name }}</td>
                <td class="p-4 text-gray-600">{{ $product->category }}</td>
                <td class="p-4">${{ $product->price }}</td>
                <td class="p-4">
                    <form action="{{ route('products.update', $product->id) }}" method="POST" class="flex items-center">
                        @csrf
                        @method('PUT')
                        <input type="number" name="stock_quantity" value="{{ $product->stock_quantity }}" 
                               class="border w-16 p-1 rounded mr-2">
                        <button type="submit" class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded">Update</button>
                    </form> [cite: 22, 25]
                </td>
                <td class="p-4">
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Delete this item?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                    </form> [cite: 24]
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection