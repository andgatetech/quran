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
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary(); // Primary key for session ID
            $table->foreignId('user_id')->nullable()->index(); // Nullable foreign key for user ID
            $table->string('ip_address', 45)->nullable(); // IP address (IPv4 or IPv6)
            $table->text('user_agent')->nullable(); // Browser/user agent details
            $table->longText('payload'); // Session payload data
            $table->integer('last_activity')->index(); // Timestamp of the last activity
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};

