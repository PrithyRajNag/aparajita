<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNoticeRequest;
use App\Http\Requests\UpdateNoticeRequest;
use App\Repositories\NoticeRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;



class NoticeController extends Controller
{
    /**
     * @var NoticeRepository
     */
    private $repository;
    private $indexRoute ;

    public function __construct(NoticeRepository $repository, $indexRoute = 'notice.index')
    {
        $this->repository = $repository;
        $this->indexRoute = $indexRoute;
    }
    public function index(){
        $roles = $this->repository->getAllRoles();
        $contentData = $this->repository->all();
//        return $contentData;
        return view('notice.index',compact('contentData','roles'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param CreateNoticeRequest $request
     * * @return JsonResponse
     */
    public function store(CreateNoticeRequest $request):JsonResponse
    {

        $data = $this->repository->create($request);
        return response()->json( 'Successfully Notice Created');
    }



    /**
     * Update the specified resource in storage.
     *
     * @param UpdateNoticeRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateNoticeRequest $request, int $id): JsonResponse
    {
        $data = $this->repository->update($request, $id);
        return response()->json('Notice Information Updated');
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
        return redirect()->route($this->indexRoute)->with('success', 'Notice Deleted');
    }
}
