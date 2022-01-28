<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBloodInputsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blood_inputs', function (Blueprint $table) {
            $table->id();

            $table->string('first_name');
            $table->string('last_name');
            $table->integer('age');
            $table->date('date');
            $table->longText('address');
            $table->string('phone_number');
            $table->string('gender');


            $table->string('slug');
            $table->boolean('status')->default(true);
            $table->boolean('is_regular_donor');
            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('organization_id');
            $table->foreignId('blood_group_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blood_inputs');
    }
}
