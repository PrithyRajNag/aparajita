<?php
namespace App\Repositories;

use App\Models\CompanyModule;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CompanyModuleRepository
{
    private $model;
    public function __construct(CompanyModule $model)
    {
        $this->model = $model;
    }
    public function all()
    {
        return $this->model->all();
    }

    public function create($request): bool
    {
        if ($request->has('name') && $request->get('name')) {
            $this->model->name = $request->name;
        }
        if ($request->has('note') && $request->get('note')) {
            $this->model->note = $request->note;
        }
        if ($request->has('status')) {
            $this->model->status = $request->status;
        }
        return $this->model->save();

    }
    public function update($request, $id)
    {
        $item = $this->model->find($id);

        if (!$item) {
            throw new NotFoundHttpException('Module Not Found');
        }
        if ($request->has('name') && $request->get('name')) {
            $item->name = $request->name;
        }
        if ($request->has('note') && $request->get('note')) {
            $item->note = $request->note;
        }
        if ($request->has('status')) {
            $item->status = $request->status;
        }


        return $item->save();
    }

    public function delete($id)
    {
        $item = $this->model->find($id);

        if (!$item) {
            throw new NotFoundHttpException('Module Not Found');
        }

        return $item->delete();
    }

}
