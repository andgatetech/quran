<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFullNameToCompetitorsTable extends Migration
{
    public function up()
    {
        // Check if the column already exists before adding it
        if (!Schema::hasColumn('competitors', 'full_name')) {
            Schema::table('competitors', function (Blueprint $table) {
                $table->string('full_name')->nullable();  // Add full_name column
            });
        }
    }

    public function down()
    {
        // Drop the columns without checking if they exist, because the migration assumes they exist
        Schema::table('competitors', function (Blueprint $table) {
            $table->dropColumn('full_name');  // Drop full_name column
        });
    }
}
