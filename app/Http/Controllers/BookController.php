<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Resources\BookResource;
use App\Http\Resources\ReaderResource;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $books = Book::all();
        // $books = Book::with('category')->get();
        $books = BookResource::collection(Book::all());
        return response()->json($books);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $request->validated();

        // $book = new Book();
        // $book->title = $request->title;
        // $book->ISBN = $request->ISBN;
        // ...
        // $book->save();

        $book = Book::create($request->only(['title', 'ISBN', 'pages', 'description', 'hard_cover', 'category_id']));

        return new BookResource($book);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        // $book = Book::with('category')->where('id', $book->id)->first();
        // return response()->json($book);
        return new BookResource($book);
    }

    function readersOfBook(Book $book) {
        $readers = $book->readers;
        if ($readers->isEmpty()) {
            return response()->json(status: 404);
        }
        return ReaderResource::collection($readers);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreBookRequest $request, Book $book)
    {
        $request->validated();

        $book->update($request->only(['title', 'ISBN', 'pages', 'description', 'hard_cover', 'category_id']));

        return new BookResource($book);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json(null, 204);
    }
}
