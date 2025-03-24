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
        Schema::table('competitions', function (Blueprint $table) {
            $table->string('curriculum')->nullable()->after('encrypted_id'); // Add curriculum field
            $table->string('rules')->nullable()->after('curriculum'); // Add rules field
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('competitions', function (Blueprint $table) {
            $table->dropColumn('curriculum'); // Drop curriculum field
            $table->dropColumn('rules'); // Drop rules field
        });
    }
};
