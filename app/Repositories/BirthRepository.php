<?php


namespace App\Repositories;

use App\Models\Birth;
use App\Models\Patient;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BirthRepository
{
    private $model;
    private $bloodGroupRepository;
    private $doctorRepository;

    public function __construct(Birth $model, BloodGroupRepository $bloodGroupRepository, DoctorRepository $doctorRepository)
    {
        $this->model = $model;
        $this->bloodGroupRepository = $bloodGroupRepository;
        $this->doctorRepository = $doctorRepository;

    }

    public function all()
    {
//        return $this->model->all();
        return $this->model->with('doctors')->with('bloodGroups')->where('organization_id',auth()->user()->organization_id)->get();
    }

    public function create($request): bool
    {
        if ($request->has('name') && $request->get('name')) {
            $this->model->name = $request->name;
        }
        if ($request->has('gender') && $request->get('gender')) {
            $this->model->gender = $request->gender;
        }
        if ($request->has('weight') && $request->get('weight')) {
            $this->model->weight = $request->weight;
        }
        if ($request->has('date') && $request->get('date')) {
            $this->model->date = $request->date;
        }
        if ($request->has('time') && $request->get('time')) {
            $this->model->time = $request->time;
        }
        if ($request->has('doctor_id') && $request->get('doctor_id')) {
            $this->model->doctor_id = $request->doctor_id;
        }
        if ($request->has('mother_name') && $request->get('mother_name')) {
            $this->model->mother_name = $request->mother_name;
        }
        if ($request->has('father_name') && $request->get('father_name')) {
            $this->model->father_name = $request->father_name;
        }
        if ($request->has('phone_number') && $request->get('phone_number')) {
            $this->model->phone_number = $request->phone_number;
        }
        if ($request->has('blood_group_id') && $request->get('blood_group_id')) {
            $this->model->blood_group_id = $request->blood_group_id;
        }
        if ($request->has('address') && $request->get('address')) {
            $this->model->address = $request->address;
        }
        if ($request->has('note') && $request->get('note')) {
            $this->model->note = $request->note;
        }
        $this->model->organization_id = auth()->user()->organization_id;
        return $this->model->save();

    }
    public function update($request, $id)
    {
        $item = $this->model->find($id);

        if (!$item) {
            throw new NotFoundHttpException('Birth Record not found');
        }

        if ($request->has('name') && $request->get('name')) {
            $item->name = $request->name;
        }
        if ($request->has('gender') && $request->get('gender')) {
            $item->gender = $request->gender;
        }
        if ($request->has('weight') && $request->get('weight')) {
            $item->weight = $request->weight;
        }
        if ($request->has('date') && $request->get('date')) {
            $item->date = $request->date;
        }
        if ($request->has('time') && $request->get('time')) {
            $item->time = $request->time;
        }
        if ($request->has('doctor_id') && $request->get('doctor_id')) {
            $item->doctor_id = $request->doctor_id;
        }
        if ($request->has('mother_name') && $request->get('mother_name')) {
            $item->mother_name = $request->mother_name;
        }
        if ($request->has('father_name') && $request->get('father_name')) {
            $item->father_name = $request->father_name;
        }
        if ($request->has('phone_number') && $request->get('phone_number')) {
            $item->phone_number = $request->phone_number;
        }
        if ($request->has('blood_group_id') && $request->get('blood_group_id')) {
            $item->blood_group_id = $request->blood_group_id;
        }
        if ($request->has('address') && $request->get('address')) {
            $item->address = $request->address;
        }
        if ($request->has('note') && $request->get('note')) {
            $item->note = $request->note;
        }

        return $item->save();
    }

    public function delete($id)
    {
        $item=$this->model->find($id);
        if (!$item) {
            throw new NotFoundHttpException('Birth Record Not Found');
        }
        return $item->delete();
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
