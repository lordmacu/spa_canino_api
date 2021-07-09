<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePetsAPIRequest;
use App\Http\Requests\API\UpdatePetsAPIRequest;
use App\Models\Pets;
use App\Models\Raza;
use App\Models\Type;
use App\Repositories\PetsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\PetsResource;
use Response;
use Storage;
use Log;
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

    public function getMyPets(Request $request){
        $pet= new Pets();
        $getPetsByUser=$pet->getPetsByUser($request->get("user_id"));
        
        foreach ($getPetsByUser as $value) {
            $value->image=Storage::url($value->image);
 
        }
        
        $raza= Raza::pluck("name");
        $types=  Type::pluck("name");
        return array("data"=>$getPetsByUser,"razas"=>$raza,"types"=>$types);
    }
    
    public function deletePet(Request $request){
        $pet= Pets::find($request->get("petId"));
        $pet->delete();
    }
    
    public function postPet(Request $request){
        
        $birthday= date("Y-m-d H:i:s", strtotime($request->get("petBithdayValue"))); // gives 201101

        Log::error($request->all());
         
        if($request->get("petId")==0){
                    $pet= new Pets();
        }else{
            $pet= Pets::find($request->get("petId"));
        }
        
        $pet->user_id=$request->get("user_id");
        $pet->name=$request->get("name");
       // $pet->image=$request->get("image");
        
        
        $raza= new Raza();
        $getRazaByName=$raza->getRazaByName($request->get("raza"));
        $pet->raza=$getRazaByName->id;
        
        $raza= new Type();
        $getTypeByname=$raza->getTypeByname($request->get("type"));
        $pet->type=$getTypeByname->id;
        
        $pet->color=$request->get("color");
        $pet->birthday=$birthday;
        $pet->status=1;
        $pet->save();
        
        
        
    }
    
    public function setImage(Request $request){
       // Log::error($request->all());
        
            $realImage = base64_decode($request->get("image"));
            $imageName=time()."_".$request->get("name"); 
            $path="/pets/".$imageName;
            file_put_contents(storage_path('app')."/pets/".$imageName, $realImage);
            
            $pet= Pets::find($request->get("id"));
            $pet->image=$path;
            $pet->save();
            
            

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
