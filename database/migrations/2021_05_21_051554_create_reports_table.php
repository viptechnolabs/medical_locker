<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id')->unsigned();
            $table->unsignedBigInteger('consultant_doctor')->unsigned();
            $table->date('consultant_date');
            $table->enum('routine_checkup', ['yes', 'no']);
            $table->enum('type', ['opd', 'indore']);
            $table->string('treatment_name', 100);
            $table->enum('insurance', ['yes', 'no']);
            $table->string('file_name', 100);
            $table->string('file_path', 100);
            $table->timestamps();
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->foreign('consultant_doctor')->references('id')->on('doctors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
