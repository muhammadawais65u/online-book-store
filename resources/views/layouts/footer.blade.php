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
