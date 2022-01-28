<?php
namespace App\Repositories;

use App\Mail\TestMail;
use App\Models\AllDoctorsSchedule;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AllDoctorsScheduleRepository
{
    private $model;
    private $doctorRepository;
    public function __construct(AllDoctorsSchedule $model, DoctorRepository $doctorRepository)
    {
        $this->model = $model;
        $this->doctorRepository = $doctorRepository;
    }
    public function all()
    {
        return $this->model->where('organization_id',auth()->user()->organization_id)->get();
    }

    public function create($request): bool
    {
        if ($request->has('doctor_id') && $request->get('doctor_id')) {
            $this->model->doctor_id = $request->doctor_id;
        }
        if ($request->has('week_day') && $request->get('week_day')) {
            $this->model->week_day = $request->week_day;
        }
        if ($request->has('start_time') && $request->get('start_time')) {
            $this->model->start_time = $request->start_time;
        }
        if ($request->has('end_time') && $request->get('end_time')) {
            $this->model->end_time = $request->end_time;
        }
        if ($request->has('patient_limit') && $request->get('patient_limit')) {
            $this->model->patient_limit = $request->patient_limit;
        }

        $this->model->organization_id = auth()->user()->organization_id;

//        $details=[
//            'title'=>'Your New Schedule Is Created',
//            'body'=>'Sunday 3:00pm-3:50pm'
//        ];
//        Mail::to('prithyrajnag.prn@gmail.com')->send(new TestMail($details));
//        echo "Email has been sent";
        return $this->model->save();

    }
    public function update($request, $id)
    {
        $item = $this->model->find($id);

        if (!$item) {

            throw new NotFoundHttpException('Doctor Information Not Found');
        }
        if ($request->has('doctor_id') && $request->get('doctor_id')) {
            $item->doctor_id = $request->doctor_id;
        }
        if ($request->has('week_day') && $request->get('week_day')) {
            $item->week_day = $request->week_day;
        }
        if ($request->has('start_time') && $request->get('start_time')) {
            $item->start_time = $request->start_time;
        }
        if ($request->has('end_time') && $request->get('end_time')) {
            $item->end_time = $request->end_time;
        }
        if ($request->has('patient_limit') && $request->get('patient_limit')) {
            $item->patient_limit = $request->patient_limit;
        }
        return $item->save();
    }


    public function get($id)
    {
        $item = $this->model->find($id);
        if (!$item) {
            throw new NotFoundHttpException('Doctor Schedule not found');
        }
        return $item;
    }

    public function delete($id)
    {
        $item = $this->model->find($id);

        if (!$item) {

            throw new NotFoundHttpException('Doctor Information Not Found');
        }
        return $item->delete();
    }


    public function getAllDoctors()
    {
        return $this->doctorRepository->all();
    }

    public function getDoctorSchedules($doctorId)
    {
        return $this->model->where('doctor_id', $doctorId)->get();
    }

}
