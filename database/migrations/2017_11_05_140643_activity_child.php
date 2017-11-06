<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ActivityChild extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_child', function (Blueprint $table) {
            $table->timestamp('registered_at'); // Children can register for an activity.
            $table->integer('child_id')->unsigned();
            $table->integer('activity_id')->unsigned();
        });

        Schema::table('activity_child', function (Blueprint $table) {
            $table->foreign('activity_id')->references('id')->on('activities')->onDelete('cascade');
            $table->foreign('child_id')->references('id')->on('children')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activity_child');
    }
}
