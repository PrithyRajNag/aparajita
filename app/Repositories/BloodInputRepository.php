<?php
namespace App\Repositories;

use App\Models\BloodCollection;
use App\Models\BloodInput;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BloodInputRepository
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
//        return $this->model->with('bloodCollection')->get();
        return $this->model->where('organization_id',auth()->user()->organization_id)->get();
    }

    public function create($request): bool
    {
        if ($request->has('first_name') && $request->get('first_name')) {
            $this->model->first_name = $request->first_name;
        }
        if ($request->has('last_name') && $request->get('last_name')) {
            $this->model->last_name = $request->last_name;
        }
        if ($request->has('age') && $request->get('age')) {
            $this->model->age = $request->age;
        }
        if ($request->has('address') && $request->get('address')) {
            $this->model->address = $request->address;
        }
        if ($request->has('phone_number') && $request->get('phone_number')) {
            $this->model->phone_number = $request->phone_number;
        }
        if ($request->has('gender') && $request->get('gender')) {
            $this->model->gender = $request->gender;
        }
        if ($request->has('date') && $request->get('date')) {
            $this->model->date = $request->date;
        }
        if ($request->has('is_regular_donor') ) {
            $this->model->is_regular_donor = $request->is_regular_donor;
        }
        if ($request->has('blood_group_id') && $request->get('blood_group_id')) {
            $this->model->blood_group_id = $request->blood_group_id;
        }

        $this->model->organization_id = auth()->user()->organization_id;

        $this->model->save();

        $bloodCollection = new BloodCollection();
        if ($request->has('bag_number') && $request->get('bag_number')) {
            $bloodCollection->bag_number = $request->bag_number;
        }
        if ($request->has('blood_group_id') && $request->get('blood_group_id')) {
            $bloodCollection->blood_group_id = $request->blood_group_id;
        }
        $bloodCollection->is_available = true;
        $bloodCollection->blood_input_id = $this->model->id;
        $bloodCollection->organization_id = auth()->user()->organization_id;
        return $bloodCollection->save();

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
        if ($request->has('date') && $request->get('date')) {
            $item->date = $request->date;
        }
        if ($request->has('is_regular_donor') && $request->get('is_regular_donor')) {
            $item->is_regular_donor = $request->is_regular_donor;
        }
        if ($request->has('blood_group_id') && $request->get('blood_group_id')) {
            $item->blood_group_id = $request->blood_group_id;
        }
        $item->save();


        $collection = BloodCollection::where('blood_input_id',$id)->first();

        if ($request->has('bag_number') && $request->get('bag_number')) {
            $collection->bag_number = $request->bag_number;
        }
        if ($request->has('blood_group_id') && $request->get('blood_group_id')) {
            $collection->blood_group_id = $request->blood_group_id;
        }

        return $collection->save();
    }

    public function delete($id)
    {
        $item = $this->model->find($id);

        if (!$item) {
            throw new NotFoundHttpException('Blood Input Record Not Found');
        }

        return $item->delete();
    }
    public function getAllBloodGroups()
    {
        return $this->bloodGroupRepository->all();
    }

    public function getBloodCollection()
    {
        $data = BloodCollection::get();
        $available = [];
        $unavailable = [];
        foreach ($data as $item) {
            if (isset($available[$item['blood_group_id']]) && $item['is_available'] == 1 ) {
                $available[$item['blood_group_id']] = $available[$item['blood_group_id']] + 1;
            }
            if ( !isset($available[$item['blood_group_id']]) && $item['is_available'] == 1 ) {
                $available[$item['blood_group_id']] = 1;
            }


            if (isset($unavailable[$item['blood_group_id']]) && $item['is_available'] == 0 ) {
                $unavailable[$item['blood_group_id']] = $unavailable[$item['blood_group_id']] + 1;
            }
            if ( !isset($unavailable[$item['blood_group_id']]) && $item['is_available'] == 0 ) {
                $unavailable[$item['blood_group_id']] = 1;
            }


        }
        return [
            'available' => $available,
            'unavailable' => $unavailable,
        ];
    }
}
