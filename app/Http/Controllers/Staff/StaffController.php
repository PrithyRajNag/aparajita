<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateStaffRequest;
use App\Http\Requests\UpdateStaffRequest;
use App\Repositories\StaffRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StaffController extends Controller
{

    private $repository;
    private $indexRoute ;

    public function __construct(StaffRepository $repository, $indexRoute = 'staff.index')
    {
        $this->repository = $repository;
        $this->indexRoute = $indexRoute;
    }

    public function index(){
        $contentData = $this->repository->all();
        return view('staff.index' , compact('contentData'));
    }


    public function create(){
        $bloodGroups = $this->repository->getAllBloodGroups();
        $roles = $this->repository->getAllRoles();
//        return $roles;
        return view('staff.create', compact('bloodGroups', 'roles'));
    }



    public function store(CreateStaffRequest $request)
    {
//        return $request->all();
        $data = $this->repository->create($request);
        return redirect()->route($this->indexRoute)->with('success', 'Successfully Staff Created');
    }

    public function edit($id){
        $data = $this->repository->get($id);
        $bloodGroups = $this->repository->getAllBloodGroups();
        $roles = $this->repository->getAllRoles();

        return view('staff.edit', compact('data','bloodGroups','roles'));
    }

    public function update(UpdateStaffRequest $request, int $id):RedirectResponse
    {
        $data = $this->repository->update($request, $id);
        return redirect()->route( 'staff.index')->with('success','Successfully Staff Information Updated');
    }
    public function show(int $id)
    {
        $data = $this->repository->get( $id);
        return view('staff.info',compact('data'));
    }

    public function destroy(int $id): RedirectResponse
    {
        $data = $this->repository->delete($id);
        return redirect()->route($this->indexRoute)->with('success', 'Staff Is Deleted');
    }
}
