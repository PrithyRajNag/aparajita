<?php
namespace App\Repositories;

use App\Models\TestResultItem;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TestResultItemRepository
{
    private $model;
    private $testResultCategoryRepository;
    public function __construct(TestResultItem $model, TestResultCategoryRepository $testResultCategoryRepository)
    {
        $this->model = $model;
        $this->testResultCategoryRepository = $testResultCategoryRepository;
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
        if ($request->has('normal_range') && $request->get('normal_range')) {
            $this->model->normal_range = $request->normal_range;
        }
        if ($request->has('unit') && $request->get('unit')) {
            $this->model->unit = $request->unit;
        }
        if ($request->has('test_result_category_id') && $request->get('test_result_category_id')) {
            $this->model->test_result_category_id = $request->test_result_category_id;
        }
        $this->model->organization_id = auth()->user()->organization_id;
        return $this->model->save();

    }
    public function update($request, $id)
    {
        $item = $this->model->find($id);

        if (!$item) {
            throw new NotFoundHttpException('Test Result Item Not Found');
        }

        if ($request->has('name') && $request->get('name')) {
            $item->name = $request->name;
        }
        if ($request->has('normal_range') && $request->get('normal_range')) {
            $item->normal_range = $request->normal_range;
        }
        if ($request->has('unit') && $request->get('unit')) {
            $item->unit = $request->unit;
        }
        if ($request->has('test_result_category_id') && $request->get('test_result_category_id')) {
            $item->test_result_category_id = $request->test_result_category_id;
        }



        return $item->save();
    }

    public function delete($id)
    {
        $item = $this->model->find($id);

        if (!$item) {
            throw new NotFoundHttpException('Test Result Item Not Found');
        }

        return $item->delete();
    }

    public function getAllTestResultCategory()
    {
        return $this->testResultCategoryRepository->all();
    }

}
