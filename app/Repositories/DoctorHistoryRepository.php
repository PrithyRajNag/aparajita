<?php
namespace App\Repositories;

use App\Models\DoctorDocument;
use App\Models\DoctorInfo;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DoctorHistoryRepository
{
    private $model;
    private $doctorDocumentModel;
    private $doctorRepository;
    public function __construct(DoctorDocument $doctorDocumentModel,DoctorRepository $doctorRepository)
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


    public function createDocument($request, $doctorId): bool
    {
        if ($request->has('title') && $request->get('title')) {
            $this->doctorDocumentModel->title = $request->title;
        }
        if ($request->hasFile('cover')) {

            $fileName = time() . '.'. $request->cover->getClientOriginalName();
            $request->cover->move(public_path('uploads'), $fileName);

            $this->doctorDocumentModel->cover = $fileName;
//            $path = $request->file('cover')->store('documents', $this->doctorDocumentModel->cover);
        }
//        $document->organization_id = auth()->user()->organization_id;

        $this->doctorDocumentModel->organization_id = auth()->user()->organization_id;
        $this->doctorDocumentModel->doctor_id = $doctorId;

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
