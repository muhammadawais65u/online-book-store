<!-- Customer Footer -->
<footer class="customer-footer bg-light text-dark">
    <div class="container-fluid">
        <div class="row py-4">
            <!-- Company Info -->
            <div class="col-lg-4 col-md-6 mb-4">
                <h6 class="mb-3 fw-bold text-success">Online Book Store</h6>
                <p class="text-muted mb-2">
                    Your trusted online bookstore for quality books and excellent service.
                    Discover your next favorite read and enjoy seamless shopping.
                </p>
                <div class="d-flex gap-3">
                    <a href="#" class="text-success text-decoration-none">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-success text-decoration-none">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-success text-decoration-none">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="text-success text-decoration-none">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-2 col-md-6 mb-4">
                <h6 class="mb-3 fw-bold">Quick Links</h6>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="{{ route('customer.dashboard') }}" class="text-muted text-decoration-none hover-text-success">
                            <i class="fas fa-angle-right me-2"></i>Dashboard
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('books.index') }}" class="text-muted text-decoration-none hover-text-success">
                            <i class="fas fa-angle-right me-2"></i>Browse Books
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('orders.index') }}" class="text-muted text-decoration-none hover-text-success">
                            <i class="fas fa-angle-right me-2"></i>My Orders
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('cart.index') }}" class="text-muted text-decoration-none hover-text-success">
                            <i class="fas fa-angle-right me-2"></i>Shopping Cart
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Support -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h6 class="mb-3 fw-bold">Customer Support</h6>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="#" class="text-muted text-decoration-none hover-text-success">
                            <i class="fas fa-question-circle me-2"></i>Help Center
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-muted text-decoration-none hover-text-success">
                            <i class="fas fa-envelope me-2"></i>Contact Us
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-muted text-decoration-none hover-text-success">
                            <i class="fas fa-truck me-2"></i>Shipping Info
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-muted text-decoration-none hover-text-success">
                            <i class="fas fa-undo me-2"></i>Returns & Refunds
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Customer Stats -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h6 class="mb-3 fw-bold">Your Account</h6>
                <ul class="list-unstyled text-muted">
                    <li class="mb-2">
                        <i class="fas fa-shopping-bag me-2 text-success"></i>
                        {{ Auth::user()->orders()->count() }} Orders Placed
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-heart me-2 text-danger"></i>
                        Favorite Categories
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-calendar me-2 text-primary"></i>
                        Member Since {{ Auth::user()->created_at->format('M Y') }}
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-star me-2 text-warning"></i>
                        Customer Portal
                    </li>
                </ul>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="border-top border-secondary py-3">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0 text-muted">
                        © {{ date('Y') }} Online Book Store. All rights reserved.
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <small class="text-muted">
                        Made with <i class="fas fa-heart text-danger"></i> for book lovers
                    </small>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
.customer-footer {
    margin-top: auto;
    border-top: 1px solid #e9ecef;
}

.hover-text-success:hover {
    color: #198754 !important;
    transition: color 0.3s ease;
}

.customer-footer a {
    transition: all 0.3s ease;
}

.customer-footer a:hover {
    transform: translateX(3px);
}

.customer-footer ul li {
    transition: all 0.3s ease;
}

.customer-footer ul li:hover {
    transform: translateX(5px);
}

@media (max-width: 768px) {
    .customer-footer .text-md-end {
        text-align: left !important;
        margin-top: 10px;
    }
}
</style>
