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
        'from_date',
        'to_date',
        'encrypted_id'
    ];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
