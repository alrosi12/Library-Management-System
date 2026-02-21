<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
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
        return (new BookResource($book));
    }

    public function store(StoreBookRequest $request)
    {
        $validated = $request->validated();
        $book = Book::create($validated);

        if (!empty($validated['category_ids'])) {
            $book->categories()->sync($validated['category_ids']);
        }

        $book->load(['author', 'categories']);

        return response()->json([
            'success' => true,
            'message' => 'Created Successfully',
            'data'    => new BookResource($book),
        ], 201);
    }
    public function update(UpdateBookRequest $request, $id)
    {
        $book = Book::findOrFail($id);
        $validated = $request->validated();

        $book->update($validated);

        if ($request->has('category_ids')) {
            $book->categories()->sync($validated['category_ids'] ?? []);
        }

        // $book->load(['author', 'categories']);

        return (new BookResource($book))
            ->additional([
                'success' => true,
                'message' => 'Updated Successfully',
            ]);
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
