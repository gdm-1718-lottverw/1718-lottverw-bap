<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('amount_paid');
            $table->string('amount_outstanding');
            $table->text('other_details');
            $table->timestamp('date_of_payment');
            $table->unsignedInteger('bill_id');  
            $table->unsignedInteger('fine_id');  
            $table->timestamps();
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->foreign('bill_id')->references('id')->on('bills');
            $table->foreign('fine_id')->references('id')->on('fine');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
