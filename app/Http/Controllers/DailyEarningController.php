<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDailyEarningRequest;
use App\Http\Requests\UpdateDailyEarningRequest;
use App\Models\DailyEarning;
use App\Repositories\DailyEarningRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Mpdf\Mpdf;

class DailyEarningController extends Controller
{
    private $repository;
    private $indexRoute ;

    public function __construct(DailyEarningRepository $repository , $indexRoute = 'earning.index')
    {
        $this->repository = $repository;
        $this->indexRoute = $indexRoute;
    }
    public function index(){
        $contentData = $this->repository->all();
        return view('daily_earning.index', compact('contentData' ));
    }

    public function create(){
        // $users = $this->repository->getUsers();
        return view('daily_earning.create');
    }

    public function store(CreateDailyEarningRequest $request)
    {
        $data = $this->repository->create($request);
        return redirect()->route($this->indexRoute)->with('success','Successfully Earning Record Created');

    }

    public function edit($id){
        $data = $this->repository->get($id);
//        return $data;
        return view('daily_earning.edit', compact( 'data'));
    }

    public function update(UpdateDailyEarningRequest $request, int $id)
    {
//        return $request->all();
        $data = $this->repository->update($request, $id);
        return redirect()->route( 'earning.index')->with('success','Successfully Earning Record Information Updated');
    }

    public function destroy(int $id): RedirectResponse
    {
        $data = $this->repository->delete($id);
        return redirect()->route($this->indexRoute)->with('success', 'Earning Record Is Deleted');
    }
    public function pdf($id)
    {
        $fileName = 'Daily-Earning.pdf';
        $data = $this->repository->get($id);
//         return $data;
        $mpdf = new Mpdf([
            'format' => [200,100],
            'margin_top' => 20,
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_bottom' => 10,
        ]) ;

        $html = \view('daily_earning.dailyEarningPdf')->with('data', $data);
        $html = $html->render();
        $stylesheet1 = file_get_contents(public_path('css/dailyEarningPdf.css'));
        $mpdf->SetTitle('Patient-Earning');
        $mpdf->WriteHTML($stylesheet1,1);
        $mpdf->WriteHTML($html, 0);
        $mpdf->Output($fileName, 'I');
    }
}
