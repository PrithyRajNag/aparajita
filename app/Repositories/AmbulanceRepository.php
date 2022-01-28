<?php
namespace App\Repositories;

use App\Models\Ambulance;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AmbulanceRepository
{
    /**
     * @var Ambulance
     */
    private $model;

    /**
     * AmbulanceRepository constructor.
     * @param Ambulance $model
     */
    public function __construct(Ambulance $model)
    {
        $this->model = $model;
    }

    /**
     * @return Ambulance[]|Collection
     */
    public function all()
    {
//        return $this->model->all();
        return $this->model->where('organization_id',auth()->user()->organization_id)->get();
    }

    /**
     * @param $request
     * @return bool
     */
    public function create($request): bool
    {
        if ($request->has('vehicle_number') && $request->get('vehicle_number')) {
            $this->model->vehicle_number = $request->vehicle_number;
        }
        if ($request->has('vehicle_model') && $request->get('vehicle_model')) {
            $this->model->vehicle_model = $request->vehicle_model;
        }
        if ($request->has('driver_name') && $request->get('driver_name')) {
            $this->model->driver_name = $request->driver_name;
        }
        if ($request->has('driver_license') && $request->get('driver_license')) {
            $this->model->driver_license = $request->driver_license;
        }
        if ($request->has('driver_phone_number') && $request->get('driver_phone_number')) {
            $this->model->driver_phone_number = $request->driver_phone_number;
        }
        if ($request->has('driver_address') && $request->get('driver_address')) {
            $this->model->driver_address = $request->driver_address;
        }
        $this->model->organization_id = auth()->user()->organization_id;
        return $this->model->save();
    }

    /**
     * @param $request
     * @param $id
     * @return mixed
     */
    public function update($request, $id)
    {
        $item = $this->model->find($id);
        if (!$item) {
            throw new NotFoundHttpException('Ambulance not found');
        }
        if ($request->has('vehicle_number') && $request->get('vehicle_number')) {
            $item->vehicle_number = $request->vehicle_number;
        }
        if ($request->has('vehicle_model') && $request->get('vehicle_model')) {
            $item->vehicle_model = $request->vehicle_model;
        }
        if ($request->has('driver_name') && $request->get('driver_name')) {
            $item->driver_name = $request->driver_name;
        }
        if ($request->has('driver_license') && $request->get('driver_license')) {
            $item->driver_license = $request->driver_license;
        }
        if ($request->has('driver_phone_number') && $request->get('driver_phone_number')) {
            $item->driver_phone_number = $request->driver_phone_number;
        }
        if ($request->has('driver_address') && $request->get('driver_address')) {
            $item->driver_address = $request->driver_address;
        }
        return $item->save();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $item=$this->model->find($id);
        if (!$item) {
            throw new NotFoundHttpException('Ambulance Not Found');
        }
        return $item->delete();
    }
}
