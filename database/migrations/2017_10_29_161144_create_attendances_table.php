<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->time('from');
            $table->time('until');
            $table->string('type'); // fullday, half a day, morning, afternoon, midday...; 
            $table->datetime('registered_on');
            $table->datetime('canceled_on')->nullable();
            $table->string('guardian'); // person planned to pick up the child;
            $table->string('picked_up_by'); // The person who actually picked up the child;
            $table->time('picked_up_at');
            $table->text('other_details')->nullable();
            $table->integer('registered_by'); // parent relationship;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendances');
    }
}
