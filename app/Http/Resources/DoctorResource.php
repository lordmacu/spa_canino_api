<?php

namespace App\Http\Resources;
use Storage;

use Illuminate\Http\Resources\Json\JsonResource;

class DoctorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array            'image' => env('APP_URL').'/storage/'.$this->image,

     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'image' =>  Storage::url($this->image),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
