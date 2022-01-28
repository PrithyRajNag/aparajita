<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCompanyCreateOrganizationRequest;
use App\Http\Requests\UpdateOrganizationRequest;
use App\Repositories\CompanyCreateHospitalRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CompanyCreateHospitalController extends Controller
{
    private $repository;
    private $indexRoute ;

    public function __construct(CompanyCreateHospitalRepository $repository, $indexRoute = 'company.organization.index')
    {
        $this->repository = $repository;
        $this->indexRoute = $indexRoute;
    }

    public function index(){
        $contentData = $this->repository->all();
        return view('company.organization.index' , compact('contentData'));
    }


    public function create(){
        return view('company.organization.create');
    }


    public function store(CreateCompanyCreateOrganizationRequest $request)
    {
        return $request->all();
        $data = $this->repository->create($request);
        return redirect()->route($this->indexRoute)->with('success', 'Successfully Hospital Created');
    }

    public function edit($id){
        $data = $this->repository->get($id);
        return view('company.organization.edit', compact('data','designations'));
    }

    public function update(UpdateOrganizationRequest $request, int $id):RedirectResponse
    {
        $data = $this->repository->update($request, $id);
        return redirect()->route( 'company.organization.index')->with('success','Successfully Hospital Information Updated');
    }
    public function show(int $id)
    {
        $data = $this->repository->get( $id);
        return view('company.employee.info',compact('data'));
    }

    public function destroy(int $id): RedirectResponse
    {
        $data = $this->repository->delete($id);
        return redirect()->route($this->indexRoute)->with('success', 'Hospital Deleted');
    }
}
