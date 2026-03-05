<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with(['author', 'category'])->orderBy('title')->paginate(10);
        return view('admin.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = Author::where('is_active', true)->orderBy('name')->get();
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        return view('admin.books.create', compact('authors', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'nullable|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'pages' => 'required|integer|min:1',
            'isbn' => 'required|string|unique:books,isbn',
            'published_date' => 'required|date',
            'category_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:authors,id',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pdf_file' => 'nullable|file|mimes:pdf|max:10240'
        ]);

        // Additional validation: if not free book, price is required
        if (!$request->has('is_free')) {
            $request->validate([
                'price' => 'required|numeric|min:0'
            ]);
        }

        $bookData = $request->except(['cover_image', 'pdf_file']);
        $bookData['slug'] = Str::slug($request->title);
        $bookData['is_active'] = true;
        $bookData['is_featured'] = $request->has('is_featured');
        $bookData['is_free'] = $request->has('is_free');

        // Set price to 0 for free books
        if ($request->has('is_free')) {
            $bookData['price'] = 0.00;
        }

        if ($request->hasFile('cover_image')) {
            $imagePath = $request->file('cover_image')->store('books', 'public');
            $bookData['cover_image'] = $imagePath;
        }

        if ($request->hasFile('pdf_file')) {
            $pdfPath = $request->file('pdf_file')->store('books/pdfs', 'public');
            $bookData['pdf_file'] = $pdfPath;
        }

        Book::create($bookData);

        return redirect()->route('admin.books.index')
            ->with('success', 'Book created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::findOrFail($id);
        $authors = Author::where('is_active', true)->orderBy('name')->get();
        $categories = Category::where('is_active', true)->orderBy('name')->get();

        return view('admin.books.edit', compact('book', 'authors', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $book = Book::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'nullable|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'pages' => 'required|integer|min:1',
            'isbn' => 'required|string|unique:books,isbn,' . $book->id,
            'published_date' => 'required|date',
            'category_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:authors,id',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pdf_file' => 'nullable|file|mimes:pdf|max:10240'
        ]);

        // Additional validation: if not free book, price is required
        if (!$request->has('is_free')) {
            $request->validate([
                'price' => 'required|numeric|min:0'
            ]);
        }

        $bookData = $request->except(['cover_image', 'pdf_file']);
        $bookData['slug'] = Str::slug($request->title);
        $bookData['is_active'] = true;
        $bookData['is_featured'] = $request->has('is_featured');
        $bookData['is_free'] = $request->has('is_free');

        // Set price to 0 for free books
        if ($request->has('is_free')) {
            $bookData['price'] = 0.00;
        }

        if ($request->hasFile('cover_image')) {
            // Delete old cover image if exists
            if ($book->cover_image) {
                Storage::disk('public')->delete($book->cover_image);
            }
            $imagePath = $request->file('cover_image')->store('books', 'public');
            $bookData['cover_image'] = $imagePath;
        }

        if ($request->hasFile('pdf_file')) {
            // Delete old PDF file if exists
            if ($book->pdf_file) {
                Storage::disk('public')->delete($book->pdf_file);
            }
            $pdfPath = $request->file('pdf_file')->store('books/pdfs', 'public');
            $bookData['pdf_file'] = $pdfPath;
        }

        $book->update($bookData);

        return redirect()->route('admin.books.index')
            ->with('success', 'Book updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
