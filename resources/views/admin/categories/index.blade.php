@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex justify-between items-center mb-12">
        <h1 class="text-4xl font-bold text-gray-800">Categories</h1>
        <a href="{{ route('admin.categories.create') }}" class="btn-primary">
            ➕ Add Category
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($categories as $category)
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-xl font-bold text-gray-800">{{ $category->name }}</h3>
                    <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-sm font-semibold">
                        {{ $category->products_count }} items
                    </span>
                </div>

                <p class="text-gray-600 mb-4 line-clamp-2">{{ $category->description }}</p>

                <div class="flex gap-2">
                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn-secondary py-2 text-sm flex-1">
                        Edit
                    </a>
                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full btn-danger py-2 text-sm" onclick="return confirm('Are you sure?')">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $categories->links() }}
    </div>
</div>
@endsection