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
        Schema::table('curriculum_books', function (Blueprint $table) {
            $table->unsignedBigInteger('book_id')->nullable()->after('cu_id'); // Add after 'book_number' column
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade'); // Define foreign key
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('curriculum_books', function (Blueprint $table) {
            //$table->dropColumn('book_id'); // Rollback by removing the column
        });
    }
};
