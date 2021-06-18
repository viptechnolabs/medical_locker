<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mobile_no', 13);
            $table->string('email');
            $table->longText('address');
            $table->string('city', 22);
            $table->string('state', 22);
            $table->string('pin_code', 10);
            $table->string('aadhar_no', 13);
            $table->enum('gender', ['male', 'female', 'transgender', 'other']);
            $table->date('dob');
            $table->enum('status', ['inactive', 'active'])->default('active');
            $table->string('token')->unique()->nullable();
            $table->string('verification_code')->unique()->nullable();
            $table->string('profile_photo');
            $table->string('document_photo');
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
}
