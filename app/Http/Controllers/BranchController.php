<?php

namespace App\Http\Controllers;

use App\Http\Requests\BranchRequest;
use App\Http\Requests\BranchUpdateRequest;
use App\Models\Branch;
use App\Models\Category;

class BranchController extends Controller
{
    public function index()
    {
        $this->authorize('view', Branch::class);
        $branch = Branch::with(['users', 'ticket'])->get();

        return response()->json($branch);
    }

    public function create(BranchRequest $request)
    {
        $this->authorize('create', Category::class);
        $branchData = $request->validated();
        try {
            $branch = Branch::create($branchData);

            return response()->json(['message' => $branch->name.' branch created succssfuly'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }

    }

    public function update(int $id, BranchUpdateRequest $request)
    {
        $this->authorize('update', Branch::class);
        try {
            $branch = Branch::findOrFail($id);
            $branch->update($request->all());

            return response()->json(['message' => $branch->name.' updated'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function delete(int $id)
    {
        $this->authorize('delete', Branch::class);
        try {
            $branch = Branch::findOrFail($id);
            $branch->delete();

            return response()->json(['message' => $branch->name.' deleted'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
