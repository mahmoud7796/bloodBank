<?php

namespace App\Http\Resources;

use App\Models\City;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'name'=> $this->name,
            'email'=> $this->email,
            'phone_number'=> $this->phone_number,
            'date_of_birth'=> $this->date_of_birth,
            'profile_picture'=> $this->profile_picture,
            'blood_type'=> $this->blood_type,
            'height'=> $this->height,
            'weight'=> $this->weight,
            "city"=> new CityResource($this->whenLoaded('city')),
            "governorate"=> new GovernorateResource($this->whenLoaded('governorate')),
        ];
    }
}
