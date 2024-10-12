<?php

namespace App\Http\Controllers\API\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\Books\ListBookRequest;
use App\Http\Resources\Books\BookCollection;
use App\Models\Book;

class BookController extends Controller
{
    public function index(ListBookRequest $request)
    {
        $books = Book::query()->when($request->search, function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('barcode', 'like', '%' . $request->search . '%')
                ->orWhere('author', 'like', '%' . $request->search . '%');
        })->paginate(20);

        return response()->json(new BookCollection($books));
    }
}
