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
            $table->string('type');
            $table->boolean('in');
            $table->boolean('out');
            $table->dateTime('time_in')->nullable(); // official registered in
            $table->dateTime('time_out')->nullable(); // official registered out
            $table->dateTime('registered_on'); // reserved
            $table->unsignedInteger('has_been_pickup_by')->nullable(); 
            $table->time('pickup_time'); // billable time can be modified
            $table->boolean('no_show');
            $table->boolean('go_home_alone');
            $table->unsignedInteger('organization_id');
            $table->unsignedInteger('child_id');
            $table->timestamps();
        });

        Schema::table('planned_attendances', function (Blueprint $table) {
            $table->foreign('organization_id')->references('id')->on('organizations');
            $table->foreign('child_id')->references('id')->on('children');
            $table->foreign('has_been_pickup_by')->references('id')->on('guardians');
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
