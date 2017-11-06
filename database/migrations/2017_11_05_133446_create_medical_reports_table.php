<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicalReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_attention', function (Blueprint $table) {
            $table->increments('id');
            $table->text('description');
            $table->string('medication');
            $table->string('prescription'); // path to source?
            $table->unsignedInteger('children_id'); // path to source? 
            $table->timestamps();
        });

        Schema::table('medical_attention', function (Blueprint $table) {
            $table->foreign('children_id')->references('id')->on('children');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical_attention');
    }
}
