<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTestCategoryRequest;
use App\Http\Requests\CreateTestItemRequest;
use App\Http\Requests\UpdateTestCategoryRequest;
use App\Http\Requests\UpdateTestItemRequest;
use App\Repositories\TestCategoryRepository;
use App\Repositories\TestItemRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TestItemController extends Controller
{
    private $repository;
    private $indexRoute ;

    public function __construct(TestItemRepository $repository, $indexRoute = 'test.item.index')
    {
        $this->repository = $repository;
        $this->indexRoute = $indexRoute;
    }

    public function index()
    {
        $contentData = $this->repository->all();
        $testCategories = $this->repository->getAllTestCategories();
        return view('test.item.index', compact('contentData','testCategories'));
    }

    public function store(CreateTestItemRequest $request)
    {
        $data = $this->repository->create($request);
        return response()->json('Test Item Created');
//        return redirect()->route($this->indexRoute)->with('success', 'Test Item Created Successfully');
    }

    public function update(UpdateTestItemRequest $request, int $id):JsonResponse
    {
        $data = $this->repository->update($request, $id);
        return response()->json('Test Item Updated');
//        return redirect()->route($this->indexRoute)->with('success', 'Test Item Updated Successfully');
    }

    public function destroy(int $id): RedirectResponse
    {
        $data = $this->repository->delete($id);
        return redirect()->route($this->indexRoute)->with('success', 'Test Item Deleted Successfully');
    }
}
