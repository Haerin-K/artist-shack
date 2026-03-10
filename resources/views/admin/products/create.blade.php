@extends('layouts.app')

@section('title', 'Create Product')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-4xl font-bold text-gray-800 mb-8">Create New Product</h1>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md p-8 space-y-6">
        @csrf

        <div>
            <label class="block text-gray-700 font-semibold mb-2">Product Name *</label>
            <input type="text" name="name" value="{{ old('name') }}" required class="input-field @error('name') border-red-500 @enderror">
            @error('name')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-2">Category *</label>
            <select name="category_id" required class="input-field @error('category_id') border-red-500 @enderror">
                <option value="">Select a category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-2">Description *</label>
            <textarea name="description" rows="5" required class="input-field @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Price *</label>
                <input type="number" name="price" step="0.01" value="{{ old('price') }}" required class="input-field @error('price') border-red-500 @enderror">
                @error('price')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Stock Quantity *</label>
                <input type="number" name="stock" value="{{ old('stock') }}" required class="input-field @error('stock') border-red-500 @enderror">
                @error('stock')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-2">SKU *</label>
            <input type="text" name="sku" value="{{ old('sku') }}" required class="input-field @error('sku') border-red-500 @enderror">
            @error('sku')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-2">Product Images</label>
            <input type="file" name="images[]" multiple accept="image/*" class="input-field @error('images.*') border-red-500 @enderror">
            <p class="text-gray-600 text-sm mt-1">Upload one or multiple images (JPEG, PNG, GIF)</p>
            @error('images.*')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-4">
            <button type="submit" class="btn-primary py-3">
                Create Product
            </button>
            <a href="{{ route('admin.products.index') }}" class="btn-secondary py-3">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection