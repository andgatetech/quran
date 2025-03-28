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
        Schema::table('curriculum', function (Blueprint $table) {
            //
            $table->integer('book_number')->nullable();
            $table->integer('from_ayat_number')->nullable();
            $table->integer('to_ayat_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('curriculum', function (Blueprint $table) {
            $table->dropColumn(['book_number', 'from_ayat_number', 'to_ayat_number']);
        });
    }
};
