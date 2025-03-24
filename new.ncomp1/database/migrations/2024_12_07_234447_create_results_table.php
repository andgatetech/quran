<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultsTable extends Migration
{
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id(); // Auto-increment ID
            $table->unsignedBigInteger('competitor_id');
            $table->unsignedBigInteger('competition_id');
            $table->unsignedBigInteger('judge_id');

            $table->unsignedBigInteger('point_category_id');
            $table->integer('total_points');
            $table->integer('gained_points');
            $table->string('status', 50)->default('pending'); // Default status
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('results');
    }
}
