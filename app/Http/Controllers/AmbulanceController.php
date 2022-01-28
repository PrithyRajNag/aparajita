<?php
namespace App\Http\Controllers;
use App\Http\Requests\CreateAmbulanceRequest;
use App\Http\Requests\UpdateAmbulanceRequest;
use App\Repositories\AmbulanceRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class AmbulanceController extends Controller
{
    /**
     * @param AmbulanceRepository $repository
     */
    private $repository;
    private $indexRoute ;

    public function __construct(AmbulanceRepository $repository, $indexRoute = 'ambulance.index')
    {
        $this->repository = $repository;
        $this->indexRoute = $indexRoute;
    }
    public function index(){
        $contentData = $this->repository->all();
        return view('ambulance.index', compact('contentData'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param CreateAmbulanceRequest $request
     * @return JsonResponse
     */
    public function store(CreateAmbulanceRequest $request): JsonResponse
    {
//        dd($request->all());
        $data = $this->repository->create($request);
        return response()->json( 'Successfully Ambulance Created');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param UpdateAmbulanceRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateAmbulanceRequest $request, int $id): JsonResponse
    {
        $data = $this->repository->update($request, $id);
        return response()->json('Ambulance Information Updated');
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
        return redirect()->route($this->indexRoute)->with('success', 'Ambulance Information Deleted');
    }
}
