<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Categories\StoreCategoryRequest;
use App\Http\Requests\Categories\UpdateCategoryRequest;
use App\Http\Resources\Categories\CategoryCollection;
use App\Http\Resources\Categories\CategoryResource;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return response()->json(new CategoryCollection($categories));
    }

    public function store(StoreCategoryRequest $request)
    {
        $validated = $request->validated();

        $category = new Category($validated);
        $category->save();

        return response()->json(new CategoryResource($category));
    }


    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $validated = $request->validated();

        $category->update($validated);

        return response()->json(new CategoryResource($category));
    }

    public function show(Category $category)
    {
        return response()->json(new CategoryResource($category));
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([
            'message' => 'Category has been deleted.'
        ]);
    }
}
