<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBillRequest;
use App\Http\Requests\UpdateBillRequest;
use App\Models\Bill;
use App\Repositories\BillRepository;
use Illuminate\Http\RedirectResponse;

class BillController extends Controller
{
    private $repository;
    private $indexRoute ;

    public function __construct(BillRepository $repository , $indexRoute = 'bill.index')
    {
        $this->repository = $repository;
        $this->indexRoute = $indexRoute;
    }
    public function index(){
        $contentData = $this->repository->all();
        return view('bill.index', compact('contentData' ));
    }

    public function create(){
        $users = $this->repository->getUsers();
        return view('bill.create', compact( 'users'));
    }

    public function store(CreateBillRequest $request)
    {
        $data = $this->repository->create($request);
        return redirect()->route($this->indexRoute)->with('success','Successfully Bill Created');

    }

    public function edit($id){
        $data = $this->repository->get($id);
        $users = $this->repository->getUsers();
//        return $data;
        return view('bill.edit', compact( 'data','users'));
    }

    public function update(UpdateBillRequest $request, int $id)
    {
//        return $request->all();
        $data = $this->repository->update($request, $id);
        return redirect()->route( 'bill.index')->with('success','Successfully Bill Information Updated');
    }

    public function destroy(int $id): RedirectResponse
    {
        $data = $this->repository->delete($id);
        return redirect()->route($this->indexRoute)->with('success', 'Bill Is Deleted');
    }

    public function download($id)
    {
        $document = Bill::where('id', $id)->firstOrFail();
        $pathToFile = storage_path('app/uploads/'. $document->file);
        return response()->download($pathToFile);
    }
}
