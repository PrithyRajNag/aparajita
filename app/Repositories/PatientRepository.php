<?php
namespace App\Repositories;

use App\Models\DoctorAssignToPatient;
use App\Models\Patient;
use App\Models\PatientAdmitAndDischarge;
use App\Models\PatientAppointment;
use App\Models\PatientBilling;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PatientRepository
{
    private $model;
    private $bloodGroupRepository;
    private $doctorRepository;

    public function __construct(Patient $model, BloodGroupRepository $bloodGroupRepository, DoctorRepository $doctorRepository)
    {
        $this->model = $model;
        $this->bloodGroupRepository = $bloodGroupRepository;
        $this->doctorRepository = $doctorRepository;
    }
    public function all()
    {
        return $this->model->where('organization_id',auth()->user()->organization_id)->get();
    }
    public function current()
    {
        return $this->model->where('organization_id',auth()->user()->organization_id)->where('status',1)->where('is_appointment',0)->get();
    }

    public function create($request): bool
    {
 ////////Need For All TYpe///////
        if ($request->has('first_name') && $request->get('first_name')) {
            $this->model->first_name = $request->first_name;
        }
        if ($request->has('last_name') && $request->get('last_name')) {
            $this->model->last_name = $request->last_name;
        }
        if ($request->has('age') && $request->get('age')) {
            $this->model->age = $request->age;
        }
        if ($request->has('phone_number') && $request->get('phone_number')) {
            $this->model->phone_number = $request->phone_number;
        }
        if ($request->has('gender') && $request->get('gender')) {
            $this->model->gender = $request->gender;
        }
        if ($request->has('religion') && $request->get('religion')) {
            $this->model->religion = $request->religion;
        }
        if ($request->has('dob') && $request->get('dob')) {
            $this->model->dob = $request->dob;
        }
        if ($request->has('address') && $request->get('address')) {
            $this->model->address = $request->address;
        }
        if ($request->has('blood_group_id') && $request->get('blood_group_id')) {
            $this->model->blood_group_id = $request->blood_group_id;
        }
        if ($request->hasFile('image')) {
            $image = base64_encode(file_get_contents($request->file('image')));
            $this->model->image = $image;
        }

//        if ($request->hasFile('image')) {
//            $fileName = time() . '.' . $request->image->getClientOriginalName();
//            $path = $request->image->store('public/images/');
//            $this->model->image = $request->image->hashname();
//        }

        $this->model->organization_id = auth()->user()->organization_id;
        $this->model->save();


 ////////Need For Hospital///////

        // Patient admit record saving
        $patientAdmitNDischarge = new PatientAdmitAndDischarge();
        if ($request->has('attendee_name') && $request->get('attendee_name')) {
            $patientAdmitNDischarge->attendee_name = $request->attendee_name;
        }
        if ($request->has('attendee_relation_with_patient') && $request->get('attendee_relation_with_patient')) {
            $patientAdmitNDischarge->attendee_relation_with_patient = $request->attendee_relation_with_patient;
        }
        if ($request->has('admit_date') && $request->get('admit_date')) {
            $patientAdmitNDischarge->admit_date = $request->admit_date;
        }
        if ($request->has('admit_time') && $request->get('admit_time')) {
            $patientAdmitNDischarge->admit_time = $request->admit_time;
        }
        if ($request->has('discharge_date') && $request->get('discharge_date')) {
            $patientAdmitNDischarge->discharge_date = $request->discharge_date;
        }
        if ($request->has('discharge_time') && $request->get('discharge_time')) {
            $patientAdmitNDischarge->discharge_time = $request->discharge_time;
        }
        if ($request->has('notes') && $request->get('notes')) {
            $patientAdmitNDischarge->notes = $request->notes;
        }
        $patientAdmitNDischarge->patient_id = $this->model->id;

        $patientAdmitNDischarge->save();


        //////// Doctor assign to patient saving ////////
        $doctorAssignToPatient = new DoctorAssignToPatient();

        if ($request->has('doctor_id') && $request->get('doctor_id')) {
            $doctorAssignToPatient->doctor_id = $request->doctor_id;
        }
        if ($request->has('release_date') && $request->get('release_date')) {
            $doctorAssignToPatient->release_date = $request->release_date;
        }
        if ($request->has('doctor_type_for_patient') && $request->get('doctor_type_for_patient')) {
            $doctorAssignToPatient->doctor_type_for_patient = $request->doctor_type_for_patient;
        }

        $doctorAssignToPatient->assign_date = $patientAdmitNDischarge->admit_date;

        $doctorAssignToPatient->patient_id = $this->model->id;


        return $doctorAssignToPatient->save();

    }

    public function update($request, $id)
    {

 ////////Need For All Type///////
        $item = $this->model->find($id);
        if (!$item) {
            throw new NotFoundHttpException('Patient not found');
        }
        if ($request->has('first_name') && $request->get('first_name')) {
            $item->first_name = $request->first_name;
        }
        if ($request->has('last_name') && $request->get('last_name')) {
            $item->last_name = $request->last_name;
        }
        if ($request->has('age') && $request->get('age')) {
            $item->age = $request->age;
        }
        if ($request->has('phone_number') && $request->get('phone_number')) {
            $item->phone_number = $request->phone_number;
        }
        if ($request->has('gender') && $request->get('gender')) {
            $item->gender = $request->gender;
        }
        if ($request->has('religion') && $request->get('religion')) {
            $item->religion = $request->religion;
        }
        if ($request->has('dob') && $request->get('dob')) {
            $item->dob = $request->dob;
        }
        if ($request->has('address') && $request->get('address')) {
            $item->address = $request->address;
        }
        if ($request->hasFile('image')) {
            $image = base64_encode(file_get_contents($request->file('image')));
            $item->image = $image;
        }
//        if ($request->hasFile('image')) {
//            if ($item->image != null && Storage::exists('public/images/' . $item->image) ) {
//                Storage::delete('public/images/' . $item->image);
//            }
//            $fileName = time() . '.' . $request->image->getClientOriginalName();
//            $request->image->store('public/images/');
//            $item->image = $request->image-> hashname();
//        }
        $item->save();



 ////////Need For Hospital///////
        $patientAdmitNDischarge = PatientAdmitAndDischarge::where('patient_id', $id)->first();
        if ($request->has('attendee_name') && $request->get('attendee_name')) {
            $patientAdmitNDischarge->attendee_name = $request->attendee_name;
        }
        if ($request->has('attendee_relation_with_patient') && $request->get('attendee_relation_with_patient')) {
            $patientAdmitNDischarge->attendee_relation_with_patient = $request->attendee_relation_with_patient;
        }
        if ($request->has('admit_date') && $request->get('admit_date')) {
            $patientAdmitNDischarge->admit_date = $request->admit_date;
        }
        if ($request->has('admit_time') && $request->get('admit_time')) {
            $patientAdmitNDischarge->admit_time = $request->admit_time;
        }
        if ($request->has('discharge_date') && $request->get('discharge_date')) {
            $patientAdmitNDischarge->discharge_date = $request->discharge_date;
        }
        if ($request->has('discharge_time') && $request->get('discharge_time')) {
            $patientAdmitNDischarge->discharge_time = $request->discharge_time;
        }
        if ($request->has('notes') && $request->get('notes')) {
            $patientAdmitNDischarge->notes = $request->notes;
        }
        $patientAdmitNDischarge->save();



        //////// Doctor assign to patient saving ////////
        $doctorAssignToPatient = DoctorAssignToPatient::where('patient_id', $id)->first();
        if ($request->has('doctor_id') && $request->get('doctor_id')) {
            $doctorAssignToPatient->doctor_id = $request->doctor_id;
        }
        if ($request->has('assign_date') && $request->get('assign_date')) {
            $doctorAssignToPatient->assign_date = $request->assign_date;
        }
        if ($request->has('release_date') && $request->get('release_date')) {
            $doctorAssignToPatient->release_date = $request->release_date;
        }
        if ($request->has('doctor_type_for_patient') && $request->get('doctor_type_for_patient')) {
            $doctorAssignToPatient->doctor_type_for_patient = $request->doctor_type_for_patient;
        }
        return $doctorAssignToPatient->save();
    }

    public function delete($id)
    {
        $item=$this->model->find($id);
        if (!$item) {
            throw new NotFoundHttpException('Patient Not Found');
        }
        PatientAppointment::where('patient_id',$id)->delete();
        return $item->delete();
    }


    public function get($id)
    {
        $item = $this->model->find($id);

        if (!$item) {
            throw new NotFoundHttpException('Patient not Found');
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
}
