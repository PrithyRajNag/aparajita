<?php
namespace App\Http\Controllers\Company;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCompanyEmployeePasswordRequest;
use App\Http\Requests\UpdateCompanyProfileRequest;
use App\Repositories\CompanyProfileRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyProfileController extends Controller
{
    private $repository;
    public function __construct(CompanyProfileRepository $repository)
    {
        $this->repository = $repository;
    }
    public function index(){
//        @dd(auth()->auth()->guard('company')->user()->id);
        $data = $this->repository->get(auth()->guard('company')->user()->id);
        return view('company.profile.index', compact('data'));
    }
    public function update(UpdateCompanyProfileRequest $request, $id)
    {
        $data = $this->repository->update($request, $id);
        return redirect()->route( 'company.profile.index')->with('profile_success','Successfully Profile Updated');
    }
    public function passUpdate(UpdateCompanyEmployeePasswordRequest $request, $id)
    {
//        return $request->all();
        $data = $this->repository->passUpdate($request, $id);
        Auth::logout();
//        session()->flush();
        return redirect()->route( 'com-login');
    }
}
