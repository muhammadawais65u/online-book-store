@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Checkout</h2>
    
    @if($cart && $cart->items->count() > 0)
        <form action="{{ route('orders.place') }}" method="POST">
            @csrf
            <div class="row">
                <!-- Shipping Information -->
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Shipping Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" value="{{ Auth::user()->phone ?? '' }}" required>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="address" class="form-label">Shipping Address</label>
                                <textarea class="form-control" id="address" name="shipping_address" rows="3" required>{{ Auth::user()->address ?? '' }}</textarea>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="payment_method" class="form-label">Payment Method</label>
                                    <select class="form-select" id="payment_method" name="payment_method" required>
                                        <option value="">Select Payment Method</option>
                                        <option value="cash_on_delivery">Cash on Delivery</option>
                                        <option value="credit_card">Credit Card</option>
                                        <option value="debit_card">Debit Card</option>
                                        <option value="paypal">PayPal</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="notes" class="form-label">Order Notes (Optional)</label>
                                    <textarea class="form-control" id="notes" name="notes" rows="2" placeholder="Any special instructions..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Order Items -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Order Items</h5>
                        </div>
                        <div class="card-body">
                            @foreach($cart->items as $item)
                                <div class="row align-items-center mb-3 pb-3 border-bottom">
                                    <div class="col-md-2">
                                        @if($item->book->cover_image)
                                            <img src="{{ asset('storage/' . $item->book->cover_image) }}" class="img-fluid rounded" alt="{{ $item->book->title }}">
                                        @else
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 60px;">
                                                <i class="fas fa-book text-muted"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="mb-1">{{ $item->book->title }}</h6>
                                        <p class="text-muted small mb-0">by {{ $item->book->author->name }}</p>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <span class="badge bg-secondary">Qty: {{ $item->quantity }}</span>
                                    </div>
                                    <div class="col-md-2 text-end">
                                        <span class="fw-bold">{{ $item->subtotal }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                
                <!-- Order Summary -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Order Summary</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal:</span>
                                <span>{{ $cart->formatted_total }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Shipping:</span>
                                <span>Free</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Tax:</span>
                                <span>$0.00</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mb-3">
                                <strong>Total:</strong>
                                <strong>{{ $cart->formatted_total }}</strong>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-check"></i> Place Order
                                </button>
                                <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left"></i> Back to Cart
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Security Note -->
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="text-center">
                                <i class="fas fa-shield-alt fa-2x text-success mb-2"></i>
                                <h6>Secure Checkout</h6>
                                <p class="small text-muted">Your payment information is safe and secure with us.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @else
        <div class="text-center py-5">
            <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
            <h4>Your cart is empty</h4>
            <p class="text-muted">You need to add items to your cart before checkout.</p>
            <a href="{{ route('books.index') }}" class="btn btn-primary">
                <i class="fas fa-book"></i> Browse Books
            </a>
        </div>
    @endif
</div>
@endsection
