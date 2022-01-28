<?php
namespace App\Repositories;

use App\Models\Lab;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class LabRepository
{
    private $model;
    public function __construct(Lab $model)
    {
        $this->model = $model;
    }
    public function all()
    {
        return $this->model->where('organization_id',auth()->user()->organization_id)->get();
    }

    public function create($request): bool
    {

        if ($request->has('name') && $request->get('name')) {
            $this->model->name = $request->name;
        }
        if ($request->has('address') && $request->get('address')) {
            $this->model->address = $request->address;
        }
        $this->model->organization_id = auth()->user()->organization_id;

        return $this->model->save();

    }
    public function update($request, $id)
    {
        $item = $this->model->find($id);

        if (!$item) {
            throw new NotFoundHttpException('Lab Not Found');
        }

        if ($request->has('name') && $request->get('name')) {
            $item->name = $request->name;
        }
        if ($request->has('address') && $request->get('address')) {
            $item->address = $request->address;
        }

        return $item->save();
    }

    public function delete($id)
    {
        $item=$this->model->find($id);
        if (!$item) {
            throw new NotFoundHttpException('Lab Not Found');
        }
        return $item->delete();
    }
}
