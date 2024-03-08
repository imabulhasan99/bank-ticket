<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\CategorService;

class CategoryController extends Controller
{
    public function create(CategoryRequest $request)
    {
        $categoryData = $request->validated();
        $this->authorize('create', Category::class);

        return CategorService::create($categoryData);

    }

    public function index()
    {
        $this->authorize('viewAny', Category::class);
        $categories = Category::with('subcategory')->get();

        return response()->json($categories);
    }

    public function update(int $id, CategoryRequest $request)
    {
        $this->authorize('update', Category::class);

        return CategorService::update($id, $request);
    }

    public function delete($id)
    {
        $this->authorize('delete', Category::class);

        return CategorService::delete($id);
    }
}
