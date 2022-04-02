<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description');
            $table->enum('blood_type',['A+','A-','B+','B-','O+','O-','AB+','AB-']);
            $table->integer('no_of_bags');
            $table->string('phone_number');
            $table->date('request_expiredDate');

            $table->foreignId('user_id');
            $table->foreignId('governorate_id');
            $table->foreignId('city_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests');
    }
}
