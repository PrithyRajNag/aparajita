<?php

namespace App\Http\Controllers\Bed;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBedTypeRequest;
use App\Http\Requests\UpdateBedTypeRequest;
use App\Repositories\BedTypeRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;


class BedTypeController extends Controller
{
    /**
     * @var BedTypeRepository
     */
    private $repository;
    private $indexRoute ;

    public function __construct(BedTypeRepository $repository, $indexRoute = 'bed.type.index')
    {
        $this->repository = $repository;
        $this->indexRoute = $indexRoute;
    }
    public function index(){
        $contentData = $this->repository->all();
        return view('bed.type.index',compact('contentData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateBedTypeRequest $request
     * @return JsonResponse
     */
    public function store(CreateBedTypeRequest $request): JsonResponse
    {

        $data = $this->repository->create($request);
        return response()->json( 'Successfully Bed Type Created');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBedTypeRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateBedTypeRequest $request, int $id): JsonResponse
    {
        $data = $this->repository->update($request, $id);
        return response()->json('Bed Type Information Updated');
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
        return redirect()->route($this->indexRoute)->with('success', 'Bed Type Deleted');
    }
}
