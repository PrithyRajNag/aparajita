<?php
namespace App\Repositories;

use App\Models\DoctorHoliday;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DoctorHolidayRepository
{
    private $model;
    private $doctorRepository;
    public function __construct(DoctorHoliday $model, DoctorRepository $doctorRepository)
    {
        $this->model = $model;
        $this->doctorRepository = $doctorRepository;
    }
    public function all()
    {
        return $this->model->where('organization_id',auth()->user()->organization_id)->get();
    }

    public function create($request): bool
    {

        if ($request->has('start_date') && $request->get('start_date')) {
            $this->model->start_date = $request->start_date;
        }
        if ($request->has('end_date') && $request->get('end_date')) {
            $this->model->end_date = $request->end_date;
        }
        if ($request->has('doctor_id') && $request->get('doctor_id')) {
            $this->model->doctor_id = $request->doctor_id;
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
            throw new NotFoundHttpException('Doctor Holiday Not Found');
        }

        if ($request->has('start_date') && $request->get('start_date')) {
            $item->start_date = $request->start_date;
        }
        if ($request->has('end_date') && $request->get('end_date')) {
            $item->end_date = $request->end_date;
        }
        if ($request->has('doctor_id') && $request->get('doctor_id')) {
            $item->doctor_id = $request->doctor_id;
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
            throw new NotFoundHttpException('Doctors Holiday Not Found');
        }

        return $item->delete();
    }
    public function getAllDoctors()
    {
        return $this->doctorRepository->all();
    }
}
