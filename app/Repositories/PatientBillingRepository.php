<?php

namespace App\Repositories;

use App\Models\BedAssign;
use App\Models\BedList;
use App\Models\DoctorAssignToPatient;
use App\Models\Patient;
use App\Models\PatientAdmitAndDischarge;
use App\Models\PatientBilling;
use App\Models\PatientBillingAdvance;
use App\Models\PatientBillingServiceCharges;
use App\Models\PatientTest;
use Carbon\Carbon;
use http\Exception;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PatientBillingRepository
{
    private $model;
    private $patientModel;

    public function __construct(PatientBilling $model, Patient $patientModel)
    {
        $this->model = $model;
        $this->patientModel = $patientModel;
    }

    public function all()
    {
        return $this->patientModel
            ->where('organization_id', auth()->user()->organization_id)
            ->where('is_appointment', false)
            ->where('is_paid', false)
            ->where('is_resolved', false)
            ->orderBy('id', 'DESC')
            ->get();
    }

    public function create($request)
    {
        try {
            $billing = PatientBilling::where('patient_id', $request->patient_id)
                ->where('is_latest', 1)->first();
            if ($billing !== null) {
                if ($request->has('patient_id') && $request->get('patient_id')) {
                    $billing->patient_id = $request->patient_id;
                }
                if ($request->has('total_bed_price') && $request->get('total_bed_price')) {
                    $billing->total_bed_price = $request->total_bed_price;
                }
                if ($request->has('total_test_price') && $request->get('total_test_price')) {
                    $billing->total_test_price = $request->total_test_price;
                }
                if ($request->has('total_service_price') && $request->get('total_service_price')) {
                    $billing->total_service_price = $request->total_service_price;
                }
                if ($request->has('sub_total') && $request->get('sub_total')) {
                    $billing->sub_total = $request->sub_total;
                }
                if ($request->has('discount') && $request->get('discount')) {
                    $billing->discount = $request->discount;
                }
                if ($request->has('gross_total') && $request->get('gross_total')) {
                    $billing->gross_total = $request->gross_total;
                }
                if ($request->has('total_paid') && $request->get('total_paid')) {
                    $billing->total_paid = $request->total_paid;
                }

                $billing->organization_id = auth()->user()->organization_id;
                $billing->save();


                if ($request->has('advance') && $request->get('advance')) {
                    $advance = new PatientBillingAdvance();
                    $advance->amount = $request->advance;
                    $advance->date = Carbon::now()->toDateString();
                    $advance->patient_billing_id = $billing->id;
                    $advance->organization_id = auth()->user()->organization_id;
                    $advance->save();
                }

//                if ($request->get('service_name')) {
                $service = ['service_name', 'service_date', 'service_count', 'service_price'];
                $i = 0;
//                dd($request->all());
                for ($i; $i < count($request->service_name); $i++) {
                    $data['patient_billing_id'] = $billing->id;
                    $data['name'] = $request[$service[0]][$i];
                    $data['date'] = $request[$service[1]][$i];
                    $data['count'] = $request[$service[2]][$i];
                    $data['amount'] = $request[$service[3]][$i];
                    if ($data['name'] != null) {
                        PatientBillingServiceCharges::create($data);
                    }
                }
//                }

                if ($request->get('full_paid') && $request->get('total_paid')) {

                    if ($request->get('total_bed_price')) {
                        $bed_list_id = BedAssign::where('patient_id', $billing->patient_id)->
                        where('is_latest', 1)->where('status', 1)->where('organization_id', auth()->user()->organization_id)->pluck('bed_list_id');
                        $bed = BedList::where('id', $bed_list_id)->first();
                        $bed->is_available = 1;
                        $bed->save();

                        $lastBedAssign = BedAssign::where('patient_id', $billing->patient_id)->
                        where('is_latest', 1)->where('end_date',null)->where('organization_id', auth()->user()->organization_id)->first();
                        $lastBedAssign->end_date = Carbon::now()->toDateString();
                        $lastBedAssign->save();


                        $bedAssigns = BedAssign::where('patient_id', $billing->patient_id)->
                        where('is_latest', 1)->where('organization_id', auth()->user()->organization_id)->get();
                        foreach ($bedAssigns as $bedAssign) {
                            $bedAssign->status = 0;
                            $bedAssign->is_latest = 0;
//                        dd($bedAssign);
                            $bedAssign->save();
                        }

                    }

                    if ($request->get('total_test_price')) {
                        $tests = PatientTest::where('patient_id', $billing->patient_id)->
                        where('is_latest', 1)->where('organization_id', auth()->user()->organization_id)->get();
                        foreach ($tests as $test) {
                            $test->status = 0;
                            $test->is_latest = 0;
                            $test->save();
                        }
                    }

                    $doctorAssign = DoctorAssignToPatient::where('patient_id', $billing->patient_id)->
                    where('is_latest', 1)->first();
                    if ($doctorAssign != null) {
                        $doctorAssign->is_latest = 0;
                        $doctorAssign->save();
                    }

                    $admit = PatientAdmitAndDischarge::where('patient_id', $billing->patient_id)->
                    where('is_latest', 1)->first();
                    if ($admit != null) {
                        $admit->is_latest = 0;
                        $admit->discharge_date = Carbon::now()->toDateString();
                        $admit->discharge_time = Carbon::now()->toTimeString();
                        $admit->save();
                    }

                    $patient = Patient::where('id', $billing->patient_id)->
                    where('organization_id', auth()->user()->organization_id)->first();
                    $patient->is_bed_assigned = 0;
                    $patient->status = 0;
                    $patient->is_paid = 1;
                    $patient->save();

                    $billing->is_latest = 0;
                    $billing->full_paid = 1;
                    $billing->total_paid = $request->total_paid;
                    $billing->save();

                }


//            if ($request->get('service_price')) {
//                $service_name = implode(', ', array_map([$this, 'parameter'], $request->service_name));
//            }


            } else {
                $billing = new PatientBilling();
                if ($request->has('patient_id') && $request->get('patient_id')) {
                    $billing->patient_id = $request->patient_id;
                }
                if ($request->has('total_bed_price') && $request->get('total_bed_price')) {
                    $billing->total_bed_price = $request->total_bed_price;
                }
                if ($request->has('total_test_price') && $request->get('total_test_price')) {
                    $billing->total_test_price = $request->total_test_price;
                }
                if ($request->has('total_service_price') && $request->get('total_service_price')) {
                    $billing->total_service_price = $request->total_service_price;
                }
                if ($request->has('sub_total') && $request->get('sub_total')) {
                    $billing->sub_total = $request->sub_total;
                }
                if ($request->has('discount') && $request->get('discount')) {
                    $billing->discount = $request->discount;
                }
                if ($request->has('gross_total') && $request->get('gross_total')) {
                    $billing->gross_total = $request->gross_total;
                }
                if ($request->has('total_paid') && $request->get('total_paid')) {
                    $billing->total_paid = $request->total_paid;
                }
                $billing->organization_id = auth()->user()->organization_id;

                $billing->save();

                if ($request->has('advance') && $request->get('advance')) {
                    $advance = new PatientBillingAdvance();
                    $advance->amount = $request->advance;
                    $advance->date = Carbon::now()->toDateString();
                    $advance->patient_billing_id = $billing->id;
                    $advance->organization_id = auth()->user()->organization_id;
                    $advance->save();
                }

//                if ($request->get('service_name')) {
                $service = ['service_name', 'service_date', 'service_count', 'service_price'];
                $i = 0;
//                dd($request->all());

                for ($i; $i < count($request->service_name); $i++) {
                    $data['patient_billing_id'] = $billing->id;
                    $data['name'] = $request[$service[0]][$i];
                    $data['date'] = $request[$service[1]][$i];
                    $data['count'] = $request[$service[2]][$i];
                    $data['amount'] = $request[$service[3]][$i];
//                        PatientBillingServiceCharges::create($data);
                    if ($data['name'] != null) {
                        PatientBillingServiceCharges::create($data);
                    }
                }
//                }
                if ($request->get('full_paid') && $request->get('total_paid')) {

                    if ($request->get('total_bed_price')) {
                        $bed_list_id = BedAssign::where('patient_id', $billing->patient_id)->
                        where('is_latest', 1)->where('status', 1)->where('organization_id', auth()->user()->organization_id)->pluck('bed_list_id');
                        $bed = BedList::where('id', $bed_list_id)->first();
                        $bed->is_available = 1;
                        $bed->save();

                        $lastBedAssign = BedAssign::where('patient_id', $billing->patient_id)->
                        where('is_latest', 1)->where('end_date',null)->where('organization_id', auth()->user()->organization_id)->first();
                        $lastBedAssign->end_date = Carbon::now()->toDateString();
                        $lastBedAssign->save();


                        $bedAssigns = BedAssign::where('patient_id', $billing->patient_id)->
                        where('is_latest', 1)->where('organization_id', auth()->user()->organization_id)->get();
                        foreach ($bedAssigns as $bedAssign) {
                            $bedAssign->status = 0;
                            $bedAssign->is_latest = 0;
//                        dd($bedAssign);
                            $bedAssign->save();
                        }

                    }

                    if ($request->get('total_test_price')) {
                        $tests = PatientTest::where('patient_id', $billing->patient_id)->
                        where('is_latest', 1)->where('organization_id', auth()->user()->organization_id)->get();
                        foreach ($tests as $test) {
                            $test->status = 0;
                            $test->is_latest = 0;
                            $test->save();
                        }
                    }

                    $doctorAssign = DoctorAssignToPatient::where('patient_id', $billing->patient_id)->
                    where('is_latest', 1)->first();
                    if ($doctorAssign != null) {
                        $doctorAssign->is_latest = 0;
                        $doctorAssign->save();
                    }

                    $admit = PatientAdmitAndDischarge::where('patient_id', $billing->patient_id)->
                    where('is_latest', 1)->first();
                    if ($admit != null) {
                        $admit->is_latest = 0;
                        $admit->discharge_date = Carbon::now()->toDateString();
                        $admit->discharge_time = Carbon::now()->toTimeString();
                        $admit->save();
                    }

                    $patient = Patient::where('id', $billing->patient_id)->
                    where('organization_id', auth()->user()->organization_id)->first();
                    $patient->is_bed_assigned = 0;
                    $patient->status = 0;
                    $patient->is_paid = 1;
                    $patient->save();

                    $billing->is_latest = 0;
                    $billing->full_paid = 1;
                    $billing->total_paid = $request->total_paid;
                    $billing->save();

                }
            }
            return $billing;
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }


    }

    public function update($request, $id)
    {
        $item = $this->model->find($id);

        if (!$item) {
            throw new NotFoundHttpException();
        }


        return $item->save();
    }

    public function delete($id)
    {
        $item = $this->model->find($id);

        if (!$item) {
            throw new NotFoundHttpException();
        }

        return $item->delete();
    }

    public function getAdvanceBilling($patientId)
    {
        $patientBilling = PatientBilling::where('patient_id', $patientId)->
        where('is_latest', 1)->where('full_paid', 0)->
        where('organization_id', auth()->user()->organization_id)
            ->pluck('id');
        if ($patientBilling->isEmpty()) {
            return null;
        } else {
            $advance = PatientBillingAdvance::where('patient_billing_id', $patientBilling)->get();
            if ($advance->isEmpty()) {
                return null;
            } else {
                $total_advance_amount = $advance->sum('amount');
                $advance->total_advance_amount = $total_advance_amount;
                return $advance;
            }
        }
    }

    public function getServiceBilling($patientId)
    {
        $patientBilling = PatientBilling::where('patient_id', $patientId)->
        where('is_latest', 1)->where('full_paid', 0)->
        where('organization_id', auth()->user()->organization_id)
            ->pluck('id');
        if ($patientBilling->isEmpty()) {
            return null;
        } else {
            $service = PatientBillingServiceCharges::where('patient_billing_id', $patientBilling)->get();
            if ($service == null) {
                return null;
            } else {
                $total_service_amount = $service->sum('amount');
                $service->total_service_amount = $total_service_amount;
                return $service;
            }

        }
    }
//    public function getBillingId($id)
//    {
//        $item = $this->model->find($id);
//        if (!$item) {
//            throw new NotFoundHttpException('Patient Billing Record Not found');
//        }
//        return $item;
//    }
}
