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
        Schema::create('poetry_competition_applications', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->default(0);
            $table->integer('competition_id');
            $table->string('name');
            $table->string('name_dhivehi');
            $table->string('id_card');
            $table->string('permanent_address');
            $table->string('current_address');
            $table->string('city');
            $table->date('dob');
            $table->integer('age');
            $table->string('organization');
            $table->string('parent_name')->nullable();
            $table->string('number');
            $table->integer('age_category');
            $table->integer('side_category');
            $table->integer('read_category');
            $table->string('photo')->nullable();
            $table->string('id_card_photo')->nullable();
            $table->longText('remarks')->nullable();
            $table->string('status')->nullable()->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poetry_competition_applications');
    }
};
