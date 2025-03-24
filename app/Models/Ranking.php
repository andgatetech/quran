<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{
    use HasFactory;

    protected $fillable = ['competitor_id', 'competition_id', 'rank', 'status'];

    public function competitor()
    {
        return $this->belongsTo(Competitor::class);
    }

    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }
}
