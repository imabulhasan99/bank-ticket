<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubCategoryRequest;
use App\Models\Category;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{
    public function create(SubCategoryRequest $request)
    {
        $this->authorize('create', Category::class);
        $subCategoryData = $request->validated();
        try {
            $category = SubCategory::create($subCategoryData);

            return response()->json(['message' => $category->title.'Created successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function update(int $id, SubCategoryRequest $request)
    {
        $this->authorize('update', Category::class);
        try {
            $category = SubCategory::findOrFail($id);
            $category->update($request->validated());

            return response()->json(['message' => $category->title.' updated'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function delete(int $id)
    {
        $this->authorize('delete', Category::class);
        try {
            $category = SubCategory::findOrFail($id);
            $category->delete();

            return response()->json(['message' => 'Category deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
