<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShowUserQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'competitor_id',
        'competition_id',
        'text',
        'status',
    ];
}
