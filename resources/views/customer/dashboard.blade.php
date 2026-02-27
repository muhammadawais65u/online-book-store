@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Customer Dashboard</h1>
            <p class="text-muted">Welcome back, {{ Auth::user()->name }}!</p>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">My Orders</h5>
                    <p class="card-text">You have {{ Auth::user()->orders()->count() }} orders</p>
                    <a href="{{ route('orders.index') }}" class="btn btn-primary">View Orders</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Shopping Cart</h5>
                    <p class="card-text">{{ Auth::user()->cart ? Auth::user()->cart->items()->count() : 0 }} items in cart</p>
                    <a href="{{ route('cart.index') }}" class="btn btn-success">View Cart</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Quick Actions</h5>
                    <div class="d-flex gap-2">
                        <a href="{{ route('books.index') }}" class="btn btn-outline-primary">Browse Books</a>
                        <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary">Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
