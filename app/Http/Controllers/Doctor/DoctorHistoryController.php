<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateDoctorDocumentRequest;
use App\Http\Requests\CreateDoctorHistoryRequest;
use App\Http\Requests\UpdateDoctorHistoryRequest;
use App\Models\DoctorDocument;

use App\Repositories\AllDoctorsScheduleRepository;
use App\Repositories\DoctorHistoryRepository;
use App\Repositories\DoctorRepository;
use App\Repositories\PatientAppointmentRepository;
use App\Repositories\StaffHolidaysRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DoctorHistoryController extends Controller
{

    private $repository;
    private $doctorRepository;
    private $patientAppointmentRepository;
    private $allDoctorsScheduleRepository;
    private $staffHolidaysRepository;
    private $indexRoute ;

    public function __construct(
        DoctorHistoryRepository $repository,
        PatientAppointmentRepository $patientAppointmentRepository,
        AllDoctorsScheduleRepository $allDoctorsScheduleRepository,
        StaffHolidaysRepository $staffHolidaysRepository,
        DoctorRepository $doctorRepository,
        $indexRoute = 'doctor.history.index')
    {
        $this->repository = $repository;
        $this->doctorRepository = $doctorRepository;
        $this->patientAppointmentRepository = $patientAppointmentRepository;
        $this->allDoctorsScheduleRepository = $allDoctorsScheduleRepository;
        $this->staffHolidaysRepository = $staffHolidaysRepository;
        $this->indexRoute = $indexRoute;
    }
    public function index($doctorId){
        $doctorInfo= $this->doctorRepository->get($doctorId);
        $appointment_calender = $this->patientAppointmentRepository->getDoctorAppointmentCalender($doctorId);
        $appointments = $this->patientAppointmentRepository->getDoctorAppointments($doctorId);
        $timeSchedules = $this->allDoctorsScheduleRepository->getDoctorSchedules($doctorId);
        $holidays = $this->staffHolidaysRepository->getDoctorHolidays($doctorId);
        $documents = DoctorDocument::where('doctor_id',$doctorId)->get();
//        return $doctorInfo;
        $doctor = $this->repository->getAllDoctors();
        return view('doctor.history.index', compact('doctorInfo', 'appointments', 'appointment_calender', 'timeSchedules', 'holidays', 'documents','doctor'));
    }
    public function document($doctor_id)
    {
        $documents = DoctorDocument::all();
        return view('doctor.history.document.index', compact('documents'));
    }

    public function upload($doctor_id)
    {
        return view('doctor.history.document.create');
    }

    public function save(CreateDoctorDocumentRequest $request, $doctor_id)
    {
//        return $request->all();

        $data = $this->repository->createDocument($request, $doctor_id);
        return redirect()->route('doctor.history.index', $doctor_id);
    }
    public function download($slug)
    {
        $document = DoctorDocument::where('slug', $slug)->firstOrFail();
        $pathToFile = public_path('uploads/' . $document->cover);
        return response()->download($pathToFile);
    }
    public function show($doctor_id)
    {
        return view('doctor.history.document.index');
    }

//
//
//    public function store(CreateDoctorHistoryRequest $request): RedirectResponse
//    {
//
//        $data = $this->repository->create($request);
//
//        return redirect()->route($this->indexRoute)->with('success', 'Successfully Doctor History Created');
//
//    }
//
//    public function update(UpdateDoctorHistoryRequest $request, int $id): JsonResponse
//    {
//        $data = $this->repository->update($request, $id);
//        return response()->json('Doctor History Information Updated');
//    }
//
//
//    public function destroy(int $id): RedirectResponse
//    {
//        $data = $this->repository->delete($id);
//        return redirect()->route($this->indexRoute)->with('success', 'Doctor History Removed');
//    }
}
