<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('patient_id', 22)->unique()->default('VIP/PE/2021/1');
            $table->string('name', 100);
            $table->string('mobile_no', 13);
            $table->string('email', 50)->nullable();
            $table->longText('address');
            $table->unsignedBigInteger('city_id')->unsigned();
            $table->unsignedBigInteger('state_id')->unsigned();
            $table->string('pin_code', 10);
            $table->string('aadhar_no', 13)->unique()->nullable();
            $table->date('dob');
            $table->enum('gender', ['male', 'female', 'transgender', 'other']);
            $table->string('profile_photo')->nullable();
            $table->string('document_photo')->nullable();
//            $table->string('weight', 10);
//            $table->string('height', 10);
//            $table->unsignedBigInteger('consultant_doctor')->unsigned();
//            $table->string('treatment_type', 100);
            $table->timestamps();

            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('state_id')->references('id')->on('states');
//            $table->foreign('consultant_doctor')->references('id')->on('doctors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
