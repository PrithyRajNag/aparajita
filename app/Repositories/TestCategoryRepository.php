<?php
namespace App\Repositories;

use App\Models\TestCategory;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TestCategoryRepository
{
    private $model;
    private $labRepository;
    public function __construct(TestCategory $model, LabRepository $labRepository)
    {
        $this->model = $model;
        $this->labRepository = $labRepository;
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
        if ($request->has('description') && $request->get('description')) {
            $this->model->description = $request->description;
        }
        if ($request->has('lab_id') && $request->get('lab_id')) {
            $this->model->lab_id = $request->lab_id;
        }
        $this->model->organization_id = auth()->user()->organization_id;

        return $this->model->save();

    }
    public function update($request, $id)
    {
        $item = $this->model->find($id);

        if (!$item) {
            throw new NotFoundHttpException('Test Category Not Found');
        }

        if ($request->has('name') && $request->get('name')) {
            $item->name = $request->name;
        }
        if ($request->has('description') && $request->get('description')) {
            $item->description = $request->description;
        }
        if ($request->has('lab_id') && $request->get('lab_id')) {
            $item->lab_id = $request->lab_id;
        }

        return $item->save();
    }

    public function delete($id)
    {
        $item=$this->model->find($id);
        if (!$item) {
            throw new NotFoundHttpException('Test Category Not Found');
        }
        return $item->delete();
    }
    public function getAllLabs()
    {
        return $this->labRepository->all();
    }
}
