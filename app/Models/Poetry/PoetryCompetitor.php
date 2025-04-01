<?php

namespace App\Models\Poetry;

use Illuminate\Database\Eloquent\Model;

class PoetryCompetitor extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'poetry_competitors';

    protected $fillable = [
        'full_name',
        'full_name_dhivehi',
        'id_card_number',
        'address',
        'island_city',
        'school_name',
        'parent_name',
        'phone_number',
        'competition_id',
        'side_category_id',
        'read_category_id',
        'age_category_id',
        'number_of_questions',
        'status',
        'position',
    ];

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
        return $this->belongsTo(PoetryAgeCategory::class, 'age_category_id');
    }

    public function sideCategory()
    {
        return $this->belongsTo(PoetrySideCategory::class, 'side_category_id');
    }

    public function readCategory()
    {
        return $this->belongsTo(PoetryReadCategory::class, 'read_category_id');
    }

    public function competition()
    {
        return $this->belongsTo(PoetryCompetition::class, 'competition_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'side_category_id', 'side_category_id')
            ->where('age_category_id', $this->age_category_id)
            ->where('read_category_id', $this->read_category_id);
    }


}
