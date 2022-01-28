<?php

namespace App\Http\Controllers\patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePatientReportRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PatientReportController extends Controller
{

//    private $repository;
//    private $indexRoute ;
//
//    public function __construct(Repository $repository, $indexRoute = 'patient.report.index')
//    {
//        $this->repository = $repository;
//        $this->indexRoute = $indexRoute;
//    }
//    public function index(){
//        return view('patient.report.index');
//    }
//
//
//    public function store(CreatePatientPaymentRequest $request): RedirectResponse
//    {
//        $data = $this->repository->create($request);
//        return redirect()->route($this->indexRoute)->with('success', 'Successfully Patient Report Record Created');
//    }
//
//
//    public function update(UpdatePatientReportRequest $request, int $id): JsonResponse
//    {
//        $data = $this->repository->update($request, $id);
//        return response()->json('Patient Report Information Updated');
//    }
//
//    public function destroy(int $id): RedirectResponse
//    {
//        $data = $this->repository->delete($id);
//        return redirect()->route($this->indexRoute)->with('success', 'Patient Report Information Removed');
//    }
}
