<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('deleted_at')->nullable();
            $table->time('action_time');
            $table->unsignedInteger('action_id');
            $table->unsignedInteger('planned_attendance_id');
            $table->unsignedInteger('organization_id');
            $table->timestamps();
        });

        Schema::table('logs', function (Blueprint $table) {
            $table->foreign('action_id')->references('id')->on('actions');
            $table->foreign('organization_id')->references('id')->on('organizations');
            $table->foreign('planned_attendance_id')->references('id')->on('planned_attendances');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
}
