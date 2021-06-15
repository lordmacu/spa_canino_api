<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePetsAPIRequest;
use App\Http\Requests\API\UpdatePetsAPIRequest;
use App\Models\Pets;
use App\Repositories\PetsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\PetsResource;
use Response;

/**
 * Class PetsController
 * @package App\Http\Controllers\API
 */

class PetsAPIController extends AppBaseController
{
    /** @var  PetsRepository */
    private $petsRepository;

    public function __construct(PetsRepository $petsRepo)
    {
        $this->petsRepository = $petsRepo;
    }

    /**
     * Display a listing of the Pets.
     * GET|HEAD /pets
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $pets = $this->petsRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(PetsResource::collection($pets), 'Pets retrieved successfully');
    }

    /**
     * Store a newly created Pets in storage.
     * POST /pets
     *
     * @param CreatePetsAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePetsAPIRequest $request)
    {
        $input = $request->all();

        $pets = $this->petsRepository->create($input);

        return $this->sendResponse(new PetsResource($pets), 'Pets saved successfully');
    }

    /**
     * Display the specified Pets.
     * GET|HEAD /pets/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Pets $pets */
        $pets = $this->petsRepository->find($id);

        if (empty($pets)) {
            return $this->sendError('Pets not found');
        }

        return $this->sendResponse(new PetsResource($pets), 'Pets retrieved successfully');
    }

    /**
     * Update the specified Pets in storage.
     * PUT/PATCH /pets/{id}
     *
     * @param int $id
     * @param UpdatePetsAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePetsAPIRequest $request)
    {
        $input = $request->all();

        /** @var Pets $pets */
        $pets = $this->petsRepository->find($id);

        if (empty($pets)) {
            return $this->sendError('Pets not found');
        }

        $pets = $this->petsRepository->update($input, $id);

        return $this->sendResponse(new PetsResource($pets), 'Pets updated successfully');
    }

    /**
     * Remove the specified Pets from storage.
     * DELETE /pets/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Pets $pets */
        $pets = $this->petsRepository->find($id);

        if (empty($pets)) {
            return $this->sendError('Pets not found');
        }

        $pets->delete();

        return $this->sendSuccess('Pets deleted successfully');
    }
}
