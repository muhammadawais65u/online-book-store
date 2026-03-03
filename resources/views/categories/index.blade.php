@extends('layouts.app')

@section('content')
@include('layouts.navigation')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Book Categories</h2>
        <div>
            <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back to Home
            </a>
        </div>
    </div>

    @if($categories->count() > 0)
        <div class="row">
            @foreach($categories as $category)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card h-100 shadow-sm category-card">
                        <div class="card-body text-center">
                            <div class="category-icon mb-3">
                                @if($category->icon)
                                    <i class="{{ $category->icon }} fa-3x text-primary"></i>
                                @else
                                    <i class="fas fa-folder fa-3x text-primary"></i>
                                @endif
                            </div>
                            <h5 class="card-title">{{ $category->name }}</h5>
                            <p class="card-text text-muted small">{{ $category->description ? Str::limit($category->description, 100) : 'Browse books in this category' }}</p>
                            <div class="text-muted small mb-3">
                                {{ $category->books_count ?? $category->books()->count() }} books
                            </div>
                            <a href="{{ route('books.index', ['category' => $category->slug]) }}" class="btn btn-primary">
                                <i class="fas fa-book"></i> Browse Books
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-5">
            <i class="fas fa-folder-open fa-4x text-muted mb-3"></i>
            <h4>No Categories Found</h4>
            <p class="text-muted">No categories have been created yet.</p>
            <a href="{{ route('books.index') }}" class="btn btn-primary">Browse All Books</a>
        </div>
    @endif
</div>

<style>
.category-card {
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    border: 1px solid #e3e6f0;
}

.category-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}

.category-icon {
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>
@endsection

<!-- Footer -->
<footer class="bg-dark text-white py-4 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5>Online Book Store</h5>
                <p>Your one-stop destination for all your reading needs. Discover amazing books from various genres.</p>
            </div>
            <div class="col-md-4">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('books.index') }}" class="text-white">Browse Books</a></li>
                    <li><a href="{{ route('books.index') }}" class="text-white">Categories</a></li>
                    <li><a href="#" class="text-white">About Us</a></li>
                    <li><a href="#" class="text-white">Contact</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>Connect With Us</h5>
                <div class="d-flex gap-3">
                    <a href="#" class="text-white"><i class="fab fa-facebook fa-lg"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-twitter fa-lg"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-instagram fa-lg"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-linkedin fa-lg"></i></a>
                </div>
            </div>
        </div>
        <hr class="bg-white">
        <div class="text-center">
            <p>&copy; {{ date('Y') }} Online Book Store. All rights reserved.</p>
        </div>
    </div>
</footer>
