<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllergiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allergies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('gravity');
            $table->string('type');
            $table->text('description');
            $table->string('medication')->nullable();
            $table->string('prescription')->nullable(); // path to source? 
            $table->unsignedInteger('children_id'); // path to source? 
            $table->timestamps();
        });

        Schema::table('allergies', function (Blueprint $table) {
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
        Schema::dropIfExists('allergies');
    }
}
