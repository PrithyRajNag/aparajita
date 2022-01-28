<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSmsRequest;
use App\Repositories\SmsRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SmsController extends Controller
{
    private $repository;
    private $indexRoute ;

    public function __construct(SmsRepository $repository, $indexRoute = 'sms.index')
    {
        $this->repository = $repository;
        $this->indexRoute = $indexRoute;
    }
    public function index(){
        $contentData = $this->repository->all();
        return view('sms.index', compact('contentData'));
    }

    public function send(CreateSmsRequest $request): JsonResponse
//    public function send(CreateSmsRequest $request)
    {
//        dd($request->all());
        $data = $this->repository->create($request);
//        return $data;
        return response()->json('Sms Has Been Send');
    }

    public function destroy(int $id): RedirectResponse
    {
        $data = $this->repository->delete($id);
        return redirect()->route($this->indexRoute)->with('success', 'Sms Deleted');
    }
}
