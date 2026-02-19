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
    public function index()
    {
        // $categories = Category::with('parent')
        //     ->withCount([
        //         'products as products_number' => function ($query) {
        //             $query->where('status', '=', 'active');
        //         }
        //     ])
        $books = Book::with(['author', 'publisher', 'categories', 'borrowings', 'reviews'])->paginate(15);
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
        $validated =  $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'author_id'    => ['required', 'exists:authors,id'],
            'publisher_id' => ['nullable', 'exists:publishers,id'],
            'total_copies' => ['required', 'integer', 'min:1'],
            'status'       => ['required', 'in:available,borrowed,reserved,archived'],
            'isbn'         => ['required', 'string', 'size:13', 'unique:books,isbn'],
            'description'  => ['nullable', 'string', 'max:255'],
            'page_count'   => ['nullable', 'integer'],
            'edition'      => ['nullable', 'integer', 'min:1'],
            'category_ids' => ['required', 'array'],
            'category_ids.*' => ['exists:categories,id'],
            'publisher_date' => ['nullable', 'date']
        ]);

        // dd($validated, 'validated');
        // dd($validated);

        $book = Book::create($validated);
        $book->categories()->sync($validated['category_ids']);
        return redirect()->route('books.index')->with('success', 'Book Created Successfuly');
        // dd($book);
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
    public function update(Request $request, string $id)
    {
        $book = Book::findOrFail($id);
        $validated =  $request->validate([
            'title'        => ['required', 'string', 'max:255', 'unique:books,title,' . $id],
            'author_id'    => ['required', 'exists:authors,id'],
            'publisher_id' => ['nullable', 'exists:publishers,id'],
            'total_copies' => ['required', 'integer', 'min:1'],
            'status'       => ['required', 'in:available,borrowed,reserved,archived'],
            'isbn'         => ['required', 'string', 'size:13', 'unique:books,isbn,' . $id],
            'description'  => ['nullable', 'string', 'max:255'],
            'page_count'   => ['nullable', 'integer'],
            'edition'      => ['nullable', 'integer', 'min:1'],
            'category_ids' => ['required', 'array'],
            'category_ids.*' => ['exists:categories,id'],
            'publisher_date' => ['nullable', 'date']
        ]);
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
