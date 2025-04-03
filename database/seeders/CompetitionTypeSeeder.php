<?php

namespace Database\Seeders;

use App\Models\CompetitionType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompetitionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CompetitionType::insert([
            ['name' => 'Quran'],
            ['name' => 'Poetry'],
            ['name' => 'Quiz'],
        ]);
    }
}
