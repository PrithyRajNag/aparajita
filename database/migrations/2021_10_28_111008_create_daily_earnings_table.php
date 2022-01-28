<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyEarningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_earnings', function (Blueprint $table) {
            $table->id();
            $table->string('patient_billing_no');
            $table->date('date');
            $table->double('amount');

            $table->string('bank_name')->nullable();
            $table->string('cheque_no')->nullable();

            $table->boolean('status')->default(true);
            $table->softDeletes();
            $table->timestamps();
            $table->foreignId('organization_id');
            $table->foreignId('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daily_earnings');
    }
}
