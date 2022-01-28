<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOrganizationSmsRequest;
use App\Models\OrganizationSms;
use App\Repositories\OrganizationSmsRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrganizationSmsController extends Controller
{
    private $repository;
    private $indexRoute ;

    public function __construct(OrganizationSmsRepository $repository, $indexRoute = 'company.sms.index')
    {
        $this->repository = $repository;
        $this->indexRoute = $indexRoute;
    }
    public function index(){
        $contentData = $this->repository->all();
        $organizations = $this->repository->getAllOrganizations();
        return view('company.sms.index', compact('contentData','organizations'));
    }
    public function create(){
        $organizations = $this->repository->getAllOrganizations();
        return view('company.sms.sent_sms', compact('organizations'));
    }
    public function store(CreateOrganizationSmsRequest $request)
    {
        $data = $this->repository->create($request);
        return redirect()->route($this->indexRoute)->with('success', 'Successfully Sms Added');
    }


}
