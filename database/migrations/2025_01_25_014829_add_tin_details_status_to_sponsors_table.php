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
        Schema::table('sponsors', function (Blueprint $table) {
            $table->string('Tin')->nullable();  // Add Tin field
            $table->text('Details')->nullable();  // Add Details field
            $table->enum('status', ['Enable', 'Disable'])->default('Enable');  // Add status field
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sponsors', function (Blueprint $table) {
            $table->dropColumn('Tin');
            $table->dropColumn('Details');
            $table->dropColumn('status');
        });
    }
};
