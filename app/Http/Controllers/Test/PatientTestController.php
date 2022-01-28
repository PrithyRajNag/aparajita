<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTestPatientRequest;
use App\Http\Requests\UpdateTestPatientRequest;
use App\Models\PatientTest;
use App\Models\PatientTestItems;
use App\Repositories\PatientTestRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Mpdf\Mpdf;
use Mpdf\MpdfException;

class PatientTestController extends Controller
{
    private $repository;
    private $indexRoute;

    public function __construct(PatientTestRepository $repository, $indexRoute = 'test.patient.index')
    {
        $this->repository = $repository;
        $this->indexRoute = $indexRoute;
    }

    public function index()
    {

        $contentData = $this->repository->all();
        return view('test.patient.index', compact('contentData'));
    }

    public function create()
    {
        return view('test.patient.create');
    }

    public function store(CreateTestPatientRequest $request)
    {
//        return $request->all();
        $data = $this->repository->create($request);
        return redirect()->route($this->indexRoute)->with('success', 'Successfully Patient Test Created');
    }

    public function edit($id)
    {
        $data = $this->repository->get($id);
        return view('test.patient.edit', compact('data'));
    }

    public function update(UpdateTestPatientRequest $request, int $id)
    {
        $data = $this->repository->update($request, $id);
        return redirect()->route('test.patient.index')->with('success', 'Successfully Patient Test Updated');
    }

    public function show(int $id)
    {
        $data = $this->repository->get($id);
        return view('test.patient.info', compact('data'));
    }

//    public function showItem(int $id)
//    {
//        $data = $this->repository->getTests($id);
//        return view('test.patient.itemView', compact('data'));
//    }

    public function destroy(int $id): RedirectResponse
    {
        $data = $this->repository->delete($id);
        return redirect()->route($this->indexRoute)->with('success', 'Patient Test Record Deleted Successfully');
    }


    public function getPatient(Request $search)
    {
        return $this->repository->getPatientByNumber($search->search);
    }

    public function getDoctor(Request $search)
    {
        return $this->repository->getReferredDoctorByNumber($search->search);
    }

    public function getTest(Request $search)
    {
        return $this->repository->getTestByName($search->search);
    }

    public function itemBarcode(int $id)
    {
        $fileName = 'Test-Registration.pdf';
        $data =PatientTestItems::where('id', $id)->get();
//        return $data->patientTests->uuid;
        $mpdf = new Mpdf([
            'format' => [80,20],
            'margin_top' => 0,
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_bottom' => 0,
//            'normalLineheight'=>0.3

        ]);

        $mpdf->useFixedNormalLineHeight = false;
        $mpdf->useFixedTextBaseline = false;
        $mpdf->adjustFontDescLineheight = 0;

        $html = \view('test.patient.testRegistrationPdf')->with('data', $data);
        $html = $html->render();
        $mpdf->SetTitle('Test-Registration');


        try {

            $mpdf->WriteHTML($html);

        } catch (MpdfException $e) {

            die ($e->getMessage());

        }

        $mpdf->Output($fileName, 'I');

    }


    public function pdf(int $id)
    {
        $fileName = 'All-Test.pdf';
        $data =PatientTest::where('id', $id)->get();
        $testItems = PatientTestItems::where('patient_test_id',$id)->get();
//        return $data;
        $mpdf = new Mpdf([
            'format' => [100,150],
            'margin_top' => 10,
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_bottom' => 0,
//            'normalLineheight'=>0.3

        ]);

        $mpdf->useFixedNormalLineHeight = false;
        $mpdf->useFixedTextBaseline = false;
        $mpdf->adjustFontDescLineheight = 0;

        $html = \view('test.patient.allTestPdf')->with('data', $data)->with('testItems',$testItems);
        $html = $html->render();
        $mpdf->SetTitle('All-Tests');


        try {

            $mpdf->WriteHTML($html);

        } catch (MpdfException $e) {

            die ($e->getMessage());

        }

        $mpdf->Output($fileName, 'I');
    }
}
