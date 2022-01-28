<?php
namespace App\Repositories;

use App\Models\Organization;
use App\Models\OrganizationModules;
use App\User;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SettingsRepository
{
    private $model;
    public function __construct(Organization $model)
    {
        $this->model = $model;
//        $this->userModel = $userModel;
    }
    public function all()
    {
        return $this->model->all();
    }

    public function get($id)
    {
        $item = $this->model->find($id);
        if (!$item) {
            throw new NotFoundHttpException('User Not Found');
        }
        return $item;
    }
//    public function get($id)
//    {
//        $item = $this->userModel->find($id);
//
//        if (!$item) {
//            throw new NotFoundHttpException();
//        }
//
//        return $item;
//    }
    public function update($request, $id)
    {
        $item = Organization::where('id',auth()->user()->organization_id)->first();

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
        if ($request->hasFile('logo')) {
            if ($item->logo != null && Storage::exists('public/uploads/' . $item->logo) ) {
                Storage::delete('public/uploads/' . $item->logo);
            }
            $fileName = time() . '.' . $request->logo->getClientOriginalName();
            $request->logo->store('public/uploads');
            $item->logo = $request->logo-> hashname();
        }

        return $item->save();
    }

}
