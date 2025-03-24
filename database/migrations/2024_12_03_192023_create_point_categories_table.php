<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('point_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign key to users table
            $table->string('name');
            $table->integer('total_points');
            $table->decimal('deduction_amount', 8, 2);
            $table->timestamps();

        });

    }


    public function down(): void {
        Schema::dropIfExists('point_categories');
    }
};
