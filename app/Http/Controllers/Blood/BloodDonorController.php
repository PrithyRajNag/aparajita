<?php

namespace App\Http\Controllers\Blood;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateBloodDonorRequest;
use App\Repositories\BloodDonorRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BloodDonorController extends Controller
{

    private $repository;
    private $indexRoute ;

    public function __construct(BloodDonorRepository $repository, $indexRoute = 'blood.donor.index')
    {
        $this->repository = $repository;
        $this->indexRoute = $indexRoute;
    }
    public function index(){

        $contentData = $this->repository->all();
        $bloodGroups = $this->repository->getAllBloodGroups();
//        return $contentData;
        return view('blood.donor.index',compact('contentData','bloodGroups'));
    }


//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param CreateBloodDonorRequest $request
//     * @return RedirectResponse
//     */
//    public function store( $request): RedirectResponse
//    {
//
//        $data = $this->repository->create($request);
//
//        return redirect()->route($this->indexRoute)->with('success', 'Successfully Blood Donor Created');
//
//    }

    public function update(UpdateBloodDonorRequest $request, int $id): JsonResponse
    {
        $data = $this->repository->update($request, $id);
        return response()->json('Blood Donor Information Updated');
    }

    public function destroy(int $id): RedirectResponse
    {
        $data = $this->repository->delete($id);
        return redirect()->route($this->indexRoute)->with('success', 'Blood Donor Is Removed');
    }
}
