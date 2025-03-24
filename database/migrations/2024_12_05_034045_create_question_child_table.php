<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionChildTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_child', function (Blueprint $table) {
            $table->id();  // Auto-incrementing primary key
            $table->integer('question_id');  // Assuming the question table exists
            $table->integer('competitor_id');  // Assuming competitor table exists
            $table->integer('competition_id');  // Assuming competition table exists
            $table->enum('status', ['active', 'inactive'])->default('active');  // Enum for status with default value
            $table->timestamps();  // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_child');
    }
}