<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GovernorateResource;
use App\Http\Traits\ApiTrait;
use App\Models\Governorate;

class LocationsController extends Controller
{
    use ApiTrait;

    public function allGovernorates()
    {
        return $this->returnData('governorates',GovernorateResource::collection(Governorate::all()));
    }

    public function citiesByGovernorateId($id){

        return \App\Http\Resources\CityResource::collection(Governorate::findOrFail($id)->cities);
    }
}
