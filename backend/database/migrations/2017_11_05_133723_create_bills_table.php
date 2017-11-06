<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date_issued');
            $table->timestamp('date_of_payment')->nullable();
            $table->string('amount_due')->nullable();
            $table->string('amount_paid')->nullable();
            $table->text('other_details')->nullable();
            $table->unsignedInteger('parents_id');  
            $table->timestamps();
        });

        Schema::table('bills', function (Blueprint $table) {
            $table->foreign('parents_id')->references('id')->on('parents');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bills');
    }
}
