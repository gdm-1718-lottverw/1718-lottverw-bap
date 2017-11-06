<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlannedAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planned_attendances', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->time('from');
            $table->time('until');
            $table->string('type');
            $table->timestamp('registered_on');
           // $table->string('picked_up_by'); /// GUARDIAN ID!!!
            $table->time('pickup_time');
            $table->text('other_details');
            $table->boolean('no_show');
            $table->boolean('go_home_alone');
            $table->unsignedInteger('organization_id');
            $table->unsignedInteger('children_id');
            $table->timestamps();
        });

        Schema::table('planned_attendances', function (Blueprint $table) {
            $table->foreign('organization_id')->references('id')->on('organizations');
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
        Schema::dropIfExists('planned_attendances');
    }
}
