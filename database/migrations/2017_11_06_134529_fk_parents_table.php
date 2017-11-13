<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FkParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
    
        Schema::table('parents', function (Blueprint $table) {
            $table->foreign('auth_key_id')->references('id')->on('auth_keys');
            $table->foreign('default_pickup_hours_id')->references('id')->on('default_pickup_hours');
        });
    }

   
}
