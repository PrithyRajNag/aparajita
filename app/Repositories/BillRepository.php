<?php
namespace App\Repositories;

use App\Models\Bill;
use App\User;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BillRepository
{
    private $model;
    public function __construct(Bill $model)
    {
        $this->model = $model;
    }
    public function all()
    {
        return $this->model->where('bill_type', 2)->where('organization_id',auth()->user()->organization_id)->get();
    }

    public function create($request): bool
    {

        if ($request->has('name') && $request->get('name')) {
            $this->model->name = $request->name;
        }
        if ($request->has('note') && $request->get('note')) {
            $this->model->note = $request->note;
        }
        if ($request->has('date') && $request->get('date')) {
            $this->model->date = $request->date;
        }
        if ($request->has('amount') && $request->get('amount')) {
            $this->model->amount = $request->amount;
        }
        if ($request->has('user_id') && $request->get('user_id')) {
            $this->model->user_id = $request->user_id;
        }
        if ($request->hasFile('document')) {
            $fileName = time() . '.' . $request->document->getClientOriginalName();

            $request->document->storeAs('uploads', $fileName);
            $this->model->file = $fileName;
        }
        $this->model->bill_type = 2;
        $this->model->organization_id = auth()->user()->organization_id;

        return $this->model->save();

    }
    public function update($request, $id)
    {
        $item = $this->model->find($id);

        if (!$item) {
            throw new NotFoundHttpException('Bill Not Found');
        }

        if ($request->has('name') && $request->get('name')) {
            $item->name = $request->name;
        }
        if ($request->has('note') && $request->get('note')) {
            $item->note = $request->note;
        }
        if ($request->has('date') && $request->get('date')) {
            $item->date = $request->date;
        }
        if ($request->has('amount') && $request->get('amount')) {
            $item->amount = $request->amount;
        }
        if ($request->has('user_id') && $request->get('user_id')) {
            $item->user_id = $request->user_id;
        }
        if ($request->hasFile('document')) {
            $fileName = time() . '.' . $request->document->getClientOriginalName();

            $request->document->storeAs('uploads', $fileName);
            $item->file = $fileName;
        }
        return $item->save();
    }

    public function delete($id)
    {
        $item = $this->model->find($id);

        if (!$item) {
            throw new NotFoundHttpException('Bill Not Found');
        }

        return $item->delete();
    }


    public function get($id)
    {
        $item = $this->model->find($id);

        if (!$item) {
            throw new NotFoundHttpException('Bill not Found');
        }
        return $item;
    }


    public function getUsers()
    {
        return User::role(['admin','accountant'])->where('organization_id', auth()->user()->organization_id)->get();
    }

}
