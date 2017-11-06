<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fine', function (Blueprint $table) {
            $table->increments('id');
            $table->text('description');
            $table->timestamp('date_issued');
            $table->text('other_details')->nullable();
            $table->boolean('paid');
            $table->date('date_paid')->nullable();
            $table->string('amount');
            $table->unsignedInteger('parents_id');  
            $table->timestamps();
        });

        Schema::table('fine', function (Blueprint $table) {
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
        Schema::dropIfExists('fines');
    }
}
