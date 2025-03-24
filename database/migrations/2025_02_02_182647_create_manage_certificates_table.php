<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('manage_certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('competition_id')->constrained()->onDelete('cascade');
            $table->integer('signature_count');
            $table->integer('option');
            $table->integer('template');
            $table->date('award_date');
            $table->string('authorize_person_1')->nullable();
            $table->string('signature_1')->nullable();
            $table->string('designation_1')->nullable();
            $table->string('authorize_person_2')->nullable();
            $table->string('signature_2')->nullable();
            $table->string('designation_2')->nullable();
            $table->string('office_logo')->nullable();
            $table->string('office_stamp')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('manage_certificates');
    }
};
