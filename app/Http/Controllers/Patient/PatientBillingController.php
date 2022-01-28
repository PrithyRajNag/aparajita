<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePatientBillingRequest;
use App\Models\Patient;
use App\Models\PatientAdmitAndDischarge;
use App\Models\PatientBilling;
use App\Models\PatientBillingAdvance;
use App\Models\PatientTest;
use App\Repositories\BedAssignRepository;
use App\Repositories\PatientAppointmentRepository;
use App\Repositories\PatientBillingRepository;
use App\Repositories\PatientRepository;
use App\Repositories\PatientTestRepository;
use Carbon\Carbon;
use Mpdf\Mpdf;

class PatientBillingController extends Controller
{
    private $patientBillingRepository;
    private $patientRepository;
    private $bedAssignRepository;
    private $patientTestRepository;
    private $patientAppointmentRepository;
//    private $indexRoute ;
    public function __construct(
        PatientBillingRepository $patientBillingRepository,
        PatientRepository $patientRepository,
        BedAssignRepository $bedAssignRepository,
        PatientTestRepository $patientTestRepository,
        PatientAppointmentRepository $patientAppointmentRepository
//        $indexRoute = 'patient.billing.index'
    )
    {

        $this->patientBillingRepository = $patientBillingRepository;
        $this->patientRepository = $patientRepository;
        $this->bedAssignRepository = $bedAssignRepository;
        $this->patientTestRepository = $patientTestRepository;
        $this->patientAppointmentRepository = $patientAppointmentRepository;
//        $this->indexRoute = $indexRoute;
    }
    public function index(){
        $contentData = $this->patientBillingRepository->all();
//        return $contentData;
        return view('patient.billing.index',compact('contentData'));
    }
    public function show($patientId){
        $patientInfo = $this->patientRepository->get($patientId);
        $beds = $this->bedAssignRepository->getPatientBeds($patientId);
        $tests = $this->patientTestRepository->getPatientTests($patientId);
        $advances = $this->patientBillingRepository->getAdvanceBilling($patientId);
        $services = $this->patientBillingRepository->getServiceBilling($patientId);
        $caseHistories = PatientAdmitAndDischarge::where('patient_id', $patientId)->orderBy('admit_date', 'desc')->where('is_latest',true)->first();
        $dischargeDate = Carbon::now();
        return view('patient.billing.info', compact('patientInfo', 'beds', 'caseHistories', 'tests','dischargeDate','advances','services'));
    }
    public function store(CreatePatientBillingRequest $request,$patientId)
    {
        $data = $this->patientBillingRepository->create($request);
        $this->pdf($patientId);
        return redirect()->route('patient.billingList.index')->with('success', 'Successfully Patient Billing Created');
    }
    public function pdf($patientId)
    {
        $fileName = 'Patient-Billing.pdf';
        $patientInfo = $this->patientRepository->get($patientId);
        $tests = $this->patientTestRepository->getPatientTests($patientId);
        $referredDoctor = $this->patientTestRepository->getReferredDoctor($patientId);
        $data =PatientBilling::where('patient_id', $patientId)->where('is_latest',true)->where('organization_id',auth()->user()->organization_id)->get();
        $caseHistories = PatientAdmitAndDischarge::where('patient_id', $patientId)->orderBy('admit_date', 'desc')->where('is_latest',true)->first();
        $dischargeDate = Carbon::now();
//        return $tests->tests->testCategory->lab->name;
        $mpdf = new Mpdf([
            'format' => 'A4',
            'margin_top' => 20,
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_bottom' => 10,
        ]) ;

        $html = \view('patient.billing.patientBillingPdf',compact('patientInfo','data','caseHistories','dischargeDate','tests','referredDoctor'));
        $html = $html->render();
        $stylesheet1 = file_get_contents(public_path('css/patientBillingPdf.css'));
        $mpdf->SetTitle('Patient-Billing');
        $mpdf->WriteHTML($stylesheet1,1);
        $mpdf->WriteHTML($html, 0);
        $mpdf->Output($fileName, 'I');
    }

    public function resolved($id)
    {
        $data = Patient::where('id',$id)->first();
        $data->is_resolved = true;
        $data->save();
        return redirect()->route('patient.billingList.index');
    }

    public function old()
    {
        $data = PatientBilling::where('is_latest',0)->where('organization_id',auth()->user()->organization_id)->get();
        return view('patient.billing.old',compact('data'));
    }
    public function oldDetails($id)
    {
        $data = PatientBilling::where('id',$id)->get();
//        $advance = PatientBillingAdvance::where('patient_billing_id',$id)->get();
//        return $advance;
        return view('patient.billing.oldDetails',compact('data'));
    }
    public function oldPdf($id)
    {
        $fileName = 'Patient-Billing.pdf';
        $data = PatientBilling::where('id',$id)->get();
        $mpdf = new Mpdf([
            'format' => [180,180],
            'margin_top' => 20,
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_bottom' => 10,
        ]) ;

        $html = \view('patient.billing.oldBillingPdf',compact('data'));
        $html = $html->render();
        $stylesheet1 = file_get_contents(public_path('css/patientBillingPdf.css'));
        $mpdf->SetTitle('Patient-Billing');
        $mpdf->WriteHTML($stylesheet1,1);
        $mpdf->WriteHTML($html, 0);
        $mpdf->Output($fileName, 'I');
    }

}
