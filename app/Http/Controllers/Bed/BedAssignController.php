<?php

namespace App\Http\Controllers\Bed;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAssignBedRequest;
use App\Http\Requests\UpdateAssignBedRequest;
use App\Repositories\BedAssignRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;


class BedAssignController extends Controller
{
    /**
     * @var BedAssignRepository
     */
    private $repository;
    private $indexRoute ;

    public function __construct(BedAssignRepository $repository, $indexRoute = 'bed.assign.index')
    {
        $this->repository = $repository;
        $this->indexRoute = $indexRoute;
    }
    public function index(){
        $bedTypes= $this->repository->getAllBedTypes();
        $bedList= $this->repository->getAllBedList();
        $patients= $this->repository->getAllPatient();
        $contentData = $this->repository->all();
//        return $contentData;
        return view('bed.assign.index', compact('contentData','bedTypes' , 'bedList', 'patients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateAssignBedRequest $request
     * @return JsonResponse
     */
    public function store(CreateAssignBedRequest $request): JsonResponse
//    public function store(CreateAssignBedRequest $request)
    {
//        return $request->all();
        $data = $this->repository->create($request);
//        return $data;
        return response()->json( 'Successfully Bed Assigned');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateAssignBedRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateAssignBedRequest $request, int $id): JsonResponse
    {
        $data = $this->repository->update($request, $id);
        return response()->json('Bed Assign Information Updated');
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
        return redirect()->route($this->indexRoute)->with('success', 'Assigned Bed Is Removed');
    }
    public function beds($id)
    {
        $data = $this->repository->getBeds($id);
        return response()->json($data);
    }
}
