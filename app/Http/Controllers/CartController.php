<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cart = Auth::user()->cart;
        if (!$cart) {
            $cart = Cart::create(['user_id' => Auth::id()]);
        }

        $cart->load('cartItems.book');

        return view('cart.index', compact('cart'));
    }

    public function add(Request $request, Book $book)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('message', 'Please login to add items to cart.');
        }

        if ($book->stock_quantity < $request->quantity) {
            return back()->with('error', 'Not enough stock available.');
        }

        $cart = Auth::user()->cart;
        if (!$cart) {
            $cart = Cart::create(['user_id' => Auth::id()]);
        }

        $cartItem = $cart->cartItems()->where('book_id', $book->id)->first();

        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $request->quantity;
            if ($newQuantity > $book->stock_quantity) {
                return back()->with('error', 'Not enough stock available.');
            }
            $cartItem->update(['quantity' => $newQuantity]);
        } else {
            $cart->cartItems()->create([
                'book_id' => $book->id,
                'quantity' => $request->quantity,
                'price' => $book->price,
            ]);
        }

        $cart->updateTotalAmount();

        return back()->with('success', 'Book added to cart successfully!');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        if ($cartItem->cart->user_id !== Auth::id()) {
            abort(403);
        }

        if ($cartItem->book->stock_quantity < $request->quantity) {
            return back()->with('error', 'Not enough stock available.');
        }

        $cartItem->update(['quantity' => $request->quantity]);
        $cartItem->cart->updateTotalAmount();

        return back()->with('success', 'Cart updated successfully!');
    }

    public function remove(CartItem $cartItem)
    {
        if ($cartItem->cart->user_id !== Auth::id()) {
            abort(403);
        }

        $cart = $cartItem->cart;
        $cartItem->delete();
        $cart->updateTotalAmount();

        return back()->with('success', 'Item removed from cart!');
    }

    public function clear()
    {
        $cart = Auth::user()->cart;
        if ($cart) {
            $cart->cartItems()->delete();
            $cart->update(['total_amount' => 0]);
        }

        return back()->with('success', 'Cart cleared successfully!');
    }
}
