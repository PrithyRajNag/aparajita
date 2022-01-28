<?php

namespace App\Http\Controllers\Staff;


use App\Http\Controllers\Controller;
use App\Http\Requests\CreateStaffHolidaysRequest;
use App\Http\Requests\UpdateStaffHolidaysRequest;
use App\Repositories\StaffHolidaysRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class StaffHolidaysController extends Controller
{

    private $repository;
    private $indexRoute ;

    public function __construct(StaffHolidaysRepository $repository, $indexRoute = 'staff.holiday.index')
    {
        $this->repository = $repository;
        $this->indexRoute = $indexRoute;
    }
    public function index(){
        $contentData = $this->repository->all();
        $users = $this->repository->getStaffUsers();
        return view('staff.holiday.index' , compact('contentData', 'users' ));
    }


    public function store(CreateStaffHolidaysRequest $request): JsonResponse
    {
        $data = $this->repository->create($request);
        return response()->json( 'Successfully Staff Holiday Created');
    }

    public function update(UpdateStaffHolidaysRequest $request, int $id): JsonResponse
    {
        $data = $this->repository->update($request, $id);
        return response()->json('Successfully Staff Holiday Information Updated');
    }


    public function destroy(int $id): RedirectResponse
    {
        $data = $this->repository->delete($id);

        return redirect()->route($this->indexRoute)->with('success', 'Staff Holiday Information Removed');
    }
}
