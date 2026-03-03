<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Online Book Store') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
</head>
<body>
    <!-- Static Header -->
    <header class="bg-white shadow">
        <nav class="navbar navbar-expand-lg navbar-light bg-white">
            <div class="container">
                <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                    <i class="fas fa-book text-primary me-2"></i>
                    Online Book Store
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('books.index') }}">Books</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('books.index') }}">Categories</a>
                        </li>
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Register</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    @if(Auth::user()->isAdmin())
                                        <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                    @else
                                        <li><a class="dropdown-item" href="{{ route('customer.dashboard') }}">Dashboard</a></li>
                                    @endif
                                    <li><hr class="dropdown-divider"></li>
                                    <li><form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form></li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Page Content -->
    <main>
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('message'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="container-fluid p-0">
            <!-- Hero Section -->
            <section class="bg-primary text-white py-5">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <h1 class="display-4 fw-bold mb-4">Welcome to Online Book Store</h1>
                            <p class="lead mb-4">Discover your next favorite book from our extensive collection. Browse through thousands of titles across various genres.</p>
                            <div class="d-flex gap-3">
                                <a href="{{ route('books.index') }}" class="btn btn-light btn-lg">Browse Books</a>
                                @guest
                                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg">Sign In</a>
                                @endguest
                            </div>
                        </div>
                        <div class="col-lg-6 text-center">
                            <i class="fas fa-book-open display-1"></i>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Featured Books Section -->
            <section class="py-5">
                <div class="container">
                    <div class="row mb-4">
                        <div class="col-12">
                            <h2 class="text-center mb-4">Featured Books</h2>
                        </div>
                    </div>

                    @if(isset($featuredBooks) && $featuredBooks->count() > 0)
                        <div class="row">
                            @foreach($featuredBooks as $book)
                                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                    <div class="card h-100 shadow-sm">
                                        @if($book->cover_image)
                                            <img src="{{ asset('storage/' . $book->cover_image) }}" class="card-img-top" alt="{{ $book->title }}" style="height: 300px; object-fit: cover;">
                                        @else
                                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 300px;">
                                                <i class="fas fa-book fa-3x text-muted"></i>
                                            </div>
                                        @endif
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title">{{ Str::limit($book->title, 30) }}</h5>
                                            <p class="card-text text-muted small">by {{ $book->author->name }}</p>
                                            <div class="mt-auto">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <span class="fw-bold text-primary">{{ $book->formatted_price }}</span>
                                                    @if($book->stock_quantity > 0)
                                                        <span class="badge bg-success">In Stock</span>
                                                    @else
                                                        <span class="badge bg-danger">Out of Stock</span>
                                                    @endif
                                                </div>
                                                <div class="btn-group w-100" role="group">
                                                    <a href="{{ route('books.show', $book) }}" class="btn btn-outline-primary btn-sm">View</a>
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
                    @else
                        <div class="text-center py-5">
                            <p class="text-muted">No featured books available at the moment.</p>
                        </div>
                    @endif

                    <div class="text-center mt-4">
                        <a href="{{ route('books.index') }}" class="btn btn-primary">View All Books</a>
                    </div>
                </div>
            </section>

            <!-- Latest Books Section -->
            <section class="py-5">
                <div class="container">
                    <div class="row mb-4">
                        <div class="col-12">
                            <h2 class="text-center mb-4">Latest Books</h2>
                        </div>
                    </div>

                    @if(isset($latestBooks) && $latestBooks->count() > 0)
                        <div class="row">
                            @foreach($latestBooks as $book)
                                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                    <div class="card h-100 shadow-sm">
                                        @if($book->cover_image)
                                            <img src="{{ asset('storage/' . $book->cover_image) }}" class="card-img-top" alt="{{ $book->title }}" style="height: 300px; object-fit: cover;">
                                        @else
                                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 300px;">
                                                <i class="fas fa-book fa-3x text-muted"></i>
                                            </div>
                                        @endif
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title">{{ Str::limit($book->title, 30) }}</h5>
                                            <p class="card-text text-muted small">by {{ $book->author->name }}</p>
                                            <div class="mt-auto">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <span class="fw-bold text-primary">{{ $book->formatted_price }}</span>
                                                    @if($book->stock_quantity > 0)
                                                        <span class="badge bg-success">In Stock</span>
                                                    @else
                                                        <span class="badge bg-danger">Out of Stock</span>
                                                    @endif
                                                </div>
                                                <div class="btn-group w-100" role="group">
                                                    <a href="{{ route('books.show', $book) }}" class="btn btn-outline-primary btn-sm">View</a>
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
                    @else
                        <div class="text-center py-5">
                            <p class="text-muted">No latest books available at the moment.</p>
                        </div>
                    @endif

                    <div class="text-center mt-4">
                        <a href="{{ route('books.index') }}" class="btn btn-outline-primary">View All Latest Books</a>
                    </div>
                </div>
            </section>

            <!-- Categories Section -->
            <section class="bg-light py-5">
                <div class="container">
                    <div class="row mb-4">
                        <div class="col-12">
                            <h2 class="text-center mb-4">Browse by Category</h2>
                        </div>
                    </div>

                    @if(isset($categories) && $categories->count() > 0)
                        <div class="row">
                            @foreach($categories as $category)
                                <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3">
                                    <a href="{{ route('books.index', ['category' => $category->slug]) }}" class="text-decoration-none">
                                        <div class="card h-100 text-center">
                                            <div class="card-body">
                                                <i class="fas fa-bookmark fa-2x text-primary mb-2"></i>
                                                <h6 class="card-title">{{ $category->name }}</h6>
                                                <p class="card-text small text-muted">{{ $category->books()->count() }} books</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <p class="text-muted">No categories available at the moment.</p>
                        </div>
                    @endif
                </div>
            </section>

            <!-- Features Section -->
            <section class="py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="text-center">
                                <i class="fas fa-shipping-fast fa-3x text-primary mb-3"></i>
                                <h4>Fast Delivery</h4>
                                <p class="text-muted">Get your books delivered quickly to your doorstep with our reliable shipping service.</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="text-center">
                                <i class="fas fa-book fa-3x text-primary mb-3"></i>
                                <h4>Wide Selection</h4>
                                <p class="text-muted">Choose from thousands of books across various genres and categories.</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="text-center">
                                <i class="fas fa-shield-alt fa-3x text-primary mb-3"></i>
                                <h4>Secure Payment</h4>
                                <p class="text-muted">Shop with confidence using our secure payment methods.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <!-- Static Footer -->
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
