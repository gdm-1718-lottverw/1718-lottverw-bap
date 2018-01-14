<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChildParents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('child_parents', function (Blueprint $table) {
            $table->unsignedInteger('child_id');
            $table->unsignedInteger('parent_id');
        });

        Schema::table('child_parents', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('parents')->onDelete('cascade');
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
        Schema::dropIfExists('children_have_parents');
    }
}
