<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('show_user_questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('competitor_id');
            $table->unsignedBigInteger('competition_id');
            $table->text('text')->nullable(); // The displayed question text or ayahs
            $table->string('status')->default('shown'); // or whatever default status you prefer
            $table->timestamps();

            // Add foreign keys if desired, assuming the referenced tables exist
            // $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            // $table->foreign('competitor_id')->references('id')->on('competitors')->onDelete('cascade');
            // $table->foreign('competition_id')->references('id')->on('competitions')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('show_user_questions');
    }
};
