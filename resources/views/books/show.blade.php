@extends('layouts.app')

@section('content')
<div class="container py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('books.index') }}">Books</a></li>
            <li class="breadcrumb-item active">{{ $book->title }}</li>
        </ol>
    </nav>
    
    <div class="row">
        <!-- Book Image -->
        <div class="col-lg-4 col-md-5">
            @if($book->cover_image)
                <img src="{{ asset('storage/' . $book->cover_image) }}" class="img-fluid rounded shadow" alt="{{ $book->title }}">
            @else
                <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 500px;">
                    <i class="fas fa-book fa-5x text-muted"></i>
                </div>
            @endif
        </div>
        
        <!-- Book Details -->
        <div class="col-lg-8 col-md-7">
            <h1 class="mb-3">{{ $book->title }}</h1>
            <p class="text-muted mb-3">by {{ $book->author->name }}</p>
            
            <div class="d-flex align-items-center gap-3 mb-4">
                <span class="h3 text-primary fw-bold">{{ $book->formatted_price }}</span>
                @if($book->stock_quantity > 0)
                    <span class="badge bg-success fs-6">In Stock ({{ $book->stock_quantity }} available)</span>
                @else
                    <span class="badge bg-danger fs-6">Out of Stock</span>
                @endif
            </div>
            
            <div class="mb-4">
                <h5>Description</h5>
                <p>{{ $book->description }}</p>
            </div>
            
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>Book Details</h5>
                    <table class="table table-sm">
                        <tr>
                            <td><strong>Category:</strong></td>
                            <td>{{ $book->category->name }}</td>
                        </tr>
                        <tr>
                            <td><strong>Author:</strong></td>
                            <td>{{ $book->author->name }}</td>
                        </tr>
                        <tr>
                            <td><strong>Pages:</strong></td>
                            <td>{{ $book->pages }}</td>
                        </tr>
                        <tr>
                            <td><strong>ISBN:</strong></td>
                            <td>{{ $book->isbn }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h5>Publication Info</h5>
                    <table class="table table-sm">
                        <tr>
                            <td><strong>Published:</strong></td>
                            <td>{{ $book->published_date ? $book->published_date->format('M d, Y') : 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Language:</strong></td>
                            <td>English</td>
                        </tr>
                        <tr>
                            <td><strong>Format:</strong></td>
                            <td>Paperback</td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <!-- Add to Cart Form -->
            @if($book->stock_quantity > 0)
                <form action="{{ route('cart.add', $book) }}" method="POST" class="d-flex gap-3 align-items-end">
                    @csrf
                    <div class="flex-grow-1">
                        <label for="quantity" class="form-label">Quantity:</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="1" max="{{ $book->stock_quantity }}">
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-cart-plus"></i> Add to Cart
                    </button>
                </form>
            @else
                <button class="btn btn-secondary btn-lg" disabled>
                    <i class="fas fa-times"></i> Out of Stock
                </button>
            @endif
        </div>
    </div>
    
    <!-- Reviews Section -->
    <div class="row mt-5">
        <div class="col-12">
            <h3>Customer Reviews</h3>
            
            @if($book->reviews()->where('is_approved', true)->count() > 0)
                <div class="row">
                    @foreach($book->reviews()->where('is_approved', true')->latest()->get() as $review)
                        <div class="col-md-6 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-2">
                                        <h6 class="card-title mb-0">{{ $review->user->name }}</h6>
                                        <div>
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                        </div>
                                    </div>
                                    <p class="card-text">{{ $review->comment }}</p>
                                    <small class="text-muted">{{ $review->created_at->format('M d, Y') }}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-3">
                    <p class="text-muted">No reviews yet. Be the first to review this book!</p>
                </div>
            @endif
        </div>
    </div>
    
    <!-- Related Books -->
    @if($relatedBooks->count() > 0)
        <div class="row mt-5">
            <div class="col-12">
                <h3>Related Books</h3>
                <div class="row">
                    @foreach($relatedBooks as $relatedBook)
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                            <div class="card h-100 shadow-sm">
                                @if($relatedBook->cover_image)
                                    <img src="{{ asset('storage/' . $relatedBook->cover_image) }}" class="card-img-top" alt="{{ $relatedBook->title }}" style="height: 200px; object-fit: cover;">
                                @else
                                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                        <i class="fas fa-book fa-2x text-muted"></i>
                                    </div>
                                @endif
                                <div class="card-body">
                                    <h6 class="card-title">{{ Str::limit($relatedBook->title, 30) }}</h6>
                                    <p class="card-text text-muted small">{{ $relatedBook->author->name }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-bold text-primary">{{ $relatedBook->formatted_price }}</span>
                                        <a href="{{ route('books.show', $relatedBook) }}" class="btn btn-outline-primary btn-sm">View</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
