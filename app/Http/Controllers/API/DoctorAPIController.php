<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDoctorAPIRequest;
use App\Http\Requests\API\UpdateDoctorAPIRequest;
use App\Models\Doctor;
use App\Repositories\DoctorRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\DoctorResource;
use Response;

/**
 * Class DoctorController
 * @package App\Http\Controllers\API
 */

class DoctorAPIController extends AppBaseController
{
    /** @var  DoctorRepository */
    private $doctorRepository;

    public function __construct(DoctorRepository $doctorRepo)
    {
        $this->doctorRepository = $doctorRepo;
    }

    /**
     * Display a listing of the Doctor.
     * GET|HEAD /doctors
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $doctors = $this->doctorRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(DoctorResource::collection($doctors), 'Doctors retrieved successfully');
    }

    /**
     * Store a newly created Doctor in storage.
     * POST /doctors
     *
     * @param CreateDoctorAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateDoctorAPIRequest $request)
    {
        $input = $request->all();

        $doctor = $this->doctorRepository->create($input);

        return $this->sendResponse(new DoctorResource($doctor), 'Doctor saved successfully');
    }

    /**
     * Display the specified Doctor.
     * GET|HEAD /doctors/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Doctor $doctor */
        $doctor = $this->doctorRepository->find($id);

        if (empty($doctor)) {
            return $this->sendError('Doctor not found');
        }

        return $this->sendResponse(new DoctorResource($doctor), 'Doctor retrieved successfully');
    }

    /**
     * Update the specified Doctor in storage.
     * PUT/PATCH /doctors/{id}
     *
     * @param int $id
     * @param UpdateDoctorAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDoctorAPIRequest $request)
    {
        $input = $request->all();

        /** @var Doctor $doctor */
        $doctor = $this->doctorRepository->find($id);

        if (empty($doctor)) {
            return $this->sendError('Doctor not found');
        }

        $doctor = $this->doctorRepository->update($input, $id);

        return $this->sendResponse(new DoctorResource($doctor), 'Doctor updated successfully');
    }

    /**
     * Remove the specified Doctor from storage.
     * DELETE /doctors/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Doctor $doctor */
        $doctor = $this->doctorRepository->find($id);

        if (empty($doctor)) {
            return $this->sendError('Doctor not found');
        }

        $doctor->delete();

        return $this->sendSuccess('Doctor deleted successfully');
    }
}
