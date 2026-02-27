@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Shopping Cart</h2>
    
    @if($cart && $cart->items->count() > 0)
        <div class="row">
            <!-- Cart Items -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        @foreach($cart->items as $item)
                            <div class="row align-items-center mb-3 pb-3 border-bottom">
                                <div class="col-md-2">
                                    @if($item->book->cover_image)
                                        <img src="{{ asset('storage/' . $item->book->cover_image) }}" class="img-fluid rounded" alt="{{ $item->book->title }}">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 80px;">
                                            <i class="fas fa-book text-muted"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <h6 class="mb-1">{{ $item->book->title }}</h6>
                                    <p class="text-muted small mb-0">by {{ $item->book->author->name }}</p>
                                </div>
                                <div class="col-md-2">
                                    <span class="fw-bold">{{ $item->book->formatted_price }}</span>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group input-group-sm">
                                        <form action="{{ route('cart.update', $item) }}" method="POST" class="d-flex">
                                            @csrf
                                            @method('PUT')
                                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->book->stock_quantity }}" class="form-control form-control-sm" style="width: 60px;">
                                            <button type="submit" class="btn btn-outline-secondary btn-sm">
                                                <i class="fas fa-sync"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-2 text-end">
                                    <div class="fw-bold">{{ $item->subtotal }}</div>
                                    <form action="{{ route('cart.remove', $item) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <!-- Cart Summary -->
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
                            <a href="{{ route('checkout') }}" class="btn btn-primary">
                                <i class="fas fa-credit-card"></i> Proceed to Checkout
                            </a>
                            <a href="{{ route('books.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left"></i> Continue Shopping
                            </a>
                            <form action="{{ route('cart.clear') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger w-100">
                                    <i class="fas fa-trash"></i> Clear Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-5">
            <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
            <h4>Your cart is empty</h4>
            <p class="text-muted">Looks like you haven't added any books to your cart yet.</p>
            <a href="{{ route('books.index') }}" class="btn btn-primary">
                <i class="fas fa-book"></i> Browse Books
            </a>
        </div>
    @endif
</div>
@endsection
