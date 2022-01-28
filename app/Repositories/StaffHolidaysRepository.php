<?php
namespace App\Repositories;

use App\Models\StaffHolidays;
use App\User;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class StaffHolidaysRepository
{
    private $model;
    public function __construct(StaffHolidays $model)
    {
        $this->model = $model;
    }
    public function all()
    {
        return $this->model->where('organization_id',auth()->user()->organization_id)->with('users')->get();
    }

    public function create($request): bool
    {

        if ($request->has('start_date') && $request->get('start_date')) {
            $this->model->start_date = $request->start_date;
        }
        if ($request->has('end_date') && $request->get('end_date')) {
            $this->model->end_date = $request->end_date;
        }
        if ($request->has('user_id') && $request->get('user_id')) {
            $this->model->user_id = $request->user_id;
        }
        if ($request->has('note') && $request->get('note')) {
            $this->model->note = $request->note;
        }
        $this->model->organization_id = auth()->user()->organization_id;
        return $this->model->save();

    }
    public function update($request, $id)
    {
        $item = $this->model->find($id);

        if (!$item) {
            throw new NotFoundHttpException('Staff Holiday Not Found');
        }

        if ($request->has('start_date') && $request->get('start_date')) {
            $item->start_date = $request->start_date;
        }
        if ($request->has('end_date') && $request->get('end_date')) {
            $item->end_date = $request->end_date;
        }
        if ($request->has('user_id') && $request->get('user_id')) {
            $item->user_id = $request->user_id;
        }
        if ($request->has('note') && $request->get('note')) {
            $item->note = $request->note;
        }


        return $item->save();
    }

    public function delete($id)
    {
        $item = $this->model->find($id);

        if (!$item) {
            throw new NotFoundHttpException('Staff Holiday Not Found');
        }

        return $item->delete();
    }

    public function getStaffUsers()
    {
        return User::whereHas('roles', function ($q) {
            $q->whereNotIn('name', ['admin', 'owner', 'doctor']);
        })->where('organization_id', auth()->user()->organization_id)->get();
    }

    public function getDoctorHolidays($doctorId)
    {
        return $this->model->where('user_id', $doctorId)->get();
    }
}
