<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\PatientAdmitAndDischarge;
use App\Repositories\BedAssignRepository;
use App\Repositories\PatientAppointmentRepository;
use App\Repositories\PatientRepository;
use App\Repositories\PatientTestRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PatientHistoryController extends Controller
{

    private $patientRepository;
    private $patientAppointmentRepository;
    private $bedAssignRepository;
    private $patientTestRepository;
    private $indexRoute ;

    public function __construct(
        PatientRepository $patientRepository,
        PatientAppointmentRepository $patientAppointmentRepository,
        BedAssignRepository $bedAssignRepository,
        PatientTestRepository $patientTestRepository,
        $indexRoute = 'patient.history.index')
    {

        $this->patientRepository = $patientRepository;
        $this->patientAppointmentRepository = $patientAppointmentRepository;
        $this->bedAssignRepository = $bedAssignRepository;
        $this->patientTestRepository = $patientTestRepository;
        $this->indexRoute = $indexRoute;
    }


    public function index($patientId){
        $patientInfo = $this->patientRepository->get($patientId);
        $appointments = $this->patientAppointmentRepository->getPatientAppointments($patientId);
        $beds = $this->bedAssignRepository->getPatientBeds($patientId);
        $tests = $this->patientTestRepository->getPatientTests($patientId);
        $caseHistories = PatientAdmitAndDischarge::where('patient_id', $patientId)->orderBy('admit_date', 'desc')->get();
//            return $tests;
        return view('patient.history.index', compact('patientInfo', 'appointments', 'beds', 'caseHistories', 'tests'));
    }
//
//
//    public function store(CreatePatientHistoryRequest $request): RedirectResponse
//    {
//        $data = $this->repository->create($request);
//        return redirect()->route($this->indexRoute)->with('success', 'Successfully Patient History Created');
//    }
//
//
//    public function update(UpdatePatientHistoryRequest $request, int $id): JsonResponse
//    {
//        $data = $this->repository->update($request, $id);
//        return response()->json('Patient History Information Updated');
//    }
//
//    public function destroy(int $id): RedirectResponse
//    {
//        $data = $this->repository->delete($id);
//        return redirect()->route($this->indexRoute)->with('success', 'Patient History Information Removed');
//    }

}
