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
        Schema::create('quiz_questions', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->integer('user_id')->nullable();
            $table->bigInteger('competition_id')->index('quiz_questions_competition_id_foreign');
            $table->text('question_name');
            $table->string('option_name', 30);
            $table->string('answer_status', 30)->nullable();
            $table->timestamp('dead_line')->useCurrentOnUpdate()->useCurrent();
            $table->text('url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_questions');
    }
};
