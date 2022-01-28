<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLabRequest;
use App\Http\Requests\UpdateLabRequest;
use App\Repositories\LabRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LabController extends Controller
{
    private $repository;
    private $indexRoute ;

    public function __construct(LabRepository $repository, $indexRoute = 'lab.index')
    {
        $this->repository = $repository;
        $this->indexRoute = $indexRoute;
    }

    public function index()
    {
        $contentData = $this->repository->all();
        return view('lab.index', compact('contentData'));
    }

    public function store(CreateLabRequest $request): JsonResponse
    {
        $data = $this->repository->create($request);
        return response()->json('Lab Created');
    }

    public function update(UpdateLabRequest $request, int $id): JsonResponse
    {
        $data = $this->repository->update($request, $id);
        return response()->json('Lab Updated');
    }

    public function destroy(int $id): RedirectResponse
    {
        $data = $this->repository->delete($id);
        return redirect()->route($this->indexRoute)->with('success', 'Lab Deleted Successfully');
    }
}
