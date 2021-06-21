<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePopularAPIRequest;
use App\Http\Requests\API\UpdatePopularAPIRequest;
use App\Models\Popular;
use App\Repositories\PopularRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\PopularResource;
use Response;
use Storage;

/**
 * Class PopularController
 * @package App\Http\Controllers\API
 */

class PopularAPIController extends AppBaseController
{
    /** @var  PopularRepository */
    private $popularRepository;

    public function __construct(PopularRepository $popularRepo)
    {
        $this->popularRepository = $popularRepo;
    }

    /**
     * Display a listing of the Popular.
     * GET|HEAD /populars
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
       $Popular= new Popular();
       $populars=$Popular->getPopulars();
       
     
        return $this->sendResponse($populars, 'Populars retrieved successfully');
    }

    /**
     * Store a newly created Popular in storage.
     * POST /populars
     *
     * @param CreatePopularAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePopularAPIRequest $request)
    {
        $input = $request->all();

        $popular = $this->popularRepository->create($input);

        return $this->sendResponse(new PopularResource($popular), 'Popular saved successfully');
    }

    /**
     * Display the specified Popular.
     * GET|HEAD /populars/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Popular $popular */
        $popular = $this->popularRepository->find($id);

        if (empty($popular)) {
            return $this->sendError('Popular not found');
        }

        return $this->sendResponse(new PopularResource($popular), 'Popular retrieved successfully');
    }

    /**
     * Update the specified Popular in storage.
     * PUT/PATCH /populars/{id}
     *
     * @param int $id
     * @param UpdatePopularAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePopularAPIRequest $request)
    {
        $input = $request->all();

        /** @var Popular $popular */
        $popular = $this->popularRepository->find($id);

        if (empty($popular)) {
            return $this->sendError('Popular not found');
        }

        $popular = $this->popularRepository->update($input, $id);

        return $this->sendResponse(new PopularResource($popular), 'Popular updated successfully');
    }

    /**
     * Remove the specified Popular from storage.
     * DELETE /populars/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Popular $popular */
        $popular = $this->popularRepository->find($id);

        if (empty($popular)) {
            return $this->sendError('Popular not found');
        }

        $popular->delete();

        return $this->sendSuccess('Popular deleted successfully');
    }
}
