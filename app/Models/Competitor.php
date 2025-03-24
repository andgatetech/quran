<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competitor extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'competitors';

    /**
     * The primary key type.
     */
    protected $keyType = 'int';

    /**
     * Indicates if the IDs are auto-incrementing.
     */
    public $incrementing = true;

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = ['id'];

    /**
     * The results for the competitor.
     */
    public function results()
    {
        return $this->hasMany(Result::class);
    }

    /**
     * The ranking for the competitor.
     */
    public function ranking()
    {
        return $this->hasOne(Ranking::class, 'competitor_id');
    }

    /**
     * The side category associated with the competitor.
     */
    public function ageCategory()
    {
        return $this->belongsTo(AgeCategory::class, 'age_category_id');
    }

    public function sideCategory()
    {
        return $this->belongsTo(SideCategory::class, 'side_category_id');
    }

    public function readCategory()
    {
        return $this->belongsTo(ReadCategory::class, 'read_category_id');
    }

    public function competition()
    {
        return $this->belongsTo(Competition::class, 'competition_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'side_category_id', 'side_category_id')
            ->where('age_category_id', $this->age_category_id)
            ->where('read_category_id', $this->read_category_id);
    }


}
