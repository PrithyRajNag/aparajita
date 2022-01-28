<?php

namespace App\Http\Controllers\Bed;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBedListRequest;
use App\Http\Requests\UpdateBedListRequest;
use App\Models\BedList;
use App\Repositories\BedListRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class BedListController extends Controller
{
    /**
     * @var BedListRepository
     */
    private $repository;
    private $indexRoute;

    public function __construct(BedListRepository $repository, $indexRoute = 'bed.list.index')
    {
        $this->repository = $repository;
        $this->indexRoute = $indexRoute;
    }

    public function index()
    {
        $bedTypes = $this->repository->getAllBedTypes();
        $contentData = $this->repository->all();
        return view('bed.list.index', compact('contentData', 'bedTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateBedListRequest $request
     * @return JsonResponse
     */
    public function store(CreateBedListRequest $request): JsonResponse
    {

        $data = $this->repository->create($request);
        return response()->json('Successfully Bed Created');

    }

    public function show($id)
    {
        try {
            $data = BedList::findOrFail($id);
            return $data;
        }
        catch (\Exception $e) {
           return $e->getMessage();
        }


    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBedListRequest $request
     * @param int $id
     * @return JsonResponse
     */

    public function update(UpdateBedListRequest $request, int $id): JsonResponse
    {
        $data = $this->repository->update($request, $id);
        return response()->json('Bed Information Updated');
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
        return redirect()->route($this->indexRoute)->with('success', 'Bed Is Deleted');
    }
}
