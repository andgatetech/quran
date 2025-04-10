<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuranJuzSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $juzData = [
        //     ['id' => 1, 'book_name' => 'Al-Fatiha & Al-Baqarah 1-141', 'total_ayah' => 148],
        //     ['id' => 2, 'book_name' => 'Al-Baqarah 142-252', 'total_ayah' => 111],
        //     ['id' => 3, 'book_name' => 'Al-Baqarah 253 - Al-Imran 92', 'total_ayah' => 200],
        //     ['id' => 4, 'book_name' => 'Al-Imran 93 - An-Nisa 23', 'total_ayah' => 176],
        //     ['id' => 5, 'book_name' => 'An-Nisa 24-147', 'total_ayah' => 120],
        //     ['id' => 6, 'book_name' => 'An-Nisa 148 - Al-Anam 110', 'total_ayah' => 165],
        //     ['id' => 7, 'book_name' => 'Al-Anam 111 - Al-Araf 87', 'total_ayah' => 206],
        //     ['id' => 8, 'book_name' => 'Al-Araf 88 - Al-Anfal 40', 'total_ayah' => 145],
        //     ['id' => 9, 'book_name' => 'Al-Anfal 41 - At-Tawbah 92', 'total_ayah' => 129],
        //     ['id' => 10, 'book_name' => 'At-Tawbah 93 - Hud 5', 'total_ayah' => 109],
        //     ['id' => 11, 'book_name' => 'Hud 6 - Yusuf 52', 'total_ayah' => 123],
        //     ['id' => 12, 'book_name' => 'Yusuf 53 - Ibrahim 52', 'total_ayah' => 111],
        //     ['id' => 13, 'book_name' => 'Al-Hijr 1 - An-Nahl 128', 'total_ayah' => 154],
        //     ['id' => 14, 'book_name' => 'Al-Isra 1 - Al-Kahf 74', 'total_ayah' => 227],
        //     ['id' => 15, 'book_name' => 'Al-Kahf 75 - Ta-Ha 135', 'total_ayah' => 185],
        //     ['id' => 16, 'book_name' => 'Al-Anbiya 1 - Al-Hajj 78', 'total_ayah' => 269],
        //     ['id' => 17, 'book_name' => 'Al-Muminun 1 - Al-Furqan 20', 'total_ayah' => 158],
        //     ['id' => 18, 'book_name' => 'Al-Furqan 21 - An-Naml 55', 'total_ayah' => 174],
        //     ['id' => 19, 'book_name' => 'An-Naml 56 - Al-Ankabut 45', 'total_ayah' => 159],
        //     ['id' => 20, 'book_name' => 'Al-Ankabut 46 - Al-Ahzab 30', 'total_ayah' => 173],
        //     ['id' => 21, 'book_name' => 'Al-Ahzab 31 - Ya-Sin 27', 'total_ayah' => 178],
        //     ['id' => 22, 'book_name' => 'Ya-Sin 28 - Az-Zumar 31', 'total_ayah' => 169],
        //     ['id' => 23, 'book_name' => 'Az-Zumar 32 - Fussilat 46', 'total_ayah' => 176],
        //     ['id' => 24, 'book_name' => 'Fussilat 47 - Al-Jathiya 37', 'total_ayah' => 173],
        //     ['id' => 25, 'book_name' => 'Al-Ahqaf 1 - Az-Zariyat 30', 'total_ayah' => 178],
        //     ['id' => 26, 'book_name' => 'Az-Zariyat 31 - Al-Hadid 29', 'total_ayah' => 165],
        //     ['id' => 27, 'book_name' => 'Al-Mujadila 1 - At-Tahrim 12', 'total_ayah' => 170],
        //     ['id' => 28, 'book_name' => 'Al-Talaq 1 - Al-Mursalat 50', 'total_ayah' => 172],
        //     ['id' => 29, 'book_name' => 'An-Naba 1 - Al-Nas 6', 'total_ayah' => 169],
        //     ['id' => 30, 'book_name' => 'Short Surahs (Part 30)', 'total_ayah' => 564],
        // ];

        $juzData = [
            ['id' => 1, 'book_name' => 'Alif Lam Meem', 'total_ayah' => 148],
            ['id' => 2, 'book_name' => 'Sayaqool', 'total_ayah' => 111],
            ['id' => 3, 'book_name' => 'Tilkal Rusul', 'total_ayah' => 200],
            ['id' => 4, 'book_name' => 'Lan Tana Loo', 'total_ayah' => 176],
            ['id' => 5, 'book_name' => 'Wal Mohsanat', 'total_ayah' => 120],
            ['id' => 6, 'book_name' => 'La Yuhibbullah', 'total_ayah' => 165],
            ['id' => 7, 'book_name' => 'AWa Iza Samiu', 'total_ayah' => 206],
            ['id' => 8, 'book_name' => 'Wa Lau Annana', 'total_ayah' => 145],
            ['id' => 9, 'book_name' => 'Qalal Malao', 'total_ayah' => 129],
            ['id' => 10, 'book_name' => "Wa A'lamu", 'total_ayah' => 109],
            ['id' => 11, 'book_name' => 'Yatazeroon', 'total_ayah' => 123],
            ['id' => 12, 'book_name' => "Wa Mamin Da'abat", 'total_ayah' => 111],
            ['id' => 13, 'book_name' => 'Wa Ma Ubrioo', 'total_ayah' => 154],
            ['id' => 14, 'book_name' => 'Rubama', 'total_ayah' => 227],
            ['id' => 15, 'book_name' => 'Subhanallazi', 'total_ayah' => 185],
            ['id' => 16, 'book_name' => 'Qal Alam', 'total_ayah' => 269],
            ['id' => 17, 'book_name' => 'Aqtarabo', 'total_ayah' => 158],
            ['id' => 18, 'book_name' => 'Qadd Aflaha', 'total_ayah' => 174],
            ['id' => 19, 'book_name' => "Wa Qalallazina", 'total_ayah' => 159],
            ['id' => 20, 'book_name' => "A'man Khalaq", 'total_ayah' => 173],
            ['id' => 21, 'book_name' => 'Utlu Ma Oohi', 'total_ayah' => 178],
            ['id' => 22, 'book_name' => 'Wa Manyaqnut', 'total_ayah' => 169],
            ['id' => 23, 'book_name' => 'Wa Mali', 'total_ayah' => 176],
            ['id' => 24, 'book_name' => 'Faman Azlam', 'total_ayah' => 173],
            ['id' => 25, 'book_name' => 'Elahe Yuruddo', 'total_ayah' => 178],
            ['id' => 26, 'book_name' => "Ha'a Meem", 'total_ayah' => 165],
            ['id' => 27, 'book_name' => 'Qala Fama Khatbukum', 'total_ayah' => 170],
            ['id' => 28, 'book_name' => 'Qadd Sami Allah', 'total_ayah' => 172],
            ['id' => 29, 'book_name' => 'Tabarakallazi', 'total_ayah' => 169],
            ['id' => 30, 'book_name' => "Amma Yatasa'aloon", 'total_ayah' => 564],
        ];
        foreach ($juzData as $juz) {
            Book::create($juz);
        }
    }
}
