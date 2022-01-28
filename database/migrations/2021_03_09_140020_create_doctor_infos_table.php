<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_infos', function (Blueprint $table) {
            $table->id();
            $table->double('fees')->default(0);
            $table->string('degree');
            $table->string('designation');
            $table->string('doctor_category');
            $table->string('doctor_type');
            $table->string('speciality')->nullable();
            $table->timestamps();

            $table->foreignId('user_id');
            $table->foreignId('department_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctor_infos');
    }
}
