<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
        'competitor_id',
        'competition_id',
        'judge_id',
        'point_category_id',
        'total_points',
        'gained_points',
        'status',
    ];

    /**
     * The point category associated with the result.
     */
    public function pointCategory()
    {
        return $this->belongsTo(PointCategory::class, 'point_category_id');
    }
}

