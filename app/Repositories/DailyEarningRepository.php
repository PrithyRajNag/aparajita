<?php
namespace App\Repositories;

use App\Models\DailyEarning;
use App\User;
use Carbon\Carbon;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DailyEarningRepository
{
    private $model;
    public function __construct(DailyEarning $model)
    {
        $this->model = $model;
    }
    public function all()
    {
        return $this->model->where('organization_id',auth()->user()->organization_id)->get();
    }

    public function create($request): bool
    {
        if ($request->has('patient_billing_no') && $request->get('patient_billing_no')) {
            $this->model->patient_billing_no = $request->patient_billing_no;
        }
        if ($request->has('amount') && $request->get('amount')) {
            $this->model->amount = $request->amount;
        }
        if ($request->has('bank_name') && $request->get('bank_name')) {
            $this->model->bank_name = $request->bank_name;
        }
        if ($request->has('cheque_no') && $request->get('cheque_no')) {
            $this->model->cheque_no = $request->cheque_no;
        }
        $this->model->date = Carbon::now()->toDateString();
        $this->model->user_id = auth()->user()->id;
        $this->model->organization_id = auth()->user()->organization_id;
        return $this->model->save();

    }
    public function update($request, $id)
    {
        $item = $this->model->find($id);

        if (!$item) {
            throw new NotFoundHttpException('Billing Record Not Found');
        }
        if ($request->has('patient_billing_no') && $request->get('patient_billing_no')) {
            $item->patient_billing_no = $request->patient_billing_no;
        }
        if ($request->has('amount') && $request->get('amount')) {
            $item->amount = $request->amount;
        }
        if ($request->has('bank_name') && $request->get('bank_name')) {
            $item->bank_name = $request->bank_name;
        }
        if ($request->has('cheque_no') && $request->get('cheque_no')) {
            $item->check_no = $request->check_no;
        }


        return $item->save();
    }

    public function delete($id)
    {
        $item = $this->model->find($id);

        if (!$item) {
            throw new NotFoundHttpException('Billing Record Not Found');
        }

        return $item->delete();
    }
    public function get($id)
    {
        $item = $this->model->find($id);

        if (!$item) {
            throw new NotFoundHttpException('Billing Record not Found');
        }
        return $item;
    }
}
