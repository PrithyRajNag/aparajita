<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBirthRequest;
use App\Http\Requests\UpdateBirthRequest;
use App\Models\Birth;
use App\Repositories\BirthRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Mpdf\Mpdf;

class BirthController extends Controller
{
    /**
     * @var BirthRepository
     */
    private $repository;
    private $indexRoute ;

    public function __construct(BirthRepository $repository, $indexRoute = 'birth.index')
    {
        $this->repository = $repository;
        $this->indexRoute = $indexRoute;
    }
    public function index(){
        $doctors = $this->repository->getAllDoctors();
        $bloodGroups = $this->repository->getAllBloodGroups();
        $contentData = $this->repository->all();
//        return $contentData;
        return view('birth.index', compact('contentData', 'doctors', 'bloodGroups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateBirthRequest $request
     * @return JsonResponse
     */
    public function store(CreateBirthRequest $request): JsonResponse
    {
        $data = $this->repository->create($request);
        return response()->json( 'Successfully Birth Report Created');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBirthRequest $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(UpdateBirthRequest $request,int $id):JsonResponse
    {
        $data = $this->repository->update($request, $id);
        return response()->json('Birth Record Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy(int $id):RedirectResponse
    {
        $data = $this->repository->delete($id);

        return redirect()->route($this->indexRoute)->with('success', 'Birth Record Deleted');
    }

    public function pdf(int $id)
    {
        $fileName = 'Birth-Certificate.pdf';
        $data =Birth::where('id', $id)->where('organization_id',auth()->user()->organization_id)->get();
//        return $data;
        $mpdf = new Mpdf([
            'format' => 'A4-L',
            'margin_top' => 15,
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_bottom' => 10,
        ]) ;

        $html = \view('birth.birthCertificatePdf')->with('data', $data);
        $html = $html->render();
//        $stylesheet = file_get_contents(public_path('css/bootstrap.css'));
        $stylesheet1 = file_get_contents(public_path('css/birthPdf.css'));
        $mpdf->SetTitle('Birth-Certificate');
//        $mpdf->WriteHTML($stylesheet,1);
        $mpdf->WriteHTML($stylesheet1,1);
        $mpdf->WriteHTML($html, 2);
        $mpdf->Output($fileName, 'I');
    }
}
