<?php
namespace App\Repositories;

use App\Models\Bill;

use App\User;
use Carbon\Carbon;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SalaryRepository
{
    private $model, $userModel;
    public function __construct(Bill $model, User $userModel)
    {
        $this->model = $model;
        $this->userModel = $userModel;
    }
    public function all()
    {
//        return $this->model->where('organization_id',auth()->user()->organization_id)->get();
        return $this->userModel->whereHas('roles', function ($query) {
            return $query->whereNotIn('name', ['owner']);
        })->where('organization_id',auth()->user()->organization_id)->get();
    }

    public function create($request): bool
    {

        return $this->model->save();

    }
    public function update($request, $id)
    {
        $item = $this->model->find($id);

        if (!$item) {
            throw new NotFoundHttpException();
        }



        return $item->save();
    }

    public function pay($id)
    {
        $item = User::find($id);

        if (!$item) {
            throw new NotFoundHttpException('User Not found');
        }

        $bill = new Bill();

        $bill->user_id = $id;
        $bill->name = 'Salary';
        $bill->bill_type = 1;
        $bill->organization_id = $item->organization_id;
        $bill->amount = $item->salary;
        $bill->date = Carbon::now()->toDateString();

        return $bill->save();
    }

    public function getUser($id)
    {
        $item = User::find($id);

        if (!$item) {
            throw new NotFoundHttpException('User Not found');
        }
        return $item;
    }

    public function getUserSalarySheet($id)
    {
        return $this->model->where('user_id', $id)->where('bill_type', 1)->orderBy('id', 'DESC')->get();
    }

}
