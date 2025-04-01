<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('poetry_competitors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->string('full_name');
            $table->string('full_name_dhivehi')->nullable();
            $table->string('id_card_number')->unique('competitors_id_card_number_unique');
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
        Schema::dropIfExists('poetry_competitors');
    }
};
