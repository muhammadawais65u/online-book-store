@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- Sidebar Filters -->
        <div class="col-lg-3 col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Filters</h5>
                </div>
                <div class="card-body">
                    <!-- Search -->
                    <form method="GET" action="{{ route('books.index') }}">
                        <div class="mb-3">
                            <label for="search" class="form-label">Search Books</label>
                            <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}" placeholder="Search by title or author...">
                        </div>
                        
                        <!-- Category Filter -->
                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-select" id="category" name="category">
                                <option value="">All Categories</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->slug }}" {{ request('category') == $cat->slug ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Price Range -->
                        <div class="mb-3">
                            <label for="min_price" class="form-label">Min Price</label>
                            <input type="number" class="form-control" id="min_price" name="min_price" value="{{ request('min_price') }}" step="0.01" min="0">
                        </div>
                        
                        <div class="mb-3">
                            <label for="max_price" class="form-label">Max Price</label>
                            <input type="number" class="form-control" id="max_price" name="max_price" value="{{ request('max_price') }}" step="0.01" min="0">
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                        <a href="{{ route('books.index') }}" class="btn btn-outline-secondary w-100 mt-2">Clear</a>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Books Grid -->
        <div class="col-lg-9 col-md-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Books</h2>
                <div class="text-muted">
                    Showing {{ $books->firstItem() }} to {{ $books->lastItem() }} of {{ $books->total() }} books
                </div>
            </div>
            
            @if($books->count() > 0)
                <div class="row">
                    @foreach($books as $book)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100 shadow-sm">
                                @if($book->cover_image)
                                    <img src="{{ asset('storage/' . $book->cover_image) }}" class="card-img-top" alt="{{ $book->title }}" style="height: 250px; object-fit: cover;">
                                @else
                                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 250px;">
                                        <i class="fas fa-book fa-3x text-muted"></i>
                                    </div>
                                @endif
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ Str::limit($book->title, 40) }}</h5>
                                    <p class="card-text text-muted small">by {{ $book->author->name }}</p>
                                    <p class="card-text small">{{ Str::limit($book->description, 80) }}</p>
                                    <div class="mt-auto">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="fw-bold text-primary">{{ $book->formatted_price }}</span>
                                            @if($book->stock_quantity > 0)
                                                <span class="badge bg-success">In Stock</span>
                                            @else
                                                <span class="badge bg-danger">Out of Stock</span>
                                            @endif
                                        </div>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('books.show', $book) }}" class="btn btn-outline-primary btn-sm flex-fill">View Details</a>
                                            @if($book->stock_quantity > 0)
                                                <form action="{{ route('cart.add', $book) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="quantity" value="1">
                                                    <button type="submit" class="btn btn-primary btn-sm">Add to Cart</button>
                                                </form>
                                            @else
                                                <button class="btn btn-secondary btn-sm" disabled>Out of Stock</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $books->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-search fa-3x text-muted mb-3"></i>
                    <h4>No books found</h4>
                    <p class="text-muted">Try adjusting your search criteria or browse all books.</p>
                    <a href="{{ route('books.index') }}" class="btn btn-primary">Browse All Books</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
