<?php


namespace App\Repositories;
use App\Models\Department;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DepartmentRepository
{
    /**
     * @var Department
     */
    private $model;
    public function __construct(Department $model)
    {
        $this->model = $model;
    }
    public function all()
    {
//        return $this->model->all();
        return $this->model->where('organization_id',auth()->user()->organization_id)->get();
    }
    public function create($request): bool
    {

        if ($request->has('name') && $request->get('name')) {
            $this->model->name = $request->name;
        }
        if ($request->has('description') && $request->get('description')) {
            $this->model->description = $request->description;
        }
        $this->model->organization_id = auth()->user()->organization_id;

        return $this->model->save();

    }
    public function update($request, $id)
    {
        $item = $this->model->find($id);

        if (!$item) {
            throw new NotFoundHttpException('Department not found');
        }

        if ($request->has('name') && $request->get('name')) {
            $item->name = $request->name;
        }
        if ($request->has('description') && $request->get('description')) {
            $item->description = $request->description;
        }

        return $item->save();
    }

    public function delete($id)
    {
        $item=$this->model->find($id);
        if (!$item) {
            throw new NotFoundHttpException('Department not found');
        }
        return $item->delete();
    }

}
