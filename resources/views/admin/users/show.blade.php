@extends('layouts.app')

@section('content')
@include('layouts.admin-header')

<div class="container-fluid main-content">
    <div class="row">
        <!-- Sidebar -->
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
        <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">User Details - {{ $user->name }}</h1>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Back to Users</a>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <!-- User Information -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">User Information</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>ID:</strong> {{ $user->id }}</p>
                            <p><strong>Name:</strong> {{ $user->name }}</p>
                            <p><strong>Email:</strong> {{ $user->email }}</p>
                            <p><strong>Status:</strong> 
                                @if($user->is_active ?? true)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </p>
                            <p><strong>Joined:</strong> {{ $user->created_at->format('M d, Y H:i') }}</p>
                            @if($user->isAdmin())
                                <p><strong>Role:</strong> <span class="badge bg-danger">Admin</span></p>
                            @endif
                        </div>
                    </div>

                    <!-- Statistics -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Statistics</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Total Orders:</strong> {{ $user->orders->count() }}</p>
                            <p><strong>Total Spent:</strong> ${{ number_format($user->orders->sum('total_amount'), 2) }}</p>
                            <p><strong>Total Books:</strong> {{ $user->orders->flatMap->orderItems->sum('quantity') }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <!-- Purchased Books -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Purchased Books</h5>
                        </div>
                        <div class="card-body">
                            @if($user->orders->flatMap->orderItems->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Book Title</th>
                                                <th>Author</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Order #</th>
                                                <th>Purchase Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($user->orders as $order)
                                                @foreach($order->orderItems as $item)
                                                    <tr>
                                                        <td>
                                                            <strong>{{ $item->book->title }}</strong><br>
                                                            <small class="text-muted">{{ Str::limit($item->book->description, 50) }}</small>
                                                        </td>
                                                        <td>{{ $item->book->author->name }}</td>
                                                        <td>{{ $item->book->formatted_price }}</td>
                                                        <td>{{ $item->quantity }}</td>
                                                        <td>
                                                            <a href="{{ route('admin.orders.show', $order->id) }}" class="text-decoration-none">
                                                                {{ $order->order_number }}
                                                            </a>
                                                        </td>
                                                        <td>{{ $order->created_at->format('M d, Y') }}</td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-book fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">No purchased books</h5>
                                    <p class="text-muted">This user hasn't purchased any books yet.</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Order History -->
                    <div class="card mt-4">
                        <div class="card-header">
                            <h5 class="mb-0">Order History</h5>
                        </div>
                        <div class="card-body">
                            @if($user->orders->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Order #</th>
                                                <th>Total Amount</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($user->orders as $order)
                                                <tr>
                                                    <td>{{ $order->order_number }}</td>
                                                    <td>{{ $order->formatted_total }}</td>
                                                    <td>
                                                        <span class="badge bg-{{ $order->status_color }}">
                                                            {{ ucfirst($order->status) }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $order->created_at->format('M d, Y H:i') }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary">
                                                            <i class="fas fa-eye"></i> View
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">No orders</h5>
                                    <p class="text-muted">This user hasn't placed any orders yet.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
