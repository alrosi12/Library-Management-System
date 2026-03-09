<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Member;
use App\Models\Publisher;
use Carbon\Carbon;
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
        $request = request();

        $books =  Book::with('author')
            ->filter($request->query())
            ->paginate(15);
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

        // $book = Book::with('author', 'publisher', 'categories');
        $book = Book::all();
        return view('books.create', compact([
            // 'book',
            'publishers',
            'authors',
            'categories'
        ]));
    }

    /**
     * 
     * Form to add a new book 
     * (with dropdown for author, publisher, checkboxes for categories).
     */
    public function store(StoreBookRequest $request)
    {
        // dd($request->all());
        $requestValidated = $request->validated();
        // dd($requestValidated);
        $book = Book::create($requestValidated);
        $book->categories()->sync($requestValidated['category_ids']);
        // dd($book);
        return redirect()->route('books.index');
    }

    /**
     *Book details with author info, categories,
     *borrowing history, and reviews.
     * 
     */
    public function show($id)
    {
        $members = Member::all();
        $book = Book::with(['author', 'categories'])->findOrFail($id);
        return view('books.show', compact('book', 'members'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $authors = Author::all();
        $publishers = Publisher::all();
        $categories = Category::all();

        $book = Book::with('author', 'categories', 'borrowings')
            ->findOrFail($id);
        return view('books.edit', compact([
            'book',
            'publishers',
            'authors',
            'categories'
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, string $id)
    {
        // dd($request->all());

        $book = Book::findOrFail($id);

        $validated =  $request->validated();
        $book->update($validated);
        $book->categories()->sync($validated['category_ids']);
        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
