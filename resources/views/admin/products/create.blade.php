@extends('layouts.app')

@section('title', 'Create Product')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0"><i class="fa fa-plus"></i> Create New Product</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Product Name -->
                        <div class="form-group">
                            <label for="name" class="form-label font-weight-bold">Product Name <span class="text-danger">*</span></label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required class="form-control @error('name') is-invalid @enderror" placeholder="Enter product name">
                            @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div class="form-group">
                            <label for="category_id" class="form-label font-weight-bold">Category <span class="text-danger">*</span></label>
                            <select id="category_id" name="category_id" required class="form-control @error('category_id') is-invalid @enderror">
                                <option value="">-- Select a category --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="form-group">
                            <label for="description" class="form-label font-weight-bold">Description <span class="text-danger">*</span></label>
                            <textarea id="description" name="description" rows="4" required class="form-control @error('description') is-invalid @enderror" placeholder="Enter product description">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Price & Stock -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price" class="form-label font-weight-bold">Price (USD) <span class="text-danger">*</span></label>
                                    <input type="number" id="price" name="price" step="0.01" value="{{ old('price') }}" required class="form-control @error('price') is-invalid @enderror" placeholder="0.00">
                                    @error('price')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="stock" class="form-label font-weight-bold">Stock Quantity <span class="text-danger">*</span></label>
                                    <input type="number" id="stock" name="stock" value="{{ old('stock') }}" required class="form-control @error('stock') is-invalid @enderror" placeholder="0">
                                    @error('stock')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- SKU -->
                        <div class="form-group">
                            <label for="sku" class="form-label font-weight-bold">SKU (Stock Keeping Unit) <span class="text-danger">*</span></label>
                            <input type="text" id="sku" name="sku" value="{{ old('sku') }}" required class="form-control @error('sku') is-invalid @enderror" placeholder="e.g., PROD-001">
                            @error('sku')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Images -->
                        <div class="form-group">
                            <label for="images" class="form-label font-weight-bold">Product Images</label>
                            <input type="file" id="images" name="images[]" multiple accept="image/*" class="form-control @error('images.*') is-invalid @enderror">
                            <small class="form-text text-muted d-block mt-2">
                                <i class="fa fa-info-circle"></i> Upload one or multiple images (JPEG, PNG, GIF max 2MB each)
                            </small>
                            @error('images.*')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="form-group mt-5">
                            <button type="submit" class="btn btn-primary me-2">
                                <i class="fa fa-save"></i> Create Product
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
            </a>
        </div>
    </form>
</div>
@endsection