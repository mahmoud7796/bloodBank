<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
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
            'city_name'=> app()->getLocale() == 'en' ? $this->city_name_en : $this->city_name_ar,
            "city"=> CityResource::collection($this->whenLoaded('city_id')),
        ];
    }
}
