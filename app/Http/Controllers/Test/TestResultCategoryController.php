<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTestResultCategoryRequest;
use App\Http\Requests\UpdateTestResultCategoryRequest;
use App\Repositories\TestResultCategoryRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TestResultCategoryController extends Controller
{
    private $repository;
    private $indexRoute ;

    public function __construct(TestResultCategoryRepository $repository, $indexRoute = 'test.result.category.index')
    {
        $this->repository = $repository;
        $this->indexRoute = $indexRoute;
    }

    public function index()
    {
        $contentData = $this->repository->all();
        $testItems = $this->repository->getAllTestItems();
        return view('test.result.category.index', compact('contentData','testItems'));
    }

    public function store(CreateTestResultCategoryRequest $request)
    {
        $data = $this->repository->create($request);
        return response()->json('Test Result Category Created');
//        return redirect()->route($this->indexRoute)->with('success', 'Test Result Category Created Successfully');
    }

    public function update(UpdateTestResultCategoryRequest $request, int $id)
    {
        $data = $this->repository->update($request, $id);
        return response()->json('Test Result Category Updated');
//        return redirect()->route($this->indexRoute)->with('success', 'Test Result Category Updated Successfully');
    }

    public function destroy(int $id): RedirectResponse
    {
        $data = $this->repository->delete($id);
        return redirect()->route($this->indexRoute)->with('success', 'Test Result Category Deleted Successfully');
    }
}
