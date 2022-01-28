<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePatientAppointmentRequest;
use App\Http\Requests\UpdatePatientAppointmentRequest;
use App\Repositories\PatientAppointmentRepository;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PatientAppointmentController extends Controller
{

    private $repository;
    private $indexRoute ;

    public function __construct(PatientAppointmentRepository $repository, $indexRoute = 'patient.appointment.index')
    {
        $this->repository = $repository;
        $this->indexRoute = $indexRoute;
    }
    public function index(){
        $contentData = $this->repository->all();
//        return $contentData;
        return view('patient.appointment.index', compact('contentData'));
    }

    public function create(){
        $bloodGroups = $this->repository->getAllBloodGroups();
        $doctors = $this->repository->getAllDoctors();
//        $fees = $this->repository->getFees();
        return view('patient.appointment.create', compact( 'bloodGroups', 'doctors'));
    }

    public function store(CreatePatientAppointmentRequest $request)
    {
//        return gettype($request->blood_group_id);

        $data = $this->repository->create($request);
        return redirect()->route($this->indexRoute)->with('success', 'Successfully Patient Appointment Created');
    }

    public function edit($id){
        $data = $this->repository->get($id);
//        return $data->doctors->full_name;
        $bloodGroups = $this->repository->getAllBloodGroups();
        $doctors = $this->repository->getAllDoctors();
        $request = Request();
        $request->request->add(['doctor_id' => $id, 'date' => $data->date]);
//        $appointmentSlots = $this->getStots($request);
//        return $appointmentSlots;
        return view('patient.appointment.edit', compact( 'data','bloodGroups', 'doctors'));
    }
    public function update(UpdatePatientAppointmentRequest $request, int $id)
    {
//        return $request->all();
        $data = $this->repository->update($request, $id);
        return redirect()->route( 'patient.appointment.index')->with('success','Successfully Patient Appointment Updated');
    }

    public function destroy(int $id): RedirectResponse
    {
        $data = $this->repository->delete($id);
        return redirect()->route($this->indexRoute)->with('success', 'Patient Appointment Removed');
    }

    public function getStots(Request $request)
    {
        $day = date('l', strtotime($request->date));
        $appointmentDates = $this->repository->getDoctorAppointmentDates($request->date, $request->doctor_id);
//        return $appointmentDates;
        $appointmentDateList = [];
        foreach($appointmentDates as $dates){
            array_push($appointmentDateList, Carbon::parse($dates->start_time)->format('H:i'));
        }


        $data = $this->repository->getDoctorSchedule($request->doctor_id,$day );
//        print_r('$this->repository->getDoctorSchedule($request->doctor_id,$day )');
//        print_r($request->doctor_id);
//        print_r($day);
//        dd($data);

        $start_time = Carbon::parse($data->start_time);
        $end_time = Carbon::parse($data->end_time);
        $totalDuration = $end_time->diffInMinutes($start_time);

        $patientLimit = $data->patient_limit;

        $slotDuration = floor($totalDuration/$patientLimit);

        $slotList = array();

        while($end_time >= $start_time){
            $slotStartTime = $start_time->format('h:i A');
            $isBooked = in_array( $start_time->format('H:i'), $appointmentDateList);
            $slotEndTime = $start_time->addMinutes($slotDuration);
            if ( $end_time >= $slotEndTime) {
                array_push($slotList,['slot'=>$slotStartTime . ' - '. $slotEndTime->format('h:i A'),'is_booked'=>$isBooked]);
                $start_time->addMinute();
            }
        }
//        return $slotList;
        return response()->json( $slotList);
    }
}
