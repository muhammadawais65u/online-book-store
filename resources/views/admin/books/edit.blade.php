@extends('layouts.app')

@section('content')
@include('layouts.admin-header')

<div class="container-fluid main-content">
    <div class="row">
        <!-- Modern Sidebar -->
        <nav class="col-md-3 col-lg-2 d-md-block bg-white sidebar shadow-sm">
            <div class="position-sticky pt-3">
                <div class="text-center mb-4">
                    <h4 class="text-primary fw-bold">Admin Panel</h4>
                    <small class="text-muted">Online Book Store</small>
                </div>

                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a class="nav-link d-flex align-items-center rounded {{ request()->routeIs('admin.dashboard') ? 'active bg-primary text-white' : 'text-muted' }}"
                           href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-home me-3"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <!-- Users Section -->
                    <li class="nav-item">
                        <div class="nav-section-title text-uppercase text-muted small fw-bold mb-2 px-3">Users</div>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link d-flex align-items-center rounded {{ request()->routeIs('admin.users.*') ? 'active bg-primary text-white' : 'text-muted' }}"
                           href="{{ route('admin.users.index') }}">
                            <i class="fas fa-users me-3"></i>
                            <span>User Management</span>
                        </a>
                    </li>

                    <!-- Books Section -->
                    <li class="nav-item">
                        <div class="nav-section-title text-uppercase text-muted small fw-bold mb-2 px-3 mt-3">Books</div>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link d-flex align-items-center rounded {{ request()->routeIs('admin.books.index') ? 'active bg-primary text-white' : 'text-muted' }}"
                           href="{{ route('admin.books.index') }}">
                            <i class="fas fa-book me-3"></i>
                            <span>All Books</span>
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link d-flex align-items-center rounded {{ request()->routeIs('admin.books.create') ? 'active bg-primary text-white' : 'text-muted' }}"
                           href="{{ route('admin.books.create') }}">
                            <i class="fas fa-plus-circle me-3"></i>
                            <span>Add Book</span>
                        </a>
                    </li>

                    <!-- Authors Section -->
                    <li class="nav-item">
                        <div class="nav-section-title text-uppercase text-muted small fw-bold mb-2 px-3 mt-3">Authors</div>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link d-flex align-items-center rounded {{ request()->routeIs('admin.authors.index') ? 'active bg-primary text-white' : 'text-muted' }}"
                           href="{{ route('admin.authors.index') }}">
                            <i class="fas fa-user-edit me-3"></i>
                            <span>Authors List</span>
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link d-flex align-items-center rounded {{ request()->routeIs('admin.authors.create') ? 'active bg-primary text-white' : 'text-muted' }}"
                           href="{{ route('admin.authors.create') }}">
                            <i class="fas fa-user-plus me-3"></i>
                            <span>Add Author</span>
                        </a>
                    </li>

                    <!-- Categories Section -->
                    <li class="nav-item">
                        <div class="nav-section-title text-uppercase text-muted small fw-bold mb-2 px-3 mt-3">Categories</div>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link d-flex align-items-center rounded {{ request()->routeIs('admin.categories.index') ? 'active bg-primary text-white' : 'text-muted' }}"
                           href="{{ route('admin.categories.index') }}">
                            <i class="fas fa-tags me-3"></i>
                            <span>Categories</span>
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link d-flex align-items-center rounded {{ request()->routeIs('admin.categories.create') ? 'active bg-primary text-white' : 'text-muted' }}"
                           href="{{ route('admin.categories.create') }}">
                            <i class="fas fa-plus me-3"></i>
                            <span>Add Category</span>
                        </a>
                    </li>

                    <!-- Orders Section -->
                    <li class="nav-item">
                        <div class="nav-section-title text-uppercase text-muted small fw-bold mb-2 px-3 mt-3">Orders</div>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link d-flex align-items-center rounded {{ request()->routeIs('admin.orders.*') ? 'active bg-primary text-white' : 'text-muted' }}"
                           href="{{ route('admin.orders.index') }}">
                            <i class="fas fa-shopping-bag me-3"></i>
                            <span>Orders</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-3 mb-4 border-bottom">
                <div>
                    <h1 class="h2 fw-bold text-dark">Edit Book</h1>
                    <p class="text-muted mb-0">Update book information</p>
                </div>
                <div class="btn-toolbar">
                    <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Back to Books
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Book Information</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.books.update', $book) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Title</label>
                                            <input type="text"
                                                   class="form-control @error('title') is-invalid @enderror"
                                                   id="title"
                                                   name="title"
                                                   value="{{ old('title', $book->title) }}"
                                                   placeholder="Enter book title"
                                                   required>
                                            @error('title')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="isbn" class="form-label">ISBN</label>
                                            <input type="text"
                                                   class="form-control @error('isbn') is-invalid @enderror"
                                                   id="isbn"
                                                   name="isbn"
                                                   value="{{ old('isbn', $book->isbn) }}"
                                                   placeholder="Enter ISBN"
                                                   required>
                                            @error('isbn')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="author_id" class="form-label">Author</label>
                                            <select class="form-select @error('author_id') is-invalid @enderror"
                                                    id="author_id"
                                                    name="author_id"
                                                    required>
                                                <option value="">Select Author</option>
                                                @foreach($authors as $author)
                                                    <option value="{{ $author->id }}" {{ old('author_id', $book->author_id) == $author->id ? 'selected' : '' }}>
                                                        {{ $author->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('author_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="category_id" class="form-label">Category</label>
                                            <select class="form-select @error('category_id') is-invalid @enderror"
                                                    id="category_id"
                                                    name="category_id"
                                                    required>
                                                <option value="">Select Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                              id="description"
                                              name="description"
                                              rows="4"
                                              placeholder="Enter book description"
                                              required>{{ old('description', $book->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="price" class="form-label">Price</label>
                                            <input type="number"
                                                   step="0.01"
                                                   min="0"
                                                   class="form-control @error('price') is-invalid @enderror"
                                                   id="price"
                                                   name="price"
                                                   value="{{ old('price', $book->price) }}"
                                                   placeholder="0.00">
                                            @error('price')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="stock_quantity" class="form-label">Stock Quantity</label>
                                            <input type="number"
                                                   min="0"
                                                   class="form-control @error('stock_quantity') is-invalid @enderror"
                                                   id="stock_quantity"
                                                   name="stock_quantity"
                                                   value="{{ old('stock_quantity', $book->stock_quantity) }}"
                                                   placeholder="0">
                                            @error('stock_quantity')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <div class="form-check mt-4">
                                                <input class="form-check-input" type="checkbox" id="is_free" name="is_free" {{ old('is_free', $book->is_free) ? 'checked' : '' }} onchange="togglePriceField()">
                                                <label class="form-check-label" for="is_free">
                                                    <i class="fas fa-gift me-2"></i>Free Book
                                                </label>
                                            </div>
                                            <small class="form-text text-muted">Check if this book is available for free download</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <div class="form-check mt-4">
                                                <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" {{ old('is_featured', $book->is_featured) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="is_featured">
                                                    <i class="fas fa-star me-2"></i>Featured Book
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="pages" class="form-label">Pages</label>
                                            <input type="number"
                                                   min="1"
                                                   class="form-control @error('pages') is-invalid @enderror"
                                                   id="pages"
                                                   name="pages"
                                                   value="{{ old('pages', $book->pages) }}"
                                                   placeholder="0"
                                                   required>
                                            @error('pages')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="published_date" class="form-label">Published Date</label>
                                            <input type="date"
                                                   class="form-control @error('published_date') is-invalid @enderror"
                                                   id="published_date"
                                                   name="published_date"
                                                   value="{{ old('published_date', $book->published_date ? $book->published_date->format('Y-m-d') : '') }}"
                                                   required>
                                            @error('published_date')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="language" class="form-label">Language</label>
                                            <select class="form-select @error('language') is-invalid @enderror"
                                                    id="language"
                                                    name="language"
                                                    required>
                                                <option value="">Select Language</option>
                                                <option value="en" {{ old('language', 'en') == 'en' ? 'selected' : '' }}>English</option>
                                                <option value="ur" {{ old('language', 'ur') == 'ur' ? 'selected' : '' }}>Urdu</option>
                                                <option value="hi" {{ old('language', 'hi') == 'hi' ? 'selected' : '' }}>Hindi</option>
                                            </select>
                                            @error('language')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="cover_image" class="form-label">Cover Image</label>
                                            <input type="file"
                                                   class="form-control @error('cover_image') is-invalid @enderror"
                                                   id="cover_image"
                                                   name="cover_image"
                                                   accept="image/*">
                                            <small class="form-text text-muted">Leave empty to keep current image</small>
                                            @if($book->cover_image)
                                                <div class="mt-2">
                                                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Current cover" style="max-width: 100px; max-height: 100px;">
                                                </div>
                                            @endif
                                            @error('cover_image')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="pdf_file" class="form-label">
                                                <i class="fas fa-file-pdf me-2"></i>PDF File
                                                <span class="badge bg-success ms-2">For All Books</span>
                                            </label>
                                            <input type="file"
                                                   class="form-control @error('pdf_file') is-invalid @enderror"
                                                   id="pdf_file"
                                                   name="pdf_file"
                                                   accept="application/pdf">
                                            <small class="form-text text-muted">Leave empty to keep current PDF file</small>
                                            @if($book->pdf_file)
                                                <div class="mt-2">
                                                    <i class="fas fa-file-pdf text-danger me-2"></i>
                                                    <small class="text-muted">Current PDF: {{ basename($book->pdf_file) }}</small>
                                                </div>
                                            @endif
                                            @error('pdf_file')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn btn-primary">
                                        Update Book
                                    </button>
                                    <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">
                                        Cancel
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

@include('layouts.admin-footer')

<style>
.main-content {
    min-height: calc(100vh - 80px);
    padding-top: 80px;
}

.sidebar {
    position: fixed;
    top: 80px;
    bottom: 0;
    left: 0;
    z-index: 100;
    height: calc(100vh - 80px);
    border-right: 1px solid #e9ecef;
}

.nav-section-title {
    font-size: 0.75rem;
    letter-spacing: 0.5px;
}

.nav-link {
    padding: 0.75rem 1rem;
    margin: 0 0.5rem;
    border-radius: 0.5rem;
    transition: all 0.3s ease;
}

.nav-link:hover {
    background-color: #f8f9fa;
    color: #0d6efd !important;
}

.nav-link.active {
    box-shadow: 0 2px 4px rgba(13, 110, 253, 0.1);
}

main {
    margin-left: 0;
}

@media (max-width: 767.98px) {
    .sidebar {
        position: static;
        height: auto;
        border-right: none;
        border-bottom: 1px solid #e9ecef;
    }

    main {
        margin-left: 0;
    }

    .main-content {
        padding-top: 140px;
    }
}

.hover-bg-light:hover {
    background-color: #f8f9fa;
    transition: background-color 0.3s ease;
}

.timeline-item {
    position: relative;
}

.timeline-item:not(:last-child)::after {
    content: '';
    position: absolute;
    left: 11px;
    top: 40px;
    width: 1px;
    height: 20px;
    background-color: #e9ecef;
}

.card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1) !important;
}

.price-field {
    transition: opacity 0.3s ease;
}

.price-field.disabled {
    opacity: 0.5;
}
</style>

<script>
function togglePriceField() {
    const isFree = document.getElementById('is_free').checked;
    const priceField = document.getElementById('price');
    const priceContainer = priceField.closest('.mb-3');

    if (isFree) {
        priceField.value = '0.00';
        priceField.disabled = true;
        priceContainer.classList.add('disabled');
    } else {
        priceField.disabled = false;
        priceContainer.classList.remove('disabled');
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    togglePriceField();
});
</script>
@endsection
