<?php
namespace App\Repositories;

use App\Models\BloodInput;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BloodDonorRepository
{
    private $model;
    private $bloodGroupRepository;

    public function __construct(BloodInput $model, BloodGroupRepository $bloodGroupRepository)
    {
        $this->model = $model;
        $this->bloodGroupRepository = $bloodGroupRepository;
    }
    public function all()
    {
        return $this->model->where('is_regular_donor', 1)->get();;
    }

    public function create($request): bool
    {

        return $this->model->save();

    }
    public function update($request, $id)
    {
        $item = $this->model->find($id);

        if (!$item) {
            throw new NotFoundHttpException('Blood Input Record Not Found');
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
        if ($request->has('address') && $request->get('address')) {
            $item->address = $request->address;
        }
        if ($request->has('phone_number') && $request->get('phone_number')) {
            $item->phone_number = $request->phone_number;
        }
        if ($request->has('gender') && $request->get('gender')) {
            $item->gender = $request->gender;
        }
        if ($request->has('blood_group_id') && $request->get('blood_group_id')) {
            $item->blood_group_id = $request->blood_group_id;
        }



        return $item->save();
    }

    public function delete($id)
    {
        $item = $this->model->find($id);

        if (!$item) {
            throw new NotFoundHttpException();
        }

        return $item->delete();
    }

    public function getAllBloodGroups()
    {
        return $this->bloodGroupRepository->all();
    }
}
