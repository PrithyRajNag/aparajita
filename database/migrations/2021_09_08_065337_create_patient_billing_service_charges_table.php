<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientBillingServiceChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_billing_service_charges', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('count');
            $table->double('amount');
            $table->date('date')->nullable();
            $table->boolean('status')->default(true);

//            $table->boolean('is_latest')->default(true);
            $table->timestamps();

//            $table->foreignId('organization_id');
            $table->foreignId('patient_billing_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_billing_service_charges');
    }
}
