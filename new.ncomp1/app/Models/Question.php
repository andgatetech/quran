<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'questions';

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
     * Get the age category associated with the question.
     */
    public function ageCategory()
    {
        return $this->belongsTo(AgeCategory::class, 'age_category_id');
    }

    /**
     * Get the side category associated with the question.
     */
    public function sideCategory()
    {
        return $this->belongsTo(SideCategory::class, 'side_category_id');
    }

    /**
     * Get the read category associated with the question.
     */
    public function readCategory()
    {
        return $this->belongsTo(ReadCategory::class, 'read_category_id');
    }

    /**
     * Get the competition associated with the question.
     */

    /**
     * Get the competitor associated with the question.
     */
    public function competitor()
    {
        return $this->belongsTo(Competitor::class, 'side_category_id', 'side_category_id')
                    ->where('age_category_id', $this->age_category_id)
                    ->where('read_category_id', $this->read_category_id);
    }
    public function competition()
    {
        return $this->belongsTo(Competition::class, 'competition_id');
    }
}
