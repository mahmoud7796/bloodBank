<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RequestResource extends JsonResource
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
            'title'=> $this->title,
            'description'=> $this->description,
            'phone_number'=> $this->phone_number,
            'no_of_bags'=> $this->no_of_bags,
            'request_expiredDate'=> $this->request_expiredDate,
            'blood_type'=> $this->blood_type,
            "governorate"=> new GovernorateResource($this->whenLoaded('governorate')),
            "city"=> new CityResource($this->whenLoaded('city')),
            "user"=> new UserResource($this->whenLoaded('user')),
        ];
    }
}
