@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="container my-5">
    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="h2">Products</h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i> Add Product
            </a>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="align-middle">Product</th>
                        <th class="align-middle">Category</th>
                        <th class="align-middle">Price</th>
                        <th class="align-middle">Stock</th>
                        <th class="align-middle">Status</th>
                        <th class="align-middle">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td class="align-middle"><strong>{{ $product->name }}</strong></td>
                            <td class="align-middle">{{ $product->category->name }}</td>
                            <td class="align-middle"><strong class="text-primary">${{ number_format($product->price, 2) }}</strong></td>
                            <td class="align-middle">
                                <span class="badge
                                    @if($product->stock > 20) badge-success
                                    @elseif($product->stock > 5) badge-warning text-dark
                                    @else badge-danger @endif
                                ">
                                    {{ $product->stock }}
                                </span>
                            </td>
                            <td class="align-middle">
                                <span class="badge
                                    @if($product->is_active && !$product->deleted_at) badge-success
                                    @elseif($product->deleted_at) badge-secondary
                                    @else badge-danger @endif
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
                            <td class="align-middle">
                                @if($product->deleted_at)
                                    <form action="{{ route('admin.products.restore', $product->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success" title="Restore product">
                                            <i class="fa fa-undo"></i> Restore
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-primary" title="Edit product">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')" title="Delete product">
                                            <i class="fa fa-trash"></i> Delete
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>
@endsection