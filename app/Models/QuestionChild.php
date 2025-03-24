<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionChild extends Model
{
    use HasFactory;

    
    protected $table = 'question_child';


    protected $fillable = [
        'question_id',
        'competitor_id',
        'competition_id',
        'status'
    ];


    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function competitor()
    {
        return $this->belongsTo(Competitor::class);
    }

    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }
}
