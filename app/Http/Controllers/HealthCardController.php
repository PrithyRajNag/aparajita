<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateHealthCardRequest;
use App\Http\Requests\UpdateHealthCardRequest;
use App\Repositories\HealthCardRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HealthCardController extends Controller
{

    private $repository;
    private $indexRoute ;

    public function __construct( HealthCardRepository $repository, $indexRoute = 'health-card.index')
    {
        $this->repository = $repository;
        $this->indexRoute = $indexRoute;
    }
    public function index(){
        $patients = $this->repository->getAllPatients();
        $contentData = $this->repository->all();
//        return $patients;
        return view('health_card.index', ['contentData'=>$contentData,'patients'=>$patients]);
    }


    public function store(CreateHealthCardRequest $request): JsonResponse
    {
        $data = $this->repository->create($request);
        return response()->json( 'Successfully Health Card Created');
    }


    public function update(UpdateHealthCardRequest $request, int $id): JsonResponse
    {
//        dd($request->all());
        $data = $this->repository->update($request, $id);
        return response()->json('Health Card Information Updated');
    }

    public function destroy(int $id): RedirectResponse
    {
        $data = $this->repository->delete($id);
        return redirect()->route($this->indexRoute)->with('success', 'Health Card Deleted');
    }
}
