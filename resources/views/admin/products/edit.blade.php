@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0"><i class="fa fa-edit"></i> Edit Product</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Product Name -->
                        <div class="form-group">
                            <label for="name" class="form-label font-weight-bold">Product Name <span class="text-danger">*</span></label>
                            <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div class="form-group">
                            <label for="category_id" class="form-label font-weight-bold">Category <span class="text-danger">*</span></label>
                            <select id="category_id" name="category_id" required class="form-control @error('category_id') is-invalid @enderror">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="form-group">
                            <label for="description" class="form-label font-weight-bold">Description <span class="text-danger">*</span></label>
                            <textarea id="description" name="description" rows="5" required class="form-control @error('description') is-invalid @enderror">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Price & Stock -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price" class="form-label font-weight-bold">Price (USD) <span class="text-danger">*</span></label>
                                    <input type="number" id="price" name="price" step="0.01" value="{{ old('price', $product->price) }}" required class="form-control @error('price') is-invalid @enderror">
                                    @error('price')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="stock" class="form-label font-weight-bold">Stock Quantity <span class="text-danger">*</span></label>
                                    <input type="number" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" required class="form-control @error('stock') is-invalid @enderror">
                                    @error('stock')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- SKU -->
                        <div class="form-group">
                            <label for="sku" class="form-label font-weight-bold">SKU (Stock Keeping Unit) <span class="text-danger">*</span></label>
                            <input type="text" id="sku" name="sku" value="{{ old('sku', $product->sku) }}" required class="form-control @error('sku') is-invalid @enderror">
                            @error('sku')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Current Images -->
                        <div class="form-group">
                            <label class="form-label font-weight-bold">Current Images</label>
                            @if($product->images && count($product->images) > 0)
                                <div class="row">
                                    @foreach($product->images as $image)
                                        <div class="col-md-3 mb-3">
                                            <img src="{{ asset('storage/' . $image) }}" alt="Product image" class="img-thumbnail w-100" style="height: 150px; object-fit: cover;">
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-muted"><small>No images uploaded yet</small></p>
                            @endif
                        </div>

                        <!-- Add More Images -->
                        <div class="form-group">
                            <label for="images" class="form-label font-weight-bold">Add More Images</label>
                            <input type="file" id="images" name="images[]" multiple accept="image/*" class="form-control @error('images.*') is-invalid @enderror">
                            <small class="form-text text-muted d-block mt-2">
                                <i class="fa fa-info-circle"></i> Upload additional images (JPEG, PNG, GIF max 2MB each)
                            </small>
                            @error('images.*')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="form-group mt-5">
                            <button type="submit" class="btn btn-primary me-2">
                                <i class="fa fa-save"></i> Update Product
                            </button>
                            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                                <i class="fa fa-times"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection