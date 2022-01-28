<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBirthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('births', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('mother_name');
            $table->string('father_name');
            $table->string('phone_number');
            $table->decimal('weight');
            $table->string('gender');
            $table->date('date');
            $table->time('time');
            $table->longText('address');
            $table->longText('note')->nullable();

            $table->string('slug');
            $table->boolean('status')->default(true);
            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('organization_id');
//            $table->foreignId('patient_id'); // mother in from patient_id
            $table->foreignId('doctor_id');
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
        Schema::dropIfExists('births');
    }
}
