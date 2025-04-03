<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompetitionTypes extends Model
{
    protected $fillable =[
            'name',
    ];
    public function competition()
    {
        return $this->hasMany(Competition::class);
    }
}   
