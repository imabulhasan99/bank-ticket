<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Category;
use App\Services\BranchService;
use App\Http\Requests\BranchRequest;
use App\Http\Requests\BranchUpdateRequest;

class BranchController extends Controller
{
    public function index()
    {
        $this->authorize('view', Branch::class);
        return BranchService::index();
    }

    public function create(BranchRequest $request)
    {
        $this->authorize('create', Category::class);
        $branchData = $request->validated();
        return BranchService::create($branchData);
    }

    public function update(int $id, BranchUpdateRequest $request)
    {
        $this->authorize('update', Branch::class);
        return BranchService::update($id, $request);
    }

    public function delete(int $id)
    {
        $this->authorize('delete', Branch::class);
        return BranchService::delete($id);
    }
}
