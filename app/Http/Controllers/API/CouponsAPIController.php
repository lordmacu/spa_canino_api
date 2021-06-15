<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCouponsAPIRequest;
use App\Http\Requests\API\UpdateCouponsAPIRequest;
use App\Models\Coupons;
use App\Repositories\CouponsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\CouponsResource;
use Response;

/**
 * Class CouponsController
 * @package App\Http\Controllers\API
 */

class CouponsAPIController extends AppBaseController
{
    /** @var  CouponsRepository */
    private $couponsRepository;

    public function __construct(CouponsRepository $couponsRepo)
    {
        $this->couponsRepository = $couponsRepo;
    }

    /**
     * Display a listing of the Coupons.
     * GET|HEAD /coupons
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $coupons = $this->couponsRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(CouponsResource::collection($coupons), 'Coupons retrieved successfully');
    }

    /**
     * Store a newly created Coupons in storage.
     * POST /coupons
     *
     * @param CreateCouponsAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateCouponsAPIRequest $request)
    {
        $input = $request->all();

        $coupons = $this->couponsRepository->create($input);

        return $this->sendResponse(new CouponsResource($coupons), 'Coupons saved successfully');
    }

    /**
     * Display the specified Coupons.
     * GET|HEAD /coupons/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Coupons $coupons */
        $coupons = $this->couponsRepository->find($id);

        if (empty($coupons)) {
            return $this->sendError('Coupons not found');
        }

        return $this->sendResponse(new CouponsResource($coupons), 'Coupons retrieved successfully');
    }

    /**
     * Update the specified Coupons in storage.
     * PUT/PATCH /coupons/{id}
     *
     * @param int $id
     * @param UpdateCouponsAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCouponsAPIRequest $request)
    {
        $input = $request->all();

        /** @var Coupons $coupons */
        $coupons = $this->couponsRepository->find($id);

        if (empty($coupons)) {
            return $this->sendError('Coupons not found');
        }

        $coupons = $this->couponsRepository->update($input, $id);

        return $this->sendResponse(new CouponsResource($coupons), 'Coupons updated successfully');
    }

    /**
     * Remove the specified Coupons from storage.
     * DELETE /coupons/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Coupons $coupons */
        $coupons = $this->couponsRepository->find($id);

        if (empty($coupons)) {
            return $this->sendError('Coupons not found');
        }

        $coupons->delete();

        return $this->sendSuccess('Coupons deleted successfully');
    }
}
