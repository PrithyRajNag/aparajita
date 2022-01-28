<?php
namespace App\Repositories;

use App\Mail\TestMail;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Spatie\Permission\Models\Role;

class StaffRepository
{
    private $model;
    /**
     * @var BloodGroupRepository
     */
    private $bloodGroupRepository;
    private $roleRepository;

    public function __construct(User $model, BloodGroupRepository $bloodGroupRepository, RoleRepository $roleRepository)
    {
        $this->model = $model;
        $this->bloodGroupRepository = $bloodGroupRepository;
        $this->roleRepository = $roleRepository;
    }

    public function all()
    {
        return $this->model->whereHas('roles', function ($query) {
            return $query->whereNotIn('name', ['owner','admin', 'doctor']);
        })->where('organization_id',auth()->user()->organization_id)->get();
    }

    public function create($request): User
    {
        $user = new User();
        if ($request->has('first_name') && $request->get('first_name')) {
            $user->first_name = $request->first_name;
        }
        if ($request->has('last_name') && $request->get('last_name')) {
            $user->last_name = $request->last_name;
        }
        if ($request->has('phone_number') && $request->get('phone_number')) {
            $user->phone_number = $request->phone_number;
        }
        if ($request->has('dob') && $request->get('dob')) {
            $user->dob = $request->dob;
        }
        if ($request->has('address') && $request->get('address')) {
            $user->address = $request->address;
        }
        if ($request->has('email') && $request->get('email')) {
            $user->email = $request->email;
        }
        if ($request->has('gender') && $request->get('gender')) {
            $user->gender = $request->gender;
        }
        if ($request->has('blood_group_id') && $request->get('blood_group_id')) {
            $user->blood_group_id = $request->blood_group_id;
        }
        if ($request->has('nid') && $request->get('nid')) {
            $user->nid = $request->nid;
        }
        if ($request->has('salary') && $request->get('salary')) {
            $user->salary = $request->salary;
        }
        if ($request->has('role') && $request->get('role')) {
            $role = Role::where('name', $request->role)->first();
        }


        if ($request->hasFile('image')) {
            $image = base64_encode(file_get_contents($request->file('image')));
            $user->image = $request->image->hashname();
        }

//        if ($request->hasFile('image')) {
//            $fileName = time() . '.' . $request->image->getClientOriginalName();
//            $path = $request->image->store('public/images/');
//            $user->image = $request->image->hashname();
//        }


        $user->organization_id = auth()->user()->organization_id;
        $pass = generateRandomPassword();
        $user->password = $pass;
        $user->save();
        $user->assignRole($role);

        $details=[
            'subject'=>'Account Created ',
            'body'=>'Your Account Is Created.Your default password is '.$pass.'. Please change the password'
        ];
        Mail::to($user->email)->send(new TestMail($details));

        return $user;

    }
    public function update($request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            throw new NotFoundHttpException('Staff Not Found');
        }
        if ($request->has('first_name') && $request->get('first_name')) {
            $user->first_name = $request->first_name;
        }
        if ($request->has('last_name') && $request->get('last_name')) {
            $user->last_name = $request->last_name;
        }
        if ($request->has('phone_number') && $request->get('phone_number')) {
            $user->phone_number = $request->phone_number;
        }
        if ($request->has('dob') && $request->get('dob')) {
            $user->dob = $request->dob;
        }
        if ($request->has('address') && $request->get('address')) {
            $user->address = $request->address;
        }
        if ($request->has('email') && $request->get('email')) {
            $user->email = $request->email;
        }
        if ($request->has('gender') && $request->get('gender')) {
            $user->gender = $request->gender;
        }
        if ($request->has('blood_group_id') && $request->get('blood_group_id')) {
            $user->blood_group_id = $request->blood_group_id;
        }
        if ($request->has('nid') && $request->get('nid')) {
            $user->nid = $request->nid;
        }
        if ($request->has('salary') && $request->get('salary')) {
            $user->salary = $request->salary;
        }
        if ($request->has('role') && $request->get('role')) {
            $role = Role::where('name', $request->role)->first();
        }

        if ($request->hasFile('image')) {
            $image = base64_encode(file_get_contents($request->file('image')));
            $user->image = $request->image->hashname();
        }
//        if ($request->hasFile('image')) {
//            if ($user->image != null && Storage::exists('public/images/' . $user->image) ) {
//                Storage::delete('public/images/' . $user->image);
//            }
//            $fileName = time() . '.' . $request->image->getClientOriginalName();
//            $request->image->store('public/images/');
//            $user->image = $request->image-> hashname();
//        }
        $details=[
            'subject'=>'Account Updated',
            'body'=>'Your Account Is Updated. Please Check Your Profile If It Has Been Updated Correctly'
        ];
        Mail::to($user->email)->send(new TestMail($details));
        $user->save();
        $user->assignRole($role);

        return $user;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function get($id)
    {
        $item = $this->model->find($id);
        if (!$item) {
            throw new NotFoundHttpException('Staff not found');
        }
        return $item;
    }

    public function delete($id)
    {
        $item=$this->model->find($id);
        if (!$item) {
            throw new NotFoundHttpException('Staff Not Found');
        }
        return $item->delete();
    }

    public function getAllBloodGroups()
    {
        return $this->bloodGroupRepository->all();
    }

    public function getAllRoles()
    {
        return $this->roleRepository->all()->filter(function ($item){
            return $item->name != 'doctor' && $item->name != 'owner';
        });
    }

}
