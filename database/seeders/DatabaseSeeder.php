<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\City;
use App\Models\Governorate;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        Admin::create([
            'name'=>'Youssef Anany',
            'email'=>'admin@admin.com',
            'password'=>bcrypt('12345678'),
            'phone_number'=>'01010101010',
        ]);


        $this->call([
            CitySeeder::class,
        ]);
    }
}
