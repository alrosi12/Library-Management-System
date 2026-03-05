<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Paginated table of (books with author, )
     * status, and available copies. Include a search input.
     * 
     */
    public function index()
    {
        $books =  Book::with('author')->paginate();
        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     * 
     */
    public function create()
    {
        $authors = Author::all();
        $publishers = Publisher::all();
        $categories = Category::all();

        $book = Book::with('author', 'publisher', 'categories');
        return view('books.create', compact([
            'book' , 'publishers', 'authors', 'categories'
        ]));
    }

    /**
     * 
     * Form to add a new book 
     * (with dropdown for author, publisher, checkboxes for categories).
     */
    public function store(Request $request)
    {
        //
    }

    /**
     *Book details with author info, categories,
     *borrowing history, and reviews.
     * 
     */
    public function show(string $id)
    {
        $book = Book::with('author', 'categories', 'borrowings')
            ->findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
