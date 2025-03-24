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
        Schema::create('generate_certificate', function (Blueprint $table) {
            $table->id();
            $table->string('competition_name')->nullable();
            $table->string('sponsor_name')->nullable();
            $table->string('id_card_number');
            $table->string('certificate_type')->nullable();
            $table->text('body_content');
            $table->string('status')->nullable();
            $table->string('pdf')->nullable(); // Store the PDF file path
            $table->unsignedBigInteger('competitor_id')->nullable();
            $table->timestamps();
    
            // Foreign key constraint
            $table->foreign('competitor_id')->references('id')->on('competitors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('generate_certificate');
    }
};
