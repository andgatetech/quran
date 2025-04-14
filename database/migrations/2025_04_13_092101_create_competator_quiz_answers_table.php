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
        Schema::create('competator_quiz_answers', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('question_id')->index('competator_quiz_answer_question_id_foreign');
            $table->integer('answer_id')->index('competator_quiz_answer_answer_id_foreign');
            $table->string('answer_status', 30)->default('Pending');
            $table->timestamps();
            $table->string('id_card')->nullable();
            $table->string('phone_number', 30)->nullable();
            $table->string('participant_name')->nullable();
            $table->integer('participant_id')->nullable();
            $table->text('answer')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competator_quiz_answers');
    }
};
