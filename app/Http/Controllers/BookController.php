<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
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
    public function index()
    {
        $request = request();

        $books = Book::with(['author'])
            ->withCount([
                'borrowings as active_borrowings_count' => function ($q) {
                    $q->whereNull('returned_at');
                }
            ])
            ->filter($request->query())
            ->paginate(15);
        // $books = Book::with(['author'])
        //     ->filter($request->query())
        //     ->paginate();
        // $books = Book::with(['author'])->available()
        //    ->available()
        // ->byLanguage('en')
        //     ->orderBy('title')
        //     ->paginate(15);
        return view("dashboard.books.index", compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('dashboard.books.create', [
            'book'    => new Book(),
            'authors'    => Author::all(),
            'publishers' => Publisher::all(),
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        // dd($request->all());
        $validated =  $request->validate();

        // dd($validated);
        $book = Book::create($validated);
        $book->categories()->sync($validated['category_ids']);
        return redirect()->route('books.index')->with('success', 'Book Created Successfuly');
    }

    /**
     * Display the specified resource.
     *
     *
     *
     * @return \Illuminate\View\View
     */
    public function show(string $id)
    {

        $book = Book::with([
            'author',
            'publisher',
            'categories',
            'borrowings.member',
            'reviews.member'
        ])->findOrFail($id);

        return view('dashboard.books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::with('categories')->findOrFail($id);
        $categories = Category::all();
        $authors = Author::all();
        $publishers = Publisher::all();
        return view('dashboard.books.edit', compact('book', 'categories', 'authors', 'publishers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, string $id)
    {
        $book = Book::findOrFail($id);
        $validated =  $request->validated();
        $book->update($validated);
        $book->categories()->sync($validated['category_ids']);
        return redirect()->route('books.index')->with('success', 'Book Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book Deleted Successfully');
    }
}
