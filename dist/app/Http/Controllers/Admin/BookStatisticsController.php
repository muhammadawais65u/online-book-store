<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class BookStatisticsController extends Controller
{
    /**
     * Display book statistics page.
     */
    public function index()
    {
        // Get all books
        $allBooks = Book::with(['author', 'category'])->get();
        
        // Get purchased books (books that have been ordered)
        $purchasedBookIds = OrderItem::distinct('book_id')->pluck('book_id');
        $purchasedBooks = Book::with(['author', 'category'])
            ->whereIn('id', $purchasedBookIds)
            ->get();
        
        // Get non-purchased books
        $nonPurchasedBooks = Book::with(['author', 'category'])
            ->whereNotIn('id', $purchasedBookIds)
            ->get();
        
        // Calculate statistics
        $totalBooks = $allBooks->count();
        $totalPurchased = $purchasedBooks->count();
        $totalNonPurchased = $nonPurchasedBooks->count();
        
        // Calculate total revenue from purchased books
        $totalRevenue = OrderItem::sum('total');
        
        // Get top selling books
        $topSellingBooks = Book::with(['author', 'category'])
            ->withSum('orderItems', 'quantity')
            ->orderBy('order_items_sum_quantity', 'desc')
            ->limit(10)
            ->get();
        
        // Get books by category statistics
        $categoryStats = Book::join('categories', 'books.category_id', '=', 'categories.id')
            ->leftJoin('order_items', 'books.id', '=', 'order_items.book_id')
            ->groupBy('categories.id', 'categories.name')
            ->selectRaw('
                categories.name,
                COUNT(books.id) as total_books,
                COUNT(DISTINCT CASE WHEN order_items.id IS NOT NULL THEN books.id END) as purchased_books,
                SUM(order_items.quantity) as total_sold
            ')
            ->get();
        
        return view('admin.books.statistics', compact(
            'allBooks',
            'purchasedBooks',
            'nonPurchasedBooks',
            'totalBooks',
            'totalPurchased',
            'totalNonPurchased',
            'totalRevenue',
            'topSellingBooks',
            'categoryStats'
        ));
    }
}
