<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTestResultItemRequest;
use App\Http\Requests\UpdateTestResultItemRequest;
use App\Repositories\TestResultItemRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TestResultItemController extends Controller
{
    private $repository;
    private $indexRoute ;

    public function __construct(TestResultItemRepository $repository, $indexRoute = 'test.result.item.index')
    {
        $this->repository = $repository;
        $this->indexRoute = $indexRoute;
    }

    public function index()
    {
        $contentData = $this->repository->all();
        $testResultCategory = $this->repository->getAllTestResultCategory();
        return view('test.result.item.index', compact('contentData','testResultCategory'));
    }

    public function store(CreateTestResultItemRequest $request)
    {
        $data = $this->repository->create($request);
        return response()->json('Test Result Item Created');
//        return redirect()->route($this->indexRoute)->with('success', 'Test Result Category Created Successfully');
    }

    public function update(UpdateTestResultItemRequest $request, int $id)
    {
        $data = $this->repository->update($request, $id);
        return response()->json('Test Result Item Updated');
//        return redirect()->route($this->indexRoute)->with('success', 'Test Result Category Updated Successfully');
    }

    public function destroy(int $id): RedirectResponse
    {
        $data = $this->repository->delete($id);
        return redirect()->route($this->indexRoute)->with('success', 'Test Result Item Deleted Successfully');
    }
}
