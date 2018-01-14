<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FkChildTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
    
        Schema::table('children', function (Blueprint $table) {
            $table->foreign('organization_id')->references('id')->on('organizations');
        });
    }

   
}
