<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClosedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('closed', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->string('reason')->nullable();
            $table->unsignedInteger('organization_id');
            $table->timestamps();
        });

        Schema::table('closed', function (Blueprint $table) {
            $table->foreign('organization_id')->references('id')->on('organizations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('closed');
    }
}
