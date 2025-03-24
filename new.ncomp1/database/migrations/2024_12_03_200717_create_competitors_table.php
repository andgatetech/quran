<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetitorsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('competitors', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('id_card_number')->unique();
            $table->string('address');
            $table->string('island_city');
            $table->string('school_name')->nullable();
            $table->string('parent_name');
            $table->string('phone_number');
            $table->unsignedBigInteger('competition_id');
            $table->unsignedBigInteger('side_category_id');
            $table->unsignedBigInteger('read_category_id');
            $table->unsignedBigInteger('age_category_id');
            $table->unsignedInteger('number_of_questions');
            $table->string('status')->default('ready');
            $table->string('position')->nullable();
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competitors');
    }
}
