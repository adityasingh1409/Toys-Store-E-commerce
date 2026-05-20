@extends('layouts.app') 

@section('content') 
<div class="card border-0 shadow-sm overflow-hidden">
    <div class="row g-0">
        <div class="col-md-6"> 
            @if($product->image) 
                <img src="{{ str_starts_with($product->image, 'http') ? $product->image : asset('storage/'.$product->image) }}" class="img-fluid w-100" style="height: 500px; object-fit: cover;"> 
            @else 
                <div class="bg-light text-muted d-flex align-items-center justify-content-center h-100" style="min-height: 400px;">
                    <span class="fs-3">No Image Available</span>
                </div> 
            @endif 
        </div>
        <div class="col-md-6"> 
            <div class="card-body p-5 d-flex flex-column h-100">
                <div class="mb-2 text-muted text-uppercase small fw-bold">{{ $product->category->name ?? 'Uncategorized' }}</div>
                <h1 class="card-title fw-bold mb-3">{{ $product->name }}</h1> 
                <h2 class="text-primary fw-bold mb-4">${{ $product->price }}</h2> 
                
                <p class="card-text lead text-muted mb-4">{{ $product->description }}</p> 
                
                <div class="mt-auto">
                    <p class="mb-3">
                        <span class="badge bg-{{ $product->stock > 5 ? 'success' : 'warning' }} fs-6">
                            Stock: {{ $product->stock }} left
                        </span>
                    </p>

                    @if($product->stock > 0) 
                        <form action="{{ route('cart.add', $product) }}" method="POST" class="d-flex gap-3 align-items-center"> 
                            @csrf 
                            <div class="input-group" style="width: 140px;">
                                <span class="input-group-text">Qty</span>
                                <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="form-control text-center"> 
                            </div>
                            <button class="btn btn-success btn-lg px-4 shadow-sm">Add to Cart</button> 
                        </form> 
                    @else 
                        <div class="alert alert-danger d-inline-block">This item is currently Out of Stock</div> 
                    @endif 
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection