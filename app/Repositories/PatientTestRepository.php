<?php

namespace App\Repositories;

use App\Models\Patient;
use App\Models\PatientTest;
use App\Models\PatientTestItems;
use App\Models\PatientTestReferredDoctor;
use App\Models\TestItem;
use Carbon\Carbon;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Helpers\Helper;

class PatientTestRepository
{
    private $model;
    private $patientRepository;

    public function __construct(PatientTest $model, PatientRepository $patientRepository)
    {
        $this->model = $model;
        $this->patientRepository = $patientRepository;
    }

    public function all()
    {
        return $this->model->where('is_latest',1)->where('organization_id', auth()->user()->organization_id)->get();
    }

    public function create($request)
    {

        //if paitent id in request->get()
//        $patient_id = $request->patient_id
        if ($request->has('patient_id') && $request->get('patient_id')) {
            $this->model->patient_id = $request->patient_id;
            $patient = Patient::where('id', $this->model->patient_id)->
            where('organization_id', auth()->user()->organization_id)->first();
            $patient->is_paid = false;
            $patient->save();
        } else {
            $patient = new Patient();
            if ($request->has('first_name') && $request->get('first_name')) {
                $patient->first_name = $request->first_name;
            }
            if ($request->has('last_name') && $request->get('last_name')) {
                $patient->last_name = $request->last_name;
            }
            if ($request->has('age') && $request->get('age')) {
                $patient->age = $request->age;
            }
            if ($request->has('phone_number') && $request->get('phone_number')) {
                $patient->phone_number = $request->phone_number;
            }
            if ($request->has('gender') && $request->get('gender')) {
                $patient->gender = $request->gender;
            }
            if ($request->has('religion') && $request->get('religion')) {
                $patient->religion = $request->religion;
            }
            if ($request->has('address') && $request->get('address')) {
                $patient->address = $request->address;
            }
            $patient->organization_id = auth()->user()->organization_id;
            $patient->save();

            $this->model->patient_id = $patient->id;
        }
        if ($request->has('referred_doctor_id') && $request->get('referred_doctor_id')) {
            $this->model->referred_doctor_id = $request->referred_doctor_id;
        }
//        get patient id from $patient object
        //end of else
        if ($request->get('doctor_name')) {
//             else {
                $doctor = new PatientTestReferredDoctor();
                if ($request->has('doctor_name') && $request->get('doctor_name')) {
                    $doctor->name = $request->doctor_name;
                }
                if ($request->has('institution_name') && $request->get('institution_name')) {
                    $doctor->institution_name = $request->institution_name;
                }
                if ($request->has('degree') && $request->get('degree')) {
                    $doctor->degree = $request->degree;
                }
                if ($request->has('phone_number') && $request->get('doctor_contact_number')) {
                    $doctor->phone_number = $request->doctor_contact_number;
                }
                $doctor->organization_id = auth()->user()->organization_id;
                $doctor->save();
                $this->model->referred_doctor_id = $doctor->id;
            }

            $this->model->organization_id = auth()->user()->organization_id;
            $this->model->save();


        if ($request->has('test_item_id') && $request->get('test_item_id')) {
//            dd("Inside test_item_id");
            $test_item_id = explode(',', $request->test_item_id[0]);
            // $room = explode(',', $request->test_room[0]);
            // $floor = explode(',', $request->test_floor[0]);
            $date = explode(',', $request->d_date[0]);
            $time = explode(',', $request->d_time[0]);

//            dd($date);

            foreach ($test_item_id as $key => $item) {
//                $date = $request->d_date[$key];
//                $time = $request->d_time[$key];

                $data['patient_test_id'] = $this->model->id;
                $data['test_item_id'] = (int)$item;
                $data['price'] = TestItem::where('id', $item)->pluck('price')[0];
                // $data['room'] = $room[$key];
                // $data['floor'] = $floor[$key];
                $data['delivery_date'] = Helper::formatDate($date[$key]);
                $data['delivery_time'] = Helper::formatDate($time[$key],'H:i:s');

//                $data['delivery_date'] = date('Y-m-d', strtotime($date[$key]));
//                $data['delivery_time'] = date('H:i:s', strtotime($time[$key]));
//                $data['delivery_date'] = Carbon::parse($date[$key])->format('Y-m-d');
//                $data['delivery_time'] = Carbon::parse($time[$key])->format('H:i:s');
                PatientTestItems::create($data);
            }
        }


        return $this->model;

    }





