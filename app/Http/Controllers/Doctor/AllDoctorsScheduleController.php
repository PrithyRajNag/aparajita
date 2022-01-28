<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAllDoctorsScheduleRequest;
use App\Http\Requests\UpdateAllDoctorsScheduleRequest;
use App\Repositories\AllDoctorsScheduleRepository;
use Illuminate\Http\RedirectResponse;

class AllDoctorsScheduleController extends Controller
{

    private $repository;
    private $indexRoute ;

    public function __construct(AllDoctorsScheduleRepository $repository, $indexRoute = 'doctor.all-doctors.schedule.index')
    {
        $this->repository = $repository;
        $this->indexRoute = $indexRoute;
    }
    public function index(){


        $doctors = $this->repository->getAllDoctors();

//        $doctors = $this->repository->getAllDoctors();
        $contentData = $this->repository->all();
        return view('doctor.all_doctors_schedule.index' , compact('contentData' ,'doctors'));
    }

    public function create()
    {
        $doctors = $this->repository->getAllDoctors();
        return view('doctor.all_doctors_schedule.create', compact('doctors'));
    }


    public function store(CreateAllDoctorsScheduleRequest $request)
    {
        $data = $this->repository->create($request);
        return redirect()->route('doctor.all-doctors.schedule.index')->with('success','Successfully Doctor Schedule Created');
    }


    public function edit($id)
    {
        $data = $this->repository->get($id);
        $doctors = $this->repository->getAllDoctors();
        return view('doctor.all_doctors_schedule.edit', compact('data', 'doctors'));
    }

    public function update(UpdateAllDoctorsScheduleRequest $request, int $id)
    {
//        return $request->all();
        $data = $this->repository->update($request, $id);
        return redirect()->route('doctor.all-doctors.schedule.index')->with('success','Successfully Doctor Schedule Updated');
    }

    public function destroy(int $id): RedirectResponse
    {
        $data = $this->repository->delete($id);

        return redirect()->route($this->indexRoute)->with('success', 'Doctor Schedule Is Removed');
    }
}
