<?php
namespace App\Repositories;

use App\Mail\TestMail;
use App\Models\Organization;
use App\Models\OrganizationModules;
use App\Models\OrganizationSms;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OrganizationRepository
{
    private $model;
    private $userModel;

    public function __construct(Organization $model, User $userModel)
    {
        $this->model = $model;
        $this->userModel = $userModel;
    }
    public function all()
    {
//        return $this->model->user()->get();
        return $this->userModel->role('owner')->get();
    }

    public function create($request)
    {

        if ($request->has('organization_name') && $request->get('organization_name')) {
            $this->model->name = $request->organization_name;
        }
        if ($request->has('organization_type') && $request->get('organization_type')) {
            $this->model->organization_type = $request->organization_type;
        }
        if ($request->has('organization_address') && $request->get('organization_address')) {
            $this->model->address = $request->organization_address;
        }
        if ($request->has('is_one_time_purchase') && $request->get('is_one_time_purchase')) {
            $this->model->is_one_time_purchase = $request->is_one_time_purchase;
        }
        if ( !$request->has('is_one_time_purchase') && $request->has('monthly_bill') && $request->get('monthly_bill')) {
            $this->model->monthly_bill = $request->monthly_bill;
        }
        if ($request->hasFile('logo')) {
            $fileName = time() . '.' . $request->logo->getClientOriginalName();
            $request->logo->store('public/uploads');
            $this->model->logo = $request->logo-> hashname();
        }
        $this->model->save();

        if ($request->has('modules') && $request->get('modules')) {
            foreach ($request->modules as $item) {
                $data['organization_id'] = $this->model->id;
                $data['module_id'] = $item;
                OrganizationModules::create($data);
            }
        }

        if ($request->has('first_name') && $request->get('first_name')) {
            $this->userModel->first_name = $request->first_name;
        }
        if ($request->has('last_name') && $request->get('last_name')) {
            $this->userModel->last_name = $request->last_name;
        }
        if ($request->has('email') && $request->get('email')) {
            $this->userModel->email = $request->email;
        }
        if ($request->has('phone_number') && $request->get('phone_number')) {
            $this->userModel->phone_number = $request->phone_number;
        }
        if ($request->has('address') && $request->get('address')) {
            $this->userModel->address = $request->address;
        }
        if ($request->has('gender') && $request->get('gender')) {
            $this->userModel->gender = $request->gender;
        }
        if ($request->has('dob') && $request->get('dob')) {
            $this->userModel->dob = $request->dob;
        }
        if ($request->has('nid') && $request->get('nid')) {
            $this->userModel->nid = $request->nid;
        }
        if ($request->has('blood_group_id') && $request->get('blood_group_id')) {
            $this->userModel->blood_group_id = $request->blood_group_id;
        }
        $this->userModel->organization_id = $this->model->id;
        $pass = generateRandomPassword();
        $this->userModel->password = $pass;

        $this->userModel->save();

        $role = Role::where('name', 'owner')->first();
        $this->userModel->assignRole($role);

        $details=[
            'subject'=>'Your Account Is Created',
            'body'=>'Your default password is '.$pass.'. Please change the password'
        ];
        Mail::to($this->userModel->email)->send(new TestMail($details));
        $organizationSms = new OrganizationSms();
        $organizationSms->organization_id = $this->model->id;
        $organizationSms->sms_amount = 100;
        $organizationSms->save();
//        return $this->userModel;
     return $organizationSms;

    }

    public function get($id)
    {
        $item = $this->userModel->find($id);

        if (!$item) {
            throw new NotFoundHttpException('User Not Found');
        }

        return $item;
    }

    public function update($request, $id)
    {
        $user_id = User::find($id);

        if (!$user_id) {
            throw new NotFoundHttpException('Organization Not Found');
        }

        if ($request->has('first_name') && $request->get('first_name')) {
            $user_id->first_name = $request->first_name;
        }
        if ($request->has('last_name') && $request->get('last_name')) {
            $user_id->last_name = $request->last_name;
        }
        if ($request->has('email') && $request->get('email')) {
            $user_id->email = $request->email;
        }
        if ($request->has('phone_number') && $request->get('phone_number')) {
            $user_id->phone_number = $request->phone_number;
        }
        if ($request->has('address') && $request->get('address')) {
            $user_id->address = $request->address;
        }
        if ($request->has('gender') && $request->get('gender')) {
            $user_id->gender = $request->gender;
        }
        if ($request->has('dob') && $request->get('dob')) {
            $user_id->dob = $request->dob;
        }
        if ($request->has('nid') && $request->get('nid')) {
            $user_id->nid = $request->nid;
        }
        if ($request->has('blood_group_id') && $request->get('blood_group_id')) {
            $user_id->blood_group_id = $request->blood_group_id;
        }
        $user_id->save();


        $item = Organization::where('id',$user_id->organization_id)->first();

        if (!$item) {
            throw new NotFoundHttpException('Organization Not Found');
        }
        if ($request->has('organization_name') && $request->get('organization_name')) {
            $item->name = $request->organization_name;
        }
        if ($request->has('organization_type') && $request->get('organization_type')) {
            $item->organization_type = $request->organization_type;
        }
        if ($request->has('organization_address') && $request->get('organization_address')) {
            $item->address = $request->organization_address;
        }
        if ($request->has('is_one_time_purchase') && $request->get('is_one_time_purchase')) {
            $item->is_one_time_purchase = $request->is_one_time_purchase;
        }
        if ( !$request->has('is_one_time_purchase') && $request->has('monthly_bill') && $request->get('monthly_bill')) {
            $item->monthly_bill = $request->monthly_bill;
        }
        if ($request->hasFile('logo')) {
            if ($item->logo != null && Storage::exists('public/uploads/' . $item->logo) ) {

                Storage::delete('public/uploads/' . $item->logo);
            }
            $fileName = time() . '.' . $request->logo->getClientOriginalName();
            $request->logo->store('public/uploads');
            $item->logo = $request->logo-> hashname();
        }

        if ($request->has('modules') && $request->get('modules')) {

            OrganizationModules::where('organization_id',$item->id)->delete();
            foreach ($request->modules as $module_id) {
                $data['organization_id'] = $item->id;
                $data['module_id'] = $module_id;
                OrganizationModules::create($data);
            }
        }


        return  $item->save();
    }

    public function delete($id)
    {
        $user_id = User::find($id);

        if (!$user_id) {
            throw new NotFoundHttpException('Organization Not Found');
        }

        return $user_id->delete();
    }

}
