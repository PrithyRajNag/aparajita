<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdateUserPasswordRequest;
use App\Repositories\ProfileRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * @var ProfileRepository
     */
    private $repository;

    public function __construct(ProfileRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(){
        $data = $this->repository->get(auth()->user()->id);
        $bloodGroups = $this->repository->getAllBloodGroups();
        return view('profile.index', compact('data','bloodGroups'));
    }

    public function update(UpdateProfileRequest $request, $id)
    {
        $data = $this->repository->update($request, $id);

        return redirect()->route( 'profile.index')->with('profile_success','Successfully Doctor Updated');

    }

    public function passUpdate(UpdateUserPasswordRequest $request, $id)
    {
//        return $request->all();
        $data = $this->repository->passUpdate($request, $id);
        Auth::logout();
//        session()->flush();
        return redirect()->route( 'login');

    }
}
