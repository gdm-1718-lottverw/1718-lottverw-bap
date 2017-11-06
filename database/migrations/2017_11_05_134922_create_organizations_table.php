<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->unsignedInteger('parents_id')->nullable();
            $table->unsignedInteger('auth_key_id');
            $table->timestamps();
        });

        Schema::table('organizations', function (Blueprint $table) {
            $table->foreign('parents_id')->references('id')->on('organizations');
            $table->foreign('auth_key_id')->references('id')->on('auth_keys');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organizations');
    }
}
