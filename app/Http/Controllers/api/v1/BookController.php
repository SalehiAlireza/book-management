<?php

namespace App\Http\Controllers;

use App\Models\Models\Book\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;

class BookController extends Controller
{

    public function index() 
    {
        return Book::with('category')->get();
    }

    public function store(Request $request) 
    {
        $data = $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'total_copies' => 'required|integer|min:1',
        ]);

        $data['available_copies'] = $data['total_copies'];

        $book = Book::create($data);
        return response()->json($book, 201);
    }

    public function show(Book $book) 
    {
        return $book->load('category');
    }

    public function update(Request $request, Book $book) 
    {
        $data = $request->validate([
            'title' => 'sometimes|string',
            'author' => 'sometimes|string',
            'category_id' => 'sometimes|exists:categories,id',
            'total_copies' => 'sometimes|integer|min:1',
        ]);

        if (isset($data['total_copies'])) {
            $data['available_copies'] = $data['total_copies'];
        }

        $book->update($data);
        return response()->json($book);
    }

    public function destroy(Book $book) 
    {
        $book->delete();
        return response()->json(null, 204);
    }
    

}
