<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // display the index.blade.php
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

     // insert
    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_name'   => 'required|string|max:255',
            'book_author' => 'required|string|max:255',
            'book_stock'  => 'required|integer|min:0',
            'book_date'   => 'required|date',
        ]);

        Book::create($validated);

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    // show 
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('books.show', compact('book')); 
    }

    // display the edit.blade.php
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('books.edit', compact('book'));
    }

    // update
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'book_name'   => 'required|string|max:255',
            'book_author' => 'required|string|max:255',
            'book_stock'  => 'required|integer|min:0',
            'book_date'   => 'required|date',
        ]);

        $book = Book::findOrFail($id);
        $book->update($validated);

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }
  
    // delete
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}