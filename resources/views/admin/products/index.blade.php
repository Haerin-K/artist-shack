@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex justify-between items-center mb-12">
        <h1 class="text-4xl font-bold text-gray-800">Products</h1>
        <a href="{{ route('admin.products.create') }}" class="btn-primary">
            ➕ Add Product
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-purple-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Product</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Category</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Price</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Stock</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr class="border-b hover:bg-purple-50">
                            <td class="px-6 py-3 font-semibold text-gray-800">{{ $product->name }}</td>
                            <td class="px-6 py-3 text-gray-700">{{ $product->category->name }}</td>
                            <td class="px-6 py-3 font-bold text-purple-600">${{ number_format($product->price, 2) }}</td>
                            <td class="px-6 py-3">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                    @if($product->stock > 20) bg-green-100 text-green-700
                                    @elseif($product->stock > 5) bg-yellow-100 text-yellow-700
                                    @else bg-red-100 text-red-700 @endif
                                ">
                                    {{ $product->stock }}
                                </span>
                            </td>
                            <td class="px-6 py-3">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                    @if($product->is_active && !$product->deleted_at) bg-green-100 text-green-700
                                    @elseif($product->deleted_at) bg-gray-100 text-gray-700
                                    @else bg-red-100 text-red-700 @endif
                                ">
                                    @if($product->deleted_at)
                                        Deleted
                                    @elseif($product->is_active)
                                        Active
                                    @else
                                        Inactive
                                    @endif
                                </span>
                            </td>
                            <td class="px-6 py-3 text-sm space-x-2">
                                @if($product->deleted_at)
                                    <form action="{{ route('admin.products.restore', $product->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-green-600 hover:text-green-700 font-semibold">Restore</button>
                                    </form>
                                @else
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="text-purple-600 hover:text-purple-700 font-semibold">Edit</a>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-700 font-semibold" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-8">
        {{ $products->links() }}
    </div>
</div>
@endsection