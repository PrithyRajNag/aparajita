<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTestCategoryRequest;
use App\Http\Requests\UpdateTestCategoryRequest;
use App\Repositories\TestCategoryRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TestCategoryController extends Controller
{
    private $repository;
    private $indexRoute ;

    public function __construct(TestCategoryRepository $repository, $indexRoute = 'test.category.index')
    {
        $this->repository = $repository;
        $this->indexRoute = $indexRoute;
    }

    public function index()
    {
        $contentData = $this->repository->all();
        $labs = $this->repository->getAllLabs();
        return view('test.category.index', compact('contentData','labs'));
    }

    public function store(CreateTestCategoryRequest $request): JsonResponse
    {
        $data = $this->repository->create($request);
        return response()->json('Test Category Created');
    }

    public function update(UpdateTestCategoryRequest $request, int $id): JsonResponse
    {
        $data = $this->repository->update($request, $id);
        return response()->json('Test Category Updated');
    }

    public function destroy(int $id): RedirectResponse
    {
        $data = $this->repository->delete($id);
        return redirect()->route($this->indexRoute)->with('success', 'Test Category Deleted Successfully');
    }
}
