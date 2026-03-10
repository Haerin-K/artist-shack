@extends('layouts.app')

@section('content')
<div class="flex flex-col gap-12">
    @foreach($groupedProducts as $category => $products)
        <x-carousel 
            :products="$products" 
            :category="$category"
            :section_id="Str::slug($category)"
        />
    @endforeach
</div>
@endsection