    public function update($request, $id)
    {
        $item = $this->model->find($id);
        $patientId = $item->patient_id;
        if (!$item) {
            throw new NotFoundHttpException('Patient Test Not Found');
        }
        if ($request->has('patient_id') && $request->get('patient_id')) {

            $item->patient_id = $request->patient_id;
            $patient = Patient::where('id', $item->patient_id)->
            where('organization_id', auth()->user()->organization_id)->first();
            $patient->is_paid = false;
            $patient->save();
        } else {
            $patient = new Patient();
            if ($request->has('first_name') && $request->get('first_name')) {
                $patient->first_name = $request->first_name;
            }
            if ($request->has('last_name') && $request->get('last_name')) {
                $patient->last_name = $request->last_name;
            }
            if ($request->has('age') && $request->get('age')) {
                $patient->age = $request->age;
            }
            if ($request->has('phone_number') && $request->get('phone_number')) {
                $patient->phone_number = $request->phone_number;
            }
            if ($request->has('gender') && $request->get('gender')) {
                $patient->gender = $request->gender;
            }
            if ($request->has('religion') && $request->get('religion')) {
                $patient->religion = $request->religion;
            }
            if ($request->has('address') && $request->get('address')) {
                $patient->address = $request->address;
            }
            $patient->organization_id = auth()->user()->organization_id;
            $patient->save();
            $item->patient_id = $patient->id;
        }

//        get patient id from $patient object
        //end of else
        if ($request->get('doctor_name')) {

            if ($request->has('referred_doctor_id') && $request->get('referred_doctor_id')) {
                $item->referred_doctor_id = $request->referred_doctor_id;
            } else {
                $doctor = new PatientTestReferredDoctor();
                if ($request->has('doctor_name') && $request->get('doctor_name')) {
                    $doctor->name = $request->doctor_name;
                }
                if ($request->has('institution_name') && $request->get('institution_name')) {
                    $doctor->institution_name = $request->institution_name;
                }
                if ($request->has('degree') && $request->get('degree')) {
                    $doctor->degree = $request->degree;
                }
                if ($request->has('phone_number') && $request->get('doctor_contact_number')) {
                    $doctor->phone_number = $request->doctor_contact_number;
                }
                $doctor->organization_id = auth()->user()->organization_id;
                $doctor->save();
                $item->referred_doctor_id = $doctor->id;
            }
        }

            $item->organization_id = auth()->user()->organization_id;
//        $this->model->invoice_no = "123456";
            $item->save();



        if($request->test_item_id[0] != null ){
            $test_item_id = explode(',', $request->test_item_id[0]);
            $date = explode(',', $request->d_date[0]);
            $time = explode(',', $request->d_time[0]);

            foreach ($test_item_id as $key => $content) {

                $data['patient_test_id'] = $item->id;
                $data['test_item_id'] = (int)$content;
//                $data['price'] = TestItem::where('id', $item)->pluck('price')[0];
                $data['price'] = TestItem::where('id', $content)->pluck('price')[0];
//                $data['input_date'] = Carbon::now()->toDateString();
//                $data['input_time'] = Carbon::now()->toTimeString();
                $data['delivery_date'] = Helper::formatDate($date[$key]);
                $data['delivery_time'] = Helper::formatDate($time[$key],'H:i:s');
//                $data['delivery_date'] = date('Y-m-d', strtotime($date[$key]));
//                $data['delivery_time'] = date('H:i:s', strtotime($time[$key]));
                PatientTestItems::create($data);
            }
        }


        return $item->save();
    }

    public function delete($id)
    {
        $item = $this->model->find($id);

        if (!$item) {
            throw new NotFoundHttpException('Patient Test Not Found');
        }

        return $item->delete();
    }

    public function get($id)
    {
        $item = $this->model->find($id);
        if (!$item) {
            throw new NotFoundHttpException('Patient Test Record Not found');
        }
        return $item;
    }

    public function getTests($id)
    {
        $item = PatientTestItems::find($id);
        if (!$item) {
            throw new NotFoundHttpException('Patient Test Item Record Not found');
        }
        return $item;
    }

//    public function getTestItem($id)
//    {
////        $item = PatientTestItems::find($id);
//        $item = PatientTestItems::where('patient_test_id', $id)->get();
//        if (!$item) {
//            throw new NotFoundHttpException('Test Item Not found');
//        }
//        return $item;
//    }
    public function getReferredDoctor($patientId)
    {
        $item = PatientTest::where('patient_id', $patientId)->
        where('is_latest', true)->
        where('organization_id', auth()->user()->organization_id)->pluck('referred_doctor_id');

        if ($item->isEmpty()) {
            return null;
        } else {
            $referredDoctor = PatientTestReferredDoctor::where('id',$item)->get();
            return $referredDoctor;
        }

    }
    public function getPatientTests($patientId)
    {
        $patientTest = PatientTest::where('patient_id', $patientId)->
        where('is_latest', true)->
        where('organization_id', auth()->user()->organization_id)
            ->pluck('id');
        if ($patientTest->isEmpty()) {
            return null;
        } else {
            $tests = PatientTestItems::where('patient_test_id', $patientTest)->get();
            $total_test_amount = $tests->sum('price');
//            dd($total_test_amount);
            $tests->total_test_amount = $total_test_amount;
//            dd($tests->total_test_amount);
            return $tests;

        }


//        return $this->model->where('organization_id', auth()->user()->organization_id)
//            ->where('patient_id', $patientId)->with('patientTestItems')->get();
    }

    public function getPatientByNumber($search)
    {
        $patient = new Patient();
        $data = $patient
            ->where('organization_id', auth()->user()->organization_id)
            ->where('phone_number', 'LIKE', "%$search%")->orderBy('phone_number', 'ASC')
            ->get();
        return $data;
    }

    public function getReferredDoctorByNumber($search)
    {
        $doctor = new PatientTestReferredDoctor();
        $data = $doctor
            ->where('organization_id', auth()->user()->organization_id)
            ->where('phone_number', 'LIKE', "%$search%")->orderBy('phone_number', 'ASC')
            ->get();
        return $data;
    }

    public function getTestByName($search)
    {
        $doctor = new TestItem();
        $data = $doctor
            ->where('organization_id', auth()->user()->organization_id)
            ->where('name', 'LIKE', "%$search%")->orderBy('name', 'ASC')
            ->get();
        return $data;
    }
}
