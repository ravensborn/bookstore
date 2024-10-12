<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Books\ListBookRequest;
use App\Http\Requests\Books\StoreBookRequest;
use App\Http\Requests\Books\UpdateBookRequest;
use App\Http\Resources\Books\BookCollection;
use App\Http\Resources\Books\BookResource;
use App\Models\Book;
use App\Models\User;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class BookController extends Controller
{
    public function index(ListBookRequest $request)
    {
        $books = Book::with(['media', 'category'])
            ->when($request->search, function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('barcode', 'like', '%' . $request->search . '%')
                ->orWhere('author', 'like', '%' . $request->search . '%');
            })
            ->paginate(20);

        return response()->json(new BookCollection($books));
    }

    /**
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function store(StoreBookRequest $request)
    {
        $validated = $request->validated();

        $book = new Book($validated);
        $book->save();

        if ($request->hasFile('cover_image')) {

            $image = $request->file('cover_image');
            $name = time() . '_' . uniqid();

            $book->addMedia($image)
                ->usingName($name)
                ->usingFileName($name . '.' . pathinfo($image->getRealPath(), PATHINFO_EXTENSION))
                ->toMediaCollection('cover');
        }


        return response()->json(new BookResource($book));
    }


    public function update(UpdateBookRequest $request, Book $book)
    {
        $validated = $request->validated();

        $book->update($validated);

        if ($request->hasFile('cover_image')) {

            $book->clearMediaCollection('cover');

            $image = $request->file('cover_image');
            $name = time() . '_' . uniqid();

            $book->addMedia($image)
                ->usingName($name)
                ->usingFileName($name . '.' . pathinfo($image->getRealPath(), PATHINFO_EXTENSION))
                ->toMediaCollection('cover');
        }

        return response()->json(new BookResource($book));
    }

    public function show(Book $book)
    {
        return response()->json(new BookResource($book));
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return response()->json([
            'message' => 'Book has been deleted.'
        ]);
    }
}
