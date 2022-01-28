<?php
namespace App\Repositories;

use App\Models\HealthCard;
use App\Models\Patient;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HealthCardRepository
{
    private $model;
    public function __construct(HealthCard $model,  PatientRepository $patientRepository)
    {
        $this->model = $model;
        $this->patientRepository = $patientRepository;
    }
    public function all()
    {
        return $this->model->where('organization_id',auth()->user()->organization_id)->get();
    }

    public function create($request): bool
    {

        if ($request->has('issue_date') && $request->get('issue_date')) {
            $this->model->issue_date = $request->issue_date;
        }
        if ($request->has('expire_date') && $request->get('expire_date')) {
            $this->model->expire_date = $request->expire_date;
        }
        if ($request->has('patient_id') && $request->get('patient_id')) {
            $this->model->patient_id = $request->patient_id;
        }
        if ($request->has('card_number') && $request->get('card_number')) {
            $this->model->card_number = $request->card_number;
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
            throw new NotFoundHttpException('Health Card Not Found');
        }
        if ($request->has('issue_date') && $request->get('issue_date')) {
            $item->issue_date = $request->issue_date;
        }
        if ($request->has('expire_date') && $request->get('expire_date')) {
            $item->expire_date = $request->expire_date;
        }
        if ($request->has('patient_id') && $request->get('patient_id')) {
            $item->patient_id = $request->patient_id;
        }
        if ($request->has('card_number') && $request->get('card_number')) {
            $item->card_number = $request->card_number;
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
            throw new NotFoundHttpException('Health Card Not Found');
        }

        return $item->delete();
    }
    public function getAllPatients()
    {
//        return $this->all()->pluck('id');
        return Patient::where('organization_id',auth()->user()->organization_id)->whereNotIn('id', $this->all()->pluck('patient_id'))->where('is_alive',1)->get();
    }
}
