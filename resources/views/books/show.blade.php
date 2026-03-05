@extends('layouts.landing')

@section('content')
<div class="container py-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('books.index') }}">Books</a></li>
            <li class="breadcrumb-item active">{{ $book->title }}</li>
        </ol>
    </nav>

    <!-- Book Header Section -->
    <div class="row mb-5">
        <!-- Book Image -->
        <div class="col-lg-5 col-md-6 mb-4">
            <div class="card border-0 shadow-lg">
                @if($book->cover_image)
                    <img src="{{ asset('storage/' . $book->cover_image) }}"
                         class="card-img-top rounded-0"
                         alt="{{ $book->title }}"
                         style="height: 500px; object-fit: cover;">
                @else
                    <div class="card-img-top bg-gradient-primary d-flex align-items-center justify-content-center rounded-0"
                         style="height: 500px;">
                        <i class="fas fa-book fa-5x text-white"></i>
                    </div>
                @endif

                <!-- Quick Action Buttons Overlay -->
                <div class="card-img-overlay d-flex align-items-end p-3">
                    <div class="d-flex gap-2 w-100">
                        @if($book->pdf_file)
                            <button type="button"
                                    class="btn btn-light btn-sm flex-fill"
                                    data-bs-toggle="modal"
                                    data-bs-target="#pdfPreviewModal">
                                <i class="fas fa-eye me-1"></i>Preview
                            </button>
                        @endif
                        @if($book->is_free && $book->pdf_file)
                            <a href="{{ asset('storage/' . $book->pdf_file) }}"
                               class="btn btn-success btn-sm flex-fill"
                               download>
                                <i class="fas fa-download me-1"></i>Download
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Book Information -->
        <div class="col-lg-7 col-md-6">
            <div class="card border-0 shadow-lg h-100">
                <div class="card-body p-4">
                    <!-- Title and Author -->
                    <div class="mb-3">
                        <h1 class="h2 fw-bold text-dark mb-2">{{ $book->title }}</h1>
                        <p class="text-muted fs-5 mb-0">by <span class="text-primary fw-semibold">{{ $book->author->name }}</span></p>
                    </div>

                    <!-- Rating and Reviews -->
                    <div class="d-flex align-items-center mb-3">
                        <div class="me-3">
                            @php
                                $avgRating = $book->reviews()->where('is_approved', true)->avg('rating') ?? 0;
                            @endphp
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= $avgRating ? 'text-warning' : 'text-muted' }}"></i>
                            @endfor
                        </div>
                        <span class="text-muted small">
                            ({{ $book->reviews()->where('is_approved', true)->count() }} reviews)
                        </span>
                    </div>

                    <!-- Price Section -->
                    <div class="mb-4">
                        @if($book->is_free)
                            <div class="d-flex align-items-center">
                                <span class="h2 text-success fw-bold me-3">
                                    <i class="fas fa-gift me-2"></i>FREE
                                </span>
                                <span class="badge bg-success fs-6">Free Download Available</span>
                            </div>
                        @else
                            <div class="d-flex align-items-center">
                                <span class="h2 text-primary fw-bold me-3">{{ $book->formatted_price }}</span>
                                <span class="badge bg-warning text-dark fs-6">Paid Book</span>
                            </div>
                        @endif
                    </div>

                    <!-- Stock Status -->
                    <div class="mb-4">
                        @if($book->stock_quantity > 0)
                            <div class="alert alert-success py-2">
                                <i class="fas fa-check-circle me-2"></i>
                                <strong>In Stock</strong> - {{ $book->stock_quantity }} copies available
                            </div>
                        @else
                            <div class="alert alert-danger py-2">
                                <i class="fas fa-times-circle me-2"></i>
                                <strong>Out of Stock</strong>
                            </div>
                        @endif
                    </div>

                    <!-- Action Buttons -->
                    <div class="row g-2 mb-4">
                        @if(!$book->is_free)
                            @if($book->stock_quantity > 0)
                                <div class="col-12 mb-2">
                                    <form action="{{ route('cart.add', $book) }}" method="POST" class="d-flex gap-2">
                                        @csrf
                                        <div class="flex-grow-1">
                                            <input type="number"
                                                   class="form-control"
                                                   name="quantity"
                                                   value="1"
                                                   min="1"
                                                   max="{{ $book->stock_quantity }}"
                                                   placeholder="Quantity">
                                        </div>
                                        <button type="submit" class="btn btn-primary px-4">
                                            <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                                        </button>
                                    </form>
                                </div>
                            @else
                                <div class="col-12 mb-2">
                                    <button class="btn btn-secondary w-100" disabled>
                                        <i class="fas fa-times me-2"></i>Out of Stock
                                    </button>
                                </div>
                            @endif
                        @endif

                        <!-- PDF View and Share buttons - Always visible -->
                        <div class="col-md-6">
                            @if($book->pdf_file)
                                <button class="btn btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#pdfPreviewModal">
                                    <i class="fas fa-file-pdf me-2"></i>View PDF
                                </button>
                            @else
                                <button class="btn btn-outline-secondary w-100" disabled>
                                    <i class="fas fa-file-pdf me-2"></i>No PDF Available
                                </button>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-outline-info w-100" onclick="navigator.share ? navigator.share({title: '{{ $book->title }}', url: window.location.href}) : alert('Sharing not supported')">
                                <i class="fas fa-share me-2"></i>Share Book
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Book Details Tabs -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 shadow-lg">
                <div class="card-body p-0">
                    <ul class="nav nav-tabs nav-fill" id="bookDetailsTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab">
                                <i class="fas fa-book-open me-2"></i>Description
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab">
                                <i class="fas fa-info-circle me-2"></i>Details
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab">
                                <i class="fas fa-star me-2"></i>Reviews ({{ $book->reviews()->where('is_approved', true)->count() }})
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content p-4" id="bookDetailsContent">
                        <!-- Description Tab -->
                        <div class="tab-pane fade show active" id="description" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-8">
                                    <h4 class="mb-3">About This Book</h4>
                                    <p class="lead">{{ $book->description }}</p>
                                </div>
                                <div class="col-lg-4">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <h6 class="card-title">Book Highlights</h6>
                                            <ul class="list-unstyled mb-0">
                                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i> High-quality content</li>
                                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Expert author</li>
                                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Engaging narrative</li>
                                                <li class="mb-0"><i class="fas fa-check text-success me-2"></i> Perfect for readers</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Details Tab -->
                        <div class="tab-pane fade" id="details" role="tabpanel">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="mb-3">Book Information</h5>
                                    <table class="table table-borderless">
                                        <tr>
                                            <td class="text-muted" width="40%">Title:</td>
                                            <td class="fw-semibold">{{ $book->title }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Author:</td>
                                            <td class="fw-semibold">{{ $book->author->name }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Category:</td>
                                            <td class="fw-semibold">{{ $book->category->name }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Pages:</td>
                                            <td class="fw-semibold">{{ $book->pages ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">ISBN:</td>
                                            <td class="fw-semibold">{{ $book->isbn ?? 'N/A' }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="mb-3">Publication Details</h5>
                                    <table class="table table-borderless">
                                        <tr>
                                            <td class="text-muted" width="40%">Published:</td>
                                            <td class="fw-semibold">{{ $book->published_date ? $book->published_date->format('M d, Y') : 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Language:</td>
                                            <td class="fw-semibold">English</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Format:</td>
                                            <td class="fw-semibold">Paperback</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Price:</td>
                                            <td class="fw-semibold">{{ $book->is_free ? 'FREE' : $book->formatted_price }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Stock:</td>
                                            <td class="fw-semibold">{{ $book->stock_quantity }} available</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Reviews Tab -->
                        <div class="tab-pane fade" id="reviews" role="tabpanel">
                            @if($book->reviews()->where('is_approved', true)->count() > 0)
                                <div class="row mb-4">
                                    @foreach($book->reviews()->where('is_approved', true)->latest()->get() as $review)
                                        <div class="col-md-6 mb-4">
                                            <div class="card h-100 border-0 shadow-sm">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                                        <div>
                                                            <h6 class="card-title mb-1">{{ $review->user->name }}</h6>
                                                            <div class="mb-2">
                                                                @for($i = 1; $i <= 5; $i++)
                                                                    <i class="fas fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-muted' }}"></i>
                                                                @endfor
                                                            </div>
                                                        </div>
                                                        <small class="text-muted">{{ $review->created_at->format('M d, Y') }}</small>
                                                    </div>
                                                    <p class="card-text">{{ $review->comment }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-5">
                                    <i class="fas fa-star fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">No reviews yet</h5>
                                    <p class="text-muted">Be the first to review this book!</p>
                                </div>
                            @endif

                            <!-- Write Review Form -->
                            @auth
                                @if(!$book->reviews()->where('user_id', Auth::id())->exists())
                                    <div class="card border-0 shadow-sm">
                                        <div class="card-header bg-light">
                                            <h5 class="mb-0">Write a Review</h5>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{ route('reviews.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="book_id" value="{{ $book->id }}">

                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label fw-semibold">Rating</label>
                                                        <select class="form-select" name="rating" required>
                                                            <option value="">Select Rating</option>
                                                            <option value="5">⭐⭐⭐⭐⭐ Excellent</option>
                                                            <option value="4">⭐⭐⭐⭐ Very Good</option>
                                                            <option value="3">⭐⭐⭐ Good</option>
                                                            <option value="2">⭐⭐ Fair</option>
                                                            <option value="1">⭐ Poor</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label fw-semibold">Your Name</label>
                                                        <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold">Your Review</label>
                                                    <textarea class="form-control" name="comment" rows="4" placeholder="Share your thoughts about this book..." required></textarea>
                                                </div>

                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-paper-plane me-2"></i>Submit Review
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @else
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i>
                                        You have already reviewed this book.
                                    </div>
                                @endif
                            @else
                                <div class="alert alert-warning">
                                    <i class="fas fa-sign-in-alt me-2"></i>
                                    Please <a href="{{ route('login') }}" class="alert-link">login</a> to write a review.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Books Section -->
    @if($relatedBooks->count() > 0)
        <div class="row mb-5">
            <div class="col-12">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-white border-0 py-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="mb-0 fw-bold text-primary">Related Books</h3>
                                <p class="text-muted mb-0">You might also like these books</p>
                            </div>
                            <a href="{{ route('books.index') }}" class="btn btn-outline-primary">
                                View All Books
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($relatedBooks as $relatedBook)
                                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                    <div class="card h-100 border-0 shadow-sm hover-lift">
                                        @if($relatedBook->cover_image)
                                            <img src="{{ asset('storage/' . $relatedBook->cover_image) }}"
                                                 class="card-img-top"
                                                 alt="{{ $relatedBook->title }}"
                                                 style="height: 250px; object-fit: cover;">
                                        @else
                                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center"
                                                 style="height: 250px;">
                                                <i class="fas fa-book fa-2x text-muted"></i>
                                            </div>
                                        @endif
                                        <div class="card-body d-flex flex-column">
                                            <h6 class="card-title fw-bold mb-1">{{ Str::limit($relatedBook->title, 35) }}</h6>
                                            <p class="card-text text-muted small mb-2">by {{ $relatedBook->author->name }}</p>

                                            <div class="mt-auto">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <span class="fw-bold text-primary">{{ $relatedBook->formatted_price }}</span>
                                                    @if($relatedBook->stock_quantity > 0)
                                                        <span class="badge bg-success">In Stock</span>
                                                    @else
                                                        <span class="badge bg-danger">Out of Stock</span>
                                                    @endif
                                                </div>
                                                <a href="{{ route('books.show', $relatedBook) }}"
                                                   class="btn btn-outline-primary btn-sm w-100">
                                                    View Details
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<!-- PDF Preview Modal -->
@if($book->pdf_file)
<div class="modal fade" id="pdfPreviewModal" tabindex="-1" aria-labelledby="pdfPreviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdfPreviewModalLabel">
                    <i class="fas fa-file-pdf me-2"></i>PDF Preview: {{ $book->title }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <iframe src="{{ asset('storage/' . $book->pdf_file) }}"
                        width="100%"
                        height="600px"
                        style="border: none;"
                        title="PDF Preview">
                    <p>Your browser does not support PDFs.
                    <a href="{{ asset('storage/' . $book->pdf_file) }}" target="_blank">Download the PDF</a>.</p>
                </iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                @if($book->is_free)
                    <a href="{{ asset('storage/' . $book->pdf_file) }}" class="btn btn-success" download>
                        <i class="fas fa-download me-2"></i>Download PDF
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endif
@endsection

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
}

.hover-lift:hover {
    transform: translateY(-5px);
    transition: transform 0.3s ease;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15) !important;
}

.nav-tabs .nav-link {
    border: none;
    border-bottom: 3px solid transparent;
    color: #6c757d;
    font-weight: 500;
}

.nav-tabs .nav-link.active {
    background-color: transparent;
    border-bottom-color: #007bff;
    color: #007bff;
}

.nav-tabs .nav-link:hover {
    border-bottom-color: #007bff;
    color: #007bff;
}

.card {
    transition: all 0.3s ease;
}

.card:hover {
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1) !important;
}

.btn {
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.alert {
    border: none;
    border-radius: 10px;
}

.badge {
    font-size: 0.75em;
    padding: 0.5em 0.75em;
}

.table-borderless td {
    border: none;
    padding: 0.75rem 0;
}
</style>
