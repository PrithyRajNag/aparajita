<?php

namespace App\Repositories;

use App\Models\BloodCollection;
use App\Models\BloodOutput;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BloodOutputRepository
{
    private $model;
    private $bloodGroupRepository;
    private $bloodInputRepository;

    public function __construct(BloodOutput $model,
                                BloodGroupRepository $bloodGroupRepository,
                                BloodInputRepository $bloodInputRepository
    )
    {
        $this->model = $model;
        $this->bloodGroupRepository = $bloodGroupRepository;
        $this->bloodInputRepository = $bloodInputRepository;
    }

    public function all()
    {
//        return $this->model->all();
//        return $this->model->with('bloodCollection')->get();
        return $this->model->where('organization_id',auth()->user()->organization_id)->get();
    }

    public function create($request): bool
    {
        $organization_id = auth()->user()->organization_id;
        if ($request->has('name') && $request->get('name')) {
            $this->model->name = $request->name;
        }
        if ($request->has('address') && $request->get('address')) {
            $this->model->address = $request->address;
        }
        if ($request->has('phone_number') && $request->get('phone_number')) {
            $this->model->phone_number = $request->phone_number;
        }
        if ($request->has('date') && $request->get('date')) {
            $this->model->date = $request->date;
        }
        if ($request->has('is_patient')) {
            $this->model->is_patient = $request->is_patient;
        }
        if ($request->has('blood_group_id') && $request->get('blood_group_id')) {
            $this->model->blood_group_id = $request->blood_group_id;
        }
        if ($request->has('blood_collection_id') && $request->get('blood_collection_id')) {
            $this->model->blood_collection_id = $request->blood_collection_id;
            $bloodCollection = BloodCollection::find($this->model->blood_collection_id);

            $bloodCollection->is_available = false;
            $bloodCollection->save();
        }
        $this->model->organization_id = $organization_id;
//        $this->model->save();

        return $this->model->save();

    }

    public function update($request, $id)
    {
        $item = $this->model->find($id);

        if (!$item) {
            throw new NotFoundHttpException('Blood Output Record Not Found');
        }
//        $bag_number = $item->blood_collection_id;

        $bloodCollectionId = $item->blood_collection_id;

        if ($request->has('name') && $request->get('name')) {
            $item->name = $request->name;
        }
        if ($request->has('address') && $request->get('address')) {
            $item->address = $request->address;
        }
        if ($request->has('phone_number') && $request->get('phone_number')) {
            $item->phone_number = $request->phone_number;
        }
        if ($request->has('date') && $request->get('date')) {
            $item->date = $request->date;
        }
        if ($request->has('is_patient')) {
            $item->is_patient = $request->is_patient;
        }
        if ($request->has('blood_group_id') && $request->get('blood_group_id')) {
            $item->blood_group_id = $request->blood_group_id;
        }

        if ($request->has('blood_collection_id') && $request->get('blood_collection_id') && $bloodCollectionId != $request->get('blood_collection_id')) {

            $item->blood_collection_id = $request->blood_collection_id;
            $bloodCollection = BloodCollection::find($item->blood_collection_id);

            $bloodCollection->is_available = false;
            $bloodCollection->save();

            $bloodCollection = BloodCollection::find($bloodCollectionId);

            $bloodCollection->is_available = true;
            $bloodCollection->save();

        }

        return $item->save();

    }

    public function delete($id)
    {
        $item = $this->model->find($id);

        if (!$item) {
            throw new NotFoundHttpException('Blood Output Record Not Found');
        }

        return $item->delete();
    }

    public function getAllBloodGroups()
    {
        return $this->bloodGroupRepository->all();
    }

    public function getAvailableBlood()
    {
        return BloodCollection::where('is_available', 1)->get();
    }

    public function getBloodCollection()
    {
        $data = BloodCollection::get();
        $available = [];
        $unavailable = [];
        foreach ($data as $item) {
            if (isset($available[$item['blood_group_id']]) && $item['is_available'] == 1) {
                $available[$item['blood_group_id']] = $available[$item['blood_group_id']] + 1;
            }
            if (!isset($available[$item['blood_group_id']]) && $item['is_available'] == 1) {
                $available[$item['blood_group_id']] = 1;
            }


            if (isset($unavailable[$item['blood_group_id']]) && $item['is_available'] == 0) {
                $unavailable[$item['blood_group_id']] = $unavailable[$item['blood_group_id']] + 1;
            }
            if (!isset($unavailable[$item['blood_group_id']]) && $item['is_available'] == 0) {
                $unavailable[$item['blood_group_id']] = 1;
            }


        }
        return [
            'available' => $available,
            'unavailable' => $unavailable,
        ];
    }

    public function getBloodBags($id)
    {
        return BloodCollection::where('is_available', 1)
            ->where('blood_group_id', $id)
            ->get();
    }

}
