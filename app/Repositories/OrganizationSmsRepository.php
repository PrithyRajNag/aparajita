<?php

namespace App\Repositories;

use App\Models\OrganizationSms;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OrganizationSmsRepository
{
    private $model;
    private $organizationRepository;

    public function __construct(OrganizationSms $model, OrganizationRepository $organizationRepository)
    {
        $this->model = $model;
        $this->organizationRepository = $organizationRepository;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function create($request): bool
    {
        if ($request->has('organization_id') && $request->get('organization_id')) {
            $this->model->organization_id = $request->organization_id;
        }
        if ($request->has('sms_amount') && $request->get('sms_amount')) {
            $this->model->sms_amount = $request->sms_amount;
        }
        return $this->model->save();
    }

    public function getAllOrganizations()
    {
        return $this->organizationRepository->all();
    }
}
