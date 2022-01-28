<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCompanyCreateorganizationRequest;
use App\Http\Requests\CreateorganizationRequest;
use App\Http\Requests\UpdateOrganizationRequest;
use App\Repositories\BloodGroupRepository;
use App\Repositories\CompanyModuleRepository;
use App\Repositories\OrganizationRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    private $repository;
    private $bloodGroupRepository;
    private $companyModuleRepository;
    private $indexRoute;

    public function __construct(OrganizationRepository $repository,
                                BloodGroupRepository $bloodGroupRepository,
                                CompanyModuleRepository $companyModuleRepository,
                                $indexRoute = 'company.organization.index'
    )
    {
        $this->repository = $repository;
        $this->bloodGroupRepository = $bloodGroupRepository;
        $this->companyModuleRepository = $companyModuleRepository;
        $this->indexRoute = $indexRoute;
    }


    public function index()
    {
        $contentData = $this->repository->all();
        return view('company.organization.index', compact('contentData'));
    }


    public function create()
    {
        $bloodGroups = $this->bloodGroupRepository->all();
        $modules = $this->companyModuleRepository->all();
        return view('company.organization.create', compact('bloodGroups', 'modules'));
    }


    public function store(CreateOrganizationRequest $request)
    {
//        return $request->all();
        $data = $this->repository->create($request);
//        return $data;
        return redirect()->route($this->indexRoute)->with('success', 'Successfully Organization Created');
    }

    public function edit($id){
        $data = $this->repository->get($id);
        $modules = $this->companyModuleRepository->all();
        $bloodGroups = $this->bloodGroupRepository->all();
//        return [$data];
        return view('company.organization.edit', compact('data', 'modules', 'bloodGroups'));
    }

    public function update(UpdateOrganizationRequest $request, int $id):RedirectResponse
    {
        $data = $this->repository->update($request, $id);
        return redirect()->route( 'company.organization.index')->with('success','Successfully Organization Information Updated');
    }
    public function show(int $id)
    {
        $data = $this->repository->get( $id);
        return view('company.employee.info',compact('data'));
    }

    public function destroy(int $id): RedirectResponse
    {
        $data = $this->repository->delete($id);
        return redirect()->route($this->indexRoute)->with('success', 'Organization Deleted');
    }
}
