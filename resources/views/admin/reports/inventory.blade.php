@extends('layouts.app')

@section('title', 'Inventory Report')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-4xl font-bold text-gray-800 mb-12">📦 Inventory Report</h1>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-purple-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Product</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Category</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">SKU</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Price</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Stock</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Value</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr class="border-b hover:bg-purple-50">
                            <td class="px-6 py-3 text-gray-800 font-semibold">{{ $product->name }}</td>
                            <td class="px-6 py-3 text-gray-600">{{ $product->category->name }}</td>
                            <td class="px-6 py-3 text-gray-600 font-mono">{{ $product->sku }}</td>
                            <td class="px-6 py-3 text-gray-600">${{ number_format($product->price, 2) }}</td>
                            <td class="px-6 py-3">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                    @if($product->stock > 20) bg-green-100 text-green-700
                                    @elseif($product->stock > 5) bg-yellow-100 text-yellow-700
                                    @else bg-red-100 text-red-700 @endif
                                ">
                                    {{ $product->stock }}
                                </span>
                            </td>
                            <td class="px-6 py-3 text-purple-600 font-bold">${{ number_format($product->stock * $product->price, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection