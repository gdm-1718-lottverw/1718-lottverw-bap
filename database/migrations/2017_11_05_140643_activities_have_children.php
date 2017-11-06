<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ActivitiesHaveChildren extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities_have_children', function (Blueprint $table) {
            $table->timestamp('registered_at'); // Children can register for an activity.
            $table->integer('children_id')->unsigned();
            $table->integer('activities_id')->unsigned();
        });

        Schema::table('activities_have_children', function (Blueprint $table) {
            $table->foreign('activities_id')->references('id')->on('activities');
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
        Schema::dropIfExists('activities_have_children');
    }
}
