<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePetHistoryAPIRequest;
use App\Http\Requests\API\UpdatePetHistoryAPIRequest;
use App\Models\PetHistory;
use App\Repositories\PetHistoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\PetHistoryResource;
use Response;

/**
 * Class PetHistoryController
 * @package App\Http\Controllers\API
 */

class PetHistoryAPIController extends AppBaseController
{
    /** @var  PetHistoryRepository */
    private $petHistoryRepository;

    public function __construct(PetHistoryRepository $petHistoryRepo)
    {
        $this->petHistoryRepository = $petHistoryRepo;
    }

    /**
     * Display a listing of the PetHistory.
     * GET|HEAD /petHistories
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $petHistories = $this->petHistoryRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(PetHistoryResource::collection($petHistories), 'Pet Histories retrieved successfully');
    }

    /**
     * Store a newly created PetHistory in storage.
     * POST /petHistories
     *
     * @param CreatePetHistoryAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePetHistoryAPIRequest $request)
    {
        $input = $request->all();

        $petHistory = $this->petHistoryRepository->create($input);

        return $this->sendResponse(new PetHistoryResource($petHistory), 'Pet History saved successfully');
    }

    /**
     * Display the specified PetHistory.
     * GET|HEAD /petHistories/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var PetHistory $petHistory */
        $petHistory = $this->petHistoryRepository->find($id);

        if (empty($petHistory)) {
            return $this->sendError('Pet History not found');
        }

        return $this->sendResponse(new PetHistoryResource($petHistory), 'Pet History retrieved successfully');
    }

    /**
     * Update the specified PetHistory in storage.
     * PUT/PATCH /petHistories/{id}
     *
     * @param int $id
     * @param UpdatePetHistoryAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePetHistoryAPIRequest $request)
    {
        $input = $request->all();

        /** @var PetHistory $petHistory */
        $petHistory = $this->petHistoryRepository->find($id);

        if (empty($petHistory)) {
            return $this->sendError('Pet History not found');
        }

        $petHistory = $this->petHistoryRepository->update($input, $id);

        return $this->sendResponse(new PetHistoryResource($petHistory), 'PetHistory updated successfully');
    }

    /**
     * Remove the specified PetHistory from storage.
     * DELETE /petHistories/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var PetHistory $petHistory */
        $petHistory = $this->petHistoryRepository->find($id);

        if (empty($petHistory)) {
            return $this->sendError('Pet History not found');
        }

        $petHistory->delete();

        return $this->sendSuccess('Pet History deleted successfully');
    }
}
