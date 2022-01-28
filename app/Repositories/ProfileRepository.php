<?php
namespace App\Repositories;

use App\Mail\TestMail;
use App\User;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProfileRepository
{
    private $model;
    private $bloodGroupRepository;

    public function __construct(User $model, BloodGroupRepository $bloodGroupRepository)
    {
        $this->model = $model;
        $this->bloodGroupRepository = $bloodGroupRepository;
    }

//    public function all()
//    {
//        return $this->model->all();
//    }

//    public function create($request): bool
//    {
//
//        return $this->model->save();
//
//    }
    public function get($id)
    {
        $item = $this->model->find($id);
        if (!$item) {
            throw new NotFoundHttpException('User Not Found');
        }
        return $item;
    }
    public function update($request, $id)
    {
        $item = $this->get($id);

        if (!$item) {
            throw new NotFoundHttpException('Staff Not Found');
        }
        if ($request->has('first_name') && $request->get('first_name')) {
            $item->first_name = $request->first_name;
        }
        if ($request->has('last_name') && $request->get('last_name')) {
            $item->last_name = $request->last_name;
        }
        if ($request->has('phone_number') && $request->get('phone_number')) {
            $item->phone_number = $request->phone_number;
        }
        if ($request->has('dob') && $request->get('dob')) {
            $item->dob = $request->dob;
        }
        if ($request->has('address') && $request->get('address')) {
            $item->address = $request->address;
        }
        if ($request->has('email') && $request->get('email')) {
            $item->email = $request->email;
        }
        if ($request->has('gender') && $request->get('gender')) {
            $item->gender = $request->gender;
        }
        if ($request->has('blood_group_id') && $request->get('blood_group_id')) {
            $item->blood_group_id = $request->blood_group_id;
        }
        if ($request->has('nid') && $request->get('nid')) {
            $item->nid = $request->nid;
        }

        return $item->save();
    }

    public function passUpdate($request, $id)
    {
        $item = User::find($id);

        if (! $item) {
            throw new NotFoundHttpException('User Not found');
        }
        $pass = $request->new_password;
        $item->password = $pass;

        $details=[
            'title'=>'Your Password Is Changed',
            'body'=>'Your New Password is '.$pass
        ];
        Mail::to($item->email)->send(new TestMail($details));
        return $item->save();
    }

    public function getAllBloodGroups()
    {
        return $this->bloodGroupRepository->all();
    }


}
