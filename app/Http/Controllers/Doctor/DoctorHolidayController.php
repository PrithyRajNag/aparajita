<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateDoctorHolidayRequest;
use App\Http\Requests\UpdateDoctorHolidayRequest;
use App\Repositories\DoctorHolidayRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DoctorHolidayController extends Controller
{

    private $repository;
    private $indexRoute ;

    public function __construct(DoctorHolidayRepository $repository, $indexRoute = 'doctor.holiday.index')
    {
        $this->repository = $repository;
        $this->indexRoute = $indexRoute;
    }
    public function index(){
        $contentData = $this->repository->all();
        $doctors = $this->repository->getAllDoctors();
        return view('doctor.holiday.index' , compact('contentData', 'doctors' ));
    }


    public function store(CreateDoctorHolidayRequest $request): JsonResponse
    {
        $data = $this->repository->create($request);
        return response()->json( 'Successfully Doctor Holiday Created');
    }

    public function update(UpdateDoctorHolidayRequest $request, int $id): JsonResponse
    {
        $data = $this->repository->update($request, $id);
        return response()->json('Successfully Doctor Holiday Information Updated');
    }


    public function destroy(int $id): RedirectResponse
    {
        $data = $this->repository->delete($id);

        return redirect()->route($this->indexRoute)->with('success', 'Doctor Holiday Information Removed');
    }
}
