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
                    <li class="nav-item mb-2">
                        <a class="nav-link d-flex align-items-center rounded {{ request()->routeIs('admin.books.statistics') ? 'active bg-primary text-white' : 'text-muted' }}" 
                           href="{{ route('admin.books.statistics') }}">
                            <i class="fas fa-chart-line me-3"></i>
                            <span>Statistics</span>
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
            <!-- Header -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-3 mb-4 border-bottom">
                <div>
                    <h1 class="h2 fw-bold text-dark">Dashboard</h1>
                    <p class="text-muted mb-0">Welcome back! Here's what's happening with your store today.</p>
                </div>
                <div class="btn-toolbar">
                    <div class="btn-group me-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                    </div>
                    <button type="button" class="btn btn-sm btn-primary">
                        <i class="fas fa-download me-1"></i> Download Report
                    </button>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row g-4 mb-4">
                <div class="col-xl-3 col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <div class="small text-muted mb-1">Total Users</div>
                                    <div class="h3 mb-0 fw-bold">{{ \App\Models\User::count() }}</div>
                                    <div class="small text-success">
                                        <i class="fas fa-arrow-up"></i> 12% from last month
                                    </div>
                                </div>
                                <div class="ms-3">
                                    <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                                        <i class="fas fa-users text-primary fs-4"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <div class="small text-muted mb-1">Total Books</div>
                                    <div class="h3 mb-0 fw-bold">{{ \App\Models\Book::count() }}</div>
                                    <div class="small text-success">
                                        <i class="fas fa-arrow-up"></i> 8% from last month
                                    </div>
                                </div>
                                <div class="ms-3">
                                    <div class="bg-success bg-opacity-10 rounded-circle p-3">
                                        <i class="fas fa-book text-success fs-4"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <div class="small text-muted mb-1">Categories</div>
                                    <div class="h3 mb-0 fw-bold">{{ \App\Models\Category::count() }}</div>
                                    <div class="small text-info">
                                        <i class="fas fa-minus"></i> No change
                                    </div>
                                </div>
                                <div class="ms-3">
                                    <div class="bg-info bg-opacity-10 rounded-circle p-3">
                                        <i class="fas fa-tags text-info fs-4"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <div class="small text-muted mb-1">Total Orders</div>
                                    <div class="h3 mb-0 fw-bold">{{ \App\Models\Order::count() }}</div>
                                    <div class="small text-success">
                                        <i class="fas fa-arrow-up"></i> 23% from last month
                                    </div>
                                </div>
                                <div class="ms-3">
                                    <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                                        <i class="fas fa-shopping-bag text-warning fs-4"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts and Recent Activity -->
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-0 pt-4 pb-3">
                            <h5 class="card-title mb-0 fw-bold">Sales Overview</h5>
                            <p class="text-muted small mb-0">Monthly sales performance</p>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-center" style="height: 300px;">
                                <div class="text-center text-muted">
                                    <i class="fas fa-chart-line fa-3x mb-3"></i>
                                    <h6>Sales Chart</h6>
                                    <p class="small">Chart integration coming soon</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-0 pt-4 pb-3">
                            <h5 class="card-title mb-0 fw-bold">Recent Activity</h5>
                            <p class="text-muted small mb-0">Latest system updates</p>
                        </div>
                        <div class="card-body">
                            <div class="timeline">
                                <div class="timeline-item mb-3">
                                    <div class="d-flex">
                                        <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                                            <i class="fas fa-check text-success small"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="small fw-bold">New order received</div>
                                            <div class="text-muted small">2 minutes ago</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="timeline-item mb-3">
                                    <div class="d-flex">
                                        <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                            <i class="fas fa-user text-primary small"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="small fw-bold">New user registered</div>
                                            <div class="text-muted small">15 minutes ago</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="timeline-item mb-3">
                                    <div class="d-flex">
                                        <div class="bg-info bg-opacity-10 rounded-circle p-2 me-3">
                                            <i class="fas fa-book text-info small"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="small fw-bold">New book added</div>
                                            <div class="text-muted small">1 hour ago</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="d-flex">
                                        <div class="bg-warning bg-opacity-10 rounded-circle p-2 me-3">
                                            <i class="fas fa-star text-warning small"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="small fw-bold">New review posted</div>
                                            <div class="text-muted small">2 hours ago</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="row g-4 mt-2">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-0 pt-4 pb-3">
                            <h5 class="card-title mb-0 fw-bold">Quick Actions</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-3 col-6">
                                    <a href="{{ route('admin.books.create') }}" class="text-decoration-none">
                                        <div class="text-center p-3 border rounded-3 hover-bg-light">
                                            <i class="fas fa-plus-circle text-primary fs-2 mb-2"></i>
                                            <div class="small fw-bold">Add New Book</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-3 col-6">
                                    <a href="{{ route('admin.orders.index') }}" class="text-decoration-none">
                                        <div class="text-center p-3 border rounded-3 hover-bg-light">
                                            <i class="fas fa-shopping-bag text-success fs-2 mb-2"></i>
                                            <div class="small fw-bold">View Orders</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-3 col-6">
                                    <a href="{{ route('admin.users.index') }}" class="text-decoration-none">
                                        <div class="text-center p-3 border rounded-3 hover-bg-light">
                                            <i class="fas fa-users text-info fs-2 mb-2"></i>
                                            <div class="small fw-bold">Manage Users</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-3 col-6">
                                    <a href="{{ route('admin.books.statistics') }}" class="text-decoration-none">
                                        <div class="text-center p-3 border rounded-3 hover-bg-light">
                                            <i class="fas fa-chart-line text-warning fs-2 mb-2"></i>
                                            <div class="small fw-bold">View Statistics</div>
                                        </div>
                                    </a>
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
