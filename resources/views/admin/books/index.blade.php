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
                    <h1 class="h2 fw-bold text-dark">Books Management</h1>
                    <p class="text-muted mb-0">Manage your book inventory</p>
                </div>
                <div class="btn-toolbar">
                    <a href="{{ route('admin.books.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i> Add New Book
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($books as $book)
                                    <tr>
                                        <td>{{ $book->id }}</td>
                                        <td>{{ $book->title }}</td>
                                        <td>{{ $book->author->name }}</td>
                                        <td>{{ $book->category->name }}</td>
                                        <td>{{ $book->formatted_price }}</td>
                                        <td>{{ $book->stock_quantity }}</td>
                                        <td>
                                            @if($book->is_active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                            @if($book->is_featured)
                                                <span class="badge bg-warning">Featured</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.books.show', $book) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.books.edit', $book) }}" class="btn btn-sm btn-outline-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.books.destroy', $book) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">No books found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <span>Showing {{ $books->firstItem() }} to {{ $books->lastItem() }} of {{ $books->total() }} books</span>
                        {{ $books->links() }}
                    </div>
                </div>
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
</style>
@endsection
