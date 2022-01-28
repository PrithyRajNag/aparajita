<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorAssignToPatientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_assign_to_patient', function (Blueprint $table) {
            $table->id();

            $table->foreignId('patient_id');
            $table->foreignId('doctor_id')->nullable();
            $table->date('assign_date')->nullable();
            $table->date('release_date')->nullable();
            $table->string('doctor_type_for_patient')->nullable();

            $table->boolean('is_latest')->default(true);
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
        Schema::dropIfExists('doctor_assign_to_patient');
    }
}
