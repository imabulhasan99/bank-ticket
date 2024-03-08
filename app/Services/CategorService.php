<?php

namespace App\Services;

use App\Models\Category;

class CategorService
{
    public static function create(array $categoryData)
    {
        try {
            $category = Category::create($categoryData);

            return response()->json(['message' => $category->title.'Created successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public static function update(int $id, $request)
    {
        try {
            $category = Category::findOrFail($id);
            $category->update($request->all());

            return response()->json(['message' => $category->title.' updated'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public static function delete(int $id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();

            return response()->json(['message' => 'Category deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
