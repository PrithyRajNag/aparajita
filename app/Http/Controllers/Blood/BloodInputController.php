<?php

namespace App\Http\Controllers\Blood;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBloodInputRequest;
use App\Http\Requests\UpdateBloodInputRequest;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Repositories\BloodInputRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;



class BloodInputController extends Controller
{

    private $repository;
    private $indexRoute ;


    public function __construct(BloodInputRepository $repository, $indexRoute = 'blood.input.index')

    {
        $this->repository = $repository;
        $this->indexRoute = $indexRoute;
    }
    public function index(){

        $bloodCollection = $this->repository->getBloodCollection();
        $bloodGroups = $this->repository->getAllBloodGroups();
        $contentData = $this->repository->all();
//        return $contentData;
        return view('blood.input.index', compact('contentData', 'bloodGroups', 'bloodCollection'));

    }

//    public function store(CreateBloodInputRequest $request): RedirectResponse
//    {
//
//        $data = $this->repository->create($request);
//
//        return redirect()->route($this->indexRoute)->with('success', 'Successfully Blood Input Record Created');
//    }
    public function store(CreateBloodInputRequest $request): JsonResponse
    {

        $data = $this->repository->create($request);
        return response()->json( 'Successfully Blood Input Record Created');
    }


    public function update(UpdateBloodInputRequest $request, int $id): JsonResponse
    {
        $data = $this->repository->update($request, $id);
        return response()->json('Blood Input Record Updated');
    }


    public function destroy(int $id): RedirectResponse
    {
        $data = $this->repository->delete($id);

        return redirect()->route($this->indexRoute)->with('success', 'Blood Input Record Removed');
    }
}
