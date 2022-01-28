<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();

            $table->string('uuid')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('age');
            $table->string('phone_number');
            $table->string('gender');
            $table->string('religion')->nullable();
            $table->longText('address')->nullable();
            $table->date('dob')->nullable();
            $table->string('image')->nullable();


            $table->string('slug');
            $table->boolean('status')->default(true);
            $table->boolean('is_alive')->default(true);
            $table->boolean('is_bed_assigned')->default(false);
            $table->boolean('is_paid')->default(false);
            $table->boolean('is_appointment')->default(false);

            $table->boolean('is_resolved')->default(false);

            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('organization_id');
            $table->foreignId('blood_group_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
