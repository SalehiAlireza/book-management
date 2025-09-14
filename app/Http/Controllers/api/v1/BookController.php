<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;

class BookController extends Controller
{

    public function index() 
    {
        return Book::with('category')->get();
    }

    public function store(StoreBookRequest $request) 
    {
        $data = $request->all();

        $data['available_copies'] = $data['total_copies'];

        $book = Book::create($data);
        return response()->json($book, 201);
    }

    public function show(Book $book) 
    {
        return $book->load('category');
    }

    public function update(UpdateBookRequest $request, Book $book) 
    {
        $data = $request->all();

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
