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
            $table->string('patient_id', 10)->unique();
            $table->string('profile_photo');
            $table->string('name', 100);
            $table->string('mobile_no', 13);
            $table->string('email', 25)->unique();;
            $table->longText('address');
            $table->string('city', 22);
            $table->string('state', 22);
            $table->string('pin_code', 10);
            $table->string('aadhar_no', 13);
            $table->dateTime('dob');
            $table->enum('gender', ['male', 'female', 'transgender', 'other']);
            $table->string('weight', 10);
            $table->string('height', 10);
            $table->integer('consultant_doctor')->unsigned();
            $table->foreign('consultant_doctor')->references('id')->on('doctors');
            $table->string('treatment_type', 100);
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
        Schema::dropIfExists('patients');
    }
}
