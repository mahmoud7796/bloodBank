<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Governorate;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Governorate::truncate();
        City::truncate();

        $governorateJson = \File::get(public_path('governorates.json'));
        $governorate = json_decode($governorateJson);


        $citiesJson = \File::get(public_path('cities.json'));
        $cities = json_decode($citiesJson);

        foreach ($governorate->governorate as $key => $value){
            Governorate::create([
                "id" => $value->id,
                "governorate_name_ar" => $value->governorate_name_ar,
                "governorate_name_en" => $value->governorate_name_en,
            ]);
        }


        foreach ($cities->cities as $key => $value){
            City::create([
                "id" => $value->id,
                "governorate_id" => $value->governorate_id,
                "city_name_ar" => $value->city_name_ar,
                "city_name_en" => $value->city_name_en,
            ]);
        }
    }
}
