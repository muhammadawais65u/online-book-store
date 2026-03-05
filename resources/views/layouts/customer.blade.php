@extends('layouts.app')

@section('content')
@include('layouts.customer-header')

<div class="container-fluid main-content">
    <div class="row">
        <!-- Customer Sidebar -->
        <nav class="col-md-3 col-lg-2 d-md-block bg-white sidebar shadow-sm">
            <div class="position-sticky pt-3">
                <div class="text-center mb-4">
                    <h4 class="text-success fw-bold">Customer Portal</h4>
                    <small class="text-muted">Online Book Store</small>
                </div>

                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a class="nav-link d-flex align-items-center rounded {{ request()->routeIs('customer.dashboard') ? 'active bg-success text-white' : 'text-muted' }}"
                           href="{{ route('customer.dashboard') }}">
                            <i class="fas fa-home me-3"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <!-- Shopping Section -->
                    <li class="nav-item">
                        <div class="nav-section-title text-uppercase text-muted small fw-bold mb-2 px-3 mt-3">Shopping</div>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link d-flex align-items-center rounded {{ request()->routeIs('books.index') ? 'active bg-success text-white' : 'text-muted' }}"
                           href="{{ route('books.index') }}">
                            <i class="fas fa-book me-3"></i>
                            <span>Browse Books</span>
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link d-flex align-items-center rounded {{ request()->routeIs('cart.index') ? 'active bg-success text-white' : 'text-muted' }}"
                           href="{{ route('cart.index') }}">
                            <i class="fas fa-shopping-cart me-3"></i>
                            <span>Shopping Cart</span>
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link d-flex align-items-center rounded {{ request()->routeIs('orders.*') ? 'active bg-success text-white' : 'text-muted' }}"
                           href="{{ route('orders.index') }}">
                            <i class="fas fa-shopping-bag me-3"></i>
                            <span>My Orders</span>
                        </a>
                    </li>

                    <!-- Account Section -->
                    <li class="nav-item">
                        <div class="nav-section-title text-uppercase text-muted small fw-bold mb-2 px-3 mt-3">Account</div>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link d-flex align-items-center rounded {{ request()->routeIs('profile.edit') ? 'active bg-success text-white' : 'text-muted' }}"
                           href="{{ route('profile.edit') }}">
                            <i class="fas fa-user me-3"></i>
                            <span>Profile Settings</span>
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline w-100">
                            @csrf
                            <button type="submit" class="nav-link d-flex align-items-center rounded text-muted w-100 text-start border-0 bg-transparent">
                                <i class="fas fa-sign-out-alt me-3"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>
                </ul>

                <!-- Quick Stats in Sidebar -->
                <div class="mt-4 px-3">
                    <div class="card bg-light border-0">
                        <div class="card-body text-center">
                            <div class="mb-2">
                                <i class="fas fa-shopping-bag text-success fs-3"></i>
                            </div>
                            <div class="h5 mb-1 fw-bold">{{ Auth::user()->orders()->count() }}</div>
                            <div class="small text-muted">Total Orders</div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            @yield('customer-content')
        </main>
    </div>
</div>

@include('layouts.customer-footer')

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
    color: #198754 !important;
}

.nav-link.active {
    box-shadow: 0 2px 4px rgba(25, 135, 84, 0.1);
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
    background-color: #f8f9fa !important;
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

.badge {
    font-size: 0.75em;
}

.btn {
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

@media (max-width: 767.98px) {
    .bg-gradient-primary .btn {
        width: 100%;
        margin-bottom: 1rem;
    }
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
}
</style>
@endsection
