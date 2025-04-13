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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->enum('report_type',['Participants', 'Sponsors', 'Winners']);
            $table->string('competition_id')->nullable();
            $table->string('age_category_id')->nullable();
            $table->string('side_category_id')->nullable();
            $table->string('read_category_id')->nullable();
            $table->string('anouncement_date')->nullable();
            $table->string('date_of_close')->nullable();
            $table->string('status')->nullable();
            $table->string('path')->nullable();
            $table->string('date_of_report')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
