<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;

    protected $fillable = [
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

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
