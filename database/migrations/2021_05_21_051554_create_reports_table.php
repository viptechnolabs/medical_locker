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
            $table->unsignedBigInteger('doc_id')->unsigned();
            $table->dateTime('consultant_date');
            $table->string('treatment_type', 100);
            $table->string('file_path', 100);
            $table->timestamps();
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->foreign('doc_id')->references('id')->on('doctors');
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
