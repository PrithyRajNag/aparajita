<?php
namespace App\Repositories;

use App\Models\BedType;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BedTypeRepository
{
    /**
     * @var BedType
     */
    private $model;

    /**
     * BedTypeRepository constructor.
     * @param BedType $model
     */
    public function __construct(BedType $model)
    {
        $this->model = $model;
    }

    /**
     * @return BedType[]|Collection
     */
    public function all()
    {
//        return $this->model->all();
        return $this->model->where('organization_id',auth()->user()->organization_id)->get();
    }

    /**
     * @param $request
     * @param $organization_id
     * @return bool
     */
    public function create($request): bool
    {
        if ($request->has('name') && $request->get('name')) {
            $this->model->name = $request->name;
        }
        if ($request->has('status')) {
            $this->model->status = $request->status;
        }
        if ($request->has('description') && $request->get('description')) {
            $this->model->description = $request->description;
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
            throw new NotFoundHttpException('Bed Type Not Found');
        }
        if ($request->has('name') && $request->get('name')) {
            $item->name = $request->name;
        }
        if ($request->has('status')) {
            $item->status = $request->status;
        }
        if ($request->has('description') && $request->get('description')) {
            $item->description = $request->description;
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
            throw new NotFoundHttpException('Bed Type Not Found');
        }
        return $item->delete();
    }

}
