<?php
namespace App\Repositories;
use App\Mail\TestMail;
use App\Models\CompanyEmployee;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
class CompanyProfileRepository
{
    private $model;
    public function __construct(CompanyEmployee $model)
    {
        $this->model = $model;
    }
//    public function all()
//    {
//        return $this->model->all();
//    }
    public function get($id)
    {
        $item = $this->model->find($id);
        if (!$item) {
            throw new NotFoundHttpException('Employee Not Found');
        }
        return $item;
    }
    public function update($request, $id)
    {
        $item = $this->get($id);
        if (!$item) {
            throw new NotFoundHttpException('Employee Not Found');
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
        if ($request->has('address') && $request->get('address')) {
            $item->address = $request->address;
        }
        return $item->save();
    }
    public function passUpdate($request, $id)
    {
        $item = CompanyEmployee::find($id);
        if (! $item) {
            throw new NotFoundHttpException('Employee Not found');
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
}
