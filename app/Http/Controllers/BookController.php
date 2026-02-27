<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with(['category', 'author'])
            ->where('is_active', true);

        if ($request->has('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhereHas('author', function ($subQ) use ($search) {
                      $subQ->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $books = $query->paginate(12);
        $categories = Category::where('is_active', true)->get();
        $featuredBooks = Book::with(['category', 'author'])
            ->where('is_featured', true)
            ->where('is_active', true)
            ->take(4)
            ->get();

        return view('books.index', compact('books', 'categories', 'featuredBooks'));
    }

    public function show(Book $book)
    {
        $book->load(['category', 'author', 'reviews' => function ($query) {
            $query->where('is_approved', true)->latest();
        }]);

        $relatedBooks = Book::with(['category', 'author'])
            ->where('category_id', $book->category_id)
            ->where('id', '!=', $book->id)
            ->where('is_active', true)
            ->take(4)
            ->get();

        return view('books.show', compact('book', 'relatedBooks'));
    }
}
