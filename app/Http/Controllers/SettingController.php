<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSettingRequest;
use App\Repositories\BloodGroupRepository;
use App\Repositories\CompanyModuleRepository;
use App\Repositories\SettingsRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SettingController extends Controller
{
    private $repository;
//    private $indexRoute ;

    public function __construct(SettingsRepository $repository)
    {
        $this->repository = $repository;
//        $this->indexRoute = $indexRoute;
    }
    public function index(){
        $data = $this->repository->get(auth()->user()->organization_id);
//        $bloodGroups = $this->repository->getAllBloodGroups();
        return view('setting.index', compact('data'));
    }
//    public function edit($id){
//        $data = $this->repository->get($id);
////        return [$data];
//        return view('setting.index', compact('data'));
//    }
    public function update(UpdateSettingRequest $request, int $id)
    {
        $data = $this->repository->update($request, $id);
//        return response()->json('Organization Information Updated');
        return redirect()->route( 'setting.index')->with('success','Successfully Organization Information Updated');
    }
}
