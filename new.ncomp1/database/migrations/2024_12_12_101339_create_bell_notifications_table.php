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
        Schema::create('bell_notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('competitor_id');
            $table->unsignedBigInteger('competition_id');
            $table->unsignedBigInteger('judge_id');
            $table->timestamp('activated_at');
            $table->boolean('is_active')->default(false);
            $table->timestamps();

            // Foreign keys
            $table->foreign('competitor_id')->references('id')->on('competitors')->onDelete('cascade');
            $table->foreign('competition_id')->references('id')->on('competitions')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bell_notifications');
    }
};
