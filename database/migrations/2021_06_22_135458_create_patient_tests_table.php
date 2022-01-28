<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_tests', function (Blueprint $table) {
            $table->id();

            $table->string('uuid')->unique();
            $table->bigInteger('patient_test_no');
//            $table->double('total_amount');
//            $table->double('paid_amount')->default(0);
//            $table->boolean('full_paid')->default(false);

            $table->string('slug');
            $table->boolean('status')->default(true);

            $table->boolean('is_latest')->default(true);

            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('organization_id');
            $table->foreignId('patient_id');
            $table->foreignId('referred_doctor_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_tests');
    }
}
