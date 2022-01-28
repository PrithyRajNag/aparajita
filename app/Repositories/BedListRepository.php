<?php
namespace App\Repositories;

use App\Models\BedList;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BedListRepository
{
    /**
     * @var Bedlist
     */
    private $model;
    private $bedTypeRepository;

    /**
     * BedListRepository constructor.
     * @param BedList $model
     * @param BedTypeRepository $bedTypeRepository
     */
    public function __construct(BedList $model, BedTypeRepository $bedTypeRepository)
    {
        $this->model = $model;
        $this->bedTypeRepository = $bedTypeRepository;
    }

    /**
     * @return BedList[]|Collection
     */
    public function all()
    {
//        return $this->model->with('bedType')->get();
//        return $this->model->all();
        return $this->model->where('organization_id',auth()->user()->organization_id)->get();
    }

    /**
     * @param $request
     * @return bool
     */
    public function create($request): bool
    {
        if ($request->has('bed_number') && $request->get('bed_number')) {
            $this->model->bed_number = $request->bed_number;
        }
        if ($request->has('bed_type_id') && $request->get('bed_type_id')) {
            $this->model->bed_type_id = $request->bed_type_id;
        }
        if ($request->has('floor') && $request->get('floor')) {
            $this->model->floor = $request->floor;
        }
        if ($request->has('description') && $request->get('description')) {
            $this->model->description = $request->description;
        }
        if ($request->has('price') && $request->get('price')) {
            $this->model->price = $request->price;
        }
        if ($request->has('is_available')) {
            $this->model->is_available = $request->is_available;
        }
        if ($request->has('status')) {
            $this->model->status = $request->status;
        }
        $this->model->organization_id = auth()->user()->organization_id;;

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
            throw new NotFoundHttpException('Bed Not fount');
        }
        if ($request->has('bed_number') && $request->get('bed_number')) {
            $item->bed_number = $request->bed_number;
        }
        if ($request->has('bed_type_id') && $request->get('bed_type_id')) {
            $item->bed_type_id = $request->bed_type_id;
        }
        if ($request->has('floor') && $request->get('floor')) {
            $item->floor = $request->floor;
        }
        if ($request->has('description') && $request->get('description')) {
            $item->description = $request->description;
        }
        if ($request->has('price') && $request->get('price')) {
            $item->price = $request->price;
        }
        if ($request->has('is_available')) {
            $item->is_available = $request->is_available;
        }
        if ($request->has('status')) {
            $item->status = $request->status;
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
            throw new NotFoundHttpException('Bed Not Found');
        }
        return $item->delete();
    }

    public function getAllBedTypes()
    {
        return $this->bedTypeRepository->all();
    }
}
