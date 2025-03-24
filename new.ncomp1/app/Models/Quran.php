<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quran extends Model
{
    use HasFactory;

    // Specify the table name
    protected $table = 'the_quran_dataset';
    /**
     * The primary key type.
     */
    protected $keyType = 'int';

    /**
     * Indicates if the IDs are auto-incrementing.
     */
    public $incrementing = true;

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = ['id'];


    // Define the fields you want to access
    protected $fillable = [
        'surah_no',
        'surah_name_ar',
        'surah_name_roman',
        'ayah_no_surah',
        'ayah_no_quran',
        'ayah_no_juzz',
        'ayah_ar',
        'ayah_en',
        'ruko_no',
        'juz_no',

    ];

    // Disable timestamps if your table does not have them
    public $timestamps = false;
}
