<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBedListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bed_lists', function (Blueprint $table) {
            $table->id();
            $table->string('bed_number');
            $table->string('floor');
            $table->double('price');
            $table->longText('description')->nullable();
            $table->boolean('is_available');

            $table->string('slug');
            $table->boolean('status');
            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('organization_id');
            $table->foreignId('bed_type_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bed_lists');
    }
}
