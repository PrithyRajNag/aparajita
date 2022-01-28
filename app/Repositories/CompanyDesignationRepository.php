<?php
namespace App\Repositories;

use App\Models\CompanyDesignation;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CompanyDesignationRepository
{
    private $model;
    public function __construct(CompanyDesignation $model)
    {
        $this->model = $model;
    }
    public function all()
    {
        return $this->model->all();
    }


}
