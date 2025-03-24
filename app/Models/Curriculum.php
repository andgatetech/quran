<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
 
    /**
     * The table associated with the model.
     */
    protected $table = 'curriculum';

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
}
