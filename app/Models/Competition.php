<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;

    protected $fillable = [
        'competition_type_id',
        'user_id',
        'main_name',
        'sub_name',
        'status',
        'url',
        'start_date',
        'end_date',
        'no_of_days',
        'encrypted_id',
        'curriculum', // Add this
        'rules', // Add this
    ];

    public function competionType()
    {
        return $this->belongsTo(CompetitionTypes::class, 'competition_type_id');
    }

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
