<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FkAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::table('addresses', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('parents');
            $table->foreign('organization_id')->references('id')->on('organizations');
        });
        
    }

   
}
