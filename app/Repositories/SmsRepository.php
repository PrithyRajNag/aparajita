<?php

namespace App\Repositories;

use App\Jobs\SendSMS;
use App\Models\BloodInput;
use App\Models\Patient;
use App\Models\Sms;
use App\Models\SmsReceiver;
use App\User;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SmsRepository
{
    private $model;

    public function __construct(Sms $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->where('organization_id', auth()->user()->organization_id)->get();
    }

    public function create($request)
    {
        $receivers = [];

        if ($request->has('sms_to') && $request->get('sms_to') && $request->sms_to == 'patient') {
            $receivers = Patient::where('organization_id', auth()->user()->organization_id)
                ->pluck('phone_number');
            $this->model->receiver = 'All Patients';
        }
        if ($request->has('sms_to') && $request->get('sms_to') && $request->sms_to == 'doctor') {
            $receivers = User::where('organization_id', auth()->user()->organization_id)->role('doctor')
                ->pluck('phone_number');
            $this->model->receiver = 'All Doctors';
        }
        if ($request->has('sms_to') && $request->get('sms_to') && $request->sms_to == 'all') {
            $receivers = User::where('organization_id', auth()->user()->organization_id)->role('admin', 'receptionist', 'accountant', 'lab_staff', 'nurse', 'other_staff')
                ->pluck('phone_number');
            $this->model->receiver = 'All Staff';
        }
        if ($request->has('sms_to') && $request->get('sms_to') && $request->sms_to == 'donor') {
            $receivers = BloodInput::where('organization_id', auth()->user()->organization_id)
                ->where('is_regular_donor', 1)
                ->pluck('phone_number');
            $this->model->receiver = 'All Donors';
        }


        if ($request->has('sms_to') && $request->get('sms_to')
            && $request->sms_to == 'specific'
            && $request->has('receiver') && $request->get('receiver')) {
            $this->model->receiver = $request->sms_to;
            array_push($receivers, $request->receiver);
        }

        if ($request->has('message') && $request->get('message')) {
            $this->model->message = $request->message;
        }
//        return ["phone" => $receivers, "msg"=> $this->model->message];

        $this->model->organization_id = auth()->user()->organization_id;
        $this->model->save();


        if ($receivers->isEmpty() && $this->model->message != null) {
            foreach ($receivers as $item) {
                // save phone number with sms model id
                $smsReceiver = new SmsReceiver();
                $smsReceiver->sms_id = $this->model->id;
                $smsReceiver->phone_number = $item;
                $smsReceiver->organization_id = auth()->user()->organization_id;

                $smsReceiver->save();
                // call sendSMS job
                SendSMS::dispatch($item, $this->model->message);

            }

        }

        return $this->model;

    }

    public function delete($id)
    {
        $item = $this->model->find($id);
        if (!$item) {
            throw new NotFoundHttpException('Sms Not Found');
        }
        return $item->delete();
    }
}
