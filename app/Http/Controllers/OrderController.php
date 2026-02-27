<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $orders = Auth::user()->orders()
            ->with('orderItems.book')
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load('orderItems.book');

        return view('orders.show', compact('order'));
    }

    public function checkout()
    {
        $cart = Auth::user()->cart;
        if (!$cart || $cart->cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $cart->load('cartItems.book');

        return view('orders.checkout', compact('cart'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string|min:10',
            'phone' => 'required|string|min:10',
            'notes' => 'nullable|string',
        ]);

        $cart = Auth::user()->cart;
        if (!$cart || $cart->cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $cart->load('cartItems.book');

        // Check stock availability
        foreach ($cart->cartItems as $cartItem) {
            if ($cartItem->quantity > $cartItem->book->stock_quantity) {
                return back()->with('error', "Not enough stock for {$cartItem->book->title}. Available: {$cartItem->book->stock_quantity}");
            }
        }

        // Create order
        $order = Order::create([
            'order_number' => 'ORD-' . strtoupper(Str::random(8)),
            'user_id' => Auth::id(),
            'total_amount' => $cart->total_amount,
            'status' => 'pending',
            'payment_method' => 'cash_on_delivery',
            'shipping_address' => $request->shipping_address,
            'phone' => $request->phone,
            'notes' => $request->notes,
        ]);

        // Create order items and update stock
        foreach ($cart->cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'book_id' => $cartItem->book_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->price,
                'total' => $cartItem->subtotal,
            ]);

            // Update book stock
            $cartItem->book->decrement('stock_quantity', $cartItem->quantity);
        }

        // Clear cart
        $cart->cartItems()->delete();
        $cart->update(['total_amount' => 0]);

        return redirect()->route('orders.show', $order)->with('success', 'Order placed successfully!');
    }

    public function cancel(Order $order)
    {
        if ($order->user_id !== Auth::id() || $order->status !== 'pending') {
            abort(403);
        }

        $order->update(['status' => 'cancelled']);

        // Restore stock
        foreach ($order->orderItems as $orderItem) {
            $orderItem->book->increment('stock_quantity', $orderItem->quantity);
        }

        return back()->with('success', 'Order cancelled successfully!');
    }
}
