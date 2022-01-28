<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientTestItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_test_items', function (Blueprint $table) {
            $table->id();

            $table->double('price');

//            $table->date('input_date');
//            $table->time('input_time');
            $table->date('delivery_date')->nullable();
            $table->time('delivery_time')->nullable();
            $table->string('room')->nullable();
            $table->string('floor')->nullable();

            $table->boolean('is_latest')->default(true);

            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('patient_test_id');
            $table->foreignId('test_item_id');
            $table->foreignId('lab_staff_id')->nullable();
            $table->foreignId('certify_doctor_id')->nullable();   //  report certify doctor id
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_test_items');
    }
}
