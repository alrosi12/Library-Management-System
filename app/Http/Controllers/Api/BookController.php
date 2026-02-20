<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Models\Book;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;

class BookController extends Controller
{

    public function index()
    {
        $books = Book::with(['author'])
            ->latest('created_at')
            ->paginate(15);

        return BookResource::collection($books);
    }
    public function show($id)
    {

        $book = Book::with(['author', 'publisher', 'categories'])
            ->findOrFail($id);


        return BookResource::collection($book);

        // response()->json($books)

    }
    public function store(StoreBookRequest $request)
    {
        $validated = $request->validated();
        $book = Book::create($validated);

        if (!empty($validated['category_ids'])) {
            $book->categories()->sync($validated['category_ids']);
        }

        $book->load(['author', 'categories']);

        return (new BookResource($book))
            ->response()
            ->setStatusCode(201);
    }
    public function update(Request $request, $id)
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

        if ($request->has('category_ids')) {
            $book->categories()->sync($validated['category_ids'] ?? []);
        }

        // $book->load(['author', 'categories']);

        return (new BookResource($book))
            ->response()
            ->setStatusCode(200);
    }

    public function destroy(Book $book)
    {

        $book->delete();

        return response()->json([
            'success' => true,
            'message' => 'soft delete',
            'book_id' => $book->id,
        ], 200);
    }
}
