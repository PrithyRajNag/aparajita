<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCompanyEmployeeRequest;
use App\Http\Requests\UpdateCompanyEmployeeRequest;
use App\Repositories\CompanyEmployeeRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CompanyEmployeeController extends Controller
{

    private $repository;
    private $indexRoute ;

    public function __construct(CompanyEmployeeRepository $repository, $indexRoute = 'company.employee.index')
    {
        $this->repository = $repository;
        $this->indexRoute = $indexRoute;
    }

    public function index(){
        $contentData = $this->repository->all();
        return view('company.employee.index' , compact('contentData'));
    }


    public function create(){
        $designations = $this->repository->getAllDesignations();
        return view('company.employee.create', compact('designations'));
    }



    public function store(CreateCompanyEmployeeRequest $request)
    {
//        return $request->all();
        $data = $this->repository->create($request);
        return redirect()->route($this->indexRoute)->with('success', 'Successfully Staff Created');
    }

    public function edit($id){
        $data = $this->repository->get($id);
        $designations = $this->repository->getAllDesignations();

        return view('company.employee.edit', compact('data','designations'));
    }

    public function update(UpdateCompanyEmployeeRequest $request, int $id):RedirectResponse
    {
        $data = $this->repository->update($request, $id);
        return redirect()->route( 'company.employee.index')->with('success','Successfully Employee Information Updated');
    }
    public function show(int $id)
    {
        $data = $this->repository->get( $id);
        return view('company.employee.info',compact('data'));
    }

    public function destroy(int $id): RedirectResponse
    {
        $data = $this->repository->delete($id);
        return redirect()->route($this->indexRoute)->with('success', 'Employee Deleted');
    }
}
