<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRankingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rankings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('competitor_id');
            $table->unsignedBigInteger('competition_id');
            $table->integer('rank');
            $table->string('status')->default('active'); // Can be 'active', 'finalized', etc.
            $table->timestamps();

            $table->foreign('competitor_id')->references('id')->on('competitors')->onDelete('cascade');
            $table->foreign('competition_id')->references('id')->on('competitions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rankings');
    }
}
