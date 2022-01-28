<?php
namespace App\Repositories;

use App\Models\TestItem;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TestItemRepository
{
    private $model;
    private $testCategoryRepository;
    public function __construct(TestItem $model, TestCategoryRepository $testCategoryRepository)
    {
        $this->model = $model;
        $this->testCategoryRepository = $testCategoryRepository;
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
        if ($request->has('price') && $request->get('price')) {
            $this->model->price = $request->price;
        }
        if ($request->has('test_category_id') && $request->get('test_category_id')) {
            $this->model->test_category_id = $request->test_category_id;
        }
        $this->model->organization_id = auth()->user()->organization_id;

        return $this->model->save();

    }

    public function update($request, $id)
    {
        $item = $this->model->find($id);

        if (!$item) {
            throw new NotFoundHttpException('Test Item Not Found');
        }

        if ($request->has('name') && $request->get('name')) {
            $item->name = $request->name;
        }
        if ($request->has('description') && $request->get('description')) {
            $item->description = $request->description;
        }
        if ($request->has('price') && $request->get('price')) {
            $item->description = $request->description;
        }
        if ($request->has('test_category_id') && $request->get('test_category_id')) {
            $item->test_category_id = $request->test_category_id;
        }



        return $item->save();
    }

    public function delete($id)
    {
        $item = $this->model->find($id);

        if (!$item) {
            throw new NotFoundHttpException('Test Item Not Found');
        }

        return $item->delete();
    }

    public function getAllTestCategories()
    {
        return $this->testCategoryRepository->all();
    }

}
