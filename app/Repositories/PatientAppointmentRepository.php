<?php
namespace App\Repositories;

use App\Models\AllDoctorsSchedule;
use App\Models\DoctorInfo;
use App\Models\Patient;
use App\Models\PatientAppointment;
use Carbon\Carbon;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PatientAppointmentRepository
{
    private $model;
    private $bloodGroupRepository;
    private $doctorRepository;

    public function __construct(PatientAppointment $model, DoctorRepository $doctorRepository,BloodGroupRepository $bloodGroupRepository)
    {
        $this->model = $model;
        $this->doctorRepository = $doctorRepository;
        $this->bloodGroupRepository = $bloodGroupRepository;
    }
    public function all()
    {
//        return $this->model->all();
        return $this->model->where('organization_id',auth()->user()->organization_id)->get();
    }

    public function create($request): bool
    {
        $patient = new Patient();
        if ($request->has('first_name') && $request->get('first_name')) {
            $patient->first_name = $request->first_name;
        }
        if ($request->has('last_name') && $request->get('last_name')) {
            $patient->last_name = $request->last_name;
        }
        if ($request->has('age') && $request->get('age')) {
            $patient->age = $request->age;
        }
        if ($request->has('phone_number') && $request->get('phone_number')) {
            $patient->phone_number = $request->phone_number;
        }
        if ($request->has('gender') && $request->get('gender')) {
            $patient->gender = $request->gender;
        }
        if ($request->has('religion') && $request->get('religion')) {
            $patient->religion = $request->religion;
        }
        if ($request->has('dob') && $request->get('dob')) {
            $patient->dob = $request->dob;
        }
        if ($request->has('address') && $request->get('address')) {
            $patient->address = $request->address;
        }
        if ($request->has('blood_group_id') && $request->get('blood_group_id')) {
            $patient->blood_group_id = $request->blood_group_id;
        }
        $patient->is_appointment = true;
        $patient->organization_id = auth()->user()->organization_id;

        $patient->save();

        $this->model->patient_id = $patient->id;

        if ($request->has('doctor_id') && $request->get('doctor_id')) {
            $this->model->doctor_id = $request->doctor_id;
        }
        if ($request->has('date') && $request->get('date')) {
            $this->model->date = $request->date;
        }
        if ($request->has('time') && $request->get('time')) {
//            $this->model->time = $request->time;
            $time = $request->time;

            $times = explode("-", $time);
            $s_time = $times[0];
            $e_time = $times[1];

            $this->model->start_time = Carbon::parse( $s_time)->format('H:i');
            $this->model->end_time = Carbon::parse( $e_time)->format('H:i');
        }
        $this->model->organization_id = auth()->user()->organization_id;

        return $this->model->save();

    }

    public function update($request, $id)
    {

        $patientAppointment = PatientAppointment::find($id);

        if (!$patientAppointment) {
            throw new NotFoundHttpException('Patient Appointment Not Found');
        }

        if ($request->has('doctor_id') && $request->get('doctor_id')) {
            $patientAppointment->doctor_id = $request->doctor_id;
        }
        if ($request->has('date') && $request->get('date')) {
            $patientAppointment->date = $request->date;
        }
        if ($request->has('time') && $request->get('time')) {
            $time = $request->time;

            $times = explode("-", $time);
            $s_time = $times[0];
            $e_time = $times[1];

            $patientAppointment->start_time = Carbon::parse( $s_time)->format('H:i');
            $patientAppointment->end_time = Carbon::parse( $e_time)->format('H:i');
        }

        $patientAppointment->save();

        $patient = Patient::find($patientAppointment->patient_id);

        if ($request->has('first_name') && $request->get('first_name')) {
            $patient->first_name = $request->first_name;
        }
        if ($request->has('last_name') && $request->get('last_name')) {
            $patient->last_name = $request->last_name;
        }
        if ($request->has('age') && $request->get('age')) {
            $patient->age = $request->age;
        }
        if ($request->has('phone_number') && $request->get('phone_number')) {
            $patient->phone_number = $request->phone_number;
        }
        if ($request->has('gender') && $request->get('gender')) {
            $patient->gender = $request->gender;
        }
        if ($request->has('religion') && $request->get('religion')) {
            $patient->religion = $request->religion;
        }
        if ($request->has('dob') && $request->get('dob')) {
            $patient->dob = $request->dob;
        }
        if ($request->has('address') && $request->get('address')) {
            $patient->address = $request->address;
        }
        if ($request->has('blood_group_id') && $request->get('blood_group_id')) {
            $patient->blood_group_id = $request->blood_group_id;
        }
        $patient->is_appointment = true;
        return $patient->save();

    }

    public function delete($id)
    {
        $item = PatientAppointment::find($id);

        if (!$item) {
            throw new NotFoundHttpException('Patient Appointment Not Found');
        }

        return $item->delete();
    }

    public function get($id)
    {
        $item = $this->model->find($id);

        if (!$item) {
            throw new NotFoundHttpException('Patient Appointment not Found');
        }
        return $item;
    }

    public function getAllBloodGroups()
    {
        return $this->bloodGroupRepository->all();
    }

    public function getAllDoctors()
    {
        return $this->doctorRepository->all();
    }

    public function getDoctorSchedule($doctorId, $day)
    {
        return AllDoctorsSchedule::where('doctor_id', $doctorId)->where('week_day',$day)->first();
    }




    public function getPatientAppointments($patient_id)
    {
        return $this->model->where('patient_id',$patient_id)->orderBy('date', 'desc')->get();
    }

    public function getDoctorAppointmentCalender($doctorId)
    {
        return $this->model->where('doctor_id', $doctorId)->orderBy('date', 'desc')->get();
    }

    public function getDoctorAppointments($doctorId)
    {
        $today = Carbon::now();
        return $this->model->where('doctor_id', $doctorId)->where('date', $today->toDateString())->orderBy('date', 'desc')->get();
    }

    public function getDoctorAppointmentDates($date, $doctorId)
    {
        return $this->model->where('doctor_id', $doctorId)
            ->where('date', $date)->get();
    }
}
