<?php

namespace App\Repositories;

use App\Mail\TestMail;
use App\Models\Email;
use App\User;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EmailRepository
{
    private $model;

    public function __construct(Email $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->where('organization_id', auth()->user()->organization_id)->get();
    }

    public function create($request)
    {
        if ($request->has('email_to') && $request->get('email_to') && $request->email_to == 'doctor') {
            $emails = User::where('organization_id', auth()->user()->organization_id)->role('doctor')
                ->pluck('email');
//            $emails = $user;
            $this->model->email_id = 'All Doctors';
        }

        if ($request->has('email_to') && $request->get('email_to') && $request->email_to == 'nurse') {
            $emails = User::where('organization_id', auth()->user()->organization_id)->role('nurse')
                ->pluck('email');
//            $emails = $user;
            $this->model->email_id = 'All Nurse';
        }

        if ($request->has('email_to') && $request->get('email_to')
            && $request->email_to == 'specific'
            && $request->has('email_id') && $request->get('email_id'))
        {
            $this->model->email_id = $emails = $request->email_id;
        }

        if ($request->has('subject') && $request->get('subject')) {
            $this->model->subject = $request->subject;
        }

        if ($request->has('description') && $request->get('description')) {
            $this->model->description = $request->description;
        }
        $this->model->organization_id = auth()->user()->organization_id;
        $this->model->save();


        $details = [
            'subject' => $this->model->subject,
            'body' => $this->model->description,
        ];

        Mail::to($emails)->send(new TestMail($details));

        return $this->model;

    }

    public function delete($id)
    {
        $item = $this->model->find($id);
        if (!$item) {
            throw new NotFoundHttpException('Mail Not Found');
        }
        return $item->delete();
    }

}
