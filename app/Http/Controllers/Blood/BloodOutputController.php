<?php

namespace App\Http\Controllers\Blood;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBloodOutputRequest;
use App\Http\Requests\UpdateBloodOutputRequest;
use App\Repositories\BloodOutputRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BloodOutputController extends Controller
{

    private $repository;
    private $indexRoute;


    public function __construct(BloodOutputRepository $repository, $indexRoute = 'blood.output.index')
    {
        $this->repository = $repository;
        $this->indexRoute = $indexRoute;
    }

    public function index()
    {

        $bloodCollection = $this->repository->getBloodCollection();
        $bloodGroups = $this->repository->getAllBloodGroups();
        $availableBlood = $this->repository->getAvailableBlood();
        $contentData = $this->repository->all();
//        return  $contentData;
        return view('blood.output.index', compact('contentData', 'bloodGroups', 'bloodCollection', 'availableBlood'));

    }


    public function store(CreateBloodOutputRequest $request): JsonResponse
    {

        $data = $this->repository->create($request);
        return response()->json('Successfully Blood Output Record Created');

    }


    public function update(UpdateBloodOutputRequest $request, int $id): JsonResponse
    {
        $data = $this->repository->update($request, $id);
        return response()->json('Blood Output Record Updated');
    }


    public function destroy(int $id): RedirectResponse
    {

//        return $id;

        $data = $this->repository->delete($id);

        return redirect()->route($this->indexRoute)->with('success', 'Blood Output Record Removed');
    }

    public function bloodBags($id)
    {
        $data = $this->repository->getBloodBags($id);
        return response()->json($data);
    }
}
