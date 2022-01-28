<?php

namespace App\Repositories;

use App\Models\BedAssign;
use App\Models\BedList;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BedAssignRepository
{
    /**
     * @var Bedassign
     */
    private $model;

    /**
     * BedAssignRepository constructor.
     * @param BedAssign $model
     * @param BedTypeRepository $bedTypeRepository
     * @param BedListRepository $bedListRepository
     * @param PatientRepository $patientRepository
     */
    public function __construct(BedAssign $model, BedTypeRepository $bedTypeRepository, BedListRepository $bedListRepository, PatientRepository $patientRepository)
    {
        $this->model = $model;
        $this->bedTypeRepository = $bedTypeRepository;
        $this->bedListRepository = $bedListRepository;
        $this->patientRepository = $patientRepository;
    }

    /**
     * @return BedAssign[]|Collection
     */
    public function all()
    {
//        return $this->model->all();
        return $this->model
            ->where('organization_id', auth()->user()->organization_id)
            ->where('status',true)
            ->where('is_latest',true)
            ->with('bedList.bedType')
            ->get();
    }

    /**
     * @param $request
     * @return bool
     */
    public function create($request): bool
    {

        if ($request->has('patient_id') && $request->get('patient_id')) {
            $this->model->patient_id = $request->patient_id;

            $patient = Patient::find($this->model->patient_id);

            $patient->is_bed_assigned = true;
            $patient->is_paid = false;
            $patient->save();
        }

        if ($request->has('bed_list_id') && $request->get('bed_list_id')) {
            $this->model->bed_list_id = $request->bed_list_id;

            $item = BedList::find($request->bed_list_id);
            $item->is_available = 0;
            $item->save();
        }

        if ($request->has('start_date') && $request->get('start_date')) {
            $this->model->start_date = $request->start_date;
        }
        if ($request->has('end_date') && $request->get('end_date')) {
            $this->model->end_date = $request->end_date;
        }

        $this->model->organization_id = auth()->user()->organization_id;
        return $this->model->save();

    }

    /**
     * @param $request
     * @param $id
     * @return mixed
     */
    public function update($request, $id)
    {
        $item = $this->model->find($id);

        if (!$item) {
            throw new NotFoundHttpException('Assigned Bed Not Found');
        }
        $bedListId = $item->bed_list_id;
        $startDate = $item->start_date;
//        $endDate = $item->end_date;

        $patientId = $item->patient_id;

        if ($bedListId == $request->get('bed_list_id')) {
            if ($request->has('patient_id') && $request->get('patient_id')) {
                $item->patient_id = $request->patient_id;

                $patient = Patient::find($item->patient_id);

                $patient->is_bed_assigned = true;
                $patient->is_paid = false;
                $patient->save();

                $patient = Patient::find($patientId);

                $patient->is_bed_assigned = false;
                $patient->save();
            }
            if ($request->has('start_date') && $request->get('start_date')) {
                $item->start_date = $request->start_date;
            }
            if ($request->has('end_date') && $request->get('end_date')) {
                $item->end_date = $request->end_date;
            }
            $item->save();
        }




        elseif ($bedListId != $request->get('bed_list_id')) {
//            if ($bedListId != $request->get('bed_list_id') && $startDate = $request->get('start_date')) {
            if ( $startDate == $request->get('start_date')) {
//            $item = $this->model->find($id)->first();
                if ($request->has('patient_id') && $request->get('patient_id')) {
                    $item->patient_id = $request->patient_id;

                    $patient = Patient::find($item->patient_id);

                    $patient->is_bed_assigned = true;
                    $patient->save();

                    $patient = Patient::find($patientId);

                    $patient->is_bed_assigned = false;
                    $patient->save();
                }

//        $bedListId = $item->bed_list_id;
//                if ($request->has('bed_list_id') && $request->get('bed_list_id') && $bedListId != $request->get('bed_list_id')) {
                if ($request->has('bed_list_id') && $request->get('bed_list_id')) {

                    $item->bed_list_id = $request->bed_list_id;
                    $bedNumber = BedList::find($item->bed_list_id);

                    $bedNumber->is_available = false;
                    $bedNumber->save();

                    $bedNumber = BedList::find($bedListId);

                    $bedNumber->is_available = true;
                    $bedNumber->save();

                }

                if ($request->has('start_date') && $request->get('start_date')) {
                    $item->start_date = $request->start_date;
                }
                if ($request->has('end_date') && $request->get('end_date')) {
                    $item->end_date = $request->end_date;
                }

                $item->save();
            }





//        if ($request->has('bed_list_id') && $request->get('bed_list_id') && $bedListId != $request->get('bed_list_id')
//            && $request->has('start_date') && $request->get('start_date') && $startDate != $request->get('start_date')) {
//            if ($bedListId != $request->get('bed_list_id') && $startDate != $request->get('start_date')) {
            if ( $startDate != $request->get('start_date')) {
//                $newItem = $this->model->find($id)->first();
                $newItem = new BedAssign();

                if ($request->has('patient_id') && $request->get('patient_id')) {
//                $item->patient_id = $request->patient_id;
                    $newItem->patient_id = $request->patient_id;

                    $patient = Patient::find($newItem->patient_id);

                    $patient->is_bed_assigned = true;
                    $patient->save();

                    $patient = Patient::find($patientId);

                    $patient->is_bed_assigned = false;
                    $patient->save();
                }

//            if ($request->has('bed_list_id') && $request->get('bed_list_id') && $bedListId != $request->get('bed_list_id')) {
                if ($request->has('bed_list_id') && $request->get('bed_list_id')) {

//                $item->bed_list_id = $request->bed_list_id;
                    $newItem->bed_list_id = $request->bed_list_id;
                    $bedNumber = BedList::find($newItem->bed_list_id);

                    $bedNumber->is_available = false;
                    $bedNumber->save();

                    $bedNumber = BedList::find($bedListId);

                    $bedNumber->is_available = true;
                    $bedNumber->save();

                }

                if ($request->has('start_date') && $request->get('start_date')) {
//                $item->start_date = $request->start_date;
                    $newItem->start_date = $request->start_date;
                }
                if ($request->has('end_date') && $request->get('end_date')) {
//                $item->end_date = $request->end_date;
                    $newItem->end_date = $request->end_date;
                }
                $newItem->organization_id = auth()->user()->organization_id;
//                  BedAssign::create($item);
                $newItem->save();

//                $endDate = Carbon::createFromFormat('Y-m-d', $newItem->start_date);
                $endDate = Carbon::parse($newItem['start_date']);
//                if()
                $item->end_date = $endDate->subDays(1);
                $item->status = false;
                $item->save();
            }

        }
        return $item;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $item = $this->model->find($id);

        if (!$item) {
            throw new NotFoundHttpException('Assigned Bed Not Found');
        }

        return $item->delete();
    }

    /**
     * @return mixed
     */
    public function getAllBedTypes()
    {
        return $this->bedTypeRepository->all();
    }

    /**
     * @return mixed
     */
    public function getAllBedList()
    {
        return $this->bedListRepository->all();
    }

    /**
     * @return mixed
     */
    public function getAllPatient()
    {
        return Patient::where('organization_id',auth()->user()->organization_id)
            ->where('status',true)
            ->where('is_bed_assigned',false)
            ->get();
    }

    public function getBeds($id)
    {
        return BedList::where('is_available', 1)
            ->where('bed_type_id', $id)
            ->where('organization_id', auth()->user()->organization_id)
            ->get();
    }

    public function getPatientBeds($patient_id)
    {
        return $this->model->where('patient_id', $patient_id)->orderBy('start_date', 'desc')->
        where('is_latest',true)->get();
    }
}
