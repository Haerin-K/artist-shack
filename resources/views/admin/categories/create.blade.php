@extends('layouts.app')

@section('title', 'Create Category')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-4xl font-bold text-gray-800 mb-8">Create New Category</h1>

    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md p-8 space-y-6">
        @csrf

        <div>
            <label class="block text-gray-700 font-semibold mb-2">Category Name *</label>
            <input type="text" name="name" value="{{ old('name') }}" required class="input-field @error('name') border-red-500 @enderror">
            @error('name')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-2">Description</label>
            <textarea name="description" rows="4" class="input-field @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-2">Category Image</label>
            <input type="file" name="image" accept="image/*" class="input-field @error('image') border-red-500 @enderror">
            @error('image')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-4">
            <button type="submit" class="btn-primary py-3">
                Create Category
            </button>
            <a href="{{ route('admin.categories.index') }}" class="btn-secondary py-3">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection