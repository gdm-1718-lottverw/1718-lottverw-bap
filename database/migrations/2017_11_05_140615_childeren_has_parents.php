<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChilderenHasParents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('children_have_parents', function (Blueprint $table) {
            $table->unsignedInteger('children_id');
            $table->unsignedInteger('parents_id');
        });

        Schema::table('children_have_parents', function (Blueprint $table) {
            $table->foreign('parents_id')->references('id')->on('parents');
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
        Schema::dropIfExists('children_have_parents');
    }
}
