<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Repositories\PatientRepository;
use Illuminate\Http\RedirectResponse;

class PatientController extends Controller
{
    private $repository;
    private $indexRoute ;

    public function __construct(PatientRepository $repository, $indexRoute = 'patient.index')
    {
        $this->repository = $repository;
        $this->indexRoute = $indexRoute;
    }
    public function index(){

        $contentData = $this->repository->all();
//        return $contentData;
        return view('patient.index', compact('contentData'));
    }
    public function currentPatient(){
        $contentData = $this->repository->current();
//        return $contentData;
        return view('patient.index', compact('contentData'));
    }

    public function create(){
        $bloodGroups = $this->repository->getAllBloodGroups();
        $doctors = $this->repository->getAllDoctors();
        return view('patient.create', compact( 'bloodGroups', 'doctors'));
    }

    public function store(CreatePatientRequest $request)
    {
        $data = $this->repository->create($request);
        return redirect()->route($this->indexRoute)->with('success', 'Successfully Patient Created');
    }

    public function edit($id){
        $data = $this->repository->get($id);
        $bloodGroups = $this->repository->getAllBloodGroups();
        $doctors = $this->repository->getAllDoctors();
//        return $data;
        return view('patient.edit', compact( 'data','bloodGroups', 'doctors'));
    }

    public function update(UpdatePatientRequest $request, int $id):RedirectResponse
    {
        $data = $this->repository->update($request, $id);
        return redirect()->route( 'patient.index')->with('success','Successfully Patient Updated');
    }

    public function show(int $id)
    {
        $data = $this->repository->get( $id);
        return view('patient.info',compact('data'));
    }

    public function destroy(int $id): RedirectResponse
    {
        $data = $this->repository->delete($id);
        return redirect()->route($this->indexRoute)->with('success', 'Patient Information Removed');
    }
}
