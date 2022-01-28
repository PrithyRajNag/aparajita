<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_billings', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('patient_billing_no');
            $table->double('total_bed_price')->nullable();
            $table->double('total_test_price')->nullable();
            $table->double('total_service_price')->nullable();
            $table->double('sub_total')->default(0);
            $table->double('discount')->default(0);
            $table->decimal('gross_total')->default(0);
            $table->double('total_paid')->default(0);

            $table->boolean('full_paid')->default(false);
            $table->string('slug');
            $table->boolean('status')->default(true);
            $table->boolean('is_latest')->default(true);

            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('organization_id');
            $table->foreignId('patient_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_billings');
    }
}
