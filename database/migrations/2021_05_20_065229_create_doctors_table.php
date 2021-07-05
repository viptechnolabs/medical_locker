<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('doctor_id', 22)->unique()->default('VIP/DR/2021/0001 ');
            $table->string('profile_photo');
            $table->string('name', 100);
//            $table->string('degree', 100);
            $table->string('specialist', 100);
            $table->string('mobile_no', 13);
            $table->string('email', 50)->unique();;
            $table->longText('address');
            $table->unsignedBigInteger('city_id')->unsigned();
            $table->unsignedBigInteger('state_id')->unsigned();
//            $table->unsignedBigInteger('state_id');
            $table->string('pin_code', 10);
            $table->string('aadhar_no', 13)->unique();
            $table->string('document_photo');
            $table->enum('gender', ['male', 'female', 'transgender', 'other']);
            $table->date('dob');
            $table->enum('status', ['inactive', 'active'])->default('active');
            $table->string('token')->unique()->nullable();
            $table->string('verification_code')->unique()->nullable();
            $table->string('password', 100);
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('state_id')->references('id')->on('states');
//            $table->foreign('state_id')->references('id')->on('states');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctors');
    }
}
