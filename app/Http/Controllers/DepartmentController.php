<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Repositories\DepartmentRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class DepartmentController extends Controller
{
    /**
     * @var DepartmentRepository
     */
    private $repository;
    private $indexRoute ;

    public function __construct(DepartmentRepository $repository, $indexRoute = 'department.index')
    {
        $this->repository = $repository;
        $this->indexRoute = $indexRoute;
    }
    public function index()
    {
        $contentData = $this->repository->all();
        return view('department.index', compact('contentData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateDepartmentRequest $request
     * @return JsonResponse
     */
    public function store(CreateDepartmentRequest $request): JsonResponse
    {

        $data = $this->repository->create($request);
        return response()->json('Department Created');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateDepartmentRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateDepartmentRequest $request, int $id): JsonResponse
    {
        $data = $this->repository->update($request, $id);
        return response()->json('Department Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $data = $this->repository->delete($id);
        return redirect()->route($this->indexRoute)->with('success', 'Department Deleted');
    }
}
