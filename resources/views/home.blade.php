@extends('layouts.app') 

@section('content') 
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Explore Our Toys</h2>
</div>

<form class="mb-4 d-flex gap-2" method="GET"> 
    <input type="text" name="search" class="form-control" placeholder="Search for toys..." value="{{ request('search') }}"> 
    <select name="category_id" class="form-select" style="max-width: 250px;"> 
        <option value="">All Categories</option> 
        @foreach($categories as $c) 
            <option value="{{ $c->id }}" {{ request('category_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option> 
        @endforeach 
    </select> 
    <button class="btn btn-primary px-4">Filter</button> 
</form> 

<div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4"> 
    @foreach($products as $p) 
    <div class="col">
        <div class="card h-100 shadow-sm border-0">
            @if($p->image)
                <img src="{{ str_starts_with($p->image, 'http') ? $p->image : asset('storage/'.$p->image) }}" class="card-img-top" style="height: 220px; object-fit: cover;" alt="{{ $p->name }}">
            @else
                <div class="card-img-top bg-light d-flex align-items-center justify-content-center text-muted" style="height: 220px;">
                    <span class="fs-4">No Image</span>
                </div>
            @endif
            <div class="card-body d-flex flex-column">
                <h5 class="card-title text-truncate">{{ $p->name }}</h5>
                <p class="card-text text-muted small flex-grow-1">{{ \Illuminate\Support\Str::limit($p->description, 60) }}</p>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <h5 class="text-primary fw-bold mb-0">${{ $p->price }}</h5>
                    <a href="{{ route('product.show', $p) }}" class="btn btn-sm btn-outline-primary">View</a>
                </div>
            </div>
        </div>
    </div> 
    @endforeach 
</div> 
@endsection