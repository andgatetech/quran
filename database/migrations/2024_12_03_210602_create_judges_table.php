<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJudgesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('judges', function (Blueprint $table) {
            $table->id();
            $table->json('point_category_id');  // Store multiple point category IDs as JSON
            $table->string('full_name');
            $table->string('id_card_number')->unique();
            $table->string('address');
            $table->string('island_city');
            $table->string('work_office');
            $table->string('phone_number');
            $table->unsignedBigInteger('competition_id');
            $table->enum('bell_option', ['Enable', 'Disable']);
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });


        // Pivot table for judges and point_categories
        Schema::create('judge_point_category', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('judge_id');
            $table->unsignedBigInteger('point_category_id');
            $table->timestamps();

            // Foreign Key Constraints
            // $table->foreign('judge_id')->references('id')->on('judges')->onDelete('cascade');
            // $table->foreign('point_category_id')->references('id')->on('point_categories')->onDelete('cascade');

            // $table->unique(['judge_id', 'point_category_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('judge_point_category');
        Schema::dropIfExists('judges');
    }
}
