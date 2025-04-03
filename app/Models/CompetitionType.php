<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompetitionType extends Model
{

        /**
     * The table associated with the model.
     */
    protected $table = 'competition_types';

    protected $fillable = [
        'name',
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

    public function competition()
    {
        return $this->hasMany(Competition::class);
    }
}   
