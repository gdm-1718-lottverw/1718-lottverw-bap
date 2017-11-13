<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auth_keys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('key');
            $table->timestamp('first_login')->nullable();
            $table->date('last_login')->nullable();
            $table->date('expire_date');
            $table->unsignedInteger('role_id');
            $table->timestamps();
        });

        Schema::table('auth_keys', function (Blueprint $table) {
            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auth_keys');
    }
}
