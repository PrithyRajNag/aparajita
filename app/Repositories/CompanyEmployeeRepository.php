<?php
namespace App\Repositories;

use App\Models\CompanyEmployee;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CompanyEmployeeRepository
{
    private $model;
    private $companyDesignationRepository;
    public function __construct(CompanyEmployee $model,CompanyDesignationRepository $companyDesignationRepository)
    {
        $this->model = $model;
        $this->companyDesignationRepository = $companyDesignationRepository;
    }
    public function all()
    {
        return $this->model->all();
    }
    public function create($request):bool
    {
        if ($request->has('first_name') && $request->get('first_name')) {
            $this->model->first_name = $request->first_name;
        }
        if ($request->has('last_name') && $request->get('last_name')) {
            $this->model->last_name = $request->last_name;
        }
        if ($request->has('phone_number') && $request->get('phone_number')) {
            $this->model->phone_number = $request->phone_number;
        }
        if ($request->has('gender') && $request->get('gender')) {
            $this->model->gender = $request->gender;
        }
        if ($request->has('dob') && $request->get('dob')) {
            $this->model->dob = $request->dob;
        }
        if ($request->has('address') && $request->get('address')) {
            $this->model->address = $request->address;
        }
        if ($request->has('email') && $request->get('email')) {
            $this->model->email = $request->email;
        }
        if ($request->has('company_designation_id') && $request->get('company_designation_id')) {
            $this->model->company_designation_id = $request->company_designation_id;
        }
        $this->model->password = '123456789';

        return $this->model->save();
    }
    public function update($request, $id)
    {
        $item = $this->model->find($id);

        if (!$item) {
            throw new NotFoundHttpException('Employee Record Not Found');
        }
        if ($request->has('first_name') && $request->get('first_name')) {
            $item->first_name = $request->first_name;
        }
        if ($request->has('last_name') && $request->get('last_name')) {
            $item->last_name = $request->last_name;
        }
        if ($request->has('phone_number') && $request->get('phone_number')) {
            $item->phone_number = $request->phone_number;
        }
        if ($request->has('gender') && $request->get('gender')) {
            $item->gender = $request->gender;
        }
        if ($request->has('dob') && $request->get('dob')) {
            $item->dob = $request->dob;
        }
        if ($request->has('address') && $request->get('address')) {
            $item->address = $request->address;
        }
        if ($request->has('email') && $request->get('email')) {
            $item->email = $request->email;
        }
        if ($request->has('company_designation_id') && $request->get('company_designation_id')) {
            $item->company_designation_id = $request->company_designation_id;
        }


        return $item->save();
    }
    public function delete($id)
    {
        $item=$this->model->find($id);
        if (!$item) {
            throw new NotFoundHttpException('Employee Record Not Found');
        }
        return $item->delete();
    }

    public function get($id)
    {
        $item = $this->model->find($id);
        if (!$item) {
            throw new NotFoundHttpException('Employee not found');
        }
        return $item;
    }

    public function getAllDesignations()
    {
        return $this->companyDesignationRepository->all();
    }
}
