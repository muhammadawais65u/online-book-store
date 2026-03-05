@extends('layouts.customer')

@section('customer-content')
    <!-- Welcome Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm bg-gradient-primary text-white">
                <div class="card-body py-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h1 class="h2 fw-bold mb-2">Welcome back, {{ Auth::user()->name }}!</h1>
                            <p class="mb-0 opacity-75">Discover your next favorite book and manage your orders</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('books.index') }}" class="btn btn-light btn-lg">
                                    <i class="fas fa-book me-2"></i>Browse Books
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="small text-muted mb-1">Total Orders</div>
                            <div class="h3 mb-0 fw-bold">{{ Auth::user()->orders()->count() }}</div>
                            <div class="small text-success">
                                <i class="fas fa-shopping-bag me-1"></i> Active orders
                            </div>
                        </div>
                        <div class="ms-3">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                                <i class="fas fa-shopping-bag text-primary fs-4"></i>
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
                            <div class="small text-muted mb-1">Cart Items</div>
                            <div class="h3 mb-0 fw-bold">{{ Auth::user()->cart ? Auth::user()->cart->cartItems()->count() : 0 }}</div>
                            <div class="small text-info">
                                <i class="fas fa-cart-plus me-1"></i> Ready to checkout
                            </div>
                        </div>
                        <div class="ms-3">
                            <div class="bg-success bg-opacity-10 rounded-circle p-3">
                                <i class="fas fa-shopping-cart text-success fs-4"></i>
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
                            <div class="small text-muted mb-1">Total Spent</div>
                            <div class="h3 mb-0 fw-bold">${{ number_format(Auth::user()->orders()->sum('total_amount'), 2) }}</div>
                            <div class="small text-warning">
                                <i class="fas fa-dollar-sign me-1"></i> On books
                            </div>
                        </div>
                        <div class="ms-3">
                            <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                                <i class="fas fa-dollar-sign text-warning fs-4"></i>
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
                            <div class="small text-muted mb-1">Favorite Category</div>
                            <div class="h6 mb-0 fw-bold">
                                @php
                                    $topCategory = Auth::user()->orders()
                                        ->join('order_items', 'orders.id', '=', 'order_items.order_id')
                                        ->join('books', 'order_items.book_id', '=', 'books.id')
                                        ->join('categories', 'books.category_id', '=', 'categories.id')
                                        ->select('categories.name')
                                        ->groupBy('categories.id', 'categories.name')
                                        ->orderByRaw('COUNT(*) DESC')
                                        ->first();
                                @endphp
                                {{ $topCategory ? $topCategory->name : 'No orders yet' }}
                            </div>
                            <div class="small text-info">
                                <i class="fas fa-heart me-1"></i> Most purchased
                            </div>
                        </div>
                        <div class="ms-3">
                            <div class="bg-info bg-opacity-10 rounded-circle p-3">
                                <i class="fas fa-heart text-info fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row g-4">
        <!-- Recent Orders -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title mb-0 fw-bold">Recent Orders</h5>
                            <p class="text-muted small mb-0">Your latest book purchases</p>
                        </div>
                        <a href="{{ route('orders.index') }}" class="btn btn-outline-primary btn-sm">
                            View All Orders
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @php
                        $recentOrders = Auth::user()->orders()
                            ->with(['orderItems.book'])
                            ->latest()
                            ->take(5)
                            ->get();
                    @endphp

                    @if($recentOrders->count() > 0)
                        <div class="timeline">
                            @foreach($recentOrders as $order)
                            <div class="timeline-item mb-4">
                                <div class="d-flex">
                                    <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                        <i class="fas fa-shopping-bag text-primary small"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <div class="fw-bold">Order #{{ $order->order_number }}</div>
                                                <div class="text-muted small">{{ $order->created_at->format('M d, Y') }}</div>
                                                <div class="small text-muted">
                                                    {{ $order->orderItems->count() }} item(s) • ${{ number_format($order->total_amount, 2) }}
                                                </div>
                                            </div>
                                            <div class="text-end">
                                                <span class="badge
                                                    @if($order->status === 'pending') bg-warning text-dark
                                                    @elseif($order->status === 'processing') bg-info
                                                    @elseif($order->status === 'shipped') bg-primary
                                                    @elseif($order->status === 'delivered') bg-success
                                                    @else bg-secondary
                                                    @endif">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                                <br>
                                                <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-outline-primary mt-2">
                                                    View Details
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-shopping-bag fa-3x text-muted mb-3"></i>
                            <h6 class="text-muted">No orders yet</h6>
                            <p class="text-muted small">Your order history will appear here</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Quick Actions & Activity -->
        <div class="col-lg-4">
            <!-- Quick Actions -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="card-title mb-0 fw-bold">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <a href="{{ route('books.index') }}" class="text-decoration-none">
                                <div class="d-flex align-items-center p-3 border rounded-3 hover-bg-light">
                                    <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                        <i class="fas fa-book text-primary fs-5"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="fw-bold">Browse Books</div>
                                        <div class="small text-muted">Discover new titles</div>
                                    </div>
                                    <i class="fas fa-chevron-right text-muted"></i>
                                </div>
                            </a>
                        </div>
                        <div class="col-12">
                            <a href="{{ route('cart.index') }}" class="text-decoration-none">
                                <div class="d-flex align-items-center p-3 border rounded-3 hover-bg-light">
                                    <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                                        <i class="fas fa-shopping-cart text-success fs-5"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="fw-bold">Shopping Cart</div>
                                        <div class="small text-muted">View your cart items</div>
                                    </div>
                                    <i class="fas fa-chevron-right text-muted"></i>
                                </div>
                            </a>
                        </div>
                        <div class="col-12">
                            <a href="{{ route('orders.index') }}" class="text-decoration-none">
                                <div class="d-flex align-items-center p-3 border rounded-3 hover-bg-light">
                                    <div class="bg-info bg-opacity-10 rounded-circle p-2 me-3">
                                        <i class="fas fa-history text-info fs-5"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="fw-bold">Order History</div>
                                        <div class="small text-muted">Track your purchases</div>
                                    </div>
                                    <i class="fas fa-chevron-right text-muted"></i>
                                </div>
                            </a>
                        </div>
                        <div class="col-12">
                            <a href="{{ route('profile.edit') }}" class="text-decoration-none">
                                <div class="d-flex align-items-center p-3 border rounded-3 hover-bg-light">
                                    <div class="bg-warning bg-opacity-10 rounded-circle p-2 me-3">
                                        <i class="fas fa-user text-warning fs-5"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="fw-bold">Profile Settings</div>
                                        <div class="small text-muted">Update your information</div>
                                    </div>
                                    <i class="fas fa-chevron-right text-muted"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Activity Summary -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="card-title mb-0 fw-bold">Activity Summary</h5>
                    <p class="text-muted small mb-0">Your recent activity</p>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item mb-3">
                            <div class="d-flex">
                                <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                                    <i class="fas fa-sign-in-alt text-success small"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="small fw-bold">Last login</div>
                                    <div class="text-muted small">Today at {{ now()->format('h:i A') }}</div>
                                </div>
                            </div>
                        </div>

                        @if($recentOrders->count() > 0)
                        <div class="timeline-item mb-3">
                            <div class="d-flex">
                                <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                    <i class="fas fa-shopping-bag text-primary small"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="small fw-bold">Last order</div>
                                    <div class="text-muted small">{{ $recentOrders->first()->created_at->diffForHumans() }}</div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="timeline-item">
                            <div class="d-flex">
                                <div class="bg-info bg-opacity-10 rounded-circle p-2 me-3">
                                    <i class="fas fa-user text-info small"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="small fw-bold">Member since</div>
                                    <div class="text-muted small">{{ Auth::user()->created_at->format('M Y') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
