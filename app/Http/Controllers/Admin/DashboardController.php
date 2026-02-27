<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get dashboard statistics
        $totalBooks = Book::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::where('status', 'completed')->sum('total_amount');
        $recentOrders = Order::with('user', 'items.book')
            ->latest()
            ->take(5)
            ->get();
        
        // Get books with low stock
        $lowStockBooks = Book::where('stock', '<=', 5)
            ->orderBy('stock', 'asc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalBooks',
            'totalOrders', 
            'totalRevenue',
            'recentOrders',
            'lowStockBooks'
        ));
    }
}
