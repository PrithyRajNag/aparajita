<?php
namespace App\Repositories;

use App\Models\Role;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RoleRepository
{
    private $model;
    public function __construct(Role $model)
    {
        $this->model = $model;
    }
    public function all()
    {
        return $this->model->all();
    }
}
