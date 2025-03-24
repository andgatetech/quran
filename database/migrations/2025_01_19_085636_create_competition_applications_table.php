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
        Schema::create('competition_applications', function (Blueprint $table) {
            $table->id();
            $table->integer('competition_id');
            $table->string('name');
            $table->string('id_card');
            $table->string('permanent_address');
            $table->string('current_address');
            $table->string('city');
            $table->date('dob');
            $table->integer('age');
            $table->string('organization');
            $table->string('parent_name')->nullable()->default(null);
            $table->string('number');
            $table->integer('age_category');
            $table->integer('side_category');
            $table->integer('read_category');
            $table->string('photo')->nullable()->default(null);
            $table->string('id_card_photo')->nullable()->default(null);
            $table->longText('remarks')->nullable()->default(null);
            $table->string('status')->nullable()->default('Pending');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competition_applications');
    }
};
