<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAboutAPIRequest;
use App\Http\Requests\API\UpdateAboutAPIRequest;
use App\Models\About;
use App\Repositories\AboutRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\AboutResource;
use Response;

/**
 * Class AboutController
 * @package App\Http\Controllers\API
 */

class AboutAPIController extends AppBaseController
{
    /** @var  AboutRepository */
    private $aboutRepository;

    public function __construct(AboutRepository $aboutRepo)
    {
        $this->aboutRepository = $aboutRepo;
    }

    /**
     * Display a listing of the About.
     * GET|HEAD /abouts
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $abouts = $this->aboutRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(AboutResource::collection($abouts), 'Abouts retrieved successfully');
    }

    /**
     * Store a newly created About in storage.
     * POST /abouts
     *
     * @param CreateAboutAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateAboutAPIRequest $request)
    {
        $input = $request->all();

        $about = $this->aboutRepository->create($input);

        return $this->sendResponse(new AboutResource($about), 'About saved successfully');
    }

    /**
     * Display the specified About.
     * GET|HEAD /abouts/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var About $about */
        $about = $this->aboutRepository->find($id);

        if (empty($about)) {
            return $this->sendError('About not found');
        }

        return $this->sendResponse(new AboutResource($about), 'About retrieved successfully');
    }

    /**
     * Update the specified About in storage.
     * PUT/PATCH /abouts/{id}
     *
     * @param int $id
     * @param UpdateAboutAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAboutAPIRequest $request)
    {
        $input = $request->all();

        /** @var About $about */
        $about = $this->aboutRepository->find($id);

        if (empty($about)) {
            return $this->sendError('About not found');
        }

        $about = $this->aboutRepository->update($input, $id);

        return $this->sendResponse(new AboutResource($about), 'About updated successfully');
    }

    /**
     * Remove the specified About from storage.
     * DELETE /abouts/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var About $about */
        $about = $this->aboutRepository->find($id);

        if (empty($about)) {
            return $this->sendError('About not found');
        }

        $about->delete();

        return $this->sendSuccess('About deleted successfully');
    }
}
