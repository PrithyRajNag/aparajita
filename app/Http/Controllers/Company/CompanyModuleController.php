<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCompanyModuleRequest;
use App\Http\Requests\UpdateCompanyModuleRequest;
use App\Repositories\CompanyModuleRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CompanyModuleController extends Controller
{
    private $repository;
    private $indexRoute ;

    public function __construct(CompanyModuleRepository $repository, $indexRoute = 'company.module.index')
    {
        $this->repository = $repository;
        $this->indexRoute = $indexRoute;
    }


    public function index(){
        $contentData = $this->repository->all();
        return view('company.module.index',compact('contentData'));
    }


    public function store(CreateCompanyModuleRequest $request):JsonResponse
    {

        $data = $this->repository->create($request);
        return response()->json( 'Successfully Module Created');
    }


    public function update(UpdateCompanyModuleRequest $request, int $id): JsonResponse
    {
        $data = $this->repository->update($request, $id);
        return response()->json('Successfully Module Updated');
    }


    public function destroy(int $id): RedirectResponse
    {
        $data = $this->repository->delete($id);
        return redirect()->route($this->indexRoute)->with('success', 'Module Deleted');
    }
}
