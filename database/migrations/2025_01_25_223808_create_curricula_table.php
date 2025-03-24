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
        Schema::create('curriculum', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID column
            $table->string('title'); // For the 'title' field
            $table->integer('number_of_questions')->nullable(); // For the 'number_of_questions' field
            $table->integer('total_ayah')->nullable(); // For the 'total_ayah' field
            $table->unsignedBigInteger('competition_id')->nullable(); // Foreign key to 'competitions' table
            $table->unsignedBigInteger('side_category_id')->nullable(); // Foreign key to 'side_categories' table
            $table->unsignedBigInteger('read_category_id')->nullable(); // Foreign key to 'read_categories' table
            $table->unsignedBigInteger('age_category_id')->nullable(); // Foreign key to 'age_categories' table
            $table->text('remarks')->nullable(); // For the 'remarks' field
            $table->timestamps(); // Created at and updated at timestamps
    
            // Foreign key constraints (ensure these tables exist)
            $table->foreign('competition_id')->references('id')->on('competitions')->onDelete('set null');
            $table->foreign('side_category_id')->references('id')->on('side_categories')->onDelete('set null');
            $table->foreign('read_category_id')->references('id')->on('read_categories')->onDelete('set null');
            $table->foreign('age_category_id')->references('id')->on('age_categories')->onDelete('set null');

            $table->unsignedBigInteger('user_id')->nullable(); // Add user_id column (nullable in case it's not required initially)
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade'); // Optional: Foreign key constraint for the user_id
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('curriculum');
    }
    
};
