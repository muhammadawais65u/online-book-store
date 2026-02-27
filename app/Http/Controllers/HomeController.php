<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Get featured books
        $featuredBooks = Book::where('is_featured', true)
                            ->where('is_active', true)
                            ->with(['author', 'category'])
                            ->take(8)
                            ->get();

        // Get all categories
        $categories = Category::where('is_active', true)
                             ->withCount('books')
                             ->get();

        return view('welcome', compact('featuredBooks', 'categories'));
    }
}
