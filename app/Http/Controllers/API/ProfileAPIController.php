<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProfileAPIRequest;
use App\Http\Requests\API\UpdateProfileAPIRequest;
use App\Models\Profile;
use App\Models\User;
use App\Repositories\ProfileRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\ProfileResource;
use Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Log;
/**
 * Class ProfileController
 * @package App\Http\Controllers\API
 */
class ProfileAPIController extends AppBaseController {

    /** @var  ProfileRepository */
    private $profileRepository;

    public function __construct(ProfileRepository $profileRepo) {
        $this->profileRepository = $profileRepo;
    }

    public function register(Request $request) {



        $user = new User();
        $getUserById = $user->getUserById($request->get("email"));
        if ($getUserById) {

            if (Hash::check($request->password, $getUserById->password)) {
                return array("status" => 200, "data" => "Usuario logueado", "user" => $getUserById);
            } else {
                return array("status" => 500, "data" => "El usuario no existe o la contraseña esta incorrecta");
            }
        }
        $user->name = $request->get("name");
        $user->email = $request->get("email");
        $user->password = Hash::make($request->get("password"));
        $user->save();

        return array("status" => 200, "data" => "Usuario creado correctamente", "user" => $user);
    }
    
    public function login(Request $request) {

        $user = new User();
        $getUserById = $user->getUserById($request->get("email"));
        
      
        
        if ($getUserById) {

            if (Hash::check($request->password, $getUserById->password)) {
                return array("status" => 200, "data" => "Usuario logueado", "user" => $getUserById);
            } else {
                return array("status" => 500, "data" => "El usuario no existe o la contraseña esta incorrecta");
            }
        }
     }
    

    /**
     * Display a listing of the Profile.
     * GET|HEAD /profiles
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request) {
        $profiles = $this->profileRepository->all(
                $request->except(['skip', 'limit']),
                $request->get('skip'),
                $request->get('limit')
        );

        return $this->sendResponse(ProfileResource::collection($profiles), 'Profiles retrieved successfully');
    }

    /**
     * Store a newly created Profile in storage.
     * POST /profiles
     *
     * @param CreateProfileAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateProfileAPIRequest $request) {
        $input = $request->all();

        $profile = $this->profileRepository->create($input);

        return $this->sendResponse(new ProfileResource($profile), 'Profile saved successfully');
    }

    /**
     * Display the specified Profile.
     * GET|HEAD /profiles/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id) {
        /** @var Profile $profile */
        $profile = $this->profileRepository->find($id);

        if (empty($profile)) {
            return $this->sendError('Profile not found');
        }

        return $this->sendResponse(new ProfileResource($profile), 'Profile retrieved successfully');
    }

    /**
     * Update the specified Profile in storage.
     * PUT/PATCH /profiles/{id}
     *
     * @param int $id
     * @param UpdateProfileAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProfileAPIRequest $request) {
        $input = $request->all();

        /** @var Profile $profile */
        $profile = $this->profileRepository->find($id);

        if (empty($profile)) {
            return $this->sendError('Profile not found');
        }

        $profile = $this->profileRepository->update($input, $id);

        return $this->sendResponse(new ProfileResource($profile), 'Profile updated successfully');
    }

    /**
     * Remove the specified Profile from storage.
     * DELETE /profiles/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id) {
        /** @var Profile $profile */
        $profile = $this->profileRepository->find($id);

        if (empty($profile)) {
            return $this->sendError('Profile not found');
        }

        $profile->delete();

        return $this->sendSuccess('Profile deleted successfully');
    }

}
