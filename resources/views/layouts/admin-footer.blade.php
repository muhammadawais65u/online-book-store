<!-- Modern Admin Footer -->
<footer class="admin-footer bg-dark text-white">
    <div class="container-fluid">
        <div class="row py-4">
            <!-- Company Info -->
            <div class="col-lg-4 col-md-6 mb-4">
                <h6 class="mb-3 fw-bold">Online Book Store</h6>
                <p class="text-muted mb-2">
                    Your trusted online bookstore for quality books and excellent service. 
                    Manage your inventory, track sales, and grow your business.
                </p>
                <div class="d-flex gap-3">
                    <a href="#" class="text-white text-decoration-none">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-white text-decoration-none">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-white text-decoration-none">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="text-white text-decoration-none">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-2 col-md-6 mb-4">
                <h6 class="mb-3 fw-bold">Quick Links</h6>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="{{ route('admin.dashboard') }}" class="text-muted text-decoration-none hover-text-white">
                            <i class="fas fa-angle-right me-2"></i>Dashboard
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('admin.books.index') }}" class="text-muted text-decoration-none hover-text-white">
                            <i class="fas fa-angle-right me-2"></i>Books
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('admin.orders.index') }}" class="text-muted text-decoration-none hover-text-white">
                            <i class="fas fa-angle-right me-2"></i>Orders
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('admin.users.index') }}" class="text-muted text-decoration-none hover-text-white">
                            <i class="fas fa-angle-right me-2"></i>Users
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Support -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h6 class="mb-3 fw-bold">Support</h6>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="#" class="text-muted text-decoration-none hover-text-white">
                            <i class="fas fa-book me-2"></i>Documentation
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-muted text-decoration-none hover-text-white">
                            <i class="fas fa-question-circle me-2"></i>Help Center
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-muted text-decoration-none hover-text-white">
                            <i class="fas fa-envelope me-2"></i>Contact Us
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-muted text-decoration-none hover-text-white">
                            <i class="fas fa-bug me-2"></i>Report Issue
                        </a>
                    </li>
                </ul>
            </div>

            <!-- System Info -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h6 class="mb-3 fw-bold">System Info</h6>
                <ul class="list-unstyled text-muted">
                    <li class="mb-2">
                        <i class="fas fa-server me-2"></i>
                        Version: 1.0.0
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-clock me-2"></i>
                        Last Backup: 2 hours ago
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-database me-2"></i>
                        Database: MySQL
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-shield-alt me-2"></i>
                        Security: Active
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
.admin-footer {
    margin-top: auto;
}

.hover-text-white:hover {
    color: #ffffff !important;
    transition: color 0.3s ease;
}

.admin-footer a {
    transition: all 0.3s ease;
}

.admin-footer a:hover {
    transform: translateX(3px);
}

.admin-footer ul li {
    transition: all 0.3s ease;
}

.admin-footer ul li:hover {
    transform: translateX(5px);
}

@media (max-width: 768px) {
    .admin-footer .text-md-end {
        text-align: left !important;
        margin-top: 10px;
    }
}
</style>
