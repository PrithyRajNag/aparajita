<?php
namespace App\Repositories;

use App\Models\Death;
use App\Models\Patient;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DeathRepository
{
    private $model;
    private $patientRepository;
    private $doctorRepository;

    public function __construct(Death $model,  PatientRepository $patientRepository, DoctorRepository $doctorRepository)
    {
        $this->model = $model;
        $this->patientRepository = $patientRepository;
        $this->doctorRepository = $doctorRepository;
    }
    public function all()
    {
//        return $this->model->all();
        return $this->model->with('doctors')->where('organization_id',auth()->user()->organization_id)->get();
    }

    public function create($request): bool
    {
        if ($request->has('date') && $request->get('date')) {
            $this->model->date = $request->date;
        }
        if ($request->has('time') && $request->get('time')) {
            $this->model->time = $request->time;
        }
        if ($request->has('patient_id') && $request->get('patient_id')) {
            $this->model->patient_id = $request->patient_id;

            $patient = Patient::find($this->model->patient_id);

            $patient->is_alive = false;
            $patient->save();
        }
        if ($request->has('phone_number') && $request->get('phone_number')) {
            $this->model->phone_number = $request->phone_number;
        }
        if ($request->has('note') && $request->get('note')) {
            $this->model->note = $request->note;
        }
        if ($request->has('doctor_id') && $request->get('doctor_id')) {
            $this->model->doctor_id = $request->doctor_id;
        }
        $this->model->organization_id = auth()->user()->organization_id;
        return $this->model->save();

    }
    public function update($request, $id)
    {
        $item = $this->model->find($id);

        if (!$item) {
            throw new NotFoundHttpException('Death Record Not Found');
        }
        if ($request->has('date') && $request->get('date')) {
            $item->date = $request->date;
        }
        if ($request->has('time') && $request->get('time')) {
            $item->time = $request->time;
        }

        $patientId = $item->patient_id;
        if ($request->has('patient_id') && $request->get('patient_id') && $patientId != $request->get('patient_id')) {
            $item->patient_id = $request->patient_id;

            $patient = Patient::find($item->patient_id);

            $patient->is_alive = false;
            $patient->save();

            $patient = Patient::find($patientId);

            $patient->is_alive = true;
            $patient->save();
        }
        if ($request->has('phone_number') && $request->get('phone_number')) {
            $item->phone_number = $request->phone_number;
        }
        if ($request->has('note') && $request->get('note')) {
            $item->note = $request->note;
        }
        if ($request->has('doctor_id') && $request->get('doctor_id')) {
            $item->doctor_id = $request->doctor_id;
        }
        return $item->save();
    }

    public function delete($id)
    {
        $item=$this->model->find($id);
        if (!$item) {
            throw new NotFoundHttpException('Death Record Not Found');
        }
        return $item->delete();
    }
    public function getAllPatients()
    {
//        return $this->patientRepository->all();
        return Patient::where('organization_id',auth()->user()->organization_id)->where('is_alive',1)->get();
    }
    public function getAllDoctors()
    {
        return $this->doctorRepository->all();
    }
}
