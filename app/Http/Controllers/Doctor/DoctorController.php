<?php
namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\Models\DoctorInfo;
use App\Repositories\DoctorRepository;

use http\Env\Response;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;

use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Redirect;

use Illuminate\View\View;
class DoctorController extends Controller
{
    /**
     * @var DoctorRepository
     */
    private $repository;
    private $indexRoute ;
    public function __construct(DoctorRepository $repository, $indexRoute = 'doctor.index')
    {
        $this->repository = $repository;
        $this->indexRoute = $indexRoute;
    }
    /**
     * @return Application|Factory|View
     */
    public function index(){
        $contentData = $this->repository->all();
        return view('doctor.index', compact('contentData'));
    }
    public function create(){
        $bloodGroups = $this->repository->getAllBloodGroups();
        $departments = $this->repository->getAllDepartment();

        return view('doctor.create', compact('bloodGroups', 'departments'));
    }

    public function store(CreateDoctorRequest $request)
    {
        $data = $this->repository->create($request);
        return redirect()->route( 'doctor.index')->with('success','Successfully Doctor Created');

    }

    public function edit($id){
        $data = $this->repository->get($id);
        $bloodGroups = $this->repository->getAllBloodGroups();
        $departments = $this->repository->getAllDepartment();
        return view('doctor.edit', compact('data','bloodGroups','departments'));

    }


    public function update(UpdateDoctorRequest $request, int $id):RedirectResponse
    {
        $data = $this->repository->update($request, $id);
        return redirect()->route( 'doctor.index')->with('success','Successfully Doctor Updated');
    }

    public function show(int $id)
   {
        $data = $this->repository->get( $id);
       return view('doctor.info',compact('data'));
   }


    public function destroy(int $id): RedirectResponse
    {
        $data = $this->repository->delete($id);
        return redirect()->route($this->indexRoute)->with('success', 'Doctor Is Deleted');
    }
}
