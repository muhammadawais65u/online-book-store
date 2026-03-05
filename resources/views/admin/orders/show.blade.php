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
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mb-5">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-3 mb-4 border-bottom">
                <div>
                    <h1 class="h2 fw-bold text-dark">Order Details</h1>
                    <p class="text-muted mb-0">View order information</p>
                </div>
                <div class="btn-toolbar">
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Back to Orders
                    </a>
                </div>
            </div>
                    
          
      

        <!-- Main Content -->
        <div class="col-md-9 mx-sm-auto col-lg-10 ">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Order Details - #{{ $order->order_number }}</h1>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Back to Orders</a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-md-8">
                    <!-- Order Items -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Order Items</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Book</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->orderItems as $item)
                                            <tr>
                                                <td>
                                                    <strong>{{ $item->book->title }}</strong><br>
                                                    <small class="text-muted">by {{ $item->book->author->name }}</small>
                                                </td>
                                                <td>{{ $item->book->formatted_price }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ $item->quantity * $item->book->price }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr class="table-dark">
                                            <th colspan="3">Total Amount</th>
                                            <th>{{ $order->formatted_total }}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

       
                   

             


                    <div class="col-md-4">
                        <!-- Order Information -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Order Information</h5>
                            </div>
                            <div class="card-body">
                                <p><strong>Order Number:</strong> {{ $order->order_number }}</p>
                                <p><strong>Status:</strong> 
                                    <span class="badge bg-{{ $order->status_color }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </p>
                                <p><strong>Order Date:</strong> {{ $order->created_at->format('M d, Y H:i') }}</p>
                                <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>
                            </div>
                        </div>

                        <!-- Customer Information -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Customer Information</h5>
                            </div>
                            <div class="card-body">
                                <p><strong>Name:</strong> {{ $order->user->name }}</p>
                                <p><strong>Email:</strong> {{ $order->user->email }}</p>
                                <p><strong>Phone:</strong> {{ $order->phone }}</p>
                            </div>
                        </div>

                        <!-- Shipping Information -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Shipping Address</h5>
                            </div>
                            <div class="card-body">
                                <p>{{ $order->shipping_address }}</p>
                            </div>
                        </div>

                        <!-- Update Status -->
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Update Status</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <select name="status" class="form-select" required>
                                            <option value="">Select Status</option>
                                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">Update Status</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
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
