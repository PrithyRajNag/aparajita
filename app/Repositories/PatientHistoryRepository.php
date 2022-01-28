<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 5/7/2021
 * Time: 2:56 PM
 */

namespace App\Repositories;


use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PatientHistoryRepository

{
    private $model;
    private $doctorDocumentModel;
    private $doctorRepository;
    public function __construct(
        DoctorDocument $doctorDocumentModel,
        DoctorRepository $doctorRepository
    )
    {
//        $this->model = $model;
        $this->doctorDocumentModel = $doctorDocumentModel;
        $this->doctorRepository = $doctorRepository;
    }
    public function all()
    {
        return $this->doctorDocumentModel->where('organization_id',auth()->user()->organization_id)->get();
    }

//    public function create($request): bool
//    {
//
//        return $this->model->save();
//
//    }
//    public function update($request, $id)
//    {
//        $item = $this->model->find($id);
//
//        if (!$item) {
//            throw new NotFoundHttpException();
//        }
//
//
//
//        return $item->save();
//    }


    public function createDocument($request): bool
    {
//        if ($request->has('doctor_id') && $request->get('doctor_id')) {
//            $this->model->patient_id = $request->patient_id;
//
//            $patient = Patient::find($this->model->patient_id);
//
//            $patient->is_alive = false;
//            $patient->save();
//        }
//        $document = new DoctorDocument();
        if ($request->has('title') && $request->get('title')) {
            $this->doctorDocumentModel->title = $request->title;
        }
        if ($request->hasFile('cover')) {
            $this->doctorDocumentModel->cover = $request->cover->getClientOriginalName();
            $request->cover->storeAs('documents', $this->doctorDocumentModel->cover);
        }
//        $document->organization_id = auth()->user()->organization_id;

        $this->doctorDocumentModel->organization_id = auth()->user()->organization_id;


//        $doctor = new DoctorInfo(id);

//        $this->doctorDocumentModel->doctor_id = $request->;

        return $this->doctorDocumentModel->save();

    }


    public function delete($id)
    {
        $item = $this->model->find($id);

        if (!$item) {
            throw new NotFoundHttpException('File Not Found');
        }

        return $item->delete();
    }
    public function getAllDoctors()
    {
        return $this->doctorRepository->all();
    }
}
