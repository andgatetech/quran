<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BellNotification extends Model
{
    use HasFactory;

    protected $fillable = ['competitor_id', 'competition_id','judge_id', 'is_active'];
    public function competitor()
    {
        return $this->belongsTo(Competitor::class, 'competitor_id');
    }

    public function competition()
    {
        return $this->belongsTo(Competition::class, 'competition_id');
    }
}
