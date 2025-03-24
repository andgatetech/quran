<?php

use App\Models\Question;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('competition_id');
            $table->string('question_name');
            $table->unsignedBigInteger('age_category_id');
            $table->unsignedBigInteger('side_category_id');
            $table->unsignedBigInteger('read_category_id');
            $table->json('book_number');
            $table->unsignedBigInteger('surah');
            $table->unsignedBigInteger('from_ayat_number');
            $table->unsignedBigInteger('to_ayat_number');
            $table->unsignedTinyInteger('hardness');
            $table->timestamps();     });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
}
