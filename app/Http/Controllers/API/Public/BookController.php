<?php

namespace App\Http\Controllers\API\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\Books\BookCollection;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::paginate(20);

        return response()->json(new BookCollection($books));
    }
}
