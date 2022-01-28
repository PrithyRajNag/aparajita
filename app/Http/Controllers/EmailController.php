<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmailRequest;
use App\Repositories\EmailRepository;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmailController extends Controller
{
    private $repository;
    private $indexRoute ;

    public function __construct(EmailRepository $repository, $indexRoute = 'email.index')
    {
        $this->repository = $repository;
        $this->indexRoute = $indexRoute;
    }
    public function index(){
        $contentData = $this->repository->all();
        return view('email.index', compact('contentData'));
    }

    public function send(CreateEmailRequest $request): JsonResponse
    {
//        dd($request->all());
        $data = $this->repository->create($request);
        return response()->json('Mail Has Been Send');
    }
    public function destroy(int $id): RedirectResponse
    {
        $data = $this->repository->delete($id);
        return redirect()->route($this->indexRoute)->with('success', 'Mail Deleted');
    }

//    public function test()
//    {
//        $user = User::role('doctor')->where('organization_id', auth()->user()->organization_id)
//            ->pluck('email');
//
//        return response()->json($user);
//
//    }
}
