<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientAdmitAndDischargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_admit_and_discharges', function (Blueprint $table) {
            $table->id();

            $table->foreignId('patient_id');

            $table->string('attendee_name')->nullable();
            $table->string('attendee_relation_with_patient')->nullable();

            $table->date('admit_date')->nullable();
            $table->time('admit_time')->nullable();
            $table->date('discharge_date')->nullable();
            $table->time('discharge_time')->nullable();
            $table->boolean('is_latest')->default(true);


            $table->longText('notes')->nullable();
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
        Schema::dropIfExists('patient_admit_and_discharges');
    }
}
