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
        Schema::create('quiz_question_answers', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('question_id')->index('quiz_question_answers_question_id_foreign');
<<<<<<< HEAD
            $table->string('answer_name');
            $table->string('correct_answer_status')->default('No');
=======
            $table->text('answer_name');
            $table->text('correct_answer_status')->default('No');
>>>>>>> alauddin_poetry_announce
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_question_answers');
    }
};
