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
    public function index()
    {
        return BookResource::collection(Book::paginate(15));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $requestValidated = $request->validated();

        $book = Book::with('author', 'categories')->create($requestValidated);
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
        return new BookResource(Book::with('author', 'publisher', 'categories')->findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        
        $requestValidated = $request->validated();


        $book = Book::with('author', 'categories');
        $book->update($requestValidated);
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
