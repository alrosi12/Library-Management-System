<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request = request();

        $books =  Book::with('author', 'categories')
            ->filter($request->query())
            ->paginate(15);

        return BookResource::collection($books);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $requestValidated = $request->validated();

        $book = Book::create($requestValidated);
        if (!empty($requestValidated['category_ids'])) {
            $book->categories()->sync($requestValidated['category_ids']);
        }

        return response($book);
    }

    /**
     * 
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::with('author', 'publisher', 'categories')
            ->findOrFail($id);
        return new BookResource($book);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, $id)
    {

        $book = Book::findOrFail($id);

        $validated =  $request->validated();
        $book->update($validated);
        $book->categories()->sync($validated['category_ids']);
        // $requestValidated = $request->validated();


        // $book = Book::with('author', 'categories');
        // $book->update($requestValidated);
        // if ($request->has('category_ids')) {
        //     Book::categories()->sync($requestValidated['category_ids']);
        // }

        return response($book);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json([
            'message' => 'deleted Successfully'
        ]);
    }
}
