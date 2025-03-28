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
        Schema::create('poetry_competitions', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->string('main_name');
            $table->string('sub_name');
            $table->timestamps();
            $table->string('status')->default('Pending');
            $table->string('encrypted_id')->nullable();
            $table->string('curriculum')->nullable();
            $table->string('rules')->nullable();
            $table->date('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->integer('no_of_days')->nullable();
            $table->longText('url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poetry_competitions');
    }
};
