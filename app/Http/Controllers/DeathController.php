<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDeathRequest;
use App\Http\Requests\UpdateDeathRequest;
use App\Models\Death;
use App\Repositories\DeathRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Mpdf\Mpdf;

class DeathController extends Controller
{
    /**
     * @var DeathRepository
     */
    private $repository;
    private $indexRoute ;

    public function __construct(DeathRepository $repository, $indexRoute = 'death.index')
    {
        $this->repository = $repository;
        $this->indexRoute = $indexRoute;
    }
    public function index(){
        $patients = $this->repository->getAllPatients();
        $doctors = $this->repository->getAllDoctors();
        $contentData = $this->repository->all();
        return view('death.index', compact('contentData','patients','doctors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateDeathRequest $request
     * @return JsonResponse
     */
    public function store(CreateDeathRequest $request): JsonResponse
    {
        $data = $this->repository->create($request);
        return response()->json( 'Successfully Death Report Created');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateDeathRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateDeathRequest $request, int $id): JsonResponse
    {
        $data = $this->repository->update($request, $id);
        return response()->json('Death Record Updated');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $data = $this->repository->delete($id);

        return redirect()->route($this->indexRoute)->with('success', 'Death record Deleted');
    }

    public function pdf(int $id)
    {
        $fileName = 'Death-Certificate.pdf';
        $data =Death::where('id', $id)->where('organization_id',auth()->user()->organization_id)->get();
//        return $data;
        $mpdf = new Mpdf([
            'format' => 'A4-L',
            'margin_top' => 16,
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_bottom' => 10,
        ]) ;

        $html = \view('death.deathCertificatePdf')->with('data', $data);
        $html = $html->render();
//        $stylesheet = file_get_contents(public_path('css/bootstrap.css'));
        $stylesheet1 = file_get_contents(public_path('css/deathPdf.css'));
        $mpdf->SetTitle('Death-Certificate');
//        $mpdf->WriteHTML($stylesheet,1);
        $mpdf->WriteHTML($stylesheet1,1);
        $mpdf->WriteHTML($html, 2);
        $mpdf->Output($fileName, 'I');
    }
}
