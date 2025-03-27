<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // Import DB facade

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('book_name');
            $table->timestamps();
        });

        DB::table('books')->insert([
            [
                'book_name' => 'Alif Lam Meem',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'book_name' => 'Sayaqool',
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'book_name' => 'Alif Lam',
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'book_name' => 'Meem',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
