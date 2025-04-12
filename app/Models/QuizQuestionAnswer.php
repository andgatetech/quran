<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizQuestionAnswer extends Model
{
    protected $fillable =[
        'question_id',
        'answer_name',       
    ];
    
}
