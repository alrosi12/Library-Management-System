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
     * Display a listing of the resource.
     */
    public function index(Book $book)
    {
        // $categories = Category::with('parent')
        //     ->withCount([
        //         'products as products_number' => function ($query) {
        //             $query->where('status', '=', 'active');
        //         }
        //     ])
        $books = Book::with(['author', 'publisher', 'categories', 'borrowings', 'reviews'])->get();
        return view("dashboard.books.index", compact("books"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('dashboard.books.create', [
            'authors'    => Author::all(),
            'publishers' => Publisher::all(),
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'author_id'    => ['required', 'exists:authors,id'],
            'publisher_id' => ['nullable', 'exists:publishers,id'],
            'categories'   => ['nullable', 'array', 'exists:categories,id'],
            'quantity'     => ['required', 'integer', 'min:1'],
            'status'       => ['required', 'in:available,borrowed,reserved,archived'],
            'isbn'         => ['required', 'string', 'size:13', 'unique:books,isbn'],
            'description'  => ['nullable', 'string'],

        ]);

        // dd($request);
        $book = Book::create($request->all());
        return redirect()->route('books.index')->with('success', 'Book Created Successfuly');
        // dd($book);
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
