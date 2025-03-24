<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Competition;
use App\Models\SideCategory;
use App\Models\ReadCategory;
use App\Models\AgeCategory;
use App\Models\PointCategory;
use App\Models\Competitor;
use App\Models\Judge;
use App\Models\Sponsor;
use App\Models\Host; // Add Host model
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Insert records into 'users' table
        DB::table('users')->insert([
            [
                'user_name' => 'John Doe',
                'user_role' => 'user',
                'email' => 'a@a',
                'password' => Hash::make('a'),
                'address' => '123 Main Street, Cityville',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'Jane Smith',
                'user_role' => 'user',
                'email' => 'b@b',
                'password' => Hash::make('a'),
                'address' => '456 Elm Street, Townsville',
                'status' => 'deactive',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'Jane Smith',
                'user_role' => 'admin',
                'email' => 'admin@123',
                'password' => Hash::make('a'),
                'address' => '456 Elm Street, Townsville',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Insert 2 records into 'competitions'
         // Create Competitions
    $competition1 = Competition::create([
        'user_id' => 1,
        'main_name' => 'Quran Competition 2024',
        'sub_name' => 'Category A',
    ]);

    $competition2 = Competition::create([
        'user_id' => 2,
        'main_name' => 'Quran Competition 2024',
        'sub_name' => 'Category B',
    ]);

    // Create Point Categories
    $pointCategory1 = PointCategory::create([
        'user_id' => 1,
        'name' => 'Point Category 1',
        'total_points' => 100,
        'deduction_amount' => 5.00,
    ]);

    $pointCategory2 = PointCategory::create([
        'user_id' => 2,
        'name' => 'Point Category 2',
        'total_points' => 120,
        'deduction_amount' => 10.00,
    ]);

    // Create Judges
// Seeding Judges with two point categories for Judge 1
$judge1 = Judge::create([
    'full_name' => 'Judge One',
    'id_card_number' => '111223344',
    'address' => 'Judge Address 1',
    'island_city' => 'City A',
    'work_office' => 'Office 1',
    'phone_number' => '1111111111',
    'competition_id' => $competition1->id,
    'point_category_id' => json_encode([$pointCategory1->id, $pointCategory2->id]), // Add both point categories to Judge 1
    'bell_option' => 'Enable',
    'email' => 'j@j',
    'password' => Hash::make('a'),
]);


$judge2 = Judge::create([
    'full_name' => 'Judge Two',
    'id_card_number' => '223344556',
    'address' => 'Judge Address 2',
    'island_city' => 'City B',
    'work_office' => 'Office 2',
    'phone_number' => '2222222222',
    'competition_id' => $competition2->id,
    'point_category_id' => json_encode([$pointCategory2->id]), // Store point categories as JSON array
    'bell_option' => 'Disable',
    'email' => 'j2@j',
    'password' => Hash::make('b'),
]);






        // Insert 2 records into 'side_categories'
        $sideCategory1 = SideCategory::create([
            'user_id' => 1,
            'name' => 'Side Category 1',
        ]);

        $sideCategory2 = SideCategory::create([
            'user_id' => 2,
            'name' => 'Side Category 2',
        ]);

        // Insert 2 records into 'read_categories'
        $readCategory1 = ReadCategory::create([
            'user_id' => 1,
            'name' => 'Read Category 1',
        ]);

        $readCategory2 = ReadCategory::create([
            'user_id' => 2,
            'name' => 'Read Category 2',
        ]);

        // Insert 2 records into 'age_categories'
        $ageCategory1 = AgeCategory::create([
            'user_id' => 1,
            'name' => 'Age Group 10-15',
        ]);

        $ageCategory2 = AgeCategory::create([
            'user_id' => 2,
            'name' => 'Age Group 16-20',
        ]);



        // Insert 2 records into 'competitors'
        $competitor1 = Competitor::create([
            'full_name' => 'Competitor One',
            'id_card_number' => '123456789',
            'address' => 'Address 1',
            'island_city' => 'City 1',
            'school_name' => 'School 1',
            'parent_name' => 'Parent One',
            'phone_number' => '0123456789',
            'competition_id' => $competition1->id,
            'side_category_id' => $sideCategory1->id,
            'read_category_id' => $readCategory1->id,
            'age_category_id' => $ageCategory1->id,
            'number_of_questions' => 10,
            'status' => 'ready',
            'position' => '2',

        ]);

        $competitor2 = Competitor::create([
            'full_name' => 'Competitor Two',
            'id_card_number' => '987654321',
            'address' => 'Address 2',
            'island_city' => 'City 2',
            'school_name' => 'School 2',
            'parent_name' => 'Parent Two',
            'phone_number' => '0987654321',
            'competition_id' => $competition2->id,
            'side_category_id' => $sideCategory2->id,
            'read_category_id' => $readCategory2->id,
            'age_category_id' => $ageCategory2->id,
            'number_of_questions' => 12,
            'status' => 'performed',
            'position' => '1',

        ]);

        // Insert 2 records into 'judges'



        DB::table('questions')->insert([
            [
                'competition_id' => 1,
                'question_name' => 'Recite Ayat 1-5 of Surah Al-Fatiha',
                'age_category_id' => 1,
                'side_category_id' => 2,
                'read_category_id' => 3,
                'book_number' => 1,
                'surah' => 1,
                'from_ayat_number' => 1,
                'to_ayat_number' => 5,
                'hardness' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'competition_id' => 2,
                'question_name' => 'Explain the meaning of Ayat 255 of Surah Al-Baqarah',
                'age_category_id' => 2,
                'side_category_id' => 3,
                'read_category_id' => 4,
                'book_number' => 2,
                'surah' => 2,
                'from_ayat_number' => 255,
                'to_ayat_number' => 255,
                'hardness' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'competition_id' => 1,
                'question_name' => 'Recite and translate Ayat 10-15 of Surah Yasin',
                'age_category_id' => 3,
                'side_category_id' => 1,
                'read_category_id' => 5,
                'book_number' => 30,
                'surah' => 36,
                'from_ayat_number' => 10,
                'to_ayat_number' => 15,
                'hardness' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Insert 2 records into 'sponsors'
        $sponsor1 = Sponsor::create([
            'name' => 'Sponsor One',
            'competition_id' => $competition1->id,
            'logo' => 'logo1.png',
        ]);

        $sponsor2 = Sponsor::create([
            'name' => 'Sponsor Two',
            'competition_id' => $competition2->id,
            'logo' => 'logo2.png',
        ]);

        // Insert 3 records into 'hosts' table
        DB::table('hosts')->insert([
            [
                'competition_id' => 1,
                'host_id' => 'a1',
                'password' => Hash::make('a'),

                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'competition_id' => 2, // Assuming competition with ID 2 exists
                'host_id' => '2',
                'password' => Hash::make('a'),

                'status' => 'done',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'competition_id' => 3, // Assuming competition with ID 3 exists
                'host_id' => '3',
                'password' => Hash::make('a'),

                'status' => 'done',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);


        DB::table('question_child')->insert([
            [
                'question_id' => 1,
                'competitor_id' => 2,
                'competition_id' => 1,
                'status' => 'active',
            ],
            [
                'question_id' => 1,
                'competitor_id' => 3,
                'competition_id' => 1,
                'status' => 'inactive',
            ],
            [
                'question_id' => 1,
                'competitor_id' => 4,
                'competition_id' => 2,
                'status' => 'active',
            ]
        ]);
    }
}
