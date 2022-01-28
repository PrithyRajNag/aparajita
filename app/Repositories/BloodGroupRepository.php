<?php
namespace App\Repositories;


use App\Models\BloodGroup;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BloodGroupRepository
{
    private $model;
    public function __construct(BloodGroup $model)
    {
        $this->model = $model;
    }
    public function all()
    {
        return $this->model->all();
    }

}
