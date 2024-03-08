<?php

namespace App\Services;

use App\Models\Branch;

class BranchService
{
    public static function index()
    {
        try {
            $branch = Branch::with(['users', 'ticket'])->get();
            return response()->json($branch);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    public static function create(array $branchData)
    {
        try {
            $branch = Branch::create($branchData);

            return response()->json(['message' => $branch->name.' branch created succssfuly'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }

    }

    public static function update(int $id,$request)
    {
        try {
            $branch = Branch::findOrFail($id);
            $branch->update($request->all());

            return response()->json(['message' => $branch->name.' updated'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public static function delete(int $id)
    {
        try {
            $branch = Branch::findOrFail($id);
            $branch->delete();

            return response()->json(['message' => $branch->name.' deleted'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
