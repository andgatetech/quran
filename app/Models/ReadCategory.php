<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReadCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'competition_type_id',
    ];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
