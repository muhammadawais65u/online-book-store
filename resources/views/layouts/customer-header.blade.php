<!-- Customer Header -->
<header class="customer-header bg-white shadow-sm border-bottom">
    <div class="container-fluid">
        <div class="row align-items-center py-3">
            <!-- Logo and Brand -->
            <div class="col-md-3">
                <div class="d-flex align-items-center">
                    <div class="bg-success rounded-circle p-2 me-3">
                        <i class="fas fa-book text-white"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Online Book Store</h5>
                        <small class="text-muted">Customer Portal</small>
                    </div>
                </div>
            </div>

            <!-- Search Bar -->
            <div class="col-md-6">
                <div class="position-relative">
                    <input type="text"
                           class="form-control ps-5"
                           placeholder="Search books, authors..."
                           id="customerSearch">
                    <i class="fas fa-search position-absolute text-muted"
                       style="left: 15px; top: 50%; transform: translateY(-50%);"></i>
                </div>
            </div>

            <!-- User Actions -->
            <div class="col-md-3">
                <div class="d-flex align-items-center justify-content-end">
                    <!-- Cart -->
                    <a href="{{ route('cart.index') }}" class="btn btn-outline-success position-relative me-3">
                        <i class="fas fa-shopping-cart"></i>
                        @if(Auth::check() && Auth::user()->cart)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ Auth::user()->cart->cartItems()->count() }}
                            </span>
                        @endif
                    </a>

                    <!-- User Menu -->
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary d-flex align-items-center"
                                type="button"
                                data-bs-toggle="dropdown">
                            <div class="bg-light rounded-circle p-2 me-2">
                                <i class="fas fa-user text-muted"></i>
                            </div>
                            <div class="text-start">
                                <div class="fw-bold">{{ Auth::user()->name }}</div>
                                <small class="text-muted">Customer</small>
                            </div>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><h6 class="dropdown-header">{{ Auth::user()->name }}</h6></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('customer.dashboard') }}">
                                    <i class="fas fa-home me-2"></i> Dashboard
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('orders.index') }}">
                                    <i class="fas fa-shopping-bag me-2"></i> My Orders
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="fas fa-user-cog me-2"></i> Profile Settings
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<style>
.customer-header {
    position: sticky;
    top: 0;
    z-index: 1030;
    backdrop-filter: blur(10px);
    background-color: rgba(255, 255, 255, 0.95);
}

.customer-header .form-control {
    border-radius: 25px;
    border: 1px solid #e9ecef;
    padding-left: 45px;
    transition: all 0.3s ease;
}

.customer-header .form-control:focus {
    border-color: #198754;
    box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.25);
}

.customer-header .btn {
    border-radius: 25px;
    transition: all 0.3s ease;
}

.customer-header .btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.customer-header .dropdown-menu {
    border: none;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    margin-top: 10px;
}

.customer-header .dropdown-item {
    padding: 10px 20px;
    transition: all 0.3s ease;
}

.customer-header .dropdown-item:hover {
    background-color: #f8f9fa;
    transform: translateX(5px);
}

.position-absolute {
    position: absolute;
}

.top-0 {
    top: 0;
}

.start-100 {
    left: 100%;
}

.translate-middle {
    transform: translate(-50%, -50%);
}
</style>
