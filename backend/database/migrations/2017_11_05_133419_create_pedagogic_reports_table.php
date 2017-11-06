<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedagogicReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedagogic_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->text('description');
            $table->string('medication');
            $table->string('prescription'); // path to source? 
            $table->unsignedInteger('children_id'); // path to source? 
            $table->timestamps();
        });

        Schema::table('pedagogic_reports', function (Blueprint $table) {
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
        Schema::dropIfExists('pedagogic_reports');
    }
}
