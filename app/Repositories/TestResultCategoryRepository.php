<?php
namespace App\Repositories;

use App\Models\TestResultCategory;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TestResultCategoryRepository
{
    private $model;
    private $testItemRepository;
    public function __construct(TestResultCategory $model, TestItemRepository $testItemRepository)
    {
        $this->model = $model;
        $this->testItemRepository = $testItemRepository;
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
        if ($request->has('test_item_id') && $request->get('test_item_id')) {
            $this->model->test_item_id = $request->test_item_id;
        }
        $this->model->organization_id = auth()->user()->organization_id;

        return $this->model->save();

    }
    public function update($request, $id)
    {
        $item = $this->model->find($id);

        if (!$item) {
            throw new NotFoundHttpException('Test Result Category Not Found');
        }

        if ($request->has('name') && $request->get('name')) {
            $item->name = $request->name;
        }
        if ($request->has('description') && $request->get('description')) {
            $item->description = $request->description;
        }
        if ($request->has('test_item_id') && $request->get('test_item_id')) {
            $item->test_item_id = $request->test_item_id;
        }

        return $item->save();
    }

    public function delete($id)
    {
        $item = $this->model->find($id);

        if (!$item) {
            throw new NotFoundHttpException('Test Result Category Not Found');
        }

        return $item->delete();
    }

    public function getAllTestItems()
    {
        return $this->testItemRepository->all();
    }
}
