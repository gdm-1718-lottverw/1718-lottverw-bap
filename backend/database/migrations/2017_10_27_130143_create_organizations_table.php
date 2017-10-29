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
            $table->unsignedInteger('main_organization_id')->nullable();
            $table->unsignedInteger('auth_key_id')->nullable();
            $table->unsignedInteger('parent_id')->nullable();
            $table->timestamps();
            $table->foreign('main_organization_id')
            ->references('id')->on('organizations')->onDelete('cascade');
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
