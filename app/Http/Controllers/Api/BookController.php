<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;

class BookController extends Controller
{

    public function index()
    {
        $books = Book::with(['author'])
            ->paginate();

        if (request()->expectsJson()) {
            return response()->json(BookResource::collection($books));
        }

        // response()->json($books)

        return view("dashboard.books.index", compact("books"));
    }

    public function show($id)
    {

        $book = Book::with(['author', 'publisher', 'categories'])
            ->findOrFail($id);

        if (request()->expectsJson()) {
            return new BookResource($book);
        }
        // response()->json($books)

        return view("dashboard.books.index", compact("books"));
    }
    public function store(Request $request)
    {
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

        $book = Book::create($validated);

        if (!empty($validated['category_ids'])) {
            $book->categories()->sync($validated['category_ids']);
        }

        $book->load(['author', 'categories']);

        return (new BookResource($book))
            ->response()
            ->setStatusCode(201);
    }

    public function destroy(Book $book)
{
    
    $book->delete();   // ← soft delete (يحط deleted_at = now())

    return response()->json([
        'success' => true,
        'message' => 'تم حذف الكتاب بنجاح (soft delete)',
        'book_id' => $book->id,
    ], 200);
}
}
