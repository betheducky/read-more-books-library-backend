<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::where('user_id', Auth::id())->get();

        return response()->json([
            'message' => 'Books retrieved successfully',
            'books' => $books
        ], 200, ['Content-Type' => 'application/json']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)

    {
        // debug incoming info from angular
        Log::info("Incoming book data: ", $request->all());

        $validatedData = $request->validate([
            'id' => 'required|integer|min:1|max:999999999',
            'cover_url' => 'nullable|url|max:512',
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'link_to_more' => 'required|url|max:512',
            'year_published' => 'required|integer|min:1|max:2026'
        ]);

        $book = new Book();
        $book->user_id = Auth::id();
        $book->id = $request->id;
        $book->title = $validatedData['title'];
        $book->author = $validatedData['author'] ?? null;
        $book->cover_url = $validatedData['cover_url'] ?? null;
        $book->year_published = $validatedData['year_published'];
        $book->link_to_more = $validatedData["link_to_more"];
        $book->save();

        return response()->json([
            'message' => 'Book added to list!',
            'book' => $book
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $book = Book::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$book) {
            return response()->json(['message' => 'Book not found! :('], 404);
        }

        $book->delete();

        return response()->json(['message' => 'Book successfully deleted!'], 200);
    }
}
