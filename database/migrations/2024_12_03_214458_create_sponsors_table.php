<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSponsorsTable extends Migration
{
    public function up()
    {
        Schema::create('sponsors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('competition_id');
            $table->string('logo')->nullable();
            $table->timestamps();

            // Foreign key constraint
            // $table->foreign('competition_id')->references('id')->on('competitions')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sponsors');
    }
}
