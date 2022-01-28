<?php
namespace App\Repositories;
use App\Models\Notice;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class NoticeRepository
{
    /**
     * @var Notice
     */
    private $model;
    private $roleRepository;

    /**
     * NoticeRepository constructor.
     * @param Notice $model
     * @param RoleRepository $roleRepository
     */
    public function __construct(Notice $model, RoleRepository $roleRepository)
    {
        $this->model = $model;
        $this->roleRepository = $roleRepository;
    }

    /**
     * @return Notice[]|Collection
     */
    public function all()
    {
//        return $this->model->all();
        return $this->model->where('organization_id',auth()->user()->organization_id)->get();
    }

    /**
     * @param $request
     * @param $organization_id
     * @return bool
     */
    public function create($request): bool
    {
        if ($request->has('role_id') && $request->get('role_id')) {
            $this->model->role_id = $request->role_id;
        }
        if ($request->has('title') && $request->get('title')) {
            $this->model->title = $request->title;
        }
        if ($request->has('description') && $request->get('description')) {
            $this->model->description = $request->description;
        }
        if ($request->has('start_date') && $request->get('start_date')) {
            $this->model->start_date = $request->start_date;
        }
        if ($request->has('end_date') && $request->get('end_date')) {
            $this->model->end_date = $request->end_date;
        }
        if ($request->has('status')) {
            $this->model->status = $request->status;
        }
        $this->model->organization_id = auth()->user()->organization_id;;

        return $this->model->save();

    }

    /**
     * @param $request
     * @param $id
     * @return bool
     */
    public function update($request, $id)
    {
        $item = $this->model->find($id);

        if (!$item) {
            throw new NotFoundHttpException('Notice Not Found');
        }

        if ($request->has('role_id') && $request->get('role_id')) {
            $item->role_id = $request->role_id;
        }
        if ($request->has('title') && $request->get('title')) {
            $item->title = $request->title;
        }
        if ($request->has('description') && $request->get('description')) {
            $item->description = $request->description;
        }
        if ($request->has('start_date') && $request->get('start_date')) {
            $item->start_date = $request->start_date;
        }
        if ($request->has('end_date') && $request->get('end_date')) {
            $item->end_date = $request->end_date;
        }
        if ($request->has('status')) {
            $item->status = $request->status;
        }


        return $item->save();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $item=$this->model->find($id);
        if (!$item) {
            throw new NotFoundHttpException('Notice Not Found');
        }
        return $item->delete();
    }


    public function getAllRoles()
    {
        return $this->roleRepository->all();
    }

}
