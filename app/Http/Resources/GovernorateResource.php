<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GovernorateResource extends JsonResource
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
            'id' =>$this->id,
            'governorate_name'=> app()->getLocale() == 'en' ? $this->governorate_name_en : $this->governorate_name_ar,
            "governorate"=> GovernorateResource::collection($this->whenLoaded('governorate_id')),
        ];
    }
}
