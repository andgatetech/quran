<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    protected $fillable =[
            'competition_id',
            'question_name',
            'option_name',
            'dead_line',
            'url',
            
    ];


    public function competitionName()
    {
        return $this->hasMany(Competition::class,'id','competition_id');
    }

    public function questionAnswer()
    {
        return $this->hasMany(QuizQuestionAnswer::class,'question_id','id');
    }
    
}
