<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('hosts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('competition_id');
            $table->string('host_id');
            $table->string('password');
            $table->string('status')->default('active');

            $table->timestamps(); 
        });


    }

    public function down()
    {


        Schema::dropIfExists('hosts');
    }
};
