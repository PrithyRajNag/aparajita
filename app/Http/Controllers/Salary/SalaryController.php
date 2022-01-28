<?php

namespace App\Http\Controllers\Salary;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSalaryRequest;
use App\Http\Requests\UpdateSalaryRequest;
use App\Repositories\SalaryRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    private $repository;
    private $indexRoute ;

    public function __construct(SalaryRepository $repository , $indexRoute = 'salary.index')
    {
        $this->repository = $repository;
        $this->indexRoute = $indexRoute;
    }
    public function index(){
        $contentData = $this->repository->all();
        return view('salary.index', compact('contentData' ));
    }
    public function store(CreateSalaryRequest $request): JsonResponse
    {
        $data = $this->repository->create($request);
        return response()->json( 'Successfully Salary Created');
    }
    public function update(UpdateSalaryRequest $request, int $id): JsonResponse
    {
        $data = $this->repository->update($request, $id);
        return response()->json('Salary Information Updated');
    }
    public function pay(int $id): RedirectResponse
    {
        $data = $this->repository->pay($id);
        return redirect()->route($this->indexRoute)->with('success', 'Salary Is Paid');
    }

    public function salarySheet($id){
        $data = $this->repository->getUser($id);
        $contentData = $this->repository->getUserSalarySheet($id);
        return view('salary.total.index', compact('data', 'contentData'));
    }

}
