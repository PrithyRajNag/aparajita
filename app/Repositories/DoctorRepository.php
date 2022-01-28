<?php
namespace App\Repositories;

use App\Mail\TestMail;
use App\Models\Department;
use App\Models\DoctorInfo;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DoctorRepository
{
    /**
     * @var DoctorInfo
     */
    private $model;
    /**
     * @var BloodGroupRepository
     */
    private $bloodGroupRepository;
    /**
     * @var DepartmentRepository
     */
    private $departmentRepository;
    /**
     * DoctorRepository constructor.
     * @param DoctorInfo $model
     * @param BloodGroupRepository $bloodGroupRepository
     * @param DepartmentRepository $departmentRepository
     */
    public function __construct(DoctorInfo $model, BloodGroupRepository $bloodGroupRepository, DepartmentRepository $departmentRepository)
    {
        $this->model = $model;
        $this->bloodGroupRepository = $bloodGroupRepository;
        $this->departmentRepository = $departmentRepository;
    }
    /**
     * @return DoctorInfo[]|Collection
     */
    public function all()
    {

        $user = User::role('doctor')->with('doctorInfos')
            ->where('organization_id', auth()->user()->organization_id)
            ->get();
       return $user;

    }
    /**
     * @param $request
     * @return bool
     */
    public function create($request): bool
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
        if ($request->has('join_date') && $request->get('join_date')) {
            $user->join_date = $request->join_date;
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
        $user->assignRole('doctor');


        $this->model->user_id = $user->id;

        if ($request->has('designation') && $request->get('designation')) {
            $this->model->designation = $request->designation;
        }
        if ($request->has('degree') && $request->get('degree')) {
            $this->model->degree = $request->degree;
        }
        if ($request->has('speciality') && $request->get('speciality')) {
            $this->model->speciality = $request->speciality;
        }
        if ($request->has('doctor_type') && $request->get('doctor_type')) {
            $this->model->doctor_type = $request->doctor_type;
        }
        if ($request->has('doctor_category') && $request->get('doctor_category')) {
            $this->model->doctor_category = $request->doctor_category;
        }
        if ($request->has('department_id') && $request->get('department_id')) {
            $this->model->department_id = $request->department_id;
        }
        if ($request->has('fees') && $request->get('fees')) {
            $this->model->fees = $request->fees;
        }

        $details=[
            'subject'=>'Account Created',
            'body'=>'Your Account Is Created.Your default password is '.$pass.'. Please change the password'
        ];
        Mail::to($user->email)->send(new TestMail($details));

        return $this->model->save();
    }

    /**
     * @param $request
     * @param $id
     * @param $user_id
     * @return mixed
     */
    public function update($request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            throw new NotFoundHttpException('Doctor not found');
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
        if ($request->has('join_date') && $request->get('join_date')) {
            $user->join_date = $request->join_date;
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

        $user->save();


        $item = DoctorInfo::where('user_id',$id)->first();
        if (!$item) {
            throw new NotFoundHttpException('Doctor Info not found');
        }

        if ($request->has('designation') && $request->get('designation')) {
            $this->model->designation = $request->designation;
        }
        if ($request->has('degree') && $request->get('degree')) {
            $this->model->degree = $request->degree;
        }
        if ($request->has('speciality') && $request->get('speciality')) {
            $item->speciality = $request->speciality;
        }
        if ($request->has('doctor_type') && $request->get('doctor_type')) {
            $item->doctor_type = $request->doctor_type;
        }
        if ($request->has('doctor_category') && $request->get('doctor_category')) {
            $item->doctor_category = $request->doctor_category;
        }
        if ($request->has('department_id') && $request->get('department_id')) {
            $item->department_id = $request->department_id;
        }
        if ($request->has('fees') && $request->get('fees')) {
            $item->fees = $request->fees;
        }

        $details=[
            'subject'=>'Account Updated',
            'body'=>'Your Account Is Updated. Please Check Your Profile If It Has Been Updated Correctly'
        ];
        Mail::to($user->email)->send(new TestMail($details));
        return $item->save();
    }




    /**
     * @param $id
     * @return mixed
     */
    public function get($id)
    {
        $item = User::find($id);
        if (!$item) {
            throw new NotFoundHttpException('Doctor not found');
        }
        return $item;
    }



    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $item = User::find($id);
        if (!$item) {
            throw new NotFoundHttpException('Doctor Not Found');
        }
        return $item->delete();
    }

    /**
     * @return mixed
     */
    public function getAllBloodGroups()
    {
        return $this->bloodGroupRepository->all();
    }

    /**
     * @return Department[]|Collection
     */
    public function getAllDepartment()
    {
        return $this->departmentRepository->all();
    }
}
