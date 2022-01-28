<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBloodOutputsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blood_outputs', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->longText('address');
            $table->string('phone_number');
            $table->date('date');
//            $table->date('amount');

            $table->boolean('status')->default(true);
            $table->boolean('is_patient');
            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('organization_id');
            $table->foreignId('blood_group_id');
            $table->foreignId('blood_collection_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blood_outputs');
    }
}